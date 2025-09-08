<?php

namespace App\Http\Controllers\Admin\Dashboard;

use Carbon\Carbon;
use App\Models\Expense;
use App\Models\Partner;
use Illuminate\Http\Request;

use App\Models\FeeSubmission;
use App\Models\PartnerProfit;
use App\Models\PartnerBalance;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\PartnerProfitHistory;
use Illuminate\Support\Facades\Auth;

class PartnerProfitController extends Controller
{
    /**
     * List partner profits with month/year filters + show derived "settled" and "due".
     * Also compute month summary: total fees, expenses, net.
     */
    public function index(Request $request)
    {
        $month = (int) ($request->input('month') ?: now()->month);
        $year  = (int) ($request->input('year')  ?: now()->year);

        $start = Carbon::create($year, $month, 1)->startOfDay();
        $end   = (clone $start)->endOfMonth()->endOfDay();

        // Month summary (optional)
        $totalFees = (float) FeeSubmission::whereBetween('created_at', [$start, $end])->sum('amount');
        $totalExpenses = (float) Expense::whereBetween('date', [$start->toDateString(), $end->toDateString()])
            ->sum(DB::raw('CAST(amount AS DECIMAL(12,2))'));
        $netProfit = $totalFees - $totalExpenses;

        // base query
        $query = PartnerProfit::with('partner')
            ->where('month', $month)
            ->where('year',  $year);

        // ✅ Restrict to only logged-in partner
        if (Auth::user()->role === 'partner') {
            $query->whereHas('partner', function ($q) {
                $q->where('email', Auth::user()->email);
            });
        }

        $profits = $query->orderBy('partner_id')
            ->get()
            ->map(function ($p) {
                // Settled = PAID only (NOT balance)
                $paid = (float) PartnerProfitHistory::where('partner_id', $p->partner_id)
                    ->where('month', $p->month)
                    ->where('year',  $p->year)
                    ->where('status', 'paid')
                    ->sum('amount');

                // Balance amount (unpaid carry-forward)
                $balanceAmt = (float) PartnerBalance::where('partner_id', $p->partner_id)
                    ->where('month', $p->month)
                    ->where('year',  $p->year)
                    ->sum('amount');

                $p->settled = $paid;
                $p->balance_amount = $balanceAmt;
                $p->due = max(0, (float)$p->amount - $paid - $balanceAmt);

                // Derived status
                if ($p->due > 0) {
                    $p->derived_status = 'unpaid';
                } elseif ($balanceAmt > 0) {
                    $p->derived_status = 'balance';
                } else {
                    $p->derived_status = 'paid';
                }

                return $p;
            });

        return view('admin.pages.dashboard.partners.partner_profits.index', [
            'profits'       => $profits,
            'selectedMonth' => $month,
            'selectedYear'  => $year,
            'summary'       => [
                'fees'      => $totalFees,
                'expenses'  => $totalExpenses,
                'netProfit' => $netProfit,
            ],
        ]);
    }


    public function generateMonthlyProfit(Request $request)
    {
        $month = (int) ($request->input('month') ?: now()->month);
        $year  = (int) ($request->input('year')  ?: now()->year);

        $start = Carbon::create($year, $month, 1)->startOfDay();
        $end   = (clone $start)->endOfMonth()->endOfDay();

        $totalFees = (float) FeeSubmission::whereBetween('created_at', [$start, $end])->sum('amount');

        $totalExpenses = (float) Expense::whereBetween('date', [$start->toDateString(), $end->toDateString()])
            ->sum(DB::raw('CAST(amount AS DECIMAL(12,2))'));

        $netProfit = $totalFees - $totalExpenses; // allow negative

        DB::transaction(function () use ($month, $year, $netProfit) {
            $partners = Partner::all();

            foreach ($partners as $partner) {
                $newAmount = round(($partner->percentage / 100) * $netProfit, 2);

                $profit = PartnerProfit::firstOrNew([
                    'partner_id' => $partner->id,
                    'month'      => $month,
                    'year'       => $year,
                ]);

                $oldAmount = (float) ($profit->exists ? $profit->amount : 0);
                $profit->amount = $newAmount; // store total share (can be negative)
                // don't change status here
                $profit->save();

                // Optional history to record recalculation
                $status = ($profit->wasRecentlyCreated) ? 'calculated'
                    : (($newAmount > $oldAmount) ? 'increment' : (($newAmount < $oldAmount) ? 'decrement' : 'unchanged'));

                PartnerProfitHistory::create([
                    'partner_profit_id' => $profit->id,
                    'partner_id'        => $partner->id,
                    'month'             => $month,
                    'year'              => $year,
                    'status'            => $status,
                    'amount'            => abs($newAmount - $oldAmount),
                    'note'              => 'Generate monthly: total share updated to ' . $newAmount,
                    'performed_by'      => auth()->id(),
                    'performed_at'      => now(),
                ]);
            }
        });

        return back()->with('store', "Profits recalculated for {$start->format('F')} {$year}.");
    }

    /**
     * Mark current DUE as paid (computed on-the-fly). If no due, show info message.
     */
    public function markAsPaid($id)
    {
        $profit = PartnerProfit::with('partner')->findOrFail($id);

        // Compute current due from histories
        $settled = (float) PartnerProfitHistory::where('partner_id', $profit->partner_id)
            ->where('month', $profit->month)
            ->where('year',  $profit->year)
            ->whereIn('status', ['paid', 'balance'])
            ->sum('amount');

        $due = max(0, (float)$profit->amount - $settled);

        if ($due <= 0) {
            return back()->with('info', 'Nothing due for this partner in this month.');
        }

        DB::transaction(function () use ($profit, $due) {
            // Create expense (no dedupe so multiple payments possible; to dedupe, use history id after create)
            Expense::create([
                'title'   => 'Partner Profit Payout',
                'amount'  => (string) $due,
                'date'    => now()->toDateString(),
                'purpose' => 'Payout for ' . $profit->partner->name,
                'type'    => 'essential',
                'ref_type' => 'partner_profit_payment',
                'ref_id'  => $profit->id, // optional
            ]);

            // History as the source of truth for "settled"
            PartnerProfitHistory::create([
                'partner_profit_id' => $profit->id,
                'partner_id'        => $profit->partner_id,
                'month'             => $profit->month,
                'year'              => $profit->year,
                'status'            => 'paid',
                'amount'            => $due,
                'note'              => 'Paid against current due.',
                'performed_by'      => auth()->id(),
                'performed_at'      => now(),
            ]);

            // Optional: set stored status (UI derives status anyway)
            $profit->status = 'paid';
            $profit->save();
        });

        return back()->with('success', 'Profit marked as paid.');
    }

    /**
     * Move current DUE to balance. If no due, show info message.
     */
    public function moveToBalance($id)
    {
        $profit = PartnerProfit::findOrFail($id);

        // How much is already PAID this cycle? (paid-only)
        $paid = (float) PartnerProfitHistory::where('partner_id', $profit->partner_id)
            ->where('month', $profit->month)
            ->where('year',  $profit->year)
            ->where('status', 'paid')
            ->sum('amount');

        // How much is already moved to BALANCE this cycle?
        $balanced = (float) PartnerBalance::where('partner_id', $profit->partner_id)
            ->where('month', $profit->month)
            ->where('year',  $profit->year)
            ->sum('amount');

        // Current due = total share - paid - balanced
        $due = max(0, (float) $profit->amount - $paid - $balanced);

        if ($due <= 0) {
            return back()->with('info', 'Nothing to move to balance for this partner in this month.');
        }

        DB::transaction(function () use ($profit, $due) {
            // Upsert per-cycle balance (NO history here)
            $balance = PartnerBalance::firstOrNew([
                'partner_id' => $profit->partner_id,
                'month'      => $profit->month,
                'year'       => $profit->year,
            ]);
            $balance->amount = (float) ($balance->amount ?? 0) + $due;
            $balance->status = 'balance';
            $balance->save();

            // Update profit row state (optional; UI derives from balance amount anyway)
            $profit->status = 'balance';
            $profit->save();
        });

        return back()->with('store', 'Amount moved to partner balance.');
    }



    /**
     * Balances index (unchanged from earlier).
     */
    public function balanceIndex()
    {
        $query = PartnerBalance::with('partner')->orderByDesc('updated_at');

        if (Auth::user()->role === 'partner') {
            $query->whereHas('partner', function ($q) {
                $q->where('email', Auth::user()->email);
            });
        }

        $balances = $query->get();

        return view('admin.pages.dashboard.partners.partner_profits.balance', compact('balances'));
    }


    public function history(Request $request, $partner_id)
    {
        // Optional filters
        $month = $request->input('month');
        $year  = $request->input('year');

        $partner = Partner::find($partner_id);

        $histories = PartnerProfitHistory::with([
            'profit.partner',
            'performedBy' // make sure relation exists on the model
        ])
            ->where('partner_id', $partner_id)
            ->when($month, fn($q) => $q->where('month', (int)$month))
            ->when($year,  fn($q) => $q->where('year',  (int)$year))
            // prefer performed_at if present; then created_at
            ->orderByDesc(DB::raw('COALESCE(performed_at, created_at)'))
            ->get();

        return view('admin.pages.dashboard.partners.partner_profits.history', [
            'histories'   => $histories,
            'partnerName' => $partner?->name ?? 'Partner',
            'selectedMonth' => $month,
            'selectedYear'  => $year,
        ]);
    }
    // PartnerProfitController.php
    public function fullHistory(Request $request)
    {
        $month  = $request->input('month');
        $year   = $request->input('year');
        $search = $request->input('search');

        $query = PartnerProfitHistory::with(['profit.partner', 'performedBy'])
            ->when($month, fn($q) => $q->where('month', (int) $month))
            ->when($year,  fn($q) => $q->where('year',  (int) $year))
            ->when($search, function ($q) use ($search) {
                // search within partner name
                $q->whereHas('profit.partner', function ($p) use ($search) {
                    $p->where('name', 'like', '%' . $search . '%');
                });
            })
            ->whereIn('status', ['paid', 'balance'])
            ->orderByDesc(DB::raw('COALESCE(performed_at, created_at)'));

        // ✅ If the logged-in user is a partner, only show THEIR history
        if (Auth::user()->role === 'partner') {
            $query->whereHas('profit.partner', function ($p) {
                $p->where('email', Auth::user()->email);
            });
        }

        $histories = $query
            ->paginate(15)
            ->appends($request->query());

        return view('admin.pages.dashboard.partners.partner_profits.full_history', compact('histories'));
    }
}
