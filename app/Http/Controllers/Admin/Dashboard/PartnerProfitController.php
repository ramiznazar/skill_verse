<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\Partner;
use Illuminate\Http\Request;

use App\Models\PartnerProfit;
use App\Models\ProfitCalculation;
use App\Models\PartnerBalance;
use App\Models\PartnerProfitHistory;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;



class PartnerProfitController extends Controller
{
    /**
     * Show recent profits (last 10 minutes).
     */
    public function index(Request $request)
    {
        $query = PartnerProfit::with(['partner', 'calculation'])
            ->where('created_at', '>=', now()->subMinutes(10));

        if ($request->month) {
            $query->whereHas('calculation', fn($q) => $q->where('month', $request->month));
        }

        if ($request->year) {
            $query->whereHas('calculation', fn($q) => $q->where('year', $request->year));
        }

        $profits = $query->orderByDesc('created_at')->get();

        return view('admin.pages.dashboard.partners.partner_profits.index', [
            'profits' => $profits,
            'selectedMonth' => $request->month,
            'selectedYear' => $request->year,
        ]);
    }

    /**
     * Generate or update monthly profits.
     */
    public function generateMonthlyProfit()
    {
        $month = now()->month;
        $year = now()->year;

        $calculation = ProfitCalculation::where('month', $month)
            ->where('year', $year)
            ->first();

        if (!$calculation) {
            return back()->with('error', 'First calculate the monthly profit.');
        }

        DB::transaction(function () use ($calculation) {
            $partners = Partner::all();

            foreach ($partners as $partner) {
                $existing = PartnerProfit::where('partner_id', $partner->id)
                    ->where('profit_calculation_id', $calculation->id)
                    ->first();

                $profitAmount = ($partner->percentage / 100) * $calculation->net_profit;

                if ($existing) {
                    $existing->update([
                        'amount' => $profitAmount,
                        'status' => 'unpaid',
                        'created_at' => now(), // 👈 Refresh timestamp for 10-min window
                    ]);

                    PartnerProfitHistory::create([
                        'partner_profit_id' => $existing->id,
                        'action' => 'updated',
                        'amount' => $profitAmount,
                        'note' => 'Profit updated for existing entry.',
                    ]);
                } else {
                    $partnerProfit = PartnerProfit::create([
                        'partner_id' => $partner->id,
                        'profit_calculation_id' => $calculation->id,
                        'amount' => $profitAmount,
                        'status' => 'unpaid',
                        'created_at' => now(),
                    ]);

                    PartnerProfitHistory::create([
                        'partner_profit_id' => $partnerProfit->id,
                        'action' => 'calculated',
                        'amount' => $profitAmount,
                        'note' => 'Monthly profit calculated.',
                    ]);
                }
            }
        });

        return back()->with('store', 'Monthly partner profits generated/updated successfully.');
    }

    /**
     * Mark profit as paid.
     */
    public function markAsPaid($id)
    {
        $profit = PartnerProfit::findOrFail($id);
        $profit->update(['status' => 'paid']);

        PartnerProfitHistory::create([
            'partner_profit_id' => $profit->id,
            'action' => 'marked_paid',
            'amount' => $profit->amount,
            'note' => 'Marked as paid manually.',
        ]);

        return redirect()->back()->with('success', 'Profit marked as paid successfully.');
    }

    /**
     * Move profit to partner balance.
     */
    public function moveToBalance($id)
    {
        DB::transaction(function () use ($id) {
            $profit = PartnerProfit::findOrFail($id);

            if ($profit->status !== 'unpaid') {
                throw new \Exception('Only unpaid profits can be moved to balance.');
            }

            $partner = $profit->partner;

            $balance = PartnerBalance::firstOrCreate(
                ['partner_id' => $partner->id],
                ['total_balance' => 0]
            );

            $balance->increment('total_balance', $profit->amount);
            $profit->update(['status' => 'balance']);

            PartnerProfitHistory::create([
                'partner_profit_id' => $profit->id,
                'action' => 'moved_to_balance',
                'amount' => $profit->amount,
                'note' => 'Profit moved to balance.',
            ]);
        });

        return back()->with('store', 'Profit successfully moved to partner balance.');
    }

    /**
     * Show history for specific profit.
     */
public function fullHistory()
{
    $histories = PartnerProfitHistory::with(['profit.partner', 'profit.calculation'])
        ->when(request('month'), fn($q) => $q->whereHas('profit.calculation', fn($q) => $q->where('month', request('month'))))
        ->when(request('year'), fn($q) => $q->whereHas('profit.calculation', fn($q) => $q->where('year', request('year'))))
        ->when(request('search'), fn($q) => $q->whereHas('profit.partner', fn($q) => $q->where('name', 'like', '%'.request('search').'%')))
        ->latest()
        ->paginate(10);

    return view('admin.pages.dashboard.partners.partner_profits.full_history', compact('histories'));
}


public function history($partner_id)
{
    $histories = PartnerProfitHistory::with(['profit.partner', 'profit.calculation'])
        ->whereHas('profit', function ($query) use ($partner_id) {
            $query->where('partner_id', $partner_id);
        })
        ->orderByDesc('created_at')
        ->get();

    $partner = Partner::find($partner_id);
    $partnerName = $partner ? $partner->name : 'Partner';

    return view('admin.pages.dashboard.partners.partner_profits.history', compact('histories', 'partnerName'));
}



    /**
     * Show all partner balances.
     */
    public function balanceIndex()
    {
        $balances = PartnerBalance::with('partner')->orderByDesc('updated_at')->get();
        return view('admin.pages.dashboard.partners.partner_profits.partner_balances', compact('balances'));
    }
}

