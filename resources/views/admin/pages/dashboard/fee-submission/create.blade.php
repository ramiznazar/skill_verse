@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Fee Management</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('fee-submission.index') }}" class="btn btn-sm btn-primary" title="Back">Back</a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Add Fee</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" action="{{ route('fee-submission.store', $admission->id) }}"
                                method="POST" novalidate>
                                @csrf

                                {{-- Student Info --}}
                                <div class="form-group mb-3">
                                    <label><strong>Student Name:</strong> {{ $admission->name }}</label><br>
                                    <label><strong>Admission No:</strong> {{ $admission->roll_no ?? '—' }}</label>
                                </div>

                                {{-- Payment Method --}}
                                <div class="form-group">
                                    <label>Payment Method</label>
                                    <select name="payment_method" id="paymentMethod" class="form-control" required>
                                        <option value="">-- Select Method --</option>
                                        <option value="account">By Account</option>
                                        <option value="hand">By Hand</option>
                                    </select>
                                    @error('payment_method')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Hidden Collector Field (auto-fill current user ID) --}}
                                <input type="hidden" name="collector_id" id="collectorIdField" value="">

                                {{-- Account Selection --}}
                                <div class="form-group" id="accountDiv" style="display: none;">
                                    <label>Select Account</label>
                                    <select name="account_id" id="accountSelect" class="form-control">
                                        <option value="">-- Select Account --</option>
                                        @foreach ($accounts as $account)
                                            <option value="{{ $account->id }}" data-name="{{ $account->name }}"
                                                data-number="{{ $account->number }}">
                                                {{ $account->type }} - {{ $account->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('account_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Account Info --}}
                                <div id="accountInfo" style="display: none;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Account Name</label>
                                                <input type="text" id="accountName" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Account Number</label>
                                                <input type="text" id="accountNumber" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Multi-Course Fee Selection --}}
                                <div class="form-group mt-4">
                                    <label><strong>Select Fee to Submit:</strong></label><br>

                                    @if ($admission->courses->isNotEmpty())
                                        @foreach ($admission->courses as $course)
                                            <div class="border rounded p-3 mb-3">
                                                <h6 class="text-primary mb-1">
                                                    🎓 {{ $course->title }}
                                                    <small
                                                        class="text-muted">({{ $course->pivot->batch->title ?? 'Batch' }})</small>
                                                </h6>
                                                <p class="mb-2">Total Fee:
                                                    ₨{{ number_format($course->pivot->course_fee) }}</p>

                                                @php
                                                    $submitted = \App\Models\FeeSubmission::where(
                                                        'admission_id',
                                                        $admission->id,
                                                    )
                                                        ->where('course_id', $course->id)
                                                        ->pluck('payment_type')
                                                        ->toArray();
                                                @endphp

                                                {{-- Full fee or installment options --}}
                                                @php
                                                    // $pivotPaymentType = $admission->payment_type;
                                                    // $pivotPaymentType =
                                                    //     $course->pivot->payment_type ?? $admission->payment_type;
                                                    $pivotPaymentType =
                                                        $course->pivot->payment_type ?:
                                                        $admission->payment_type ?? 'full_fee';

                                                @endphp

                                                @if ($pivotPaymentType === 'full_fee')
                                                    @php $paid = in_array('full_fee', $submitted); @endphp
                                                    <label class="fancy-checkbox d-block">
                                                        <input type="checkbox" name="fees[{{ $course->id }}][]"
                                                            value="full_fee" {{ $paid ? 'checked disabled' : '' }}>
                                                        <span>
                                                            Full Fee
                                                            —₨{{ number_format($course->pivot->course_fee ?: $admission->full_fee) }}

                                                            @if ($paid)
                                                                <small class="text-success">(Already Submitted)</small>
                                                            @endif
                                                        </span>
                                                    </label>
                                                @elseif ($pivotPaymentType === 'installment')
                                                    @php
                                                        $installments = [
                                                            'installment_1' =>
                                                                $course->pivot->installment_1 ??
                                                                ($admission->installment_1 ?? 0),
                                                            'installment_2' =>
                                                                $course->pivot->installment_2 ??
                                                                ($admission->installment_2 ?? 0),
                                                            'installment_3' =>
                                                                $course->pivot->installment_3 ??
                                                                ($admission->installment_3 ?? 0),
                                                        ];
                                                    @endphp

                                                    @foreach ($installments as $key => $amount)
                                                        @if ($amount > 0)
                                                            @php $paid = in_array($key, $submitted); @endphp
                                                            <label class="fancy-checkbox d-block">
                                                                <input type="checkbox" name="fees[{{ $course->id }}][]"
                                                                    value="{{ $key }}"
                                                                    {{ $paid ? 'checked disabled' : '' }}>
                                                                <span>
                                                                    {{ ucfirst(str_replace('_', ' ', $key)) }} —
                                                                    ₨{{ number_format($amount) }}
                                                                    @if ($paid)
                                                                        <small class="text-success">(Already
                                                                            Submitted)</small>
                                                                    @endif
                                                                </span>
                                                            </label>
                                                        @endif
                                                    @endforeach
                                                @endif

                                            </div>
                                        @endforeach
                                    @else
                                        {{-- Fallback for legacy single-course admissions --}}
                                        <div class="border rounded p-3 mb-3">
                                            <h6 class="text-primary">🎓 {{ $admission->course->title }}</h6>
                                            <p>Full Fee: ₨{{ number_format($admission->full_fee) }}</p>
                                        </div>
                                    @endif
                                </div>

                                <br>
                                <button type="submit" class="btn btn-primary">Submit Fee</button>
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
            const methodSelect = document.getElementById('paymentMethod');
            const accountDiv = document.getElementById('accountDiv');
            const accountInfo = document.getElementById('accountInfo');
            const accountSelect = document.getElementById('accountSelect');
            const accountName = document.getElementById('accountName');
            const accountNumber = document.getElementById('accountNumber');
            const collectorIdField = document.getElementById('collectorIdField');
            const loggedInUserId = {{ auth()->user()->id }};

            methodSelect.addEventListener('change', function() {
                const method = this.value;
                if (method === 'hand') {
                    collectorIdField.value = loggedInUserId;
                    accountDiv.style.display = 'none';
                    accountInfo.style.display = 'none';
                } else if (method === 'account') {
                    collectorIdField.value = '';
                    accountDiv.style.display = 'block';
                    accountInfo.style.display = 'block';
                } else {
                    collectorIdField.value = '';
                    accountDiv.style.display = 'none';
                    accountInfo.style.display = 'none';
                }
            });

            accountSelect.addEventListener('change', function() {
                const selected = this.options[this.selectedIndex];
                accountName.value = selected.getAttribute('data-name') || '';
                accountNumber.value = selected.getAttribute('data-number') || '';
            });
        });
    </script>
@endsection
