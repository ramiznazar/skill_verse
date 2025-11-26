<?php

namespace App\Http\Controllers\Website;

use Carbon\Carbon;
use App\Models\Course;
use App\Models\TestDay;
use App\Models\TestBooking;
use App\Models\TestSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TestBookingController extends Controller
{
    public function create()
    {
        $setting = TestSetting::first(); // your table is interview_settings now
        if (!$setting->is_booking_open) {
            return view('website.pages.test.booking-close');
        }

        // $courses = Course::all();
        $courses = Course::where('discount_offer', 1)
            ->where('is_active', 1)
            ->get();

        $today = Carbon::today();

        // Get all future open days
        $days = TestDay::where('is_open', 1)
            ->whereDate('test_date', '>=', $today)
            ->orderBy('test_date')
            ->get();

        $slots = [];
        // dd($days);
        foreach ($days as $day) {

            $daySlots = json_decode($day->slots, true);

            if (empty($daySlots) || !is_array($daySlots)) {
                continue;
            }

            foreach ($daySlots as $slot) {
                if ($slot['booked'] < $slot['capacity']) {
                    $slots[] = [
                        'id'        => $day->id,
                        'date'      => $day->test_date,
                        'time'      => $slot['time'],
                        'available' => $slot['capacity'] - $slot['booked'],
                    ];
                }
            }
        }

        return view('website.pages.test.booking', compact('courses', 'slots'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'course_id' => 'required|exists:courses,id',
            'slot' => 'required',
        ]);

        // Split slot value
        [$dayId, $slotTime] = explode('|', $request->slot);

        $day = TestDay::findOrFail($dayId);
        $slots = json_decode($day->slots, true);

        // Find selected slot
        foreach ($slots as $index => $slot) {
            if ($slot['time'] === $slotTime) {

                // Check if available
                if ($slot['booked'] >= $slot['capacity']) {
                    return back()->withErrors(['slot' => 'This slot is fully booked now.']);
                }
                // Increase booked
                $slots[$index]['booked']++;
            }
        }

        // Save updated JSON
        $day->slots = json_encode($slots);
        $day->save();

        // Create booking
        $booking = TestBooking::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'course_id' => $request->course_id,
            'test_day_id' => $dayId,
            'test_date' => $day->test_date,
            'slot_time' => $slotTime, // NEW FIELD
            'purpose' => $request->purpose,
            'status' => 'pending',
        ]);
        // session(['last_booking_id' => $booking->id]);

        return redirect()->route('test.booking.summary', $booking->id);
    }

    public function summary($id)
    {
        $booking = TestBooking::with(['testDay', 'course'])->findOrFail($id);

        $name = $booking->name;
        $date = $booking->testDay->test_date;
        $time = $booking->slot_time;

        return view('website.pages.test.summary', compact('booking', 'name', 'date', 'time'));
    }
}
