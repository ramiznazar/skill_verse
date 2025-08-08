<?php

namespace App\Http\Controllers\Admin\Dashboard;

use Illuminate\Http\Request;
use App\Models\TeacherSalary;
use App\Models\TeacherBalance;
use App\Http\Controllers\Controller;

class TeacherBalanceController extends Controller
{
    public function balance()
    {
        $balances = TeacherBalance::with('teacher')->orderBy('created_at', 'desc')->get();

        return view('admin.pages.dashboard.teacher.salary.balance', compact('balances'));
    }
    public function StatusPaid($id)
    {
        $balance = TeacherBalance::findOrFail($id);

        // 2. Update balance status and amount
        $balance->status = 'paid';
        $balance->amount = 0;
        $balance->save();

        // 3. Update related salary status
        $salary = TeacherSalary::where('teacher_id', $balance->teacher_id)
            ->where('month', $balance->month)
            ->where('year', $balance->year)
            ->first();

        if ($salary) {
            $salary->status = 'paid';
            $salary->save();
        }

        return back()->with('paid', 'Balance marked as paid');
    }
}
