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
                            <h2>Update Banner</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" action="{{ route('banner.update', $banner->id) }}" method="post"
                                enctype="multipart/form-data" novalidate>
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Current Image</label>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="card">
                                            <div class="header">
                                                <img src="{{ asset($banner->image) }}" class="img-fluid rounded"
                                                    style="width:100%; height: 250px; object-fit: cover;" alt="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" name="image" accept="image/*" class="form-control">
                                        @error('image')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Main Title</label>
                                        <input type="text" name="main_title" class="form-control"
                                            value="{{ $banner->main_title }}">
                                        @error('main_title')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control"
                                            value="{{ $banner->title }}">
                                        @error('title')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Description</label>
                                        <input type="text" name="description" class="form-control"
                                            value="{{ $banner->description }}">
                                        @error('description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <br>
                                    <button type="submit" class="btn btn-primary">Update Banner</button>
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
