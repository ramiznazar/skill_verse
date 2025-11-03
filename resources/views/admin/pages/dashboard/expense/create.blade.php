@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Expenses</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('expense.index') }}" class="btn btn-sm btn-primary" title="">All Expenses</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Add Expense</h2>
                        </div>
                        <div class="body">
                            <form action="{{ route('expense.store') }}" method="POST">
                                @csrf

                                <div class="row">
                                    {{-- Title --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" name="title" class="form-control"
                                                value="{{ old('title') }}" required>
                                            @error('title')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Type</label>
                                            <select name="ref_type" class="form-control" required>
                                                <option value="">-- Select Category --</option>
                                                <option value="furniture">Furniture</option>
                                                <option value="stationery">Stationery</option>
                                                <option value="utility">Utility</option>
                                                <option value="maintenance">Maintenance</option>
                                                <option value="installment">Installments</option>
                                                <option value="salary">Salary</option>
                                                <option value="commission">Commission</option>
                                                <option value="Other">Other</option>
                                            </select>
                                            @error('ref_type')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    {{-- Amount --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Amount (PKR)</label>
                                            <input type="number" name="amount" class="form-control"
                                                value="{{ old('amount') }}" required>
                                            @error('amount')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        {{-- Date --}}
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input type="date" name="date" class="form-control"
                                                value="{{ old('date', date('Y-m-d')) }}">
                                            @error('date')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Expense Type --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Expense Type</label>
                                            <select name="type" id="expenseTypeSelect" class="form-control" required>
                                                <option value="">-- Select Type --</option>
                                                <option value="essential"
                                                    {{ old('type') == 'essential' ? 'selected' : '' }}>
                                                    Essential</option>
                                                <option value="non-essential"
                                                    {{ old('type') == 'non-essential' ? 'selected' : '' }}>Non-Essential
                                                </option>
                                            </select>
                                            @error('type')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Purpose --}}
                                <div class="form-group">
                                    <label>Purpose</label>
                                    <textarea name="purpose" class="form-control" rows="3">{{ old('purpose') }}</textarea>
                                    @error('purpose')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <br>
                                <button type="submit" class="btn btn-primary">Add Expense</button>
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
        document.getElementById('accountSelect').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const name = selectedOption.getAttribute('data-name') || '';
            const number = selectedOption.getAttribute('data-number') || '';

            document.getElementById('accountName').value = name;
            document.getElementById('accountNumber').value = number;
        });
    </script>
@endsection
