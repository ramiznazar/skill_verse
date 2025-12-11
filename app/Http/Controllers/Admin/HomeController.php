<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Lead;
use App\Models\Expense;
use App\Models\Admission;
use Illuminate\Http\Request;
use App\Models\FeeSubmission;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home()
    {
        $activeStudents = Admission::where('student_status', 'active')->count();

        // Total Students
        $totalStudents = Admission::count();
        $studentGoal = 100;
        $studentProgress = ($totalStudents / $studentGoal) * 100;

        //Students this month
        $studentsThisMonth = Admission::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $studentsLastMonth = Admission::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();

        $studentDifference = $studentsThisMonth - $studentsLastMonth;
        $studentChangeDirection = $studentDifference >= 0 ? 'up' : 'down';
        $studentChangePercent = $studentsLastMonth > 0
            ? abs(round(($studentDifference / $studentsLastMonth) * 100))
            : 100;

        $monthlyStudentProgressTarget = 200;
        $monthlyStudentProgress = ($studentsThisMonth / $monthlyStudentProgressTarget) * 100;

        // Total Leads
        $totalLeads = Lead::count();
        $leadGoal = 100;
        $leadProgress = ($totalLeads / $leadGoal) * 100;

        // Leads this month
        $monthlyLeads = Lead::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $lastMonthLeads = Lead::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();
        $leadDifference = $monthlyLeads - $lastMonthLeads;
        $leadChangeDirection = $leadDifference >= 0 ? 'up' : 'down';
        $monthlyTarget = 200;
        $leadProgress = ($monthlyLeads / $monthlyTarget) * 100;

        // Default chart variables for first load (Yearly view)
        $chartData = $this->getMonthlyData()->getData(true);

        // Lead source (Overall)
        $leadSourceLabels = ['Ads', 'Referral', 'Other'];
        $leadSourceSeriesOverall = [
            Admission::where('referral_type', 'ads')->count(),
            Admission::where('referral_type', 'referral')->count(),
            Admission::where('referral_type', 'other')->count()
        ];

        // Lead source (This Month)
        $leadSourceSeriesMonthly = [
            Admission::where('referral_type', 'ads')
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),
            Admission::where('referral_type', 'referral')
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),
            Admission::where('referral_type', 'other')
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count()
        ];

        // Top 5 Courses by Admissions
        $topCourses = DB::table('admission_course_batch')
            ->join('courses', 'admission_course_batch.course_id', '=', 'courses.id')
            ->select('courses.title', DB::raw('COUNT(admission_course_batch.admission_id) as total'))
            ->groupBy('courses.title')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        // extract data for the chart
        $topCourseCategories = $topCourses->pluck('title');
        $topCourseSeries = $topCourses->pluck('total');

        return view('admin.index', compact(
            'activeStudents',
            'totalStudents',
            'studentGoal',
            'studentProgress',
            'studentsThisMonth',
            'monthlyStudentProgress',
            'studentDifference',
            'studentChangeDirection',
            'studentChangePercent',
            'totalLeads',
            'leadGoal',
            'leadProgress',
            'monthlyLeads',
            'leadDifference',
            'leadChangeDirection',
            'leadProgress',
            'chartData',
            'leadSourceLabels',
            'leadSourceSeriesOverall',
            'leadSourceSeriesMonthly',
            'topCourseCategories',
            'topCourseSeries'
        ));
    }

    public function getWeeklyData()
    {
        $year = now()->year;
        $month = now()->month;

        $weeks = ['Week 1', 'Week 2', 'Week 3', 'Week 4'];

        $weekRanges = [
            [1, 7],
            [8, 14],
            [15, 21],
            [22, now()->endOfMonth()->day]
        ];

        $revenueData = [];
        $expenseData = [];
        $profitData = [];

        foreach ($weekRanges as [$start, $end]) {
            // Fee submission revenue
            $feeSubmissionRevenue = FeeSubmission::whereYear('submission_date', $year)
                ->whereMonth('submission_date', $month)
                ->whereDay('submission_date', '>=', $start)
                ->whereDay('submission_date', '<=', $end)
                ->sum('amount');

            // Registration fee revenue (from admissions created in this week)
            $registrationFeeRevenue = Admission::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->whereDay('created_at', '>=', $start)
                ->whereDay('created_at', '<=', $end)
                ->where('registration_fee', '>', 0)
                ->sum('registration_fee');

            // Total revenue
            $revenue = $feeSubmissionRevenue + ($registrationFeeRevenue ?? 0);

            $expense = Expense::whereYear('date', $year)
                ->whereMonth('date', $month)
                ->whereDay('date', '>=', $start)
                ->whereDay('date', '<=', $end)
                ->sum('amount');

            $profit = $revenue - $expense;

            $revenueData[] = $revenue;
            $expenseData[] = $expense;
            $profitData[] = $profit;
        }

        return response()->json([
            'categories' => $weeks,
            'series' => [
                ['name' => 'Profit', 'data' => $profitData],
                ['name' => 'Expenses', 'data' => $expenseData],
                ['name' => 'Revenue', 'data' => $revenueData]
            ]
        ]);
    }

    public function getMonthlyData()
    {
        $year = now()->year;
        $months = collect(range(1, 12))->map(fn($m) => date('M', mktime(0, 0, 0, $m, 1)));

        $revenueData = [];
        $expenseData = [];
        $profitData = [];

        foreach (range(1, 12) as $month) {
            // Fee submission revenue
            $feeSubmissionRevenue = FeeSubmission::whereYear('submission_date', $year)
                ->whereMonth('submission_date', $month)
                ->sum('amount');

            // Registration fee revenue (from admissions created in this month)
            $registrationFeeRevenue = Admission::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('registration_fee', '>', 0)
                ->sum('registration_fee');

            // Total revenue
            $revenue = $feeSubmissionRevenue + ($registrationFeeRevenue ?? 0);

            $expense = Expense::whereYear('date', $year)
                ->whereMonth('date', $month)
                ->sum('amount');

            $profit = $revenue - $expense;

            $revenueData[] = $revenue;
            $expenseData[] = $expense;
            $profitData[] = $profit;
        }

        return response()->json([
            'categories' => $months,
            'series' => [
                ['name' => 'Profit', 'data' => $profitData],
                ['name' => 'Expenses', 'data' => $expenseData],
                ['name' => 'Revenue', 'data' => $revenueData]
            ]
        ]);
    }

    public function getYearlyData()
    {
        // Get years from both fee submissions and admissions
        $feeSubmissionYears = FeeSubmission::selectRaw('YEAR(submission_date) as year')
            ->distinct()
            ->pluck('year');
        
        $admissionYears = Admission::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->pluck('year');
        
        // Merge and get unique years
        $years = $feeSubmissionYears->merge($admissionYears)->unique()->sort()->values();

        $revenueData = [];
        $expenseData = [];
        $profitData = [];

        foreach ($years as $year) {
            // Fee submission revenue
            $feeSubmissionRevenue = FeeSubmission::whereYear('submission_date', $year)->sum('amount');
            
            // Registration fee revenue (from admissions created in this year)
            $registrationFeeRevenue = Admission::whereYear('created_at', $year)
                ->where('registration_fee', '>', 0)
                ->sum('registration_fee');
            
            // Total revenue
            $revenue = $feeSubmissionRevenue + ($registrationFeeRevenue ?? 0);
            
            $expense = Expense::whereYear('date', $year)->sum('amount');
            $profit = $revenue - $expense;

            $revenueData[] = $revenue;
            $expenseData[] = $expense;
            $profitData[] = $profit;
        }

        return response()->json([
            'categories' => $years,
            'series' => [
                ['name' => 'Profit', 'data' => $profitData],
                ['name' => 'Expenses', 'data' => $expenseData],
                ['name' => 'Revenue', 'data' => $revenueData]
            ]
        ]);
    }
}
