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
                            <h2>Add New Student</h2>
                        </div>
                        <div class="body">

                            <form id="admission-form" action="{{ route('admission.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                {{-- Course & Batch --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Course</label>
                                            <select name="course_id" id="course_id" class="form-control" required>
                                                <option value="">Select Course</option>
                                                @foreach ($courses as $course)
                                                    <option value="{{ $course->id }}"
                                                        {{ old('course_id', $lead->course_id ?? '') == $course->id ? 'selected' : '' }}>
                                                        {{ $course->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('course_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Batch</label>
                                            <select name="batch_id" id="batch_id" class="form-control" required>
                                                <option value="">Select Batch</option>
                                            </select>
                                            @error('batch_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <hr class="mt-4">

                                {{-- Student Info --}}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" name="image" class="form-control" accept="image/*">
                                            @error('image')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Full Name</label>
                                            <input type="text" name="name"
                                                value="{{ old('name', $lead->name ?? '') }}" class="form-control" required>
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>CNIC</label>
                                            <input type="text" name="cnic"
                                                value="{{ old('cnic', $lead->cnic ?? '') }}" class="form-control">
                                            @error('cnic')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Guardian Name</label>
                                            <input type="text" name="guardian_name"
                                                value="{{ old('guardian_name', $lead->guardian_name ?? '') }}"
                                                class="form-control">
                                            @error('guardian_name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Guardian Contact</label>
                                            <input type="text" name="guardian_contact"
                                                value="{{ old('guardian_contact', $lead->guardian_contact ?? '') }}"
                                                class="form-control">
                                            @error('guardian_contact')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date of Birth</label>
                                            <input type="date" name="dob" value="{{ old('dob', $lead->dob ?? '') }}"
                                                class="form-control">
                                            @error('dob')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email"
                                                value="{{ old('email', $lead->email ?? '') }}" class="form-control">
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" name="phone"
                                                value="{{ old('phone', $lead->phone ?? '') }}" class="form-control"
                                                required>
                                            @error('phone')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Joining Date</label>
                                            <input type="date" name="joining_date" value="{{ old('joining_date') }}"
                                                class="form-control" required>
                                            @error('joining_date')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="student_status" class="form-control">
                                                <option value="active"
                                                    {{ old('student_status') == 'active' ? 'selected' : '' }}>
                                                    Active</option>
                                                <option value="unactive"
                                                    {{ old('student_status') == 'unactive' ? 'selected' : '' }} selected>
                                                    UnActive</option>
                                            </select>
                                            @error('status')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select name="gender" class="form-control">
                                                <option value="">Select Gender</option>
                                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>
                                                    Male</option>
                                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>
                                                    Female</option>
                                            </select>
                                            @error('gender')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Qualification</label>
                                            <select name="qualification" class="form-control">
                                                <option value="middle"
                                                    {{ old('qualification', $lead->qualification ?? '') == 'middle' ? 'selected' : '' }}>
                                                    Middle</option>
                                                <option value="metric"
                                                    {{ old('qualification', $lead->qualification ?? '') == 'metric' ? 'selected' : '' }}>
                                                    Metric</option>
                                                <option value="intermediate"
                                                    {{ old('qualification', $lead->qualification ?? '') == 'intermediate' ? 'selected' : '' }}>
                                                    Intermediate</option>
                                                <option value="graduate"
                                                    {{ old('qualification', $lead->qualification ?? '') == 'graduate' ? 'selected' : '' }}>
                                                    Graduate</option>
                                                <option value="m-phill"
                                                    {{ old('qualification', $lead->qualification ?? '') == 'm-phill' ? 'selected' : '' }}>
                                                    M Phill</option>
                                            </select>

                                            @error('qualification')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Last Institute</label>
                                            <input type="text" name="last_institute"
                                                value="{{ old('last_institute', $lead->last_institute ?? '') }}"
                                                class="form-control">
                                            @error('last_institute')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Referral Info --}}
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label for="referral_type">Referral Type</label>
                                        <select name="referral_type" id="referral_type" class="form-control">
                                            <option value="">Select Type</option>
                                            <option value="ads"
                                                {{ old('referral_type', $lead->referral_type ?? '') == 'ads' ? 'selected' : '' }}>
                                                Ads</option>
                                            <option value="referral"
                                                {{ old('referral_type', $lead->referral_type ?? '') == 'referral' ? 'selected' : '' }}>
                                                Referral</option>
                                            <option value="other"
                                                {{ old('referral_type', $lead->referral_type ?? '') == 'other' ? 'selected' : '' }}>
                                                Other</option>
                                        </select>
                                        @error('referral_type')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-3" id="referral_details_section" style="display: none;">
                                    <div class="col-md-4">
                                        <label>Referral Source</label>
                                        <input type="text" name="referral_source"
                                            value="{{ old('referral_source', $lead->referral_source ?? '') }}"
                                            class="form-control">
                                        @error('referral_source')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label>Source Contact #</label>
                                        <input type="number" name="referral_source_contact"
                                            value="{{ old('referral_source_contact', $lead->referral_source_contact ?? '') }}"
                                            class="form-control">
                                        @error('referral_source_contact')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label>Source Commission (%)</label>
                                        <input type="number" name="referral_source_commission"
                                            value="{{ old('referral_source_commission') }}" class="form-control">
                                        @error('referral_source_commission')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <label>Address</label>
                                    <textarea name="address" class="form-control" rows="3">{{ old('address', $lead->address ?? '') }}</textarea>
                                    @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <hr class="mt-4">

                                {{-- Fee Section --}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Total Fee</label>
                                        <input type="number" id="full_fee" name="full_fee" class="form-control"
                                            value="{{ old('full_fee') }}">
                                        @error('full_fee')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Payment Type</label>
                                        <div class="d-flex flex-column">
                                            <label><input type="radio" name="payment_type" value="full_fee"
                                                    {{ old('payment_type') == 'full_fee' ? 'checked' : '' }}> Full
                                                Payment</label>
                                            <label><input type="radio" name="payment_type" value="installment"
                                                    {{ old('payment_type') == 'installment' ? 'checked' : '' }}>
                                                Installments</label>
                                        </div>
                                        @error('payment_type')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- Calculated Total (after options) --}}
                                    <div class="col-md-12 mt-2">
                                        <label>Calculated Total (after options)</label>
                                        <input type="text" id="calculated_total" class="form-control" value="0"
                                            readonly>
                                        {{-- <small id="calculated_breakdown" class="text-muted d-block mt-1"></small> --}}
                                        {{-- Additional charges checkbox --}}
                                        <div class="row mb-2">
                                            <div class="col-md-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="apply_additional_charges" name="apply_additional_charges"
                                                        value="1"
                                                        {{ old('apply_additional_charges') ? 'checked' : '' }}>
                                                    <small class="form-check-label" for="apply_additional_charges" >
                                                        (Apply additional charges — ₨1000 per installment)
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Installment Fields --}}
                                <div id="installment-section" style="display: none;" class="mt-3">


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
                                                class="form-control" value="{{ old('installment_1') }}">
                                            @error('installment_1')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label>Installment 2</label>
                                            <input type="number" name="installment_2" id="installment_2"
                                                class="form-control" value="{{ old('installment_2') }}">
                                            @error('installment_2')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-4" id="installment_3_wrapper">
                                            <label>Installment 3</label>
                                            <input type="number" name="installment_3" id="installment_3"
                                                class="form-control" value="{{ old('installment_3') }}">
                                            @error('installment_3')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mt-4">Submit Admission</button>
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
        // Load batches by course
        $('#course_id').on('change', function() {
            let courseId = $(this).val();
            $('#batch_id').html('<option>Loading...</option>');
            $.get(`get-batches/${courseId}`, function(data) {
                let html = '<option value="">Select Batch</option>';
                data.forEach(batch => {
                    html +=
                        `<option value="${batch.id}" data-fee="${batch.course.full_fee}">${batch.title} (${batch.shift})</option>`;
                });
                $('#batch_id').html(html);
            });
        });

        let fullFee = 0;
        const PER_INSTALLMENT_CHARGE = 1000;

        // When batch is selected, set fee value
        $('#batch_id').on('change', function() {
            let fee = $(this).find(':selected').data('fee') || 0;
            fullFee = parseInt(fee) || 0;
            $('#full_fee').val(fullFee);
            autoDistributeInstallments();
        });

        // When admin edits the fee manually
        $('#full_fee').on('input', function() {
            fullFee = parseInt($(this).val() || 0);
            autoDistributeInstallments();
        });

        // Toggle section on payment type
        $('input[name="payment_type"]').on('change', function() {
            if ($(this).val() === 'installment') {
                $('#installment-section').show();
                $('#apply_additional_charges').prop('disabled', false);
                autoDistributeInstallments();
            } else {
                $('#installment-section').hide();
                $('#apply_additional_charges').prop('checked', false).prop('disabled', true);
                renderTotal(); // refresh calculated total for full payment
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

        // Recalc when additional charges checkbox is toggled
        $(document).on('change', '#apply_additional_charges', function() {
            autoDistributeInstallments();
        });

        // Manual edit of installments (1 and 2) triggers recalculation of remaining
        $('#installment_1, #installment_2').on('input', function() {
            adjustRemainingInstallments();
        });

        // --- Totals helpers ---
        function computeTotalParts() {
            const paymentType = $('input[name="payment_type"]:checked').val();
            const isInstallment = paymentType === 'installment';
            const count = parseInt($('#installment_count').val()) || 0;
            const applyExtra = $('#apply_additional_charges').is(':checked');

            const base = parseInt(fullFee) || 0;
            const extra = (isInstallment && applyExtra) ? (PER_INSTALLMENT_CHARGE * count) : 0;
            const total = base + extra;

            return {
                base,
                extra,
                total,
                count,
                applyExtra,
                isInstallment
            };
        }

        function renderTotal() {
            const p = computeTotalParts();
            $('#calculated_total').val(p.total);
            if (p.applyExtra && p.isInstallment) {
                $('#calculated_breakdown').text(
                    `Base: ₨${p.base} + Extra: ₨${PER_INSTALLMENT_CHARGE} × ${p.count} = ₨${p.extra}`);
            } else {
                $('#calculated_breakdown').text(`Base: ₨${p.base}`);
            }
        }

        // Distribute fee across installments
        function autoDistributeInstallments() {
            const count = parseInt($('#installment_count').val());
            const total = computeTotalParts().total;

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
            renderTotal();
        }

        // Re-adjust remaining amount based on admin input
        function adjustRemainingInstallments() {
            const count = parseInt($('#installment_count').val());
            const total = computeTotalParts().total;

            const inst1 = parseInt($('#installment_1').val()) || 0;
            const inst2 = parseInt($('#installment_2').val()) || 0;

            if (count === 2) {
                $('#installment_2').val(Math.max(total - inst1, 0));
                $('#installment_3').val('');
            } else {
                const inst3 = total - inst1 - inst2;
                $('#installment_3').val(inst3 > 0 ? inst3 : 0);
            }
            renderTotal();
        }

        // Referral logic toggle
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

            toggleReferralFields();
            referralType.addEventListener('change', toggleReferralFields);

            // Initialize payment section visibility/state
            const paymentType = $('input[name="payment_type"]:checked').length ?
                $('input[name="payment_type"]:checked').val() :
                null;

            if (paymentType === 'installment') {
                $('#installment-section').show();
                $('#apply_additional_charges').prop('disabled', false);
            } else {
                $('#installment-section').hide();
                $('#apply_additional_charges').prop('checked', false).prop('disabled', true);
            }

            // Respect current count for visibility of installment 3
            const count = parseInt($('#installment_count').val());
            if (count === 2) {
                $('#installment_3_wrapper').hide();
                $('#installment_3').val('');
            } else {
                $('#installment_3_wrapper').show();
            }

            // Initial totals render
            autoDistributeInstallments();
        });
    </script>
@endsection
