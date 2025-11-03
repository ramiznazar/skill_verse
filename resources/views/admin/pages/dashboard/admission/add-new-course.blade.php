@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header d-flex justify-content-between">
            <h2>Add New Course — {{ $admission->name }}</h2>
            <a href="{{ route('admission.index') }}" class="btn btn-sm btn-primary">Back</a>
        </div>

        <div class="container-fluid">
            <div class="card">
                <div class="body">
                    <form method="POST" action="{{ route('admission.storeNewCourse', $admission->id) }}">
                        @csrf

                        {{-- Course --}}
                        <div class="form-group">
                            <label>Course</label>
                            <select name="course_id" id="course_id" class="form-control" required>
                                <option value="">Select Course</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}" data-minfee="{{ $course->min_fee }}">
                                        {{ $course->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Batch --}}
                        <div class="form-group">
                            <label>Batch</label>
                            <select name="batch_id" id="batch_id" class="form-control" required>
                                <option value="">Select Batch</option>
                            </select>
                        </div>

                        {{-- Course Fee --}}
                        <div class="form-group">
                            <label>Course Fee</label>
                            <input type="number" name="course_fee" id="course_fee" class="form-control" required>
                        </div>

                        {{-- Payment Type --}}
                        <div class="form-group">
                            <label>Payment Type</label>
                            <select name="payment_type" class="form-control" id="payment_type">
                                <option value="full_fee">Full Fee</option>
                                <option value="installment">Installment</option>
                            </select>
                        </div>

                        {{-- Installments Section --}}
                        <div id="installment-section" style="display:none;">
                            <div class="form-group">
                                <label>Installment Count</label>
                                <select name="installment_count" class="form-control" id="installment_count">
                                    <option value="2">2 Installments</option>
                                    <option value="3">3 Installments</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Installment 1</label>
                                    <input type="number" name="installment_1" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label>Installment 2</label>
                                    <input type="number" name="installment_2" class="form-control">
                                </div>
                                <div class="col-md-4" id="installment_3_wrapper">
                                    <label>Installment 3</label>
                                    <input type="number" name="installment_3" class="form-control">
                                </div>
                            </div>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="apply_additional_charges"
                                    value="1">
                                <label class="form-check-label">Apply additional ₨1000 per installment</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success mt-3">Add Course</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional-javascript')
<script>
    // 🔹 Load batches + autofill min_fee
    $('#course_id').on('change', function() {
        let courseId = $(this).val();
        if (!courseId) return;

        let selected = $(this).find(':selected');
        let minFee = selected.data('minfee');
        $('#course_fee').val(minFee || '');

        // Load batches for selected course
        $.get(`{{ url('admin/admission/get-batches') }}/${courseId}`, function(data) {
            let html = '<option value="">Select Batch</option>';
            data.forEach(batch => {
                html += `<option value="${batch.id}">${batch.title} (${batch.shift})</option>`;
            });
            $('#batch_id').html(html);
        });
    });

    // 🔹 Toggle Installment section
    $('#payment_type').on('change', function() {
        if ($(this).val() === 'installment') {
            $('#installment-section').show();
            autoFillInstallments();
        } else {
            $('#installment-section').hide();
        }
    });

    // 🔹 When installment count changes → recalc
    $('#installment_count').on('change', function() {
        autoFillInstallments();
    });

    // 🔹 When first installment is manually changed → adjust the rest
    $('input[name="installment_1"]').on('input', function() {
        adjustRemainingInstallments();
    });

    // 🔹 When apply additional charges toggled → update all
    $('input[name="apply_additional_charges"]').on('change', function() {
        autoFillInstallments();
    });

    // 🔹 When course fee changes → recalc
    $('#course_fee').on('input', function() {
        autoFillInstallments();
    });

    // ✅ Core logic: Auto-fill or adjust installments
    function autoFillInstallments() {
        const total = parseFloat($('#course_fee').val()) || 0;
        const count = parseInt($('#installment_count').val()) || 2;
        const addCharges = $('input[name="apply_additional_charges"]').is(':checked');

        if (total <= 0) return;

        // Base amount per installment
        const base = Math.floor(total / count);
        const remainder = total - base * count;

        for (let i = 1; i <= 3; i++) {
            const input = $(`input[name="installment_${i}"]`);
            if (i <= count) {
                input.closest('.col-md-4').show();

                let value = base;
                if (i === 1) value += remainder; // handle leftover rupees

                if (addCharges) value += 1000; // add additional charge
                input.val(value);
            } else {
                input.closest('.col-md-4').hide().find('input').val('');
            }
        }
    }

    // ✅ Adjust remaining installments dynamically when first one changes
    function adjustRemainingInstallments() {
        const total = parseFloat($('#course_fee').val()) || 0;
        const count = parseInt($('#installment_count').val()) || 2;
        const addCharges = $('input[name="apply_additional_charges"]').is(':checked');

        let first = parseFloat($('input[name="installment_1"]').val()) || 0;
        let remaining = total - first;

        // Divide remaining among rest
        let perInstallment = count > 1 ? Math.floor(remaining / (count - 1)) : 0;
        let remainder = remaining - perInstallment * (count - 1);

        for (let i = 2; i <= count; i++) {
            const input = $(`input[name="installment_${i}"]`);
            let value = perInstallment;
            if (i === 2) value += remainder; // put leftover in 2nd

            if (addCharges) value += 1000;
            input.val(value);
        }
    }
</script>
@endsection