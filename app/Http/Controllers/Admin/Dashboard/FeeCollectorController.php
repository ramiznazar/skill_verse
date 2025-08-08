<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeSubmission;
use App\Models\Account;
use App\Models\User;

class FeeCollectorController extends Controller
{
    public function index()
    {
        $feeSubmissions = FeeSubmission::with(['admission.course', 'user', 'account'])->get();

        // Group by user (for "hand") or account (for "account")
        $groupedSubmissions = $feeSubmissions->groupBy(function ($item) {
            return $item->payment_method === 'hand'
                ? 'user_' . $item->user_id
                : 'account_' . $item->account_id;
        });

        return view('admin.pages.dashboard.fee-collector.index', compact('groupedSubmissions'));
    }
    public function collectorHistory(Request $request, User $user)
    {
        $query = FeeSubmission::with('admission.course')
            ->where('user_id', $user->id)
            ->where('payment_method', 'hand');

        if ($request->filled('month')) {
            $query->whereMonth('submission_date', $request->month);
        }

        if ($request->filled('year')) {
            $query->whereYear('submission_date', $request->year);
        }

        $submissions = $query->latest()->get();

        return view('admin.pages.dashboard.fee-collector.history', [
            'user' => $user,
            'submissions' => $submissions,
            'type' => 'collector',
        ]);
    }

    public function accountHistory(Request $request, Account $account)
    {
        $query = FeeSubmission::with('admission.course')
            ->where('account_id', $account->id)
            ->where('payment_method', 'account');

        if ($request->filled('month')) {
            $query->whereMonth('submission_date', $request->month);
        }

        if ($request->filled('year')) {
            $query->whereYear('submission_date', $request->year);
        }

        $submissions = $query->latest()->get();

        return view('admin.pages.dashboard.fee-collector.history', [
            'account' => $account,
            'submissions' => $submissions,
            'type' => 'account',
        ]);
    }
}
