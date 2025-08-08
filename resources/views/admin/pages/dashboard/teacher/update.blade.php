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
                            <h2>Update Teachers</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" action="{{ route('teacher.update', $teacher->id) }}" method="POST"
                                enctype="multipart/form-data" novalidate>
                                @csrf
                                @method('PUT')

                                {{-- Current Image --}}
                                <div class="form-group">
                                    <label>Current Image</label>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="card">
                                            <div class="header">
                                                <img src="{{ asset($teacher->image) }}" class="img-fluid rounded"
                                                    style="width:100%; height: 250px; object-fit: cover;"
                                                    alt="Teacher Image">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Image --}}
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="image" accept="image/*" class="form-control">
                                    @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="row">
                                    {{-- Name --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ old('name', $teacher->name) }}">
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
                                                value="{{ old('email', $teacher->email) }}">
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
                                                value="{{ old('phone', $teacher->phone) }}">
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
                                                value="{{ old('skill', $teacher->skill) }}">
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
                                                @foreach (['6 month', '1 year', '2 year', 'more then two year'] as $exp)
                                                    <option value="{{ $exp }}"
                                                        {{ old('experience', $teacher->experience) == $exp ? 'selected' : '' }}>
                                                        {{ ucfirst($exp) }}
                                                    </option>
                                                @endforeach
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
                                                @foreach (['middle', 'metric', 'intermediate', 'graduate', 'm-phill'] as $qual)
                                                    <option value="{{ $qual }}"
                                                        {{ old('qualification', $teacher->qualification) == $qual ? 'selected' : '' }}>
                                                        {{ ucfirst($qual) }}
                                                    </option>
                                                @endforeach
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
                                                value="{{ old('salary', $teacher->salary) }}">
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
                                                <option value="active"
                                                    {{ old('status', $teacher->status) == 'active' ? 'selected' : '' }}>
                                                    Active</option>
                                                <option value="inactive"
                                                    {{ old('status', $teacher->status) == 'inactive' ? 'selected' : '' }}>
                                                    Inactive</option>
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
                                                value="{{ old('joining_date', $teacher->joining_date) }}">
                                            @error('joining_date')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Notes --}}
                                <div class="form-group">
                                    <label>Notes</label>
                                    <textarea name="notes" class="form-control" rows="4">{{ old('notes', $teacher->notes) }}</textarea>
                                    @error('notes')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <br>
                                <button type="submit" class="btn btn-primary">Update Teacher</button>
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
