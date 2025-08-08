@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Edit Gallery Image</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('gallary-image.index') }}" class="btn btn-sm btn-primary">All Images</a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Update Gallery Image</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" action="{{ route('gallary-image.update', $image->id) }}" method="POST"
                                enctype="multipart/form-data" novalidate>
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Select Category</label>
                                    <select name="gallary_category_id" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $image->gallary_category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('gallary_category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Current Images</label><br>
                                    @if ($image->images && is_array($image->images))
                                        <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                                            @foreach ($image->images as $img)
                                                <img src="{{ asset($img) }}" alt="Image"
                                                    style="width: 150px; height: auto; border: 1px solid #ddd;">
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-muted">No images found.</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Replace with New Images</label>
                                    <input type="file" name="images[]" class="form-control" multiple>
                                    @error('images.*')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <br>
                                <button type="submit" class="btn btn-primary">Update Images</button>
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
            $('#basic-form').parsley();
        });
    </script>
@endsection
