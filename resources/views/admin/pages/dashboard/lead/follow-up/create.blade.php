@extends('admin.layouts.main')

@section('content')
<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Leads • Add Follow-up</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <a href="{{ route('lead-followups.index',$lead->id) }}" class="btn btn-sm btn-primary">All Leads</a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>Add New Follow-up</h2>
                    </div>
                    <div class="body">
                        @php
                            // Choose action based on context
                            $action = isset($lead)
                                ? route('lead-followups.store', $lead->id)   // /admin/leads/{lead}/follow-ups
                                : route('lead_follow_ups.store');            // /admin/lead-follow-ups
                            $contactMethods = ['call','whatsapp','sms','in_person','email','other'];
                            $statuses = ['new','no_answer','interested','not_interested','admission_done','callback_requested','rescheduled'];
                        @endphp

                        <form id="follow-up-form" action="{{ $action }}" method="POST" novalidate>
                            @csrf

                            <div class="row">
                                {{-- Contact Method --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contact Method</label>
                                        <select name="contact_method" class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($contactMethods as $cm)
                                                <option value="{{ $cm }}" {{ old('contact_method') === $cm ? 'selected' : '' }}>
                                                    {{ $cm === 'in_person' ? 'In-person' : ucfirst(str_replace('_',' ', $cm)) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('contact_method') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                {{-- Status --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($statuses as $st)
                                                <option value="{{ $st }}" {{ old('status') === $st ? 'selected' : '' }}>
                                                    {{ ucwords(str_replace('_',' ', $st)) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                {{-- Followed At --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Followed At</label>
                                        <input
                                            type="datetime-local"
                                            name="followed_at"
                                            class="form-control"
                                            value="{{ old('followed_at', now()->format('Y-m-d\TH:i')) }}">
                                        @error('followed_at') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Note --}}
                            <div class="form-group">
                                <label>What did the student say?</label>
                                <textarea name="note" class="form-control" rows="4" placeholder="E.g., Asked to call next week, interested in weekend batch...">{{ old('note') }}</textarea>
                                @error('note') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Save Follow-up</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('additional-javascript')
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (window.jQuery && $('#follow-up-form').length) {
        $('#follow-up-form').parsley && $('#follow-up-form').parsley();
    }
});
</script>
@endsection
