<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Models\User;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Account;
use App\Models\Admission;

use Illuminate\Support\Str;
use App\Models\FeeCollector;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\FeeSubmission;
use App\Models\TeacherSalary;
use Illuminate\Support\Carbon;
use App\Mail\FeeSubmissionMail;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ReferralCommission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        ])
            // ->where('student_status', 'active')
            ->orderBy('joining_date', 'desc');

        $status = $request->get('status', 'all');
        $search = trim((string) $request->get('search'));
        $courseId = $request->get('course_id');
        $payment = $request->get('payment');
        $month = $request->get('month'); // format: YYYY-MM

        // 🔍 SEARCH FILTER
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('admissions.name', 'like', "%{$search}%")
                    ->orWhereHas('course', fn($c) => $c->where('courses.title', 'like', "%{$search}%"))
                    ->orWhereHas('batch', fn($b) => $b->where('batches.title', 'like', "%{$search}%"))
                    ->orWhereHas('courses', fn($c) => $c->where('courses.title', 'like', "%{$search}%"));
            });
        }

        // 🎯 STATUS FILTER
        if ($status !== 'all') {
            $query->where('admissions.fee_status', $status);
        }

        // 📘 COURSE FILTER
        if (!empty($courseId)) {
            $query->where(function ($q) use ($courseId) {
                $q->where('admissions.course_id', $courseId)
                    ->orWhereHas('courses', fn($c) => $c->where('courses.id', $courseId));
            });
        }

        // 💳 PAYMENT TYPE FILTER
        if (!empty($payment)) {
            $query->where('admissions.payment_type', $payment);
        }

        // 🧍 STUDENT STATUS FILTER
        $studentStatus = $request->get('student_status');
        if (!empty($studentStatus)) {
            $query->where('admissions.student_status', $studentStatus);
        }

        // 💳 PAYMENT TYPE FILTER
        if (!empty($payment)) {
            $query->where('admissions.payment_type', $payment);
        }

        // 🧮 TOTALS + MONTHLY FILTER
        if (!empty($month)) {
            try {
                $start = Carbon::createFromFormat('Y-m', $month)->startOfMonth();
                $end = Carbon::createFromFormat('Y-m', $month)->endOfMonth();

                // 🎯 Admissions that exist in pivot
                $admissionIds = DB::table('admission_course_batch')->distinct()->pluck('admission_id');

                // Filter monthly
                $query->whereIn('admissions.id', $admissionIds)
                    ->whereHas('feeSubmissions', function ($q) use ($start, $end) {
                        $q->whereBetween('submission_date', [$start, $end]);
                    });

                // 💰 Total collected this month
                $totalCollected = FeeSubmission::whereIn('admission_id', $admissionIds)
                    ->whereBetween('submission_date', [$start, $end])
                    ->sum('amount');

                // 💰 Total collected till this month
                $totalCollectedTillMonth = FeeSubmission::whereIn('admission_id', $admissionIds)
                    ->whereDate('submission_date', '<=', $end)
                    ->sum('amount');

                // ✅ FIXED FEE CALCULATION
                $addedTotal = DB::table('admission_course_batch')
                    ->whereIn('admission_id', $admissionIds)
                    ->sum('course_fee');

                $mainTotal = Admission::whereNotIn('id', $admissionIds)->sum('full_fee');

                $totalFee = $mainTotal + $addedTotal;

                $totalRemaining = $totalFee - $totalCollectedTillMonth;
            } catch (\Exception $e) {
                // fallback if invalid month
                $admissionIds = DB::table('admission_course_batch')->distinct()->pluck('admission_id');
                $totalCollected = FeeSubmission::whereIn('admission_id', $admissionIds)->sum('amount');

                $addedTotal = DB::table('admission_course_batch')
                    ->whereIn('admission_id', $admissionIds)
                    ->sum('course_fee');

                $mainTotal = Admission::whereNotIn('id', $admissionIds)->sum('full_fee');

                $totalFee = $mainTotal + $addedTotal;
                $totalRemaining = $totalFee - $totalCollected;
            }
        } else {
            // 🧾 All Data (no month selected)
            $admissionIds = DB::table('admission_course_batch')->distinct()->pluck('admission_id');
            $query->whereIn('admissions.id', $admissionIds);

            $totalCollected = FeeSubmission::whereIn('admission_id', $admissionIds)->sum('amount');

            // ✅ FIXED FEE CALCULATION
            $addedTotal = DB::table('admission_course_batch')
                ->whereIn('admission_id', $admissionIds)
                ->sum('course_fee');

            $mainTotal = Admission::whereNotIn('id', $admissionIds)->sum('full_fee');

            $totalFee = $mainTotal + $addedTotal;
            $totalRemaining = $totalFee - $totalCollected;
        }

        // 📄 Pagination
        $admissions = $query->paginate(15)->withQueryString();

        // 📚 Available courses
        $courses = Course::whereHas('admissions')
            ->select('id', 'title')
            ->orderBy('title')
            ->get();

        return view('admin.pages.dashboard.fee-submission.index', compact(
            'admissions',
            'status',
            'courses',
            'totalCollected',
            'totalRemaining',
            'month'
        ));
    }

    public function create($id)
    {
        $admission = Admission::with(['feeSubmissions'])->findOrFail($id);
        $accounts = Account::all();

        $submittedFees = $admission->feeSubmissions
            ->groupBy('course_id')
            ->map(fn($group) => $group->pluck('payment_type')->toArray())
            ->toArray();

        return view('admin.pages.dashboard.fee-submission.create', compact('admission', 'accounts', 'submittedFees'));
    }


    public function store(Request $request, $id)
    {
        $request->validate([
            'payment_method' => 'required|in:account,hand',
            // 'account_id' => 'required_if:payment_method,account|exists:accounts,id',
        ]);
        $admission = Admission::findOrFail($id);
        $totalAmountThisSubmission = 0;
        $latestFeeSubmission = null; // for notification message later

        // 🧩 fees are now grouped by course_id => [ ['installment_1', 'installment_2'], ... ]
        foreach ($request->fees as $courseId => $feeTypes) {

            // Get course pivot info
            $pivot = DB::table('admission_course_batch')
                ->where('admission_id', $admission->id)
                ->where('course_id', $courseId)
                ->first();

            if (!$pivot) {
                continue; // skip invalid course ids
            }

            foreach ($feeTypes as $feeType) {
                // calculate amount
                $amount = match ($feeType) {
                    'full_fee' => $pivot->course_fee,
                    'installment_1' => $pivot->installment_1 ?? 0,
                    'installment_2' => $pivot->installment_2 ?? 0,
                    'installment_3' => $pivot->installment_3 ?? 0,
                    'installment_4' => $pivot->installment_4 ?? 0,
                    default => 0,
                };

                // check if already submitted
                $alreadySubmitted = FeeSubmission::where('admission_id', $admission->id)
                    ->where('course_id', $courseId)
                    ->where('payment_type', $feeType)
                    ->exists();

                if ($alreadySubmitted)
                    continue;

                // ✅ Create new fee submission
                $feeSubmission = FeeSubmission::create([
                    'admission_id' => $admission->id,
                    'course_id' => $courseId,
                    'payment_method' => $request->payment_method,
                    'account_id' => $request->payment_method === 'account' ? $request->account_id : null,
                    'user_id' => Auth::id(),
                    'payment_type' => $feeType,
                    'amount' => $amount,
                    'receipt_no' => 'SKILLVERSE-RCPT-' . strtoupper(Str::random(5)) . '-' . time(),
                    'submission_date' => now(),
                ]);

                $latestFeeSubmission = $feeSubmission;
                $totalAmountThisSubmission += $amount;

                // 📨 send email if applicable
                if (!empty($admission->email)) {
                    try {
                        Mail::to($admission->email)->send(new FeeSubmissionMail($feeSubmission));
                    } catch (\Throwable $e) {
                        Log::error('Failed to send FeeSubmissionMail for Admission ID: ' . $admission->id, [
                            'error' => $e->getMessage(),
                            'email' => $admission->email,
                        ]);
                    }
                }

                // 💰 referral commission
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

        // 🧮 update overall fee status
        $admission->load(['courses', 'feeSubmissions']);

        // 🧮 Recalculate paid & expected totals
        $totalPaid = $admission->feeSubmissions->sum('amount');

        // calculate expected total
        $expectedTotal = 0;

        if ($admission->courses->count() > 0) {
            // multi-course admission
            foreach ($admission->courses as $course) {
                $expectedTotal += (float) ($course->pivot->course_fee ?? 0);
            }
        } else {
            // legacy single-course admission
            $expectedTotal = (float) ($admission->full_fee ?? 0);
        }

        // prevent divide-by-zero or negative fee
        $expectedTotal = max($expectedTotal, 1);

        // 🟢 Decide status
        if ($totalPaid <= 0) {
            $admission->fee_status = 'pending';
        } elseif ($totalPaid < $expectedTotal) {
            $admission->fee_status = 'uncomplete';
        } else {
            $admission->fee_status = 'complete';
        }

        $admission->save();
        

        // ✅ TEACHER SALARY HANDLING (same as before)
        if (!empty($pivot->batch_id)) {
            $batch = Batch::find($pivot->batch_id);
            if ($batch && $batch->teacher_id && $amount > 0) {
                $teacher = $batch->teacher;
                $month = now()->month;
                $year = now()->year;

                $payType = $teacher->pay_type ?? 'percentage';
                $percent = (int) ($teacher->percentage ?? (is_numeric($teacher->salary) ? $teacher->salary : 0));
                $fixed = (int) ($teacher->fixed_salary ?? 0);

                $teacherSalary = TeacherSalary::firstOrNew([
                    'teacher_id' => $teacher->id,
                    'month' => $month,
                    'year' => $year,
                ]);

                if (
                    in_array(strtolower($teacherSalary->status ?? 'unpaid'), ['paid', 'balance'], true)
                    && $payType === 'percentage'
                ) {
                    $teacherSalary->status = 'unpaid';
                    $teacherSalary->total_fee_collected = 0;
                    $teacherSalary->total_students = 0;
                    $teacherSalary->salary_amount = 0;
                    $teacherSalary->computed_percentage_amount = 0;
                    $teacherSalary->computed_fixed_amount = 0;
                }

                if ($admission->mode === 'physical') {
                    $teacherSalary->total_fee_collected = (int) (($teacherSalary->total_fee_collected ?? 0) + $amount);
                }

                $teacherSalary->pay_type = $payType;
                $teacherSalary->percentage = $percent;

                $computedPercentage = (int) round(($teacherSalary->total_fee_collected ?? 0) * ($percent / 100));
                $computedFixed = $fixed;

                $teacherSalary->computed_percentage_amount = $computedPercentage;
                $teacherSalary->computed_fixed_amount = $computedFixed;
                $teacherSalary->salary_amount = $payType === 'fixed' ? $computedFixed : $computedPercentage;

                $physicalCount = FeeSubmission::whereHas('admission', function ($q) use ($batch) {
                    $q->where('batch_id', $batch->id)->where('mode', 'physical');
                })
                    ->whereMonth('submission_date', $month)
                    ->whereYear('submission_date', $year)
                    ->distinct('admission_id')
                    ->count('admission_id');

                $onlineCount = FeeSubmission::whereHas('admission', function ($q) use ($batch) {
                    $q->where('batch_id', $batch->id)->where('mode', 'online');
                })
                    ->whereMonth('submission_date', $month)
                    ->whereYear('submission_date', $year)
                    ->distinct('admission_id')
                    ->count('admission_id');

                $teacherSalary->total_students = $physicalCount;
                $teacherSalary->total_online_students = $onlineCount;
                $teacherSalary->save();
            }
        }

        // ✅ ONLINE STUDENT BONUS
        if ($admission->mode === 'online') {
            // $batch = Batch::find($admission->batch_id);
            $batch = Batch::find($pivot->batch_id);
            if ($batch && $batch->teacher_id) {
                $teacher = $batch->teacher;
                $month = now()->month;
                $year = now()->year;
                $percent = max(0, min(100, (int) ($admission->online_percentage ?? 50)));
                $bonusAmount = (int) round($totalAmountThisSubmission * ($percent / 100));

                $teacherSalary = TeacherSalary::firstOrNew([
                    'teacher_id' => $teacher->id,
                    'month' => $month,
                    'year' => $year,
                ]);
                $teacherSalary->online_bonus = ($teacherSalary->online_bonus ?? 0) + $bonusAmount;

                $onlineCount = FeeSubmission::whereHas('admission', function ($q) use ($batch) {
                    $q->where('batch_id', $batch->id)->where('mode', 'online');
                })
                    ->whereMonth('submission_date', $month)
                    ->whereYear('submission_date', $year)
                    ->distinct('admission_id')
                    ->count('admission_id');

                $teacherSalary->total_online_students = $onlineCount;
                $teacherSalary->save();
            }
        }

        // 🔔 Notification (uses the last created submission)
        if ($latestFeeSubmission) {
            $notification = Notification::create([
                'title' => 'Fee Submitted',
                'message' => '₨' . number_format($latestFeeSubmission->amount) . ' received from ' . $admission->name,
                'icon' => 'fa fa-money',
                'type' => 'fee',
                'status' => 1,
            ]);

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
