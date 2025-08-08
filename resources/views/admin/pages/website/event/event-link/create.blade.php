@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Event Links</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('event-link.index',$event->id) }}" class="btn btn-sm btn-primary" title="">All Links</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Add New Event Link</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" action="{{ route('event-link.store',$event->id) }}" method="post" novalidate>
                                @csrf

                                        <div class="form-group">
                                            <label>Link Name</label>
                                            <input type="text" name="title" class="form-control"
                                                value="{{ old('title') }}" placeholder="facebook, youtube, tiktok, instagram, linkedin">
                                            @error('title')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>URL</label>
                                            <input type="text" name="link" class="form-control"
                                                value="{{ old('link') }}" placeholder="Enter URL Link">
                                            @error('link')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                <br>
                                <button type="submit" class="btn btn-primary">Add Event Link</button>
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
