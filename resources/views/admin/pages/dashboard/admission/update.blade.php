@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Admissions</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('admission.index') }}" class="btn btn-sm btn-primary" title="">All Admissions</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Update Student Admission</h2>
                        </div>
                        <div class="body">
                            <form id="admission-form" action="{{ route('admission.update', $admission->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- Course & Batch --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Course</label>
                                        <select name="course_id" id="course_id" class="form-control">
                                            <option value="">Select Course</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}"
                                                    {{ old('course_id', $admission->course_id) == $course->id ? 'selected' : '' }}>
                                                    {{ $course->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('course_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label>Batch</label>
                                        <select name="batch_id" id="batch_id" class="form-control">
                                            <option value="">Select Batch</option>
                                            @foreach ($batches as $batch)
                                                <option value="{{ $batch->id }}"
                                                    {{ old('batch_id', $admission->batch_id) == $batch->id ? 'selected' : '' }}>
                                                    {{ $batch->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('batch_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <hr class="mt-4">

                                {{-- Student Info --}}
                                <div class="row mt-2">
                                    <div class="col-md-4">
                                        <label>Image</label>
                                        <input type="file" name="image" class="form-control" accept="image/*">
                                        @error('image')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label>Full Name</label>
                                        <input type="text" name="name" value="{{ old('name', $admission->name) }}"
                                            class="form-control">
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label>CNIC</label>
                                        <input type="text" name="cnic" value="{{ old('cnic', $admission->cnic) }}"
                                            class="form-control">
                                        @error('cnic')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-4">
                                        <label>Guardian Name</label>
                                        <input type="text" name="guardian_name"
                                            value="{{ old('guardian_name', $admission->guardian_name) }}"
                                            class="form-control">
                                        @error('guardian_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label>Guardian Contact</label>
                                        <input type="text" name="guardian_contact"
                                            value="{{ old('guardian_contact', $admission->guardian_contact) }}"
                                            class="form-control">
                                        @error('guardian_contact')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label>Date of Birth</label>
                                        <input type="date" name="dob" value="{{ old('dob', $admission->dob) }}"
                                            class="form-control">
                                        @error('dob')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-4">
                                        <label>Email</label>
                                        <input type="email" name="email" value="{{ old('email', $admission->email) }}"
                                            class="form-control">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label>Phone</label>
                                        <input type="text" name="phone" value="{{ old('phone', $admission->phone) }}"
                                            class="form-control">
                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label>Joining Date</label>
                                        <input type="date" name="joining_date"
                                            value="{{ old('joining_date', $admission->joining_date) }}"
                                            class="form-control">
                                        @error('joining_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-4">
                                        <label>Status</label>
                                        <select name="student_status" class="form-control">
                                            <option value="active"
                                                {{ old('status', $admission->student_status) == 'active' ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="unactive"
                                                {{ old('status', $admission->student_status) == 'unactive' ? 'selected' : '' }}>
                                                UnActive</option>
                                        </select>
                                        @error('status')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label>Gender</label>
                                        <select name="gender" class="form-control">
                                            <option value="">Select Gender</option>
                                            <option value="male"
                                                {{ old('gender', $admission->gender) == 'male' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="female"
                                                {{ old('gender', $admission->gender) == 'female' ? 'selected' : '' }}>
                                                Female</option>
                                        </select>
                                        @error('gender')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label>Qualification</label>
                                        <select name="qualification" class="form-control">
                                            @foreach (['middle', 'metric', 'intermediate', 'graduate', 'm-phill'] as $q)
                                                <option value="{{ $q }}"
                                                    {{ old('qualification', $admission->qualification) == $q ? 'selected' : '' }}>
                                                    {{ ucfirst($q) }}</option>
                                            @endforeach
                                        </select>
                                        @error('qualification')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <label>Last Institute</label>
                                        <input type="text" name="last_institute"
                                            value="{{ old('last_institute', $admission->last_institute) }}"
                                            class="form-control">
                                        @error('last_institute')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-4">
                                        <label>Referral Source</label>
                                        <input type="text" name="referral_source"
                                            value="{{ old('referral_source', $admission->referral_source) }}" class="form-control">
                                        @error('referral_source')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label>Source Contact #</label>
                                        <input type="number" name="referral_source_contact"
                                            value="{{ old('referral_source_contact', $admission->referral_source_contact) }}" class="form-control">
                                        @error('referral_source_contact')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label>Source Commission (%)</label>
                                        <input type="number" name="referral_source_commission"
                                            value="{{ old('referral_source_commission', $admission->referral_source_commission) }}" class="form-control">
                                        @error('referral_source_commission')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <label>Address</label>
                                    <textarea name="address" class="form-control" rows="3">{{ old('address', $admission->address) }}</textarea>
                                    @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <hr class="mt-4">

                                {{-- Fee Section --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Payment Type</label>
                                        <div>
                                            <label><input type="radio" name="payment_type" value="full_fee"
                                                    {{ old('payment_type', $admission->payment_type) == 'full_fee' ? 'checked' : '' }}>
                                                Full Payment</label><br>
                                            <label><input type="radio" name="payment_type" value="installment"
                                                    {{ old('payment_type', $admission->payment_type) == 'installment' ? 'checked' : '' }}>
                                                Installments (+₨3000)</label>
                                        </div>
                                        @error('payment_type')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label>Total Fee</label>
                                        <input type="number" id="full_fee" name="full_fee" class="form-control"
                                            value="{{ old('full_fee', $admission->full_fee) }}">
                                        @error('full_fee')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div id="installment-section"
                                    style="{{ old('payment_type', $admission->payment_type) == 'installment' ? '' : 'display:none;' }}"
                                    class="mt-3">
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label>Installment Count</label>
                                            <select id="installment_count" class="form-control">
                                                <option value="2">2 Installments</option>
                                                <option value="3" selected>3 Installments</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Installment 1</label>
                                            <input type="number" name="installment_1" id="installment_1"
                                                class="form-control"
                                                value="{{ old('installment_1', $admission->installment_1) }}">
                                            @error('installment_1')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label>Installment 2</label>
                                            <input type="number" name="installment_2" id="installment_2"
                                                class="form-control"
                                                value="{{ old('installment_2', $admission->installment_2) }}">
                                            @error('installment_2')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-4" id="installment_3_wrapper">
                                            <label>Installment 3</label>
                                            <input type="number" name="installment_3" id="installment_3"
                                                class="form-control"
                                                value="{{ old('installment_3', $admission->installment_3) }}">
                                            @error('installment_3')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mt-4">Update Admission</button>
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
            // validation needs name of the element
            $('#food').multiselect();

            // initialize after multiselect
            $('#basic-form').parsley();
        });
    </script>
    <script>
        // Load batches by course
        $('#course_id').on('change', function() {
            let courseId = $(this).val();
            $('#batch_id').html('<option>Loading...</option>');
            $.get(`/get-batches/${courseId}`, function(data) {
                let html = '<option value="">Select Batch</option>';
                data.forEach(batch => {
                    html +=
                        `<option value="${batch.id}" data-fee="${batch.course.full_fee}">${batch.title} (${batch.shift})</option>`;
                });
                $('#batch_id').html(html);
            });
        });
        let fullFee = 0;

        // When batch is selected, set fee value
        $('#batch_id').on('change', function() {
            let fee = $(this).find(':selected').data('fee') || 0;
            fullFee = parseInt(fee);
            $('#full_fee').val(fullFee);
            autoDistributeInstallments();
        });

        // When admin edits the fee manually
        $('#full_fee').on('input', function() {
            fullFee = parseInt($(this).val() || 0);
            autoDistributeInstallments();
        });

        // Toggle section
        $('input[name="payment_type"]').on('change', function() {
            if ($(this).val() === 'installment') {
                $('#installment-section').show();
                autoDistributeInstallments();
            } else {
                $('#installment-section').hide();
            }
        });

        // Handle installment count dropdown change
        $('#installment_count').on('change', function() {
            let count = parseInt($(this).val());
            if (count === 2) {
                $('#installment_3_wrapper').hide();
                $('#installment_3').val('');
            } else {
                $('#installment_3_wrapper').show();
            }
            autoDistributeInstallments();
        });

        // Manual edit of installments (1 and 2) triggers recalculation
        $('#installment_1, #installment_2').on('input', function() {
            adjustRemainingInstallments();
        });

        // Distribute initial fee
        function autoDistributeInstallments() {
            const count = parseInt($('#installment_count').val());
            const total = fullFee + 3000;

            if (count === 2) {
                const half = Math.ceil(total / 2);
                $('#installment_1').val(half);
                $('#installment_2').val(total - half);
                $('#installment_3').val('');
            } else {
                const part = Math.floor(total / 3);
                const remain = total - (part * 2);
                $('#installment_1').val(part);
                $('#installment_2').val(part);
                $('#installment_3').val(remain);
            }
        }

        // Re-adjust remaining amount based on admin input
        function adjustRemainingInstallments() {
            const count = parseInt($('#installment_count').val());
            const total = fullFee + 3000;

            const inst1 = parseInt($('#installment_1').val()) || 0;
            const inst2 = parseInt($('#installment_2').val()) || 0;

            if (count === 2) {
                $('#installment_2').val(total - inst1);
                $('#installment_3').val('');
            } else {
                const inst3 = total - inst1 - inst2;
                $('#installment_3').val(inst3 > 0 ? inst3 : 0);
            }
        }
    </script>
@endsection
