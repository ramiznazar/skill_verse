<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('status', 1)
            ->latest()
            ->take(10) // only last 10 in dropdown
            ->get();

        return response()->json($notifications);
    }

    // Mark a single notification as read
    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->update(['status' => 0]);

        return response()->json(['success' => true]);
    }

    // Mark all as read
    public function markAllAsRead()
    {
        Notification::where('status', 1)->update(['status' => 0]);

        return response()->json(['success' => true]);
    }

    // Example function to create a new notification
    public function createFeeNotification($feeSubmission)
    {
        Notification::create([
            'title' => "Fee Submitted",
            'message' => "Fee of ₨{$feeSubmission->amount} submitted by {$feeSubmission->admission->name}",
            'icon' => "fa fa-money",
            'type' => "fee",
            'status' => 1,
        ]);
    }
}
