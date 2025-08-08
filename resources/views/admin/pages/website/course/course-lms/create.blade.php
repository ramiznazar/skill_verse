@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Course Languages</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('course-language.index', $course->id) }}" class="btn btn-sm btn-primary"
                        title="">All
                        Languages</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Add New LMS Course</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" action="{{ route('course-lms.store', $course->id) }}" method="post"
                                enctype="multipart/form-data" novalidate>
                                @csrf

                                {{-- Price --}}
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" name="price" class="form-control" value="{{ old('price') }}">
                                    @error('price')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Duration --}}
                                <div class="form-group">
                                    <label for="duration">Duration Days</label>
                                    <input type="text" name="duration" class="form-control"
                                        value="{{ old('duration') }}">
                                    @error('duration')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Lecture --}}
                                <div class="form-group">
                                    <label for="lecture">Lecture</label>
                                    <input type="text" name="lecture" class="form-control" value="{{ old('lecture') }}">
                                    @error('lecture')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Video Duration --}}
                                <div class="form-group">
                                    <label for="video_duration">Video Duration</label>
                                    <input type="text" name="video_duration" class="form-control"
                                        value="{{ old('video_duration') }}">
                                    @error('video_duration')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <br>
                                <button type="submit" class="btn btn-primary">Add LMS Course</button>
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
