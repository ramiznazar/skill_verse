<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Models\TestDay;
use App\Models\TestSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class TestDayController extends Controller
{
    public function index()
    {
        $days = TestDay::orderBy('test_date')->get();
        return view('admin.pages.dashboard.test.days.index', compact('days'));
    }

    public function create()
    {
        $setting = TestSetting::first();
        return view('admin.pages.dashboard.test.days.create', compact('setting'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'test_dates' => 'required|string',
            'is_open'    => 'required|boolean',
            'note'       => 'nullable|string'
        ]);

        $dates = explode(',', $request->test_dates);

        $setting = TestSetting::first();

        foreach ($dates as $date) {

            $date = trim($date);

            // RANGE CHECK
            if ($date < $setting->booking_start_date || $date > $setting->booking_end_date) {
                continue; // skip invalid date
            }

            // SKIP if exists
            if (TestDay::where('test_date', $date)->exists()) {
                continue;
            }

            // CLOSED = EMPTY SLOTS
            if ($request->is_open == 0) {
                TestDay::create([
                    'test_date' => $date,
                    'slots'     => json_encode([]),
                    'is_open'   => 0,
                    'note'      => $request->note
                ]);
                continue;
            }

            // OTHERWISE AUTO GENERATE
            $start  = Carbon::parse($setting->daily_start_time);
            $end    = Carbon::parse($setting->daily_end_time);
            $step   = $setting->slot_duration_minutes;

            $slots = [];

            while ($start->lt($end)) {
                $slots[] = [
                    'time'     => $start->format('H:i'),
                    'capacity' => $setting->slot_capacity,
                    'booked'   => 0
                ];

                $start->addMinutes($step);
            }

            TestDay::create([
                'test_date' => $date,
                'slots'     => json_encode($slots),
                'is_open'   => 1,
                'note'      => $request->note
            ]);
        }

        return redirect()->route('test.days')
            ->with('store', 'Selected dates and slots created successfully!');
    }

    public function edit($id)
    {
        $day = TestDay::findOrFail($id);

        // Already casted to array by model
        return view('admin.pages.dashboard.test.days.edit', compact('day'));
    }


    public function update(Request $request, $id)
    {
        $day = TestDay::findOrFail($id);

        $request->validate([
            'is_open' => 'required|boolean',
            'note'    => 'nullable|string',
            'slots'   => 'required|array',
            'slots.*.time'     => 'required',
            'slots.*.capacity' => 'required|integer|min:1',
            'slots.*.booked'   => 'required|integer|min:0'
        ]);

        $day->update([
            'slots' => json_encode($request->slots),
            'is_open' => $request->is_open,
            'note' => $request->note
        ]);

        return redirect()->route('test.days')->with('update', 'Interview day updated successfully!');
    }
    public function destroy($id)
    {
        $day = TestDay::findOrFail($id);
        $day->delete();
        return redirect()->back()->with('delete', 'Interview day deleted successfully!');
    }
}
