<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReferralCommission;

class ReferralCommissionController extends Controller
{
    public function index()
    {
        // Get all referral commissions with admission and course details
        $commissions = ReferralCommission::with(['admission.course'])
            ->latest()
            ->get();

        return view('admin.pages.dashboard.referral-commission.index', compact('commissions'));
    }
}
