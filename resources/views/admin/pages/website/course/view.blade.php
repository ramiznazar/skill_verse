@extends('admin.layouts.main')
@section('content')
<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Course Details</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <a href="{{ route('course.index') }}" class="btn btn-sm btn-primary">All Courses</a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="body">

                {{-- Top Section --}}
                <div class="row mb-4">
                    <div class="col-md-3 text-center">
                        @if($course->image)
                            <img src="{{ asset($course->image) }}" 
                                 class="img-thumbnail" width="150" height="150" alt="Course Image">
                        @else
                            <img src="https://via.placeholder.com/150" class="img-thumbnail" alt="No Image">
                        @endif
                    </div>
                    <div class="col-md-9">
                        <h4 class="mb-2">{{ $course->title }}</h4>
                        <p><strong>Slug:</strong> {{ $course->slug }}</p>
                        <p><strong>Category:</strong> {{ $course->courseCategory->name ?? 'N/A' }}</p>
                        <p><strong>Duration:</strong> {{ $course->duration ?? 'N/A' }}</p>
                        <p><strong>Status:</strong> 
                            @if($course->is_active)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-secondary">Inactive</span>
                            @endif
                        </p>
                    </div>
                </div>

                <hr>

                {{-- Fee Details --}}
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Full Fee:</strong> ₨{{ number_format($course->full_fee) }}</p>
                        <p><strong>Discount:</strong> {{ $course->discount }}%</p>
                        <p><strong>Minimum Fee:</strong> ₨{{ number_format($course->min_fee) }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Created At:</strong> {{ $course->created_at->format('d M Y') }}</p>
                        <p><strong>Updated At:</strong> {{ $course->updated_at->format('d M Y') }}</p>
                        <p><strong>Added By:</strong> {{ $course->created_by ?? 'N/A' }}</p>
                    </div>
                </div>

                <hr>

                {{-- Description --}}
                <div class="row">
                    <div class="col-md-12">
                        <h5>Short Description</h5>
                        <p>{{ $course->short_description ?? 'N/A' }}</p>

                        <h5 class="mt-3">Detailed Description</h5>
                        <p>{!! nl2br(e($course->description ?? 'N/A')) !!}</p>
                    </div>
                </div>

                <hr>

                {{-- Related Information --}}
                <div class="row">
                    <div class="col-md-6">
                        <h5>Outlines</h5>
                        @if(isset($course->outlines) && count($course->outlines) > 0)
                            <ul>
                                @foreach($course->outlines as $outline)
                                    <li>{{ $outline->title }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">No outlines added yet.</p>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <h5>LMS Courses</h5>
                        @if(isset($course->lmsCourses) && count($course->lmsCourses) > 0)
                            <ul>
                                @foreach($course->lmsCourses as $lms)
                                    <li>{{ $lms->title }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">No LMS courses added yet.</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
