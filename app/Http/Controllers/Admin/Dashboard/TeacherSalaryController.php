<?php

// app/Http/Controllers/Admin/Dashboard/TeacherSalaryController.php
namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeacherSalary;
use App\Models\TeacherBalance;
use App\Models\Expense;
use App\Models\Notification;
use App\Models\TeacherSalaryHistory;
use Illuminate\Support\Facades\DB;

class TeacherSalaryController extends Controller
{
    public function index(Request $request)
    {
        $query = TeacherSalary::with('teacher');

        if ($request->filled('month'))
            $query->where('month', $request->month);
        if ($request->filled('year'))
            $query->where('year', $request->year);

        $salaries = $query->latest()->get();
        return view('admin.pages.dashboard.teacher.salary.salary', compact('salaries'));
    }

    public function historyByTeacher(Request $request, $teacherId)
    {
        $histories = TeacherSalaryHistory::with(['teacher', 'salary'])
            ->where('teacher_id', $teacherId)
            ->when($request->filled('month'), fn($q) => $q->where('month', $request->month))
            ->when($request->filled('year'), fn($q) => $q->where('year', $request->year))
            ->latest()
            ->get();

        $teacher = $histories->first()?->teacher ?? null;

        return view('admin.pages.dashboard.teacher.salary.history', compact('histories', 'teacher'));
    }

    public function StatusPaid($id)
    {
        $salary = TeacherSalary::with('teacher')->findOrFail($id);
        if ($salary->status === 'paid')
            return back()->with('paid', 'Already marked as paid.');

        // ✅ Fixed-pay: is month me pahle hi 'paid' ya 'Balance → Paid' ho chuka?
        $payTypeSnapshot = $salary->pay_type ?? ($salary->teacher->pay_type ?? 'percentage');
        if ($payTypeSnapshot === 'fixed') {
            $alreadyPaidThisMonth = TeacherSalaryHistory::where('teacher_id', $salary->teacher_id)
                ->where('month', $salary->month)
                ->where('year', $salary->year)
                ->whereIn('status', ['paid', 'Balance → Paid'])
                ->exists();

            if ($alreadyPaidThisMonth) {
                return back()->with('paid', 'Fixed salary is already paid once for this month.');
            }
        }


        DB::transaction(function () use ($salary) {
            $amount = (int) $salary->salary_amount;
            $teacherName = $salary->teacher->name ?? 'Unknown';
            $monthName = \Carbon\Carbon::create()->month($salary->month)->format('F');
            $year = $salary->year;

            // History
            TeacherSalaryHistory::create([
                'teacher_id' => $salary->teacher_id,
                'teacher_salary_id' => $salary->id,
                'month' => $salary->month,
                'year' => $salary->year,
                'amount' => $amount,
                'status' => 'paid',
                'performed_by' => auth()->id(),
                'performed_at' => now(),
            ]);

            // Expense auto create (Salary → Expense)
            if ($amount > 0) {
                $expense = Expense::firstOrCreate(
                    [
                        'ref_type' => 'salary',
                        'ref_id' => $salary->id,
                    ],
                    [
                        'title' => 'salary',
                        'amount' => (string) $amount,
                        'date' => now()->toDateString(),
                        'purpose' => "Salary payout for {$teacherName}",
                        'type' => 'essential',
                    ]
                );

                // 🔔 Notify only when a new expense row was created (avoid duplicates)
                if ($expense->wasRecentlyCreated) {
                    $notification = Notification::create([
                        'title' => 'Salary Expense Logged',
                        'message' => '₨' . number_format((float) $expense->amount) . " salary payout for {$teacherName}",
                        'icon' => 'fa fa-credit-card',
                        'type' => 'expense',
                        'status' => 1,
                    ]);

                    // Attach to target roles (no Spatie; using users.role column)
                    $targetRoles = ['admin', 'administrator', 'partner'];
                    $userIds = \App\Models\User::whereIn('role', $targetRoles)->pluck('id');

                    if ($userIds->isNotEmpty()) {
                        $now = now();
                        $attach = [];
                        foreach ($userIds as $uid) {
                            $attach[$uid] = ['is_read' => false, 'created_at' => $now, 'updated_at' => $now];
                        }
                        $notification->users()->syncWithoutDetaching($attach);
                    }
                }
            }


            // Close current cycle
            $salary->update([
                'status' => 'paid',
                'salary_amount' => 0,
                'total_fee_collected' => 0,
                // 'total_students'       => 0,
            ]);
        });

        return back()->with('paid', 'Salary marked as paid and history logged.');
    }

    public function StatusBalance($id)
    {
        $salary = TeacherSalary::with('teacher')->findOrFail($id);
        if (in_array($salary->status, ['paid', 'balance'], true)) {
            return back()->with('balance', 'Already processed.');
        }

        DB::transaction(function () use ($salary) {
            $amount = (int) $salary->salary_amount;

            // Add / increment TeacherBalance
            $tb = TeacherBalance::firstOrNew([
                'teacher_id' => $salary->teacher_id,
                'month' => $salary->month,
                'year' => $salary->year,
            ]);
            $tb->amount = (int) ($tb->amount ?? 0) + $amount;
            $tb->save();

            // History
            // TeacherSalaryHistory::create([
            //     'teacher_id'        => $salary->teacher_id,
            //     'teacher_salary_id' => $salary->id,
            //     'month'             => $salary->month,
            //     'year'              => $salary->year,
            //     'amount'            => $amount,
            //     'status'            => 'balance',
            //     'performed_by'      => auth()->id(),
            //     'performed_at'      => now(),
            // ]);

            // Close current cycle (reset counters so next fees start fresh)
            $salary->update([
                'status' => 'balance',
                'salary_amount' => 0,
                'total_fee_collected' => 0,
                // 'total_students'       => 0,
            ]);
        });

        return back()->with('balance', 'Salary marked as balance, added to TeacherBalance and history logged.');
    }
}
