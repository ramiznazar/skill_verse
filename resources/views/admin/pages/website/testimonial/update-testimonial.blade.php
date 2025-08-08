@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Student Feedbacks</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('testimonial.index') }}" class="btn btn-sm btn-primary" title="">All Feedbacks</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Update Feedback</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" action="{{route('testimonial.update',$testimonial->id)}}" method="post" enctype="multipart/form-data" novalidate>
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Current Image</label> 
                                    <div class="col-lg-12 col-md-12">
                                        <div class="card">
                                            <div class="header">
                                                <img src="{{ asset($testimonial->image) }}" class="img-fluid rounded" style="width:100%; height: 250px; object-fit: cover;" alt="">
                                            </div> 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="image" accept="image/*" class="form-control">
                                    @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                        
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $testimonial->name }}">
                                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                        
                                <div class="form-group">
                                    <label>Designation</label>
                                    <input type="text" name="designation" class="form-control" value="{{ $testimonial->designation }}">
                                    @error('designation') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                        
                                <div class="form-group">
                                    <label>Message</label>
                                    <input type="text" name="message" class="form-control" value="{{ $testimonial->message }}">
                                    @error('message') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                        
                                <br>
                                <button type="submit" class="btn btn-primary">Update Feedback</button>
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
