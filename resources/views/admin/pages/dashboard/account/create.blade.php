@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Accounts</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('account.index') }}" class="btn btn-sm btn-primary" title="">All Accounts</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Add New Account</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" action="{{ route('account.store') }}" method="POST" novalidate>
                                @csrf
                                <div class="row">

                                    {{-- Account Type --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Account Type</label>
                                            <input type="text" name="type" class="form-control"
                                                value="{{ old('type') }}" required>
                                            @error('type')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Account Name --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Account Name</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ old('name') }}" required>
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Account Number --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Account Number</label>
                                            <input type="text" name="number" class="form-control"
                                                value="{{ old('number') }}" required>
                                            @error('number')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <br>
                                <button type="submit" class="btn btn-primary">Add Account</button>
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
