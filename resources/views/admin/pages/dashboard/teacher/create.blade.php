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
                            <form id="basic-form" action="{{ route('teacher.store') }}" method="post"
                                enctype="multipart/form-data" novalidate>
                                @csrf

                                {{-- Image --}}
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="image" accept="image/*" class="form-control">
                                    @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Name --}}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ old('name') }}">
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Email --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ old('email') }}">
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Phone --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" name="phone" class="form-control"
                                                value="{{ old('phone') }}">
                                            @error('phone')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- Skill --}}
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Skill</label>
                                            <input type="text" name="skill" class="form-control"
                                                value="{{ old('skill') }}">
                                            @error('skill')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Experience --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Experience</label>
                                            <select name="experience" class="form-control">
                                                <option value="6 month" {{ old('status') == '6 month' ? 'selected' : '' }}>
                                                    6 Month</option>
                                                <option value="1 year" {{ old('status') == '1 year' ? 'selected' : '' }}>
                                                    1 Year</option>
                                                <option value="2 year" {{ old('status') == '2 year' ? 'selected' : '' }}>
                                                    2 Year</option>
                                                <option value="more then two year"
                                                    {{ old('status') == 'more then two year' ? 'selected' : '' }}>
                                                    More then two year</option>
                                            </select>
                                            @error('experience')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Qualification --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Qualification</label>
                                            <select name="qualification" class="form-control">
                                                <option value="middle" {{ old('status') == 'middle' ? 'selected' : '' }}>
                                                    Middle</option>
                                                <option value="metric" {{ old('status') == 'metric' ? 'selected' : '' }}>
                                                    Metric</option>
                                                <option value="intermediate"
                                                    {{ old('status') == 'intermediate' ? 'selected' : '' }}>
                                                    Intermediate</option>
                                                <option value="graduate"
                                                    {{ old('status') == 'graduate' ? 'selected' : '' }}>
                                                    Graduate</option>
                                                <option value="m-phill" {{ old('status') == 'm-phill' ? 'selected' : '' }}>
                                                    M Phill</option>
                                            </select>
                                            @error('qualification')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    {{-- Salary --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Salary</label>
                                            <input type="text" name="salary" class="form-control"
                                                value="{{ old('salary') }}">
                                            @error('salary')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    {{-- Status --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                                                    Active</option>
                                                    <option value="inactive"
                                                    {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive
                                                </option>
                                            </select>
                                            @error('status')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Joining Date --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Joining Date</label>
                                            <input type="date" name="joining_date" class="form-control"
                                                value="{{ old('joining_date') }}">
                                            @error('joining_date')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Notes --}}
                                <div class="form-group">
                                    <label>Notes</label>
                                    <textarea name="notes" class="form-control" rows="4">{{ old('notes') }}</textarea>
                                    @error('notes')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <br>
                                <button type="submit" class="btn btn-primary">Add Teacher</button>
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
