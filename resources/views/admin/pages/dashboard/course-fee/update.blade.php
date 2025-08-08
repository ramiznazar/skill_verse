@extends('admin.layouts.main')

@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Course Fee</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('course-fee.index') }}" class="btn btn-sm btn-primary">All Fee Structures</a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Update Course Fee</h2>
                        </div>
                        <div class="body">
                            <form action="{{ route('course-fee.update', $courseFee->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                {{-- Course --}}
                                <div class="form-group">
                                    <label>Course</label>
                                    <select name="course_id" class="form-control">
                                        <option value="">Select Course</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}"
                                                {{ $course->id == $courseFee->course_id ? 'selected' : '' }}>
                                                {{ $course->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('course_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Full Fee --}}
                                <div class="form-group">
                                    <label>Full Fee (Total)</label>
                                    <input type="number" step="0.01" name="full_fee" class="form-control"
                                        placeholder="Enter full fee amount" value="{{ old('full_fee', $courseFee->full_fee) }}">
                                    @error('full_fee')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Installments --}}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Installment 1</label>
                                            <input type="number" step="0.01" name="installment_1" class="form-control"
                                                placeholder="e.g. 10000" value="{{ old('installment_1', $courseFee->installment_1) }}">
                                            @error('installment_1')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Installment 2</label>
                                            <input type="number" step="0.01" name="installment_2" class="form-control"
                                                placeholder="e.g. 10000" value="{{ old('installment_2', $courseFee->installment_2) }}">
                                            @error('installment_2')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Installment 3</label>
                                            <input type="number" step="0.01" name="installment_3" class="form-control"
                                                placeholder="e.g. 10000" value="{{ old('installment_3', $courseFee->installment_3) }}">
                                            @error('installment_3')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mt-3">Update Fee</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
