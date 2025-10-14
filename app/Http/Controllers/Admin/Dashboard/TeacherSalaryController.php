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

        // 🔎 Search by teacher name or email
        if ($request->filled('search')) {
            $query->whereHas('teacher', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // 📅 Month filter
        if ($request->filled('month')) {
            $query->where('month', $request->month);
        }

        // 📅 Year filter
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        // 💳 Status filter
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

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
        $teacherName = $salary->teacher->name ?? 'Unknown';
        $monthName = \Carbon\Carbon::create()->month($salary->month)->format('F');
        $year = $salary->year;
        $payType = $salary->pay_type ?? ($salary->teacher->pay_type ?? 'percentage');

        DB::transaction(function () use ($salary, $teacherName, $monthName, $year, $payType) {

            // 🔹 CASE 1 — Percentage Teachers → Pay both physical salary + online bonus
            if ($payType === 'percentage') {
                $mainAmount = (int) ($salary->salary_amount ?? 0);
                $bonusAmount = (int) ($salary->online_bonus ?? 0);
                $totalAmount = $mainAmount + $bonusAmount;

                if ($totalAmount <= 0) {
                    throw new \Exception("No pending amount for this teacher.");
                }

                // 🔸 History Entry
                TeacherSalaryHistory::create([
                    'teacher_id' => $salary->teacher_id,
                    'teacher_salary_id' => $salary->id,
                    'month' => $salary->month,
                    'year' => $salary->year,
                    'amount' => $totalAmount,
                    'status' => 'paid',
                    'performed_by' => auth()->id(),
                    'performed_at' => now(),
                    'note' => $bonusAmount > 0
                        ? 'Percentage salary (including online bonus)'
                        : 'Percentage salary payout',
                ]);

                // 🔸 Expense Entry
                Expense::create([
                    'ref_type' => 'salary',
                    'ref_id' => $salary->id,
                    'title' => 'Teacher Salary',
                    'amount' => (string) $totalAmount,
                    'date' => now()->toDateString(),
                    'purpose' => "Salary payout for {$teacherName} ({$monthName} {$year})",
                    'type' => 'essential',
                ]);

                // 🔸 Reset values
                $salary->update([
                    'status' => 'paid',
                    'salary_amount' => 0,
                    'online_bonus' => 0,
                    'total_online_students' => 0,
                    'total_fee_collected' => 0,
                ]);

                return;
            }

            // 🔹 CASE 2 — Fixed Teachers
            if ($payType === 'fixed') {
                $alreadyPaidFixed = TeacherSalaryHistory::where('teacher_id', $salary->teacher_id)
                    ->where('month', $salary->month)
                    ->where('year', $salary->year)
                    ->where('note', 'like', '%Fixed salary%')
                    ->exists();

                // (a) Pay fixed salary if not paid
                if (!$alreadyPaidFixed && $salary->salary_amount > 0) {
                    $amount = (int) $salary->salary_amount;

                    TeacherSalaryHistory::create([
                        'teacher_id' => $salary->teacher_id,
                        'teacher_salary_id' => $salary->id,
                        'month' => $salary->month,
                        'year' => $salary->year,
                        'amount' => $amount,
                        'status' => 'paid',
                        'performed_by' => auth()->id(),
                        'performed_at' => now(),
                        'note' => 'Fixed salary payout',
                    ]);

                    Expense::create([
                        'ref_type' => 'salary',
                        'ref_id' => $salary->id,
                        'title' => 'Teacher Salary',
                        'amount' => (string) $amount,
                        'date' => now()->toDateString(),
                        'purpose' => "Fixed salary payout for {$teacherName} ({$monthName} {$year})",
                        'type' => 'essential',
                    ]);

                    $salary->update([
                        'status' => 'paid',
                        'salary_amount' => 0,
                    ]);

                    return;
                }

                // (b) Pay online bonus if pending
                if ($salary->online_bonus > 0) {
                    $bonusAmount = (int) $salary->online_bonus;

                    TeacherSalaryHistory::create([
                        'teacher_id' => $salary->teacher_id,
                        'teacher_salary_id' => $salary->id,
                        'month' => $salary->month,
                        'year' => $salary->year,
                        'amount' => $bonusAmount,
                        'status' => 'paid',
                        'performed_by' => auth()->id(),
                        'performed_at' => now(),
                        'note' => 'Online bonus payout',
                    ]);

                    Expense::create([
                        'ref_type' => 'salary_online_bonus',
                        'ref_id' => $salary->id,
                        'title' => 'Teacher Online Bonus',
                        'amount' => (string) $bonusAmount,
                        'date' => now()->toDateString(),
                        'purpose' => "Online bonus payout for {$teacherName} ({$monthName} {$year})",
                        'type' => 'essential',
                    ]);

                    $salary->update([
                        'online_bonus' => 0,
                        'total_online_students' => 0,
                    ]);

                    return;
                }

                throw new \Exception("Fixed salary and all online bonuses already paid for this month.");
            }

            throw new \Exception("Invalid payment type.");
        });

        return back()->with('paid', 'Salary marked as paid successfully.');
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
