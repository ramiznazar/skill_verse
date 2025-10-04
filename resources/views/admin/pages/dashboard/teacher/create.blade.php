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

                                {{-- Name / Email / Phone --}}
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

                                {{-- Skill / Experience / Qualification --}}
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="course_id">Assigned Course</label>
                                            <select name="course_id" id="course_id" class="form-control" required>
                                                <option value="">-- Select Course --</option>
                                                @foreach ($courses as $course)
                                                    <option value="{{ $course->id }}"
                                                        {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                                        {{ $course->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('course_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Experience</label>
                                            <select name="experience" class="form-control">
                                                <option value="6 month"
                                                    {{ old('experience') == '6 month' ? 'selected' : '' }}>6 Month</option>
                                                <option value="1 year"
                                                    {{ old('experience') == '1 year' ? 'selected' : '' }}>1 Year</option>
                                                <option value="2 year"
                                                    {{ old('experience') == '2 year' ? 'selected' : '' }}>2 Year</option>
                                                <option value="more then two year"
                                                    {{ old('experience') == 'more then two year' ? 'selected' : '' }}>More
                                                    then two year</option>
                                            </select>
                                            @error('experience')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Qualification</label>
                                            <select name="qualification" class="form-control">
                                                <option value="middle"
                                                    {{ old('qualification') == 'middle' ? 'selected' : '' }}>Middle
                                                </option>
                                                <option value="metric"
                                                    {{ old('qualification') == 'metric' ? 'selected' : '' }}>Metric
                                                </option>
                                                <option value="intermediate"
                                                    {{ old('qualification') == 'intermediate' ? 'selected' : '' }}>
                                                    Intermediate</option>
                                                <option value="graduate"
                                                    {{ old('qualification') == 'graduate' ? 'selected' : '' }}>Graduate
                                                </option>
                                                <option value="m-phill"
                                                    {{ old('qualification') == 'm-phill' ? 'selected' : '' }}>M Phill
                                                </option>
                                            </select>
                                            @error('qualification')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Payout settings --}}
                                <div class="row">
                                    {{-- Pay Type --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Payout Type</label>
                                            <select name="pay_type" id="pay_type" class="form-control">
                                                <option value="percentage"
                                                    {{ old('pay_type', 'percentage') === 'percentage' ? 'selected' : '' }}>
                                                    Percentage</option>
                                                <option value="fixed" {{ old('pay_type') === 'fixed' ? 'selected' : '' }}>
                                                    Fixed</option>
                                            </select>
                                            @error('pay_type')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Percentage --}}
                                    <div class="col-md-4" id="percentage_wrap">
                                        <div class="form-group">
                                            <label>Percentage (%)</label>
                                            <input type="number" name="percentage" id="percentage" min="0"
                                                max="100" class="form-control" value="{{ old('percentage') }}">
                                            <small class="text-muted">e.g., 20 means 20%</small>
                                            @error('percentage')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Fixed Salary --}}
                                    <div class="col-md-4" id="fixed_wrap">
                                        <div class="form-group">
                                            <label>Fixed Salary (per month)</label>
                                            <input type="number" name="fixed_salary" id="fixed_salary" min="0"
                                                class="form-control" value="{{ old('fixed_salary') }}">
                                            @error('fixed_salary')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Status / Joining Date --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="active"
                                                    {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active
                                                </option>
                                                <option value="inactive"
                                                    {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            @error('status')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
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
    {{-- Simple toggle logic (vanilla JS) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const payType = document.getElementById('pay_type');
            const pctWrap = document.getElementById('percentage_wrap');
            const fixedWrap = document.getElementById('fixed_wrap');
            const pctInput = document.getElementById('percentage');
            const fixedInput = document.getElementById('fixed_salary');

            function syncVisibility() {
                const mode = payType.value;
                if (mode === 'fixed') {
                    fixedWrap.style.display = '';
                    pctWrap.style.display = '';
                    // make fixed required; percentage optional (but still visible for transparency)
                    fixedInput.required = true;
                    pctInput.required = false;
                } else {
                    fixedWrap.style.display = '';
                    pctWrap.style.display = '';
                    // make percentage required; fixed optional
                    fixedInput.required = false;
                    pctInput.required = true;
                }
            }

            payType.addEventListener('change', syncVisibility);
            syncVisibility();
        });
    </script>
@endsection
