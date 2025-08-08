@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Popular Courses</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('popular-course.index') }}" class="btn btn-sm btn-primary" title="">All Popular Courses</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Add New Course</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" action="{{ route('popular-course.store') }}" method="post" enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="image" accept="image/*" class="form-control">
                                    @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                        
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                        
                                <br>
                                <button type="submit" class="btn btn-primary">Add Popular Course</button>
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
