<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lead;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leads = Lead::with('course')->latest()->get();
        return view('admin.pages.dashboard.lead.index', compact('leads'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('admin.pages.dashboard.lead.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'nullable|exists:courses,id',
            'lead_type' => 'nullable',
            'name' => 'required|string|max:255',
            'guardian_name' => 'nullable|string|max:255',
            'guardian_contact' => 'nullable|string|max:20',
            'cnic' => 'nullable|string|max:20',
            'dob' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:male,female',
            'qualification' => 'nullable|string|max:50',
            'last_institute' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'referral_source' => 'nullable|string|max:255',
            'referral_source_contact' => 'nullable|string|max:20',

            
        ]);

        Lead::create($validated);

        return redirect()->back()->with('store', 'Lead created successfully.');
    }

    public function edit(Lead $lead)
    {
        $courses = Course::all();
        return view('admin.pages.dashboard.lead.update', compact('lead', 'courses'));
    }

    public function update(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'course_id' => 'nullable|exists:courses,id',
            'lead_type' => 'nullable',
            'name' => 'required|string|max:255',
            'guardian_name' => 'nullable|string|max:255',
            'guardian_contact' => 'nullable|string|max:20',
            'cnic' => 'nullable|string|max:20',
            'dob' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:male,female',
            'qualification' => 'nullable|string|max:50',
            'last_institute' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'referral_source' => 'nullable|string|max:255',
            'referral_source_contact' => 'nullable|string|max:20',
        ]);

        $lead->update($validated);

        return redirect()->route('lead.index')->with('update', 'Lead updated successfully.');
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();
        return redirect()->route('lead.index')->with('delete', 'Lead deleted successfully.');
    }

    public function show(Lead $lead)
    {
        return view('lead.show', compact('lead'));
    }
}
