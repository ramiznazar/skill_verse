<?php

namespace App\Http\Controllers\Admin\Dashboard;

use Carbon\Carbon;
use App\Models\Expense;
use Illuminate\Http\Request;
use App\Models\TeacherSalary;
use App\Models\TeacherBalance;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\TeacherSalaryHistory;

class TeacherBalanceController extends Controller
{
    public function balance()
    {
        $balances = TeacherBalance::with('teacher')->orderBy('created_at', 'desc')->get();

        return view('admin.pages.dashboard.teacher.salary.balance', compact('balances'));
    }
    public function StatusPaid($id)
    {
        $balance = TeacherBalance::with('teacher')->findOrFail($id);

        // Optional: block duplicate clicks before we delete the row
        if ($balance->status === 'paid') {
            return back()->with('paid', 'Already marked as paid.');
        }

        DB::transaction(function () use ($balance) {
            $amount = (int) $balance->amount;
            $teacherId = $balance->teacher_id;
            $teacherName = optional($balance->teacher)->name ?? 'Unknown';
            $month = $balance->month;
            $year = $balance->year;

            // Find matching salary record (to link history nicely if present)
            $salary = TeacherSalary::where('teacher_id', $teacherId)
                ->where('month', $month)
                ->where('year', $year)
                ->first();

            // 1) History entry (same table you already use)
            TeacherSalaryHistory::create([
                'teacher_id' => $teacherId,
                'teacher_salary_id' => $salary?->id,
                'month' => $month,
                'year' => $year,
                'amount' => $amount,
                'status' => 'Balance → Paid',
                'performed_by' => auth()->id(),
                'performed_at' => now(),
            ]);

            // 2) Expense (deduped by ref_type/ref_id)
            // Salary balance payout → auto create Expense + per-user Notification
            if ($amount > 0) {
                $monthName = Carbon::create()->month($month)->format('F');

                $expense = Expense::firstOrCreate(
                    [
                        'ref_type' => 'salary',
                        'ref_id' => $balance->id,
                    ],
                    [
                        'title' => 'Teacher Salary (Balance Payout)',
                        'amount' => (string) $amount,
                        'date' => now()->toDateString(),
                        'purpose' => "Salary balance payout for {$teacherName} ({$monthName})",
                        'type' => 'essential',
                    ]
                );

                // Notify only if a new expense row was created (avoid duplicates)
                if ($expense->wasRecentlyCreated) {
                    $notification = Notification::create([
                        'title' => 'Salary Balance Expense Logged',
                        'message' => '₨' . number_format((float) $expense->amount) . " balance payout for {$teacherName} ({$monthName})",
                        'icon' => 'fa fa-credit-card',
                        'type' => 'expense',
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
                }
            }


            // 4) Delete the balance row (as requested)
            $balance->delete();
        });

        return back()->with('paid', 'Balance paid, history logged, expense created, and balance entry removed.');
    }
}
