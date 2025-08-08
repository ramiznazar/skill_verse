@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Teachers</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('teacher.index') }}" class="btn btn-sm btn-primary" title="">All Teachers</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Add New Teachers</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" action="{{ route('user.update',$user->id) }}" method="POST" enctype="multipart/form-data" novalidate>
                                @csrf
                                @method('PUT')

                                {{-- Profile Picture --}}
                                {{-- <div class="form-group">
                                    <label>Profile Picture</label>
                                    <input type="file" name="profile_picture" accept="image/*" class="form-control">
                                    @if ($user->profile_picture)
                                        <img src="{{ asset($user->profile_picture) }}" width="80" height="80"
                                            style="border-radius: 50%;" class="mt-2">
                                    @endif
                                    @error('profile_picture')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div> --}}

                                {{-- Name + Username --}}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Full Name</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ old('name', $user->name) }}">
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" name="username" class="form-control"
                                                value="{{ old('username', $user->username) }}">
                                            @error('username')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ old('email', $user->email) }}">
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Email + Phone --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" name="phone" class="form-control"
                                                value="{{ old('phone', $user->phone) }}">
                                            @error('phone')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Role</label>
                                            <select name="role" class="form-control">
                                                <option value="">-- Select Role --</option>
                                                <option value="admin"
                                                    {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin
                                                </option>
                                                <option value="partner"
                                                    {{ old('role', $user->role) == 'partner' ? 'selected' : '' }}>Partner
                                                </option>
                                                <option value="administrator"
                                                    {{ old('role', $user->role) == 'administrator' ? 'selected' : '' }}>
                                                    Administrator</option>
                                            </select>
                                            @error('role')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Role + Optional Password --}}
                                <div class="row">


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>New Password (leave empty to keep current)</label>
                                            <input type="password" name="password" class="form-control">
                                            @error('password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Submit --}}
                                <button type="submit" class="btn btn-primary">Update User</button>
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
