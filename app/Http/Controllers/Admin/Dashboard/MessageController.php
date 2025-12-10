<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserMessage;
use App\Models\TestBooking;

class MessageController extends Controller
{
    /**
     * Return unread messages from contact form and booking form
     * Combines UserMessage and TestBooking into a unified response
     */
    public function index()
    {
        // Get unread contact messages
        $contactMessages = UserMessage::where('is_read', false)
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($message) {
                return [
                    'id' => 'contact_' . $message->id,
                    'type' => 'contact',
                    'title' => 'New Contact Message',
                    'message' => $message->message ? substr($message->message, 0, 100) . (strlen($message->message) > 100 ? '...' : '') : 'No message',
                    'name' => $message->name,
                    'email' => $message->email,
                    'phone' => $message->phone,
                    'icon' => 'fa fa-envelope',
                    'created_at' => $message->created_at->toISOString(),
                ];
            });

        // Get unread booking messages
        $bookingMessages = TestBooking::where('is_read', false)
            ->with('course')
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($booking) {
                return [
                    'id' => 'booking_' . $booking->id,
                    'type' => 'booking',
                    'title' => 'New Interview Booking',
                    'message' => $booking->course ? "Booked for {$booking->course->name}" : 'New interview booking',
                    'name' => $booking->name,
                    'email' => $booking->email,
                    'phone' => $booking->phone,
                    'course' => $booking->course ? $booking->course->name : null,
                    'icon' => 'fa fa-calendar-check',
                    'created_at' => $booking->created_at->toISOString(),
                ];
            });

        // Combine and sort by created_at
        $allMessages = $contactMessages->concat($bookingMessages)
            ->sortByDesc('created_at')
            ->take(10)
            ->values();

        return response()->json($allMessages);
    }

    /**
     * Mark a message as read
     */
    public function markAsRead(Request $request, $id)
    {
        try {
            $parts = explode('_', $id, 2);
            if (count($parts) !== 2) {
                return response()->json(['success' => false, 'error' => 'Invalid message ID format'], 400);
            }

            [$type, $messageId] = $parts;

            if ($type === 'contact') {
                $message = UserMessage::find($messageId);
                if ($message) {
                    $message->update(['is_read' => true]);
                    return response()->json(['success' => true]);
                }
            } elseif ($type === 'booking') {
                $booking = TestBooking::find($messageId);
                if ($booking) {
                    $booking->update(['is_read' => true]);
                    return response()->json(['success' => true]);
                }
            }

            return response()->json(['success' => false, 'error' => 'Message not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Mark all messages as read
     */
    public function markAllAsRead()
    {
        UserMessage::where('is_read', false)->update(['is_read' => true]);
        TestBooking::where('is_read', false)->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }
}
