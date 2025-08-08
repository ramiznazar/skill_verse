<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Expense;
use App\Models\FeeSubmission;
use App\Models\ProfitCalculation;

class CalculateMonthlyProfit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:calculate-monthly-profit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        $month = $now->month;
        $year = $now->year;

        if (ProfitCalculation::where('month', $month)->where('year', $year)->exists()) {
            $this->warn("Profit already calculated for $month/$year");
            return;
        }

        $income = FeeSubmission::whereMonth('submission_date', $month)
            ->whereYear('submission_date', $year)
            ->sum('amount');

        $expense = Expense::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->sum('amount');

        $net = $income - $expense;

        ProfitCalculation::create([
            'month' => $month,
            'year' => $year,
            'total_income' => $income,
            'total_expense' => $expense,
            'net_profit' => $net,
        ]);

        $this->info("Profit stored for $month/$year");
    }
}
