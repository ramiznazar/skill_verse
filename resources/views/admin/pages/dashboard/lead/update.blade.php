@extends('admin.layouts.main')

@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Leads</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('lead.index') }}" class="btn btn-sm btn-primary" title="">All Leads</a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Update Lead</h2>
                        </div>
                        <div class="body">
                            <form id="lead-form" action="{{ route('lead.update', $lead->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="lead_type" value="admin">

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Course</label>
                                        <select name="course_id" class="form-control">
                                            <option value="">Select Course</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}"
                                                    {{ old('course_id', $lead->course_id) == $course->id ? 'selected' : '' }}>
                                                    {{ $course->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('course_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label>Full Name</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name', $lead->name) }}">
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <label>Guardian Name</label>
                                        <input type="text" name="guardian_name" class="form-control"
                                            value="{{ old('guardian_name', $lead->guardian_name) }}">
                                        @error('guardian_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label>Guardian Contact</label>
                                        <input type="text" name="guardian_contact" class="form-control"
                                            value="{{ old('guardian_contact', $lead->guardian_contact) }}">
                                        @error('guardian_contact')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label>CNIC</label>
                                        <input type="text" name="cnic" class="form-control"
                                            value="{{ old('cnic', $lead->cnic) }}">
                                        @error('cnic')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <label>Date of Birth</label>
                                        <input type="date" name="dob" class="form-control"
                                            value="{{ old('dob', optional(\Carbon\Carbon::parse($lead->dob))->format('Y-m-d')) }}">
                                        @error('dob')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email', $lead->email) }}">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label>Phone</label>
                                        <input type="text" name="phone" class="form-control"
                                            value="{{ old('phone', $lead->phone) }}">
                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <label>Gender</label>
                                        <select name="gender" class="form-control">
                                            <option value="">Select Gender</option>
                                            <option value="male"
                                                {{ old('gender', $lead->gender) == 'male' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="female"
                                                {{ old('gender', $lead->gender) == 'female' ? 'selected' : '' }}>Female
                                            </option>
                                        </select>
                                        @error('gender')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label>Qualification</label>
                                        <select name="qualification" class="form-control">
                                            <option value="">Select</option>
                                            <option value="middle"
                                                {{ old('qualification', $lead->qualification) == 'middle' ? 'selected' : '' }}>
                                                Middle</option>
                                            <option value="metric"
                                                {{ old('qualification', $lead->qualification) == 'metric' ? 'selected' : '' }}>
                                                Metric</option>
                                            <option value="intermediate"
                                                {{ old('qualification', $lead->qualification) == 'intermediate' ? 'selected' : '' }}>
                                                Intermediate</option>
                                            <option value="graduate"
                                                {{ old('qualification', $lead->qualification) == 'graduate' ? 'selected' : '' }}>
                                                Graduate</option>
                                            <option value="m-phill"
                                                {{ old('qualification', $lead->qualification) == 'm-phill' ? 'selected' : '' }}>
                                                M Phill</option>
                                        </select>
                                        @error('qualification')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label>Lead Status</label>
                                        <select name="status" class="form-control">
                                            <option value="">Select Status</option>
                                            <option value="new"
                                                {{ old('status', $lead->status ?? '') == 'new' ? 'selected' : '' }}>New
                                            </option>
                                            <option value="contacted"
                                                {{ old('status', $lead->status ?? '') == 'contacted' ? 'selected' : '' }}>
                                                Contacted</option>
                                            <option value="converted"
                                                {{ old('status', $lead->status ?? '') == 'converted' ? 'selected' : '' }}>
                                                Converted</option>
                                            <option value="lost"
                                                {{ old('status', $lead->status ?? '') == 'lost' ? 'selected' : '' }}>Lost
                                            </option>
                                        </select>
                                        @error('status')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>

                                {{-- Referral Type --}}
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label>Full Fee</label>
                                        <input type="text" name="full_fee" class="form-control"
                                            value="{{ old('full_fee', $lead->full_fee) }}">
                                        @error('full_fee')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="referral_type">Referral Type</label>
                                        <select name="referral_type" id="referral_type" class="form-control">
                                            <option value="">Select Type</option>
                                            <option value="ads"
                                                {{ old('referral_type', $lead->referral_type) == 'ads' ? 'selected' : '' }}>
                                                Ads</option>
                                            <option value="referral"
                                                {{ old('referral_type', $lead->referral_type) == 'referral' ? 'selected' : '' }}>
                                                Referral</option>
                                            <option value="other"
                                                {{ old('referral_type', $lead->referral_type) == 'other' ? 'selected' : '' }}>
                                                Other</option>
                                        </select>
                                        @error('referral_type')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Referral Details (toggle) --}}
                                @php
                                    $showReferral = old('referral_type', $lead->referral_type) === 'referral';
                                @endphp
                                <div class="row mt-3" id="referral_details_section"
                                    style="display: {{ $showReferral ? 'flex' : 'none' }};">
                                    <div class="col-md-6">
                                        <label>Referral Source</label>
                                        <input type="text" name="referral_source" class="form-control"
                                            value="{{ old('referral_source', $lead->referral_source) }}">
                                        @error('referral_source')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label>Referral Source Contact</label>
                                        <input type="text" name="referral_source_contact" class="form-control"
                                            value="{{ old('referral_source_contact', $lead->referral_source_contact) }}">
                                        @error('referral_source_contact')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <label>Address</label>
                                    <textarea name="address" class="form-control" rows="3">{{ old('address', $lead->address) }}</textarea>
                                    @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary mt-4">Update Lead</button>
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
        document.addEventListener('DOMContentLoaded', function() {
            // Parsley validation (ensure the ID matches the form)
            if (window.jQuery && $('#lead-form').length) {
                $('#lead-form').parsley && $('#lead-form').parsley();
            }

            const referralType = document.getElementById('referral_type');
            const referralDetails = document.getElementById('referral_details_section');

            function toggleReferralFields() {
                const selected = referralType.value;
                if (selected === 'referral') {
                    referralDetails.style.display = 'flex';
                } else {
                    referralDetails.style.display = 'none';
                    referralDetails.querySelectorAll('input').forEach(i => i.value = '');
                }
            }

            // initial state (covers server-rendered state + back/validation)
            toggleReferralFields();

            referralType.addEventListener('change', toggleReferralFields);
        });
    </script>
@endsection
