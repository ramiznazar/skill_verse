@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Courses</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('course.index') }}" class="btn btn-sm btn-primary" title="">All Courses</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Update Course</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" action="{{ route('course.update', $course->id) }}" method="post"
                                enctype="multipart/form-data" novalidate>
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Current Image</label>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="card">
                                            <div class="header">
                                                <img src="{{ asset($course->image) }}" class="img-fluid rounded"
                                                    style="width:100%; height: 250px; object-fit: cover;" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" name="image" accept="image/*" class="form-control">
                                            @error('image')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" name="title" class="form-control"
                                                value="{{ $course->title }}">
                                            @error('title')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Slug</label>
                                            <input type="text" name="slug" class="form-control"
                                                value="{{ $course->slug }}">
                                            @error('slug')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Duration</label>
                                            <input type="text" name="duration" class="form-control"
                                                value="{{ $course->duration }}">
                                            @error('duration')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select name="category_id" class="form-control">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ $course->category_id == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Mode</label>
                                            <select name="mode" class="form-control">
                                                <option value="Online"
                                                    {{ old('mode', $course->mode) == 'Online' ? 'selected' : '' }}>Online
                                                </option>
                                                <option value="On-campus"
                                                    {{ old('mode', $course->mode) == 'On-campus' ? 'selected' : '' }}>
                                                    On-campus</option>
                                                <option value="Hybrid"
                                                    {{ old('mode', $course->mode) == 'Hybrid' ? 'selected' : '' }}>Hybrid
                                                </option>
                                            </select>
                                            @error('mode')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Level</label>
                                            <select name="level" class="form-control">
                                                <option value="Intermediate"
                                                    {{ old('level', $course->level) == 'Intermediate' ? 'selected' : '' }}>
                                                    Intermediate</option>
                                                <option value="Beginner"
                                                    {{ old('level', $course->level) == 'Beginner' ? 'selected' : '' }}>
                                                    Beginner</option>
                                                <option value="Advanced"
                                                    {{ old('level', $course->level) == 'Advanced' ? 'selected' : '' }}>
                                                    Advanced</option>
                                            </select>
                                            @error('level')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="is_active" class="form-control">
                                                <option value="1"
                                                    {{ old('is_active', $course->is_active) == 1 ? 'selected' : '' }}>
                                                    Active
                                                </option>
                                                <option value="0"
                                                    {{ old('is_active', $course->is_active) == 0 ? 'selected' : '' }}>
                                                    Inactive
                                                </option>
                                            </select>
                                            @error('is_active')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Discount Offer</label>
                                            <select name="discount_offer" class="form-control">
                                                <option value="0"
                                                    {{ old('discount_offer', $course->discount_offer) == 0 ? 'selected' : '' }}>
                                                    No
                                                </option>
                                                <option value="1"
                                                    {{ old('discount_offer', $course->discount_offer) == 1 ? 'selected' : '' }}>
                                                    Yes
                                                </option>
                                            </select>
                                            @error('discount_offer')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Full Fee</label>
                                            <input type="text" name="full_fee" class="form-control"
                                                value="{{ $course->full_fee }}">
                                            @error('full_fee')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Discount (%)</label>
                                            <input type="text" name="discount" class="form-control"
                                                value="{{ $course->discount }}" oninput="calculateMinFee()">
                                            @error('discount')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Min Fee</label>
                                            <input type="text" name="min_fee" class="form-control"
                                                value="{{ $course->min_fee }}">
                                            @error('min_fee')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div id="interview-discount-wrapper" style="display: none;">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Interview Discount (%)</label>
                                                <input type="text" name="interview_discount_per" class="form-control"
                                                    value="{{ $course->interview_discount_per }}">
                                                @error('interview_discount_per')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Interview Fee After Discount</label>
                                                <input type="text" name="interview_discount_amount"
                                                    class="form-control" value="{{ $course->interview_discount_amount }}">
                                                @error('interview_discount_amount')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Short Description</label>
                                    <textarea name="short_description" class="form-control" rows="3">{{ $course->short_description }}</textarea>
                                    @error('short_description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" rows="5">{{ $course->description }}</textarea>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <br>
                                <button type="submit" class="btn btn-primary">Update Course</button>
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
        function calculateMinFee() {
            const fullFee = parseFloat(document.querySelector('input[name="full_fee"]').value) || 0;
            const discount = parseFloat(document.querySelector('input[name="discount"]').value) || 0;

            if (fullFee > 0 && discount > 0) {
                const minFee = fullFee - ((fullFee * discount) / 100);
                document.querySelector('input[name="min_fee"]').value = minFee.toFixed(2);
            } else {
                document.querySelector('input[name="min_fee"]').value = '';
            }
        }

        // Trigger calculation on page load in case values already exist
        window.onload = calculateMinFee;
    </script>
    <script>
        function calculateInterviewDiscount() {
            const fullFee = parseFloat(document.querySelector('input[name="full_fee"]').value) || 0;
            const interviewDiscountPer = parseFloat(document.querySelector('input[name="interview_discount_per"]').value) ||
                0;

            if (fullFee > 0 && interviewDiscountPer > 0) {
                const discountAmount = (fullFee * interviewDiscountPer) / 100;
                const remainingFee = fullFee - discountAmount;
                document.querySelector('input[name="interview_discount_amount"]').value = remainingFee.toFixed(2);
            }
        }

        // show/hide interview section
        function toggleInterviewDiscountFields() {
            const offerSelect = document.querySelector('select[name="discount_offer"]');
            const wrapper = document.getElementById('interview-discount-wrapper');

            if (offerSelect.value === "1") {
                wrapper.style.display = 'block';
            } else {
                wrapper.style.display = 'none';

                document.querySelector('input[name="interview_discount_per"]').value = "";
                document.querySelector('input[name="interview_discount_amount"]').value = "";
            }
        }

        // event listeners
        document.querySelector('input[name="full_fee"]').addEventListener('input', calculateInterviewDiscount);
        document.querySelector('input[name="interview_discount_per"]').addEventListener('input',
        calculateInterviewDiscount);

        document.querySelector('select[name="discount_offer"]').addEventListener('change', toggleInterviewDiscountFields);

        // run on page load
        window.onload = function() {
            calculateMinFee();
            calculateInterviewDiscount();
            toggleInterviewDiscountFields();
        };
    </script>
@endsection
