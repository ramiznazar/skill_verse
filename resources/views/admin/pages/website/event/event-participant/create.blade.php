@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Event Participants</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('event-participant.index', $event->id) }}" class="btn btn-sm btn-primary"
                        title="">All Participants</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Add New Participant</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" action="{{ route('event-participant.store', $event->id) }}" method="post"
                                enctype="multipart/form-data" novalidate>
                                @csrf
                                
                                <div class="form-group">
                                    <label>Participant Image</label>
                                    <input type="file" name="image" class="form-control" value="{{ old('image') }}">
                                    @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Post</label>
                                    <input type="text" name="post" class="form-control" value="{{ old('post') }}">
                                    @error('post')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <br>
                                <button type="submit" class="btn btn-primary">Add Event Participant</button>
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
