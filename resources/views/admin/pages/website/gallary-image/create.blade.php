@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Gallery Images</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('gallary-image.index') }}" class="btn btn-sm btn-primary" title="">All Images</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Add New Gallery Image</h2>
                        </div>
                        <div class="body">
                            <form id="ajax-image-upload" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="gallary_category_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="">-- Select Category --</option>
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Select Images</label>
                                    <input type="file" name="images[]" class="form-control" multiple>
                                </div>

                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>

                            <div id="upload-status" class="mt-3"></div>

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

    <script>
        $('#ajax-image-upload').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: '{{ route('gallary-image.store') }}',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#upload-status').html("Uploading...");
                },
                success: function(response) {
                    $('#upload-status').html(
                        '<span class="text-success">Images uploaded successfully!</span>');
                    $('#ajax-image-upload')[0].reset();
                },
                error: function(xhr) {
                    $('#upload-status').html(
                        '<span class="text-danger">Upload failed. Check console.</span>');
                    console.log(xhr.responseText);
                }
            });
        });
    </script>
@endsection
