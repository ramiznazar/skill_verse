<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ReferralCommission;
use App\Models\ReferralCommissionHistory;

class ReferralCommissionController extends Controller
{
    public function index()
    {
        $rc = (new \App\Models\ReferralCommission)->getTable();        // referral_commissions
        $rh = (new \App\Models\ReferralCommissionHistory)->getTable(); // referral_commission_histories
        $ad = (new \App\Models\Admission)->getTable();                 // admissions

        // A) Paid totals from history (accurate after zeroing)
        $paidAgg = \App\Models\ReferralCommissionHistory::query()
            ->selectRaw('referral_name, referral_contact, SUM(amount) AS paid_total')
            ->where('status', 'paid')
            ->groupBy('referral_name', 'referral_contact');

        // B) Unpaid totals from live commissions
        $unpaidAgg = \App\Models\ReferralCommission::query()
            ->selectRaw('referral_name, referral_contact, SUM(commission_amount) AS unpaid_total')
            ->where('status', 'unpaid')
            ->groupBy('referral_name', 'referral_contact');

        // C) Students + fee + percentage math from admissions
        //    - total_students
        //    - total_student_fee (sum of full_fee once per student)
        //    - total_amount_pct = SUM(full_fee * (referral_source_commission/100))
        //    - avg_pct (fee-weighted) = SUM(full_fee * pct) / SUM(full_fee)
        $studAgg = \App\Models\Admission::query()
            ->selectRaw("
            referral_source           AS referral_name,
            referral_source_contact   AS referral_contact,
            COUNT(*)                  AS total_students,
            SUM(full_fee)             AS total_student_fee,
            SUM(full_fee * (COALESCE(referral_source_commission, 0) / 100.0))             AS total_amount_pct,
            ROUND(
                SUM(full_fee * COALESCE(referral_source_commission, 0)) / NULLIF(SUM(full_fee), 0),
                2
            )                          AS avg_pct
        ")
            ->whereNotNull('referral_source')
            ->groupBy('referral_source', 'referral_source_contact');

        // Final: base on admissions (studAgg), left-join paid & unpaid aggregates
        $referrers = DB::query()
            ->fromSub($studAgg, 's')
            ->leftJoinSub($paidAgg,  'h', function ($j) {
                $j->on('s.referral_name', '=', 'h.referral_name')
                    ->on('s.referral_contact', '=', 'h.referral_contact');
            })
            ->leftJoinSub($unpaidAgg, 'u', function ($j) {
                $j->on('s.referral_name', '=', 'u.referral_name')
                    ->on('s.referral_contact', '=', 'u.referral_contact');
            })
            ->selectRaw("
            s.referral_name,
            s.referral_contact,
            s.total_students,
            s.total_student_fee,
            s.avg_pct,
            s.total_amount_pct                              AS total_amount,        -- << show this in the table
            COALESCE(h.paid_total, 0)                       AS paid_total,
            COALESCE(u.unpaid_total, 0)                     AS unpaid_total
        ")
            ->orderByDesc('total_amount')
            ->get();

        return view('admin.pages.dashboard.referral-commission.index', compact('referrers'));
    }

    public function paid(Request $request)
    {
        $data = $request->validate([
            'referral_name'    => ['required', 'string'],
            'referral_contact' => ['nullable', 'string'],
        ]);

        $commissions = ReferralCommission::with(['admission.course', 'feeSubmission'])
            ->where('referral_name', $data['referral_name'])
            ->when(isset($data['referral_contact']) && $data['referral_contact'] !== '', function ($q) use ($data) {
                $q->where('referral_contact', $data['referral_contact']);
            })
            ->where('status', 'unpaid')
            ->get();

        if ($commissions->isEmpty()) {
            // Backend guard (no disabling in UI): nothing to pay again
            return back()->with('paid', 'No unpaid commissions found for this referrer.');
        }

        $processed = 0;

        foreach ($commissions as $commission) {
            DB::transaction(function () use ($commission) {
                $amount       = (int) $commission->commission_amount;
                $referrerName = $commission->referral_name ?? 'Unknown';

                // 1) History log
                ReferralCommissionHistory::create([
                    'referral_commission_id' => $commission->id,
                    'admission_id'           => $commission->admission_id,
                    'fee_submission_id'      => $commission->fee_submission_id,
                    'referral_name'          => $commission->referral_name,
                    'referral_contact'       => $commission->referral_contact,
                    'amount'                 => $amount,
                    'status'                 => 'paid',
                    'performed_by'           => auth()->id(),
                    'performed_at'           => now(),
                ]);

                // 2) Expense (deduped by ref_type/ref_id)
                if ($amount > 0) {
                    Expense::firstOrCreate(
                        [
                            'ref_type' => 'commission',
                            'ref_id'   => $commission->id,
                        ],
                        [
                            'title'   => 'Referral Commission',
                            'amount'  => (string) $amount,
                            'date'    => now()->toDateString(),
                            'purpose' => "Referral Commission payout to {$referrerName}",
                            'type'    => 'essential',
                        ]
                    );
                }

                // 3) Close commission
                $commission->update([
                    'status'            => 'paid',
                    'commission_amount' => 0,
                ]);
            });

            $processed++;
        }

        return back()->with('paid', "{$processed} commission(s) marked as paid. History & expenses created.");
    }

    public function history($name, $contact = null)
    {
        $query = ReferralCommission::with([
            'admission.course',
            'feeSubmission',     // ⬅️ add this
            'lastPaidHistory',   // snapshot if paid
        ])
            ->where('referral_name', $name);

        if ($contact) {
            $query->where('referral_contact', $contact);
        }

        if (request()->filled('month')) {
            $query->whereMonth('created_at', request('month'));
        }
        if (request()->filled('year')) {
            $query->whereYear('created_at', request('year'));
        }

        $commissions = $query->latest()->get();

        return view('admin.pages.dashboard.referral-commission.history', [
            'referral_name'    => $name,
            'referral_contact' => $contact,
            'commissions'      => $commissions,
        ]);
    }
}
