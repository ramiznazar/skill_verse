<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\PartnerBalance;
use App\Models\PartnerProfit;
use App\Models\PartnerProfitHistory;
use App\Models\Expense;

class PartnerBalanceController extends Controller
{
    public function statusPaid($id)
    {
        $balance = PartnerBalance::with('partner')->findOrFail($id);

        if ($balance->status === 'paid') {
            return back()->with('paid', 'Already marked as paid.');
        }

        DB::transaction(function () use ($balance) {
            $amount    = (float) $balance->amount;
            $partnerId = $balance->partner_id;
            $month     = (int) $balance->month;
            $year      = (int) $balance->year;

            if ($amount <= 0) {
                // nothing to pay; remove stale row
                $balance->delete();
                return;
            }

            // 1) Find or create the profit row for this cycle
            $profit = PartnerProfit::where('partner_id', $partnerId)
                ->where('month', $month)
                ->where('year',  $year)
                ->first();

            if (!$profit) {
                $profit = PartnerProfit::create([
                    'partner_id' => (int) $partnerId,
                    'month'      => (int) $month,
                    'year'       => (int) $year,
                    'amount'     => 0,        // safe fallback
                    'status'     => 'paid',
                ]);
            }

            // 2) Expense record
            Expense::create([
                'title'    => 'Partner Profit Payout (Balance)',
                'amount'   => (string) $amount,
                'date'     => now()->toDateString(),
                'purpose'  => 'Balance payout for ' . ($balance->partner->name ?? 'Partner'),
                'type'     => 'essential',
                'ref_type' => 'partner_balance_payment',
                'ref_id'   => $balance->id,
            ]);

            // 3) HISTORY AS PAID (this is what your Paid column sums)
            PartnerProfitHistory::create([
                'partner_profit_id' => $profit->id,
                'partner_id'        => (int) $partnerId,
                'month'             => (int) $month,
                'year'              => (int) $year,
                'status'            => 'paid',                 // <-- IMPORTANT
                'amount'            => $amount,                // amount just paid
                'note'              => 'Paid from balance.',
                'performed_by'      => auth()->id(),
                'performed_at'      => now(),
            ]);

            // 4) Remove this balance row so Balance (Rs) → 0 for this record
            $balance->delete();

            // 5) Recompute PartnerProfit.status from current totals
            $paidSum = (float) PartnerProfitHistory::where('partner_id', $partnerId)
                ->where('month', $month)
                ->where('year',  $year)
                ->where('status', 'paid')       // only paid!
                ->sum('amount');

            $remainingBalance = (float) PartnerBalance::where('partner_id', $partnerId)
                ->where('month', $month)
                ->where('year',  $year)
                ->sum('amount');

            $due = max(0, (float) $profit->amount - $paidSum - $remainingBalance);

            $profit->status = $due > 0
                ? 'unpaid'
                : ($remainingBalance > 0 ? 'balance' : 'paid');

            // Update without triggering observers that might log history
            DB::table('partner_profits')
                ->where('id', $profit->id)
                ->update([
                    'status'     => $profit->status,
                    'updated_at' => now(),
                ]);
        });

        return back()->with('paid', 'Balance paid, history & expense created, and balance entry removed.');
    }
}
