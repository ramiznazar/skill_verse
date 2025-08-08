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
                            <h2>Add New Leads</h2>
                        </div>
                        <div class="body">
                            <form action="{{ route('lead.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="lead_type" value="admin">

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Course</label>
                                        <select name="course_id" class="form-control">
                                            <option value="">Select Course</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}"
                                                    {{ old('course_id') == $course->id ? 'selected' : '' }}>
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
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <label>Guardian Name</label>
                                        <input type="text" name="guardian_name" class="form-control"
                                            value="{{ old('guardian_name') }}">
                                        @error('guardian_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label>Guardian Contact</label>
                                        <input type="text" name="guardian_contact" class="form-control"
                                            value="{{ old('guardian_contact') }}">
                                        @error('guardian_contact')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label>CNIC</label>
                                        <input type="text" name="cnic" class="form-control"
                                            value="{{ old('cnic') }}">
                                        @error('cnic')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <label>Date of Birth</label>
                                        <input type="date" name="dob" class="form-control"
                                            value="{{ old('dob') }}">
                                        @error('dob')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label>Phone</label>
                                        <input type="text" name="phone" class="form-control"
                                            value="{{ old('phone') }}">
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
                                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female
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
                                                {{ old('qualification') == 'middle' ? 'selected' : '' }}>Middle</option>
                                            <option value="metric"
                                                {{ old('qualification') == 'metric' ? 'selected' : '' }}>Metric</option>
                                            <option value="intermediate"
                                                {{ old('qualification') == 'intermediate' ? 'selected' : '' }}>Intermediate
                                            </option>
                                            <option value="graduate"
                                                {{ old('qualification') == 'graduate' ? 'selected' : '' }}>Graduate
                                            </option>
                                            <option value="m-phill"
                                                {{ old('qualification') == 'm-phill' ? 'selected' : '' }}>M Phill</option>
                                        </select>
                                        @error('qualification')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label>Last Institute</label>
                                        <input type="text" name="last_institute" class="form-control"
                                            value="{{ old('last_institute') }}">
                                        @error('last_institute')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-3">

                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label for="referral_type">Referral Type</label>
                                        <select name="referral_type" id="referral_type" class="form-control">
                                            <option value="">Select Type</option>
                                            <option value="ads" {{ old('referral_type') == 'ads' ? 'selected' : '' }}>
                                                Ads</option>
                                            <option value="referral"
                                                {{ old('referral_type') == 'referral' ? 'selected' : '' }}>Referral
                                            </option>
                                            <option value="other"
                                                {{ old('referral_type') == 'other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        @error('referral_type')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-3" id="referral_details_section" style="display: none;">
                                    <div class="col-md-6">
                                        <label>Referral Source</label>
                                        <input type="text" name="referral_source" class="form-control"
                                            value="{{ old('referral_source') }}">
                                        @error('referral_source')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label>Referral Source Contact</label>
                                        <input type="text" name="referral_source_contact" class="form-control"
                                            value="{{ old('referral_source_contact') }}">
                                        @error('referral_source_contact')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>

                                <div class="form-group mt-3">
                                    <label>Address</label>
                                    <textarea name="address" class="form-control" rows="3">{{ old('address') }}</textarea>
                                    @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary mt-4">Submit Lead</button>
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
        $(function() {
            // Initialize multiselect if any
            $('#food').multiselect();

            // Initialize Parsley.js for validation
            $('#lead-form').parsley();
        });

        // Referral Type toggle logic
        document.addEventListener('DOMContentLoaded', function() {
            const referralType = document.getElementById('referral_type');
            const referralDetails = document.getElementById('referral_details_section');

            function toggleReferralFields() {
                const selected = referralType.value;
                if (selected === 'referral') {
                    referralDetails.style.display = 'flex';
                } else {
                    referralDetails.style.display = 'none';
                    referralDetails.querySelectorAll('input').forEach(input => input.value = '');
                }
            }

            // On page load
            toggleReferralFields();

            // On change
            referralType.addEventListener('change', toggleReferralFields);
        });
    </script>
@endsection
