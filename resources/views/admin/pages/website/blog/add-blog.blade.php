@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Blog Posts</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('blog.index') }}" class="btn btn-sm btn-primary" title="">All Posts</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Create New Post</h2>
                        </div>
                        <div class="body">
                            <form id="post-form" action="{{route('blog.store')}}" method="POST" enctype="multipart/form-data" novalidate>
                                @csrf

                                <!-- Image, Title, and Post Date in One Row -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" name="image" accept="image/*" class="form-control">
                                            @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                                            @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Post Date</label>
                                            <input type="date" name="date" class="form-control" value="{{ old('date') }}">
                                            @error('date') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Best For, Duration, Certified in One Row -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Best For</label>
                                            <input type="text" name="best_for" class="form-control" value="{{ old('best_for') }}">
                                            @error('best_for') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Duration</label>
                                            <input type="text" name="duration" class="form-control" value="{{ old('duration') }}">
                                            @error('duration') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Certified</label>
                                            <select name="is_certified" class="form-control">
                                                <option value="1" selected>Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                            @error('is_certified') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" rows="5">{{ old('description') }}</textarea>
                                    @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <br>
                                <button type="submit" class="btn btn-primary">Publish Post</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
