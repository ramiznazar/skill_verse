<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeacherSalary;
use App\Models\TeacherBalance;

class TeacherSalaryController extends Controller
{
    public function index(Request $request)
    {
        $query = TeacherSalary::with('teacher');

        if ($request->filled('month')) {
            $query->where('month', $request->month);
        }

        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        $salaries = $query->latest()->get();
        return view('admin.pages.dashboard.teacher.salary.salary', compact('salaries'));
    }
    public function StatusPaid($id)
    {
        $salary = TeacherSalary::findOrFail($id);
        $salary->status = 'Paid';
        $salary->save();

        return back()->with('paid', 'Salary marked as paid.');
    }

    public function StatusBalance($id)
    {
        $salary = TeacherSalary::findOrFail($id);
        $salary->status = 'Balance';
        $salary->save();

        // Check if balance already exists
        $exists = TeacherBalance::where('teacher_id', $salary->teacher_id)
            ->where('month', $salary->month)
            ->where('year', $salary->year)
            ->first();

        if (!$exists) {
            TeacherBalance::create([
                'teacher_id' => $salary->teacher_id,
                'amount' => $salary->salary_amount,
                'month' => $salary->month,
                'year' => $salary->year,
                // 'status' => 'balance',
            ]);
        }

        return back()->with('balance', 'Salary marked as balance and logged.');
    }
    
}
