<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;
use App\Models\User;

class NotificationController extends Controller
{
    /**
     * Return ONLY unread notifications for the current user
     * (limited to last 10, and only active notifications: status=1)
     */
    public function index()
    {
        $user = auth()->user();

        $notifications = Notification::where('status', 1)
            ->whereHas('users', function ($q) use ($user) {
                $q->where('user_id', $user->id)
                    ->where('is_read', false);
            })
            ->latest()
            ->take(10)
            ->get([
                'id',
                'title',
                'message',
                'icon',
                'type',
                'created_at'
            ]);

        return response()->json($notifications);
    }

    /**
     * Mark ONE notification as read for the CURRENT USER only
     */
    public function markAsRead($id)
    {
        $userId = auth()->id();

        $updated = DB::table('notification_user')
            ->where('notification_id', $id)
            ->where('user_id', $userId)
            ->update(['is_read' => true, 'updated_at' => now()]);

        return response()->json(['success' => $updated > 0]);
    }

    /**
     * Mark ALL assigned notifications as read for the CURRENT USER only
     */
    public function markAllAsRead()
    {
        $userId = auth()->id();

        DB::table('notification_user')
            ->where('user_id', $userId)
            ->update(['is_read' => true, 'updated_at' => now()]);

        return response()->json(['success' => true]);
    }

    /**
     * Example: create a Fee notification and attach to target roles/users.
     * Call this from your Fee submission flow.
     */
    public function createFeeNotification($feeSubmission)
    {
        $notification = Notification::create([
            'title' => "Fee Submitted",
            'message' => "Fee of ₨{$feeSubmission->amount} submitted by {$feeSubmission->admission->name}",
            'icon' => "fa fa-money",
            'type' => "fee",
            'status' => 1,
        ]);

        // Attach recipients (Admins / Administrators / Partners)
        $userIds = $this->resolveRecipients(['admin', 'administrator', 'partner']);
        $this->attachRecipients($notification, $userIds);
    }

    /**
     * Resolve recipients by roles.
     * Supports both Spatie Permission and a simple `role` column fallback.
     *
     * @param  array $roleNames
     * @return \Illuminate\Support\Collection user IDs
     */
    private function resolveRecipients(array $roleNames)
    {
        // Returns Collection of user IDs
        return User::whereIn('role', $roleNames)->pluck('id');
    }
    /**
     * Attach notification to users without duplicating rows
     */
    private function attachRecipients(Notification $notification, $userIds)
    {
        if (empty($userIds) || count($userIds) === 0)
            return;

        // Build attach payload: user_id => ['is_read' => false, timestamps...]
        $attach = [];
        $now = now();
        foreach ($userIds as $uid) {
            $attach[$uid] = ['is_read' => false, 'created_at' => $now, 'updated_at' => $now];
        }

        $notification->users()->syncWithoutDetaching($attach);
    }
}
