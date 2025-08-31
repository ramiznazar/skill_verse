<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Models\Lead;
use App\Models\LeadFollowUp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;


class LeadFollowUpController extends Controller
{
    private array $contactMethods = ['call', 'whatsapp', 'sms', 'in_person', 'email', 'other'];
    private array $statuses = ['new', 'no_answer', 'interested', 'not_interested', 'admission_done', 'callback_requested', 'rescheduled'];

    /** List only this lead's follow-ups */
    public function index(Lead $lead)
    {
        $followUps = $lead->followUps()
            ->with('user')
            ->orderByDesc('followed_at')
            ->orderByDesc('id')
            ->paginate(20);

        return view('admin.pages.dashboard.lead.follow-up.index', compact('lead', 'followUps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Lead $lead)
    {
        return view('admin.pages.dashboard.lead.follow-up.create', compact('lead'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Lead $lead)
    {
        $data = $request->validate([
            'contact_method' => ['nullable', Rule::in($this->contactMethods)],
            'status'         => ['nullable', Rule::in($this->statuses)],
            'note'           => ['nullable', 'string'],
            'followed_at'    => ['nullable', 'date'],
        ]);

        $fu = new LeadFollowUp($data);
        $fu->lead_id = $lead->id;
        $fu->user_id = $request->user()->id ?? null;
        if (empty($fu->followed_at)) $fu->followed_at = now();
        $fu->save();

        return redirect()
            ->route('lead-followups.index', $lead->id)
            ->with('store', 'Follow-up added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lead $lead, LeadFollowUp $followup)
    {
        // ensure this follow-up belongs to this lead
        abort_unless((int)$followup->lead_id === (int)$lead->id, 404);

        return view('admin.pages.dashboard.lead.follow-up.update', [
            'lead' => $lead,
            'followup' => $followup, // <-- matches your Blade variable
        ]);
    }

    public function update(Request $request, Lead $lead, LeadFollowUp $followup)
    {
        abort_unless((int)$followup->lead_id === (int)$lead->id, 404);

        $contactMethods = ['call', 'whatsapp', 'sms', 'in_person', 'email', 'other'];
        $statuses = ['new', 'no_answer', 'interested', 'not_interested', 'admission_done', 'callback_requested', 'rescheduled'];

        $data = $request->validate([
            'contact_method' => ['nullable', Rule::in($contactMethods)],
            'status'         => ['nullable', Rule::in($statuses)],
            'note'           => ['nullable', 'string'],
            'followed_at'    => ['nullable', 'date'],
        ]);

        $followup->update($data);

        return redirect()
            ->route('lead-followups.index', ['lead' => $lead->id])
            ->with('update', 'Follow-up updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lead $lead, $followUpId)
    {
        $followUp = $lead->followUps()->whereKey($followUpId)->firstOrFail();
        $followUp->delete();

        return redirect()
            ->route('lead-followups.index', ['lead' => $lead->id])
            ->with('delete', 'Follow-up deleted.');
    }
}
