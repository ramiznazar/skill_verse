<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProfitCalculation;
use App\Models\Expense;
use App\Models\FeeSubmission;

class ProfitCalculationController extends Controller
{
    public function index(Request $request)
    {
        $query = ProfitCalculation::query();

        if ($request->month) {
            $query->where('month', $request->month);
        }

        if ($request->year) {
            $query->where('year', $request->year);
        }

        $profits = $query->orderByDesc('year')->orderByDesc('month')->get();

        return view('admin.pages.dashboard.profit.index', compact('profits'));
    }
    public function calculateThisMonth()
    {
        $month = now()->month;
        $year = now()->year;

        $totalIncome = FeeSubmission::whereMonth('submission_date', $month)
            ->whereYear('submission_date', $year)
            ->sum('amount');

        $totalExpense = Expense::whereMonth('date', $month)
            ->whereYear('date', $year)
            ->sum('amount');

        $netProfit = $totalIncome - $totalExpense;

        ProfitCalculation::updateOrCreate(
            ['month' => $month, 'year' => $year],
            [
                'total_income' => $totalIncome,
                'total_expense' => $totalExpense,
                'net_profit' => $netProfit,
            ]
        );

        return redirect()->back()->with('store', 'Profit for this month calculated successfully.');
    }

    public function showDailyProfit()
    {
        $date = now()->toDateString();

        $totalIncome = FeeSubmission::whereDate('submission_date', $date)->sum('amount');
        $totalExpense = Expense::whereDate('date', $date)->sum('amount');
        

        $netProfit = $totalIncome - $totalExpense;

        return view('admin.pages.dashboard.profit.index', compact('date', 'totalIncome', 'totalExpense', 'netProfit'));
    }
}
