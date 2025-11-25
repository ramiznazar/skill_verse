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
        return view('admin.pages.dashboard.test.days.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'test_date' => 'required|date|unique:test_days,test_date',
            'is_open'   => 'required|boolean',
            'note'      => 'nullable|string'
        ]);

        // Get settings
        $s = TestSetting::first();

        // Convert times
        $start  = Carbon::parse($s->daily_start_time);
        $end    = Carbon::parse($s->daily_end_time);
        $step   = $s->slot_duration_minutes;

        $slots = [];

        // Auto-generate slots
        while ($start < $end) {

            $slots[] = [
                'time'     => $start->format('H:i'),
                'capacity' => $s->slot_capacity,
                'booked'   => 0
            ];

            $start->addMinutes($step);
        }

        TestDay::create([
            'test_date' => $request->test_date,
            'slots'     => json_encode($slots),
            'is_open'   => $request->is_open,
            'note'      => $request->note
        ]);

        return redirect()->route('test.days')->with('store', 'Interview day created successfully!');
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
    public function destroy($id){
        $day = TestDay::findOrFail($id);
        $day->delete();
        return redirect()->back()->with('delete', 'Interview day deleted successfully!');
    }
}
