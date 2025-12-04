<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Models\Batch;
use App\Models\Course;
use App\Models\TestBooking;
use Illuminate\Http\Request;
use App\Mail\StudentPassMail;
use App\Jobs\SendPassEmailJob;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class TestBookingController extends Controller
{
    public function index(Request $request)
    {
        $courseId = $request->course_id;
        $date = $request->date;
        $time = $request->time;
        $attendance = $request->attendance_status;
        $status = $request->status;

        $query = TestBooking::with('course', 'testDay')->orderBy('id', 'DESC');

        // Course filter
        if (!empty($courseId)) {
            $query->where('course_id', $courseId);
        }

        // Date filter
        if (!empty($date)) {
            $query->whereHas('testDay', function ($q) use ($date) {
                $q->whereDate('test_date', $date);
            });
        }

        // Time filter
        if (!empty($time)) {
            $query->whereHas('testDay', function ($q) use ($time) {
                $q->whereTime('test_start_time', $time);
            });
        }

        // Attendance filter
        if (!empty($attendance)) {
            $query->where('attendance_status', $attendance);
        }

        // Status filter (pending/confirmed/etc)
        if (!empty($status)) {
            $query->where('status', $status);
        }

        $bookings = $query->paginate(20)->withQueryString();
        $courses = Course::select('id', 'title')->orderBy('title')->get();

        return view(
            'admin.pages.dashboard.test.booking.index',
            compact('bookings', 'courses', 'courseId', 'date', 'time', 'attendance', 'status')
        );
    }

    public function show($id)
    {
        $booking = TestBooking::with('course')->findOrFail($id);
        return view('admin.pages.dashboard.test.booking.show', compact('booking'));
    }

    public function destroy($id)
    {
        TestBooking::findOrFail($id)->delete();
        return back()->with('delete', 'Booking deleted successfully!');
    }

    public function markAttendance(Request $request)
    {
        $booking = TestBooking::findOrFail($request->id);

        $booking->attendance_status = $request->status;
        $booking->attempted_at = now();
        $booking->save();

        return response()->json([
            'success' => true,
            'status' => $request->status,
        ]);
    }

    public function markResult(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:test_bookings,id',
            'result' => 'required|in:pass,fail'
        ]);

        $booking = TestBooking::findOrFail($request->id);
        $booking->result_status = $request->result;
        $booking->save();

        return response()->json([
            'status' => $request->result
        ]);
    }

    public function confirmPass(Request $request)
    {
        try {
            $request->validate([
                'booking_id' => 'required|exists:test_bookings,id',
                'batch_id'   => 'required|exists:batches,id',
            ]);

            $booking = TestBooking::findOrFail($request->booking_id);
            $batch   = Batch::findOrFail($request->batch_id);

            // Check capacity
            $assignedCount = TestBooking::where('batch_id', $batch->id)->count();
            if ($assignedCount >= $batch->capacity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Batch is full'
                ], 422);
            }

            // Update booking
            $booking->update([
                'result_status'     => 'pass',
                'batch_id'          => $batch->id,
                'attendance_status' => 'attended',
            ]);

            // ⭐ Send email directly (NO JOB)
            if ($booking->email) {
                Mail::to($booking->email)->send(new StudentPassMail($booking, $batch));
            }

            return response()->json([
                'success' => true,
                'message' => "PASS assigned successfully.",
                'booking_id' => $booking->id
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function loadBatches(Request $request)
    {
        $booking = TestBooking::findOrFail($request->id);

        $batches = Batch::where('course_id', $booking->course_id)
            ->where('status', 'active')
            ->get()
            ->map(function ($batch) {
                $assigned = TestBooking::where('batch_id', $batch->id)->count();
                $batch->assigned = $assigned;
                return $batch;
            });

        return response()->json([
            'batches' => $batches
        ]);
    }
}
