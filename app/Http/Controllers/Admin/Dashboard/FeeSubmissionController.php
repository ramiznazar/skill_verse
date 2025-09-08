<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Models\Batch;
use App\Models\Account;

use App\Models\Admission;
use Illuminate\Support\Str;
use App\Models\FeeCollector;
use Illuminate\Http\Request;
use App\Models\FeeSubmission;
use App\Models\TeacherSalary;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ReferralCommission;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\FeeSubmissionNotification;

class FeeSubmissionController extends Controller
{
    public function index()
    {
        $admissions = Admission::with(['course', 'batch'])->orderBy('joining_date', 'desc')->get();
        return view('admin.pages.dashboard.fee-submission.index', compact('admissions'));
    }
    public function create($id)
    {
        $admission = Admission::findOrFail($id);
        $submittedFees = $admission->feeSubmissions()->pluck('payment_type')->toArray();
        $accounts = Account::all();
        return view('admin.pages.dashboard.fee-submission.create', compact('admission', 'accounts', 'submittedFees'));
    }
    public function store(Request $request, $id)
    {
        // $request->validate([
        //     'fees'           => 'required|array',
        //     'fees.*'         => 'in:full_fee,installment_1,installment_2,installment_3,installment_4',
        //     'payment_method' => 'required|in:account,hand',
        //     'account_id'     => 'required_if:payment_method,account|nullable|exists:accounts,id',
        //     'collector_id'   => 'required_if:payment_method,hand|nullable|exists:fee_collectors,id',
        // ]);

        $admission = Admission::findOrFail($id);
        $totalAmountThisSubmission = 0;

        foreach ($request->fees as $feeType) {
            $amount = match ($feeType) {
                'full_fee'      => $admission->full_fee,
                'installment_1' => $admission->installment_1,
                'installment_2' => $admission->installment_2,
                'installment_3' => $admission->installment_3,
                'installment_4' => $admission->installment_4,
            };

            $alreadySubmitted = FeeSubmission::where('admission_id', $admission->id)
                ->where('payment_type', $feeType)
                ->exists();

            if (!$alreadySubmitted) {
                $feeSubmission = FeeSubmission::create([
                    'admission_id'    => $admission->id,
                    'payment_method'  => $request->payment_method,
                    'account_id'      => $request->payment_method === 'account' ? $request->account_id : null,
                    'user_id'         => $request->payment_method === 'hand' ? Auth::id() : null,
                    'payment_type'    => $feeType,
                    'amount'          => $amount,
                    'receipt_no'      => 'SKILLVERSE-RCPT-' . strtoupper(Str::random(5)) . '-' . time(),
                    'submission_date' => now(),
                ]);

                $totalAmountThisSubmission += $amount;

                // ✅ Referral commission
                if (
                    $admission->referral_source &&
                    $admission->referral_source_commission &&
                    is_numeric($admission->referral_source_commission)
                ) {
                    $commissionAmount = $amount * (floatval($admission->referral_source_commission) / 100);

                    ReferralCommission::create([
                        'admission_id'          => $admission->id,
                        'fee_submission_id'     => $feeSubmission->id,
                        'referral_name'         => $admission->referral_source,
                        'referral_contact'      => $admission->referral_source_contact,
                        'commission_percentage' => $admission->referral_source_commission,
                        'commission_amount'     => $commissionAmount,
                    ]);
                }
            }
        }

        // Update Fee Status
        $totalPaid = FeeSubmission::where('admission_id', $admission->id)->sum('amount');
        $expectedTotal = $admission->payment_type === 'full_fee'
            ? $admission->full_fee
            : ($admission->installment_1 + $admission->installment_2 + $admission->installment_3 + $admission->installment_4);

        $admission->fee_status = match (true) {
            $totalPaid == 0                   => 'pending',
            $totalPaid < $expectedTotal       => 'uncomplete',
            default                           => 'complete',
        };
        $admission->save();

        // ✅ Teacher Salary
        $batch = Batch::find($admission->batch_id);
        if ($batch && $batch->teacher_id && $totalAmountThisSubmission > 0) {
            $teacher = $batch->teacher;
            $percentage = floatval($teacher->salary ?? 0);

            $month = now()->month;
            $year  = now()->year;

            $teacherSalary = TeacherSalary::firstOrNew([
                'teacher_id' => $teacher->id,
                'month'      => $month,
                'year'       => $year,
            ]);

            // 🔁 If the previous cycle was closed (paid/balance), reopen a fresh unpaid cycle
            if (in_array(strtolower($teacherSalary->status ?? 'unpaid'), ['paid', 'balance'], true)) {
                $teacherSalary->status = 'unpaid';
                $teacherSalary->total_fee_collected = 0;
                $teacherSalary->total_students = 0;
                $teacherSalary->salary_amount = 0;
            }

            // ➕ Add current submission
            $teacherSalary->total_fee_collected = ($teacherSalary->total_fee_collected ?? 0) + $totalAmountThisSubmission;
            $teacherSalary->percentage = $percentage;
            $teacherSalary->salary_amount = (int) ($teacherSalary->total_fee_collected * ($percentage / 100));

            // Distinct students this month for this batch
            $teacherSalary->total_students = FeeSubmission::whereHas('admission', function ($q) use ($batch) {
                $q->where('batch_id', $batch->id);
            })
                ->whereMonth('submission_date', $month)
                ->whereYear('submission_date', $year)
                ->distinct('admission_id')
                ->count('admission_id');

            $teacherSalary->save();
        }
        return redirect()->route('fee-submission.index')->with('success', 'Fee submitted successfully.');
    }
    public function receipt($id)
    {
        $fee = FeeSubmission::with('admission', 'admission.batch')->findOrFail($id);
        return view('admin.pages.dashboard.fee-submission.receipt', compact('fee'));
    }

    public function downloadReceipt($id)
    {
        $fee = FeeSubmission::with('admission', 'admission.batch')->findOrFail($id);

        $pdf = Pdf::loadView('admin.pages.dashboard.fee-submission.receipt', compact('fee'));

        return $pdf->download('receipt-' . $fee->receipt_no . '.pdf');
    }
}
