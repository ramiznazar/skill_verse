@extends('admin.layouts.main')
@section('content')
<div id="main-content">
    <div class="block-header d-flex justify-content-between">
        <h2>Edit Course — {{ $admission->name }}</h2>
        <a href="{{ route('admission.index') }}" class="btn btn-sm btn-primary">Back</a>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="body">
                <form method="POST" action="{{ route('admission.updateCourse', [$admission->id, $course->id]) }}">
                    @csrf
                    @method('PUT')

                    {{-- Course --}}
                    <div class="form-group">
                        <label>Course</label>
                        <select name="course_id" id="course_id" class="form-control" disabled>
                            @foreach ($courses as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $course->id ? 'selected' : '' }}>
                                    {{ $item->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Batch --}}
                    <div class="form-group">
                        <label>Batch</label>
                        <select name="batch_id" id="batch_id" class="form-control" required>
                            <option value="">Select Batch</option>
                            @foreach ($batches as $batch)
                                <option value="{{ $batch->id }}" {{ $pivot->batch_id == $batch->id ? 'selected' : '' }}>
                                    {{ $batch->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Course Fee --}}
                    <div class="form-group">
                        <label>Course Fee</label>
                        <input type="number" name="course_fee" id="course_fee" class="form-control"
                            value="{{ $pivot->course_fee }}" required>
                    </div>

                    {{-- Payment Type --}}
                    <div class="form-group">
                        <label>Payment Type</label>
                        <select name="payment_type" class="form-control" id="payment_type">
                            <option value="full_fee" {{ $pivot->payment_type === 'full_fee' ? 'selected' : '' }}>Full Fee</option>
                            <option value="installment" {{ $pivot->payment_type === 'installment' ? 'selected' : '' }}>Installment</option>
                        </select>
                    </div>

                    {{-- Installments Section --}}
                    <div id="installment-section" style="{{ $pivot->payment_type === 'installment' ? '' : 'display:none;' }}">
                        <div class="form-group">
                            <label>Installment Count</label>
                            <select name="installment_count" class="form-control" id="installment_count">
                                <option value="2" {{ $pivot->installment_count == 2 ? 'selected' : '' }}>2 Installments</option>
                                <option value="3" {{ $pivot->installment_count == 3 ? 'selected' : '' }}>3 Installments</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Installment 1</label>
                                <input type="number" name="installment_1" class="form-control" value="{{ $pivot->installment_1 }}">
                            </div>
                            <div class="col-md-4">
                                <label>Installment 2</label>
                                <input type="number" name="installment_2" class="form-control" value="{{ $pivot->installment_2 }}">
                            </div>
                            <div class="col-md-4" id="installment_3_wrapper">
                                <label>Installment 3</label>
                                <input type="number" name="installment_3" class="form-control" value="{{ $pivot->installment_3 }}">
                            </div>
                        </div>
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" name="apply_additional_charges"
                                value="1" {{ $pivot->apply_additional_charges ? 'checked' : '' }}>
                            <label class="form-check-label">Apply additional ₨1000 per installment</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success mt-3">Update Course</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('additional-javascript')
<script>
    // identical JS logic from Add Course page
    $('#payment_type').on('change', function() {
        if ($(this).val() === 'installment') {
            $('#installment-section').show();
            autoFillInstallments();
        } else {
            $('#installment-section').hide();
        }
    });

    $('#installment_count').on('change', function() {
        autoFillInstallments();
    });

    $('#course_fee').on('input', function() {
        autoFillInstallments();
    });

    $('input[name="apply_additional_charges"]').on('change', function() {
        autoFillInstallments();
    });

    function autoFillInstallments() {
        const total = parseFloat($('#course_fee').val()) || 0;
        const count = parseInt($('#installment_count').val()) || 2;
        const addCharges = $('input[name="apply_additional_charges"]').is(':checked');
        if (total <= 0) return;

        const base = Math.floor(total / count);
        const remainder = total - base * count;

        for (let i = 1; i <= 3; i++) {
            const input = $(`input[name="installment_${i}"]`);
            if (i <= count) {
                input.closest('.col-md-4').show();
                let value = base;
                if (i === 1) value += remainder;
                if (addCharges) value += 1000;
                input.val(value);
            } else {
                input.closest('.col-md-4').hide().find('input').val('');
            }
        }
    }
</script>
@endsection
