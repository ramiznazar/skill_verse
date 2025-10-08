<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Models\Batch;
use App\Models\Course;
use App\Models\User;
use App\Models\Account;
use Illuminate\Support\Carbon;

use App\Models\Admission;
use App\Models\Notification;
use App\Mail\FeeSubmissionMail;
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
    public function index(Request $request)
{
    $query = Admission::with([
        'course',
        'batch',
        'feeSubmissions.user',
        'feeSubmissions.account',
    ])->orderBy('joining_date', 'desc');

    $status = $request->get('status', 'all');
    $search = trim((string) $request->get('search'));
    $courseId = $request->get('course_id');
    $payment = $request->get('payment');
    $month = $request->get('month'); // 🆕 month filter (YYYY-MM)

    // 🔎 Search
    if ($search !== '') {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
                ->orWhereHas('course', fn($c) => $c->where('title', 'like', "%{$search}%"))
                ->orWhereHas('batch', fn($b) => $b->where('title', 'like', "%{$search}%"));
        });
    }

    // 🎯 Status filter
    if ($status !== 'all') {
        $query->where('fee_status', $status);
    }

    // 📘 Course filter
    if (!empty($courseId)) {
        $query->where('course_id', $courseId);
    }

    // 💳 Payment type filter
    if (!empty($payment)) {
        $query->where('payment_type', $payment);
    }

    // 🗓️ Month filter
    if (!empty($month)) {
        try {
            $start = Carbon::createFromFormat('Y-m', $month)->startOfMonth();
            $end = Carbon::createFromFormat('Y-m', $month)->endOfMonth();

            // show only those admissions who paid in that month
            $query->whereHas('feeSubmissions', function ($q) use ($start, $end) {
                $q->whereBetween('submission_date', [$start, $end]);
            });

            // totals for that month
            $totalCollected = FeeSubmission::whereBetween('submission_date', [$start, $end])->sum('amount');

            // total remaining till that month
            $totalCollectedTillMonth = FeeSubmission::where('submission_date', '<=', $end)->sum('amount');
            $totalFee = Admission::sum('full_fee');
            $totalRemaining = $totalFee - $totalCollectedTillMonth;

        } catch (\Exception $e) {
            // fallback if month invalid
            $totalCollected = FeeSubmission::sum('amount');
            $totalRemaining = Admission::sum('full_fee') - $totalCollected;
        }
    } else {
        // no month selected → show all
        $totalCollected = FeeSubmission::sum('amount');
        $totalRemaining = Admission::sum('full_fee') - $totalCollected;
    }

    $admissions = $query->paginate(15)->withQueryString();

    $courses = Course::whereHas('admissions')
        ->select('id', 'title')
        ->orderBy('title')
        ->get();

    return view('admin.pages.dashboard.fee-submission.index', compact(
        'admissions', 'status', 'courses', 'totalCollected', 'totalRemaining', 'month'
    ));
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
                'full_fee' => $admission->full_fee,
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
                    'admission_id' => $admission->id,
                    'payment_method' => $request->payment_method,
                    'account_id' => $request->payment_method === 'account' ? $request->account_id : null,
                    // 'user_id'         => $request->payment_method === 'hand' ? Auth::id() : null,
                    'user_id' => Auth::id(),
                    'payment_type' => $feeType,
                    'amount' => $amount,
                    'receipt_no' => 'SKILLVERSE-RCPT-' . strtoupper(Str::random(5)) . '-' . time(),
                    'submission_date' => now(),
                ]);

                $totalAmountThisSubmission += $amount;

                // ✅ Send email to student
                if (!empty($admission->email)) {
                    Mail::to($admission->email)->send(new FeeSubmissionMail($feeSubmission));
                }

                // ✅ Referral commission
                if (
                    $admission->referral_source &&
                    $admission->referral_source_commission &&
                    is_numeric($admission->referral_source_commission)
                ) {
                    $commissionAmount = $amount * (floatval($admission->referral_source_commission) / 100);

                    ReferralCommission::create([
                        'admission_id' => $admission->id,
                        'fee_submission_id' => $feeSubmission->id,
                        'referral_name' => $admission->referral_source,
                        'referral_contact' => $admission->referral_source_contact,
                        'commission_percentage' => $admission->referral_source_commission,
                        'commission_amount' => $commissionAmount,
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
            $totalPaid == 0 => 'pending',
            $totalPaid < $expectedTotal => 'uncomplete',
            default => 'complete',
        };
        $admission->save();

        // ✅ Teacher Salary (fixed = one payout per month)
        $batch = Batch::find($admission->batch_id);
        if ($batch && $batch->teacher_id && $totalAmountThisSubmission > 0) {
            $teacher = $batch->teacher;

            // Snapshot teacher config
            $payType = $teacher->pay_type ?? 'percentage';
            $percent = (int) ($teacher->percentage ?? (is_numeric($teacher->salary) ? $teacher->salary : 0)); // legacy fallback
            $fixed = (int) ($teacher->fixed_salary ?? 0);

            $month = now()->month;
            $year = now()->year;

            $teacherSalary = TeacherSalary::firstOrNew([
                'teacher_id' => $teacher->id,
                'month' => $month,
                'year' => $year,
            ]);

            // ❗ Reopen rule:
            // Percentage: old behavior (reopen on paid/balance)
            // Fixed: DO NOT reopen once paid/balance in same month (so no second payout)
            if (in_array(strtolower($teacherSalary->status ?? 'unpaid'), ['paid', 'balance'], true)) {
                if ($payType === 'percentage') {
                    // reopen cycle (same as before)
                    $teacherSalary->status = 'unpaid';
                    $teacherSalary->total_fee_collected = 0;
                    $teacherSalary->total_students = 0;
                    $teacherSalary->salary_amount = 0;
                    $teacherSalary->computed_percentage_amount = 0;
                    $teacherSalary->computed_fixed_amount = 0;
                } else {
                    // fixed → don't reopen; keep status as-is (paid/balance)
                    // (still allow totals/computed fields to update for transparency)
                }
            }

            // ➕ accumulate this submission
            $teacherSalary->total_fee_collected = (int) (($teacherSalary->total_fee_collected ?? 0) + $totalAmountThisSubmission);

            // snapshot config
            $teacherSalary->pay_type = $payType;
            $teacherSalary->percentage = $percent;

            // compute both
            $computedPercentage = (int) round($teacherSalary->total_fee_collected * ($percent / 100));
            $computedFixed = $fixed;

            $teacherSalary->computed_percentage_amount = $computedPercentage;
            $teacherSalary->computed_fixed_amount = $computedFixed;

            // ✅ Payable set karna:
            if ($payType === 'fixed') {
                // Sirf tab set karein jab cycle unpaid ho — agar paid/balance ho chuki, tou payable 0 hi rehne dein
                if (strtolower($teacherSalary->status ?? 'unpaid') === 'unpaid') {
                    $teacherSalary->salary_amount = $computedFixed;
                }
                // else (paid/balance): salary_amount ko wapas fixed par na le jaayein; 0 hi rehne dein
            } else {
                // percentage: normal behavior
                $teacherSalary->salary_amount = $computedPercentage;
            }

            // distinct students
            $teacherSalary->total_students = FeeSubmission::whereHas('admission', function ($q) use ($batch) {
                $q->where('batch_id', $batch->id);
            })
                ->whereMonth('submission_date', $month)
                ->whereYear('submission_date', $year)
                ->distinct('admission_id')
                ->count('admission_id');

            $teacherSalary->save();
        }

        // 🔔 Create & attach per-user notification (Fee Submission)
        $notification = Notification::create([
            'title' => 'Fee Submitted',
            'message' => '₨' . number_format($feeSubmission->amount) . ' received from ' . $feeSubmission->admission->name,
            'icon' => 'fa fa-money',
            'type' => 'fee',
            'status' => 1,
        ]);

        // Attach to target roles (no Spatie; using users.role column)
        $targetRoles = ['admin', 'administrator', 'partner'];
        $userIds = User::whereIn('role', $targetRoles)->pluck('id');

        if ($userIds->isNotEmpty()) {
            $now = now();
            $attach = [];
            foreach ($userIds as $uid) {
                $attach[$uid] = ['is_read' => false, 'created_at' => $now, 'updated_at' => $now];
            }
            $notification->users()->syncWithoutDetaching($attach);
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