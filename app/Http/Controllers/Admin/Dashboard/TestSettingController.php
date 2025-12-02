<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Models\TestSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestSettingController extends Controller
{
    public function index()
    {
        // Ensure settings ALWAYS exist
        $settings = TestSetting::first();

        if (!$settings) {
            $settings = TestSetting::create([
                // 'default_daily_limit'      => 10,
                'is_booking_open'          => true,
                'max_days_ahead'           => 30,
                'daily_start_time'         => '10:00',
                'daily_end_time'           => '16:00',
                'slot_duration_minutes'    => 60,
                'slot_capacity'            => 5,
                'admin_note'               => null
            ]);
        }

        return view('admin.pages.dashboard.test.setting.setting', compact('settings'));
    }


    public function update(Request $request)
    {
        $request->validate([
            'max_days_ahead'        => 'required|integer|min:1',
            'is_booking_open'       => 'required|boolean',
            'daily_start_time'      => 'required',
            'daily_end_time'        => 'required',
            'slot_duration_minutes' => 'required|integer|min:10',
            'slot_capacity'         => 'required|integer|min:1',
            'booking_start_date'    => 'required|date',
            'booking_end_date'      => 'required|date|after_or_equal:booking_start_date',
            'admin_note'            => 'nullable|string'
        ]);


        $settings = TestSetting::first();

        $settings->update([
            'is_booking_open'          => $request->is_booking_open,
            'max_days_ahead'           => $request->max_days_ahead,
            'daily_start_time'         => $request->daily_start_time,
            'daily_end_time'           => $request->daily_end_time,
            'slot_duration_minutes'    => $request->slot_duration_minutes,
            'slot_capacity'            => $request->slot_capacity,
            'booking_start_date'       => $request->booking_start_date,
            'booking_end_date'         => $request->booking_end_date,
            'admin_note'               => $request->admin_note,
        ]);

        return back()->with('update', 'Settings updated successfully!');
    }
}
