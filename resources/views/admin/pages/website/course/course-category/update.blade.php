@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Course Categories</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('course-category.index') }}" class="btn btn-sm btn-primary" title="">All Categories</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Update Course Category</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" action="{{ route('course-category.update',$category->id) }}" method="post" novalidate>
                                @csrf
                                @method('PUT')
                        
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $category->name }}">
                                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                        
                                <br>
                                <button type="submit" class="btn btn-primary">Update Course Category</button>
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
