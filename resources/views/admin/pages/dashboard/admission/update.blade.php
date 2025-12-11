@extends('admin.layouts.main') @section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Admissions</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right"> <a href="{{ route('admission.index') }}"
                        class="btn btn-sm btn-primary">All Admissions</a> </div>
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
                                method="POST" enctype="multipart/form-data"> @csrf @method('PUT') {{-- Course & Batch --}}
                                <div class="row">
                                    <div class="col-md-6"> <label>Course</label> <select name="course_id" id="course_id"
                                            class="form-control">
                                            <option value="">Select Course</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}"
                                                    {{ old('course_id', $admission->course_id) == $course->id ? 'selected' : '' }}>
                                                    {{ $course->title }} </option>
                                            @endforeach
                                        </select> @error('course_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6"> <label>Batch</label> <select name="batch_id" id="batch_id"
                                            class="form-control">
                                            <option value="">Select Batch</option>
                                            @foreach ($batches as $batch)
                                                <option value="{{ $batch->id }}"
                                                    data-fee="{{ $batch->course->full_fee ?? 0 }}"
                                                    {{ old('batch_id', $admission->batch_id) == $batch->id ? 'selected' : '' }}>
                                                    {{ $batch->title }} {{ $batch->shift ? "($batch->shift)" : '' }}
                                                </option>
                                            @endforeach
                                        </select> @error('batch_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <hr class="mt-4"> {{-- Student Info --}} <div class="row mt-2">
                                    <div class="col-md-4"> <label>Image</label> <input type="file" name="image"
                                            class="form-control" accept="image/*"> @error('image')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4"> <label>Full Name</label> <input type="text" name="name"
                                            value="{{ old('name', $admission->name) }}" class="form-control">
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4"> <label>CNIC</label> <input type="text" name="cnic"
                                            value="{{ old('cnic', $admission->cnic) }}" class="form-control">
                                        @error('cnic')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-4"> <label>Guardian Name</label> <input type="text"
                                            name="guardian_name"
                                            value="{{ old('guardian_name', $admission->guardian_name) }}"
                                            class="form-control"> @error('guardian_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4"> <label>Guardian Contact</label> <input type="text"
                                            name="guardian_contact"
                                            value="{{ old('guardian_contact', $admission->guardian_contact) }}"
                                            class="form-control"> @error('guardian_contact')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4"> <label>Date of Birth</label> <input type="date" name="dob"
                                            value="{{ old('dob', $admission->dob) }}" class="form-control"> @error('dob')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-4"> <label>Email</label> <input type="email" name="email"
                                            value="{{ old('email', $admission->email) }}" class="form-control">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4"> <label>Phone</label> <input type="text" name="phone"
                                            value="{{ old('phone', $admission->phone) }}" class="form-control">
                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4"> <label>Joining Date</label> <input type="date"
                                            name="joining_date" value="{{ old('joining_date', $admission->joining_date) }}"
                                            class="form-control"> @error('joining_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-4"> <label>Status</label> <select name="student_status"
                                            class="form-control">
                                            <option value="active"
                                                {{ old('student_status', $admission->student_status) == 'active' ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="unactive"
                                                {{ old('student_status', $admission->student_status) == 'unactive' ? 'selected' : '' }}>
                                                UnActive</option>
                                            <option value="completed"
                                                {{ old('student_status', $admission->student_status) == 'completed' ? 'selected' : '' }}>
                                                Completed</option>
                                        </select> @error('student_status')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4"> <label>Gender</label> <select name="gender"
                                            class="form-control">
                                            <option value="">Select Gender</option>
                                            <option value="male"
                                                {{ old('gender', $admission->gender) == 'male' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="female"
                                                {{ old('gender', $admission->gender) == 'female' ? 'selected' : '' }}>
                                                Female</option>
                                        </select> @error('gender')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4"> <label>Qualification</label> <select name="qualification"
                                            class="form-control">
                                            @foreach (['middle', 'metric', 'intermediate', 'graduate', 'm-phill'] as $q)
                                                <option value="{{ $q }}"
                                                    {{ old('qualification', $admission->qualification) == $q ? 'selected' : '' }}>
                                                    {{ ucfirst($q) }} </option>
                                            @endforeach
                                        </select> @error('qualification')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6"> <label>Last Institute</label> <input type="text"
                                            name="last_institute"
                                            value="{{ old('last_institute', $admission->last_institute) }}"
                                            class="form-control"> @error('last_institute')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> <label>Mode</label> <select id="mode"
                                                name="mode" class="form-control">
                                                <option value="physical"
                                                    {{ old('mode', $admission->mode) == 'physical' ? 'selected' : '' }}>
                                                    Physical </option>
                                                <option value="online"
                                                    {{ old('mode', $admission->mode) == 'online' ? 'selected' : '' }}>
                                                    Online </option>
                                            </select> @error('mode')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div> {{-- Online Percentage Field --}} <div class="col-md-12" id="online-percentage-wrapper"
                                    style="display:none;">
                                    <div class="form-group"> <label>Online Fee Percentage (%)</label> <input
                                            type="number" min="0" max="100" step="1"
                                            name="online_percentage" class="form-control"
                                            value="{{ old('online_percentage', $admission->online_percentage ?? 50) }}"
                                            placeholder="e.g. 50"> <small class="text-muted">This % of the paid fee goes
                                            to the teacher for online students.</small> @error('online_percentage')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div> {{-- Referral Type --}} <div class="row mt-3">
                                    <div class="col-md-12"> <label for="referral_type">Referral Type</label> <select
                                            name="referral_type" id="referral_type" class="form-control">
                                            <option value="">Select Type</option>
                                            <option value="ads"
                                                {{ old('referral_type', $admission->referral_type) == 'ads' ? 'selected' : '' }}>
                                                Ads</option>
                                            <option value="referral"
                                                {{ old('referral_type', $admission->referral_type) == 'referral' ? 'selected' : '' }}>
                                                Referral</option>
                                            <option value="other"
                                                {{ old('referral_type', $admission->referral_type) == 'other' ? 'selected' : '' }}>
                                                Other</option>
                                        </select> @error('referral_type')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div> {{-- Referral details (only when referral_type = referral) --}} <div class="row mt-3" id="referral_details_section"
                                    style="display:none;">
                                    <div class="col-md-4"> <label>Referral Source</label> <input type="text"
                                            name="referral_source"
                                            value="{{ old('referral_source', $admission->referral_source) }}"
                                            class="form-control"> @error('referral_source')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4"> <label>Source Contact #</label> <input type="number"
                                            name="referral_source_contact"
                                            value="{{ old('referral_source_contact', $admission->referral_source_contact) }}"
                                            class="form-control"> @error('referral_source_contact')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4"> <label>Source Commission (%)</label> <input type="number"
                                            name="referral_source_commission"
                                            value="{{ old('referral_source_commission', $admission->referral_source_commission) }}"
                                            class="form-control"> @error('referral_source_commission')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mt-3"> <label>Address</label>
                                    <textarea name="address" class="form-control" rows="3">{{ old('address', $admission->address) }}</textarea> @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <hr class="mt-4">

                                {{-- Fee Section --}}
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Total Fee</label>
                                            <input type="number" id="full_fee" name="full_fee" class="form-control"
                                                value="{{ old('full_fee', $admission->full_fee) }}">
                                            @error('full_fee')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Registration Fee</label>
                                            <input type="number" name="registration_fee" class="form-control"
                                                value="{{ old('registration_fee', $admission->registration_fee ?? 0) }}" min="0">
                                            @error('registration_fee')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Payment Type</label>
                                            <div class="d-flex flex-column">
                                                <label>
                                                    <input type="radio" name="payment_type" value="full_fee"
                                                        {{ old('payment_type', $admission->payment_type) == 'full_fee' ? 'checked' : '' }}>
                                                    Full Payment
                                                </label>
                                                <label>
                                                    <input type="radio" name="payment_type" value="installment"
                                                        {{ old('payment_type', $admission->payment_type) == 'installment' ? 'checked' : '' }}>
                                                    Installments
                                                </label>
                                            </div>
                                            @error('payment_type')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-2">
                                        <label>Calculated Total (after options)</label>
                                        <input type="text" id="calculated_total" class="form-control" value="0"
                                            readonly>
                                        <small id="calculated_breakdown" class="text-muted d-block mt-1"></small>

                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox" id="apply_additional_charges"
                                                name="apply_additional_charges" value="1"
                                                {{ old('apply_additional_charges', $applyExtraDefault ?? false) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="apply_additional_charges">
                                                Apply additional charges — ₨1000 per installment
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                {{-- Installment Fields --}}
                                <div id="installment-section"
                                    style="{{ old('payment_type', $admission->payment_type) == 'installment' ? '' : 'display:none;' }}"
                                    class="mt-3">

                                    <div class="row mb-3 mt-2">
                                        <div class="col-md-12">
                                            <label>Installment Count</label>
                                            <select id="installment_count" name="installment_count" class="form-control">
                                                <option value="2"
                                                    {{ (int) old('installment_count', $preCount ?? 3) === 2 ? 'selected' : '' }}>
                                                    2 Installments</option>
                                                <option value="3"
                                                    {{ (int) old('installment_count', $preCount ?? 3) === 3 ? 'selected' : '' }}>
                                                    3 Installments</option>
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

                                <div class="text-right mt-4">
                                    <button type="submit" class="btn btn-primary">Update Admission</button>
                                </div>

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
            const PER_INSTALLMENT_CHARGE = 1000;
            let fullFee = parseInt($('#full_fee').val() || 0);

            // 🔹 Load batches dynamically when course changes
            $('#course_id').on('change', function() {
                let courseId = $(this).val();
                $('#batch_id').html('<option>Loading...</option>');
                if (!courseId) return;

                $.get(`{{ url('admin/admission/get-batches') }}/${courseId}`, function(data) {
                    let html = '<option value="">Select Batch</option>';
                    if (!data.length) html += '<option disabled>No batches available</option>';
                    data.forEach(b => {
                        const fee = b.course?.min_fee ?? 0;
                        const shift = b.shift ? `(${b.shift})` : '';
                        html +=
                            `<option value="${b.id}" data-fee="${fee}">${b.title} ${shift}</option>`;
                    });
                    $('#batch_id').html(html);
                }).fail(xhr => {
                    console.error('Error loading batches:', xhr.responseText);
                    $('#batch_id').html('<option disabled>Error loading batches</option>');
                });
            });

            // 🔹 When batch changes — update total fee
            $('#batch_id').on('change', function() {
                const fee = parseInt($(this).find(':selected').data('fee') || 0);
                $('#full_fee').val(fee);
                fullFee = fee;
                autoDistributeInstallments();
            });

            // 🔹 When manual fee input changes
            $('#full_fee').on('input', function() {
                fullFee = parseInt($(this).val() || 0);
                autoDistributeInstallments();
            });

            // 🔹 Payment type change
            $('input[name="payment_type"]').on('change', function() {
                if ($(this).val() === 'installment') {
                    $('#installment-section').show();
                    $('#apply_additional_charges').prop('disabled', false);
                    autoDistributeInstallments();
                } else {
                    $('#installment-section').hide();
                    $('#apply_additional_charges').prop('checked', false).prop('disabled', true);
                    renderTotal();
                }
            });

            // 🔹 Installment count change
            $('#installment_count').on('change', function() {
                const count = parseInt($(this).val());
                if (count === 2) {
                    $('#installment_3_wrapper').hide();
                    $('#installment_3').val('');
                } else {
                    $('#installment_3_wrapper').show();
                }
                autoDistributeInstallments();
            });

            // 🔹 Additional charges toggle
            $('#apply_additional_charges').on('change', function() {
                autoDistributeInstallments();
            });

            // 🔹 Manual installment edit
            $('#installment_1, #installment_2').on('input', function() {
                adjustRemainingInstallments();
            });

            // --- Computation Helpers ---
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
                $('#calculated_breakdown').text(
                    p.applyExtra && p.isInstallment ?
                    `Base ₨${p.base} + Extra ₨${PER_INSTALLMENT_CHARGE} × ${p.count} = ₨${p.extra}` :
                    `Base ₨${p.base}`
                );
            }

            function autoDistributeInstallments() {
                const {
                    total,
                    count
                } = computeTotalParts();

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

            function adjustRemainingInstallments() {
                const {
                    total,
                    count
                } = computeTotalParts();
                const inst1 = parseInt($('#installment_1').val()) || 0;
                const inst2 = parseInt($('#installment_2').val()) || 0;

                if (count === 2) {
                    $('#installment_2').val(Math.max(total - inst1, 0));
                    $('#installment_3').val('');
                } else {
                    const inst3 = Math.max(total - inst1 - inst2, 0);
                    $('#installment_3').val(inst3);
                }
                renderTotal();
            }

            // Referral logic (same as create)
            function toggleReferralFields() {
                const type = $('#referral_type').val();
                if (type === 'referral') $('#referral_details_section').show();
                else $('#referral_details_section').hide().find('input').val('');
            }
            $('#referral_type').on('change', toggleReferralFields);

            // Mode toggle (online percentage)
            function toggleOnlinePercentage() {
                const mode = $('#mode').val();
                $('#online-percentage-wrapper').toggle(mode === 'online');
            }
            $('#mode').on('change', toggleOnlinePercentage);

            // Initialize UI states
            toggleReferralFields();
            toggleOnlinePercentage();
            const count = parseInt($('#installment_count').val()) || 3;
            if (count === 2) $('#installment_3_wrapper').hide();
            else $('#installment_3_wrapper').show();
            if ($('input[name="payment_type"]:checked').val() === 'installment') {
                $('#installment-section').show();
                $('#apply_additional_charges').prop('disabled', false);
            } else {
                $('#installment-section').hide();
                $('#apply_additional_charges').prop('checked', false).prop('disabled', true);
            }
            autoDistributeInstallments();
        });
    </script>
@endsection