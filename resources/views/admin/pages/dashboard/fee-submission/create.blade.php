@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Fee Management</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="javascript:void(0);" class="btn btn-sm btn-primary" title="">New</a>
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

                                <div class="form-group">
                                    <label><strong>Student Name:</strong> {{ $admission->name }}</label><br>
                                    <label><strong>Course:</strong> {{ $admission->course->title }}</label><br>
                                    <label><strong>Payment Type:</strong> {{ ucfirst($admission->payment_type) }}</label>
                                </div>

                                {{-- Payment Method --}}
                                <div class="form-group">
                                    <label>Payment Method</label>
                                    <select name="payment_method" id="paymentMethod" class="form-control" required>
                                        <option value="">-- Select Method --</option>
                                        <option value="account">By Account</option>
                                        <option value="hand">By Hand</option>
                                    </select>
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

                                {{-- Fee Selection --}}
                                <div class="form-group">
                                    <label><strong>Select Fee to Submit:</strong></label><br>

                                    @if ($admission->payment_type === 'full_fee')
                                        @php $submitted = in_array('full_fee', $submittedFees); @endphp
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" name="fees[]" value="full_fee"
                                                {{ $submitted ? 'checked' : '' }}>
                                            <span>Full Fee - {{ $admission->full_fee }} PKR
                                                @if ($submitted)
                                                    <small class="text-success">(Already Submitted)</small>
                                                @endif
                                            </span>
                                        </label>
                                    @else
                                        @php $installments = ['installment_1', 'installment_2', 'installment_3']; @endphp
                                        @foreach ($installments as $key)
                                            @if ($admission->$key)
                                                @php $submitted = in_array($key, $submittedFees); @endphp
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="fees[]" value="{{ $key }}"
                                                        {{ $submitted ? 'checked disabled' : '' }}>
                                                    <span>{{ ucfirst(str_replace('_', ' ', $key)) }} -
                                                        {{ $admission->$key }} PKR
                                                        @if ($submitted)
                                                            <small class="text-success">(Already Submitted)</small>
                                                        @endif
                                                    </span>
                                                </label>
                                            @endif
                                        @endforeach
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

            const loggedInUserId = {{ auth()->user()->id }}; // inject Laravel user ID

            methodSelect.addEventListener('change', function() {
                const method = this.value;

                if (method === 'hand') {
                    collectorIdField.value = loggedInUserId;
                    accountDiv.style.display = 'none';
                    accountInfo.style.display = 'none';
                } else if (method === 'account') {
                    collectorIdField.value = ''; // clear if account selected
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
