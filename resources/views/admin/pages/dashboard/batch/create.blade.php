@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Batches</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('batch.index') }}" class="btn btn-sm btn-primary" title="">All Batches</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Add New Batch</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" action="{{ route('batch.store') }}" method="POST"
                                novalidate>
                                @csrf

                                <div class="row">
                                    {{-- Course --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Course</label>
                                            <select name="course_id" class="form-control">
                                                <option value="">Select Course</option>
                                                @foreach ($courses as $course)
                                                    <option value="{{ $course->id }}"
                                                        {{ old('course_id') }}>
                                                        {{ $course->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('course_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Teacher --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Teacher</label>
                                            <select name="teacher_id" class="form-control">
                                                <option value="">Select Teacher</option>
                                                @foreach ($teachers as $teacher)
                                                    <option value="{{ $teacher->id }}"
                                                        {{ old('teacher_id')}}>
                                                        {{ $teacher->name }} ({{ $teacher->course->title }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('teacher_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- Title --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Batch Title</label>
                                            <input type="text" name="title" class="form-control"
                                                placeholder="e.g. Batch A" value="{{ old('title') }}">
                                            @error('title')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Capacity --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Capacity</label>
                                            <input type="number" name="capacity" class="form-control"
                                                placeholder="Max Students" value="{{ old('capacity') }}">
                                            @error('capacity')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Timing --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Timing</label>
                                            <input type="text" name="timing" class="form-control"
                                                placeholder="e.g. 10:00 AM - 12:00 PM"
                                                value="{{ old('timing') }}">
                                            @error('timing')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- Shift --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Shift</label>
                                            <select name="shift" class="form-control">
                                                <option value="morning"
                                                    {{ old('shift') }}>
                                                    Morning</option>
                                                <option value="evening"
                                                    {{ old('shift') }}>
                                                    Evening</option>
                                                <option value="night"
                                                    {{ old('shift') }}>Night
                                                </option>
                                            </select>
                                            @error('shift')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Status --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="active"
                                                    {{ old('status') }}>
                                                    Active</option>
                                                <option value="completed"
                                                    {{ old('status') }}>
                                                    Completed</option>
                                                <option value="cancelled"
                                                    {{ old('status') }}>
                                                    Cancelled</option>
                                            </select>
                                            @error('status')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Start Date --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <input type="date" name="start_date" class="form-control"
                                                value="{{ old('start_date') }}">
                                            @error('start_date')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- End Date --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <input type="date" name="end_date" class="form-control"
                                                value="{{ old('end_date') }}">
                                            @error('end_date')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Notes --}}
                                <div class="form-group">
                                    <label>Notes</label>
                                    <textarea name="note" class="form-control" rows="3" placeholder="Optional notes">{{ old('note') }}</textarea>
                                    @error('note')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Add New Batch</button>
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
