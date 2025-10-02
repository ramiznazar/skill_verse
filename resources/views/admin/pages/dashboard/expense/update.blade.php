@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Expenses</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('expense.index') }}" class="btn btn-sm btn-primary" title="">All Expense</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Update Expense</h2>
                        </div>
                        <div class="body">
                            <form action="{{ route('expense.update', $expense->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6">
                                        {{-- Title --}}
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" name="title" class="form-control"
                                                value="{{ old('title', $expense->title) }}" required>
                                            @error('title')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- Type --}}
                                    {{-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Type</label>
                                            <input type="text" name="ref_type" class="form-control"
                                                value="{{ old('ref_type', $expense->ref_type) }}">
                                            @error('ref_type')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div> --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Type</label>
                                            <select name="ref_type" class="form-control" required>
                                                <option value="">-- Select Category --</option>
                                                <option value="furniture"
                                                    {{ old('ref_type', $expense->ref_type ?? '') == 'furniture' ? 'selected' : '' }}>
                                                    Furniture</option>
                                                <option value="stationery"
                                                    {{ old('ref_type', $expense->ref_type ?? '') == 'stationery' ? 'selected' : '' }}>
                                                    Stationery</option>
                                                <option value="utility"
                                                    {{ old('ref_type', $expense->ref_type ?? '') == 'utility' ? 'selected' : '' }}>
                                                    Utility</option>
                                                <option value="maintenance"
                                                    {{ old('ref_type', $expense->ref_type ?? '') == 'maintenance' ? 'selected' : '' }}>
                                                    Maintenance</option>
                                                <option value="salary"
                                                    {{ old('ref_type', $expense->ref_type ?? '') == 'salary' ? 'selected' : '' }}>
                                                    Salary</option>
                                                <option value="commission"
                                                    {{ old('ref_type', $expense->ref_type ?? '') == 'commission' ? 'selected' : '' }}>
                                                    Commission</option>
                                                <option value="other"
                                                    {{ old('ref_type', $expense->ref_type ?? '') == 'other' ? 'selected' : '' }}>
                                                    Other</option>
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
                                                value="{{ old('amount', $expense->amount) }}" required>
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
                                                value="{{ old('date', $expense->date ? \Carbon\Carbon::parse($expense->date)->format('Y-m-d') : '') }}"
                                                required>
                                            @error('date')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Expense Type --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Expense Type</label>
                                            <select name="type" id="expenseTypeSelect" class="form-control">
                                                <option value="">-- Select Type --</option>
                                                <option value="essential"
                                                    {{ old('type', $expense->type) == 'essential' ? 'selected' : '' }}>
                                                    Essential
                                                </option>
                                                <option value="non-essential"
                                                    {{ old('type', $expense->type) == 'non-essential' ? 'selected' : '' }}>
                                                    Non-Essential
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
                                    <textarea name="purpose" class="form-control" rows="3" required>{{ old('purpose', $expense->purpose) }}</textarea>
                                    @error('purpose')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <br>
                                <button type="submit" class="btn btn-primary">Update Expense</button>
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
@endsection
