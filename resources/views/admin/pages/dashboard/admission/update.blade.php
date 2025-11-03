@extends('admin.layouts.main')

@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Admissions</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('admission.index') }}" class="btn btn-sm btn-primary">All Admissions</a>
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
                                                    data-fee="{{ $batch->course->full_fee ?? 0 }}"
                                                    {{ old('batch_id', $admission->batch_id) == $batch->id ? 'selected' : '' }}>
                                                    {{ $batch->title }} {{ $batch->shift ? "($batch->shift)" : '' }}
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
                                                {{ old('student_status', $admission->student_status) == 'active' ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="unactive"
                                                {{ old('student_status', $admission->student_status) == 'unactive' ? 'selected' : '' }}>
                                                UnActive</option>
                                            <option value="completed"
                                                {{ old('student_status', $admission->student_status) == 'completed' ? 'selected' : '' }}>
                                                Completed</option>
                                        </select>
                                        @error('student_status')
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
                                                    {{ ucfirst($q) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('qualification')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label>Last Institute</label>
                                        <input type="text" name="last_institute"
                                            value="{{ old('last_institute', $admission->last_institute) }}"
                                            class="form-control">
                                        @error('last_institute')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mode</label>
                                            <select id="mode" name="mode" class="form-control">
                                                <option value="physical"
                                                    {{ old('mode', $admission->mode) == 'physical' ? 'selected' : '' }}>
                                                    Physical
                                                </option>
                                                <option value="online"
                                                    {{ old('mode', $admission->mode) == 'online' ? 'selected' : '' }}>
                                                    Online
                                                </option>
                                            </select>
                                            @error('mode')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                {{-- Online Percentage Field --}}
                                <div class="col-md-12" id="online-percentage-wrapper" style="display:none;">
                                    <div class="form-group">
                                        <label>Online Fee Percentage (%)</label>
                                        <input type="number" min="0" max="100" step="1"
                                            name="online_percentage" class="form-control"
                                            value="{{ old('online_percentage', $admission->online_percentage ?? 50) }}"
                                            placeholder="e.g. 50">
                                        <small class="text-muted">This % of the paid fee goes to the teacher for online
                                            students.</small>
                                        @error('online_percentage')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Referral Type --}}
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label for="referral_type">Referral Type</label>
                                        <select name="referral_type" id="referral_type" class="form-control">
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
                                        </select>
                                        @error('referral_type')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Referral details (only when referral_type = referral) --}}
                                <div class="row mt-3" id="referral_details_section" style="display:none;">
                                    <div class="col-md-4">
                                        <label>Referral Source</label>
                                        <input type="text" name="referral_source"
                                            value="{{ old('referral_source', $admission->referral_source) }}"
                                            class="form-control">
                                        @error('referral_source')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label>Source Contact #</label>
                                        <input type="number" name="referral_source_contact"
                                            value="{{ old('referral_source_contact', $admission->referral_source_contact) }}"
                                            class="form-control">
                                        @error('referral_source_contact')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label>Source Commission (%)</label>
                                        <input type="number" name="referral_source_commission"
                                            value="{{ old('referral_source_commission', $admission->referral_source_commission) }}"
                                            class="form-control">
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
                                    <div class="col-md-12">
                                        <label>Total Fee</label>
                                        <input type="number" id="full_fee" name="full_fee" class="form-control"
                                            value="{{ old('full_fee', $admission->full_fee) }}">
                                        @error('full_fee')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">Payment Type</label>
                                        <div class="d-flex flex-column">
                                            <label><input type="radio" name="payment_type" value="full_fee"
                                                    {{ old('payment_type', $admission->payment_type) == 'full_fee' ? 'checked' : '' }}>
                                                Full Payment</label>
                                            <label><input type="radio" name="payment_type" value="installment"
                                                    {{ old('payment_type', $admission->payment_type) == 'installment' ? 'checked' : '' }}>
                                                Installments</label>
                                        </div>
                                        @error('payment_type')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        {{-- Calculated Total --}}
                                        <div class="col-md-12">
                                            <label>Calculated Total (after options)</label>
                                            <input type="text" id="calculated_total" class="form-control"
                                                value="0" readonly>
                                            <input type="hidden" id="calculated_total_input" name="calculated_total"
                                                value="0">
                                            <small id="calculated_breakdown" class="text-muted d-block mt-1"></small>
                                        </div>
                                    </div>

                                    {{-- Installment Fields --}}
                                    <div id="installment-section"
                                        style="{{ old('payment_type', $admission->payment_type) == 'installment' ? '' : 'display:none;' }}"
                                        class="mt-3">

                                        {{-- Additional charges checkbox --}}
                                        <div class="row mb-2" style="margin-top:-15px">
                                            <div class="col-md-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="apply_additional_charges" name="apply_additional_charges"
                                                        value="1"
                                                        {{ old('apply_additional_charges', $applyExtraDefault ?? false) ? 'checked' : '' }}>
                                                    <small class="form-check-label" for="apply_additional_charges">
                                                        Apply additional charges — ₨1000 per installment
                                                    </small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label>Installment Count</label>
                                                <select id="installment_count" name="installment_count"
                                                    class="form-control">
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
        // ---------- Constants ----------
        const PER_INSTALLMENT_CHARGE = 1000;

        // ---------- Helpers ----------
        function getPaymentType() {
            return $('input[name="payment_type"]:checked').val();
        }

        function getInstallmentCount() {
            return parseInt($('#installment_count').val() || '3', 10);
        }

        function computeTotalParts() {
            const isInstallment = getPaymentType() === 'installment';
            const count = isInstallment ? getInstallmentCount() : 0;
            const applyExtra = isInstallment && $('#apply_additional_charges').is(':checked');
            const base = Number.isFinite(+$('#full_fee').val()) ? +$('#full_fee').val() : 0;
            const extra = applyExtra ? (PER_INSTALLMENT_CHARGE * count) : 0;
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
            $('#calculated_total_input').val(p.total);
            if (p.applyExtra && p.isInstallment) {
                $('#calculated_breakdown').text(
                    `Base: ₨${p.base} + Extra: ₨${PER_INSTALLMENT_CHARGE} × ${p.count} = ₨${p.extra}`);
            } else {
                $('#calculated_breakdown').text(`Base: ₨${p.base}`);
            }
        }

        function autoDistributeInstallments() {
            const {
                total
            } = computeTotalParts();
            const count = getInstallmentCount();
            if (count === 2) {
                const first = Math.ceil(total / 2);
                const second = total - first;
                $('#installment_1').val(first);
                $('#installment_2').val(second);
                $('#installment_3').val('');
            } else {
                const part = Math.floor(total / 3);
                const third = total - (part * 2);
                $('#installment_1').val(part);
                $('#installment_2').val(part);
                $('#installment_3').val(third);
            }
            renderTotal();
        }

        // ---------- Smart manual rebalance (fixes remaining not moving) ----------
        let isAdjusting = false;

        function adjustRemainingInstallments(editedId = null) {
            if (isAdjusting) return;
            const {
                total
            } = computeTotalParts();
            const count = getInstallmentCount();

            let i1 = Math.max(parseInt($('#installment_1').val() || '0', 10), 0);
            let i2 = Math.max(parseInt($('#installment_2').val() || '0', 10), 0);
            let i3 = Math.max(parseInt($('#installment_3').val() || '0', 10), 0);

            isAdjusting = true;

            if (count === 2) {
                i1 = Math.min(i1, total);
                i2 = Math.max(total - i1, 0);
                i3 = 0;
            } else {
                const remainingAfterI1 = Math.max(total - i1, 0);

                if (editedId === 'installment_1') {
                    if (i2 > remainingAfterI1) {
                        i2 = remainingAfterI1;
                        i3 = 0;
                    } else {
                        i3 = Math.max(remainingAfterI1 - i2, 0);
                    }
                } else if (editedId === 'installment_2') {
                    i2 = Math.min(i2, remainingAfterI1);
                    i3 = Math.max(remainingAfterI1 - i2, 0);
                } else if (editedId === 'installment_3') {
                    i3 = Math.min(i3, remainingAfterI1);
                    i2 = Math.max(remainingAfterI1 - i3, 0);
                } else {
                    if (i2 > remainingAfterI1) {
                        i2 = remainingAfterI1;
                        i3 = 0;
                    } else {
                        i3 = Math.max(remainingAfterI1 - i2, 0);
                    }
                }

                // Safety: clamp to total
                const sum = i1 + i2 + i3;
                if (sum !== total) {
                    const diff = total - sum; // positive -> need to add
                    if (diff > 0) {
                        if (i3 || editedId !== 'installment_2') i3 += diff;
                        else i2 += diff;
                    } else if (diff < 0) {
                        let need = -diff;
                        const cut3 = Math.min(i3, need);
                        i3 -= cut3;
                        need -= cut3;
                        if (need > 0) i2 = Math.max(i2 - need, 0);
                    }
                }
            }

            $('#installment_1').val(i1);
            $('#installment_2').val(i2);
            $('#installment_3').val(count === 3 ? i3 : '');

            renderTotal();
            isAdjusting = false;
        }

        // ---------- Referral toggle ----------
        function toggleReferralFields() {
            const selected = ($('#referral_type').val() || '').toLowerCase();
            const $section = $('#referral_details_section');
            if (selected === 'referral') {
                $section.css('display', 'flex');
            } else {
                $section.hide();
                $section.find('input').val('');
            }
        }

        // ---------- Events ----------
        // Course -> Batches
        $('#course_id').on('change', function() {
            let courseId = $(this).val();
            $('#batch_id').html('<option>Loading...</option>');
            $.get(`{{ url('get-batches') }}/${courseId}`, function(data) {
                let html = '<option value="">Select Batch</option>';
                data.forEach(b => {
                    const fee = b.course?.full_fee ?? 0;
                    const shift = b.shift ? ` (${b.shift})` : '';
                    html += `<option value="${b.id}" data-fee="${fee}">${b.title}${shift}</option>`;
                });
                $('#batch_id').html(html);
            });
        });

        // Batch sets fee -> redistribute
        $('#batch_id').on('change', function() {
            const fee = parseInt($(this).find(':selected').data('fee') || '0', 10);
            $('#full_fee').val(fee);
            autoDistributeInstallments();
        });

        // Manual fee edit
        $('#full_fee').on('input', function() {
            autoDistributeInstallments();
        });

        // Payment type toggle
        $('input[name="payment_type"]').on('change', function() {
            if (getPaymentType() === 'installment') {
                $('#installment-section').show();
                $('#apply_additional_charges').prop('disabled', false);
                autoDistributeInstallments();
            } else {
                $('#installment-section').hide();
                $('#apply_additional_charges').prop('checked', false).prop('disabled', true);
                renderTotal();
            }
        });

        // Installment count change
        $('#installment_count').on('change', function() {
            const count = getInstallmentCount();
            if (count === 2) {
                $('#installment_3_wrapper').hide();
                $('#installment_3').val('');
            } else {
                $('#installment_3_wrapper').show();
            }
            autoDistributeInstallments();
        });

        // Extra charges toggled
        $(document).on('change', '#apply_additional_charges', function() {
            autoDistributeInstallments();
        });

        // Manual edit listeners on ALL three fields
        $('#installment_1, #installment_2, #installment_3').on('input', function() {
            adjustRemainingInstallments(this.id);
        });

        // Referral type toggle
        $('#referral_type').on('change', toggleReferralFields);

        // ---------- Initial state ----------
        $(document).ready(function() {
            // Installment 3 visibility
            const count = getInstallmentCount();
            if (count === 2) {
                $('#installment_3_wrapper').hide();
            } else {
                $('#installment_3_wrapper').show();
            }

            // Referral details visibility
            toggleReferralFields();

            // Show/hide installment panel
            if (getPaymentType() === 'installment') {
                $('#installment-section').show();
                $('#apply_additional_charges').prop('disabled', false);
            } else {
                $('#installment-section').hide();
                $('#apply_additional_charges').prop('checked', false).prop('disabled', true);
            }

            // If installments have values, just recompute total; else distribute
            const hasAny = ($('#installment_1').val() || $('#installment_2').val() || $('#installment_3').val());
            if (getPaymentType() === 'installment') {
                if (hasAny) renderTotal();
                else autoDistributeInstallments();
            } else {
                renderTotal();
            }
        });

        //show fee submission Percentage
        (function() {
            function toggleOnlinePercentage() {
                const modeSelect = document.getElementById('mode');
                const wrapper = document.getElementById('online-percentage-wrapper');
                if (!modeSelect || !wrapper) return;

                if (modeSelect.value === 'online') {
                    wrapper.style.display = 'block';
                } else {
                    wrapper.style.display = 'none';
                }
            }

            document.addEventListener('DOMContentLoaded', toggleOnlinePercentage);
            document.getElementById('mode').addEventListener('change', toggleOnlinePercentage);
        })();
    </script>
@endsection
