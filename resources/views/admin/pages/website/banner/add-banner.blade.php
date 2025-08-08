@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Banners</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('banner.index') }}" class="btn btn-sm btn-primary" title="">All Banners</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Add New Banner</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="image" accept="image/*" class="form-control">
                                    @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                        
                                <div class="form-group">
                                    <label>Main Title</label>
                                    <input type="text" name="main_title" class="form-control" value="{{ old('main_title') }}">
                                    @error('main_title') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                        
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                        
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" name="description" class="form-control" value="{{ old('description') }}">
                                    @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                        
                                <br>
                                <button type="submit" class="btn btn-primary">Add Banner</button>
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
