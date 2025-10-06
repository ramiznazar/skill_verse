<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationTableController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->get('search', ''));
        $type = $request->get('type', '');
        $status = $request->get('status', ''); // 1=active, 0=inactive
        $dateFrom = $request->get('date_from', '');
        $dateTo = $request->get('date_to', '');

        $query = Notification::query()
            ->withCount([
                'users as recipients_count',
                // Use the actual pivot table name in where clauses:
                'users as unread_count' => fn($q) => $q->where('notification_user.is_read', false),
                'users as read_count' => fn($q) => $q->where('notification_user.is_read', true),
            ]);

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%")
                    ->orWhere('type', 'like', "%{$search}%");
            });
        }

        if ($type !== '') {
            $query->where('type', $type);
        }

        if ($status !== '') {
            $query->where('status', (int) $status);
        }

        if ($dateFrom !== '') {
            $query->whereDate('created_at', '>=', $dateFrom);
        }
        if ($dateTo !== '') {
            $query->whereDate('created_at', '<=', $dateTo);
        }

        $notifications = $query->latest()->paginate(20)->withQueryString();

        // For filter options (distinct types)
        $types = Notification::select('type')->distinct()->orderBy('type')->pluck('type');

        return view('admin.pages.dashboard.notification.index', compact('notifications', 'types', 'search', 'type', 'status', 'dateFrom', 'dateTo'));
    }

    /**
     * Detail page: one notification + all recipients with read/unread status
     */
    public function show(Notification $notification, Request $request)
    {
        $recipients = $notification->users()
            ->select('users.id', 'users.name', 'users.email', 'notification_user.is_read', 'notification_user.created_at as assigned_at', 'notification_user.updated_at as last_action_at')
            ->orderBy('notification_user.is_read') // unread first
            ->orderBy('users.name')
            ->paginate(25)
            ->withQueryString();

        return view('admin.pages.dashboard.notification.show', compact('notification', 'recipients'));
    }

    /**
     * Optional: bulk activate/deactivate notifications
     */
    public function bulkStatus(Request $request)
    {
        $request->validate([
            'ids' => 'required|array|min:1',
            'status' => 'required|in:0,1',
        ]);

        Notification::whereIn('id', $request->ids)->update(['status' => (int) $request->status]);

        return back()->with('status', 'Notifications updated successfully.');
    }
}
