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
                            <h2>Update Event Participant</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form"
                                action="{{ route('event-participant.update', ['event_id' => $event->id, 'id' => $participant->id]) }}"
                                method="post" enctype="multipart/form-data" novalidate>
                                @csrf
                                @method('PUT')

                                <label>Current Image</label>
                                <div class="col-lg-12 col-md-12">
                                    <div class="card">
                                        <div class="header">
                                            <img src="{{ asset($participant->image) }}" class="img-fluid rounded"
                                                style="width:100%; height: 250px; object-fit: cover;" alt="">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Participant Image</label>
                                    <input type="file" name="image" class="form-control">
                                    @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ $participant->name }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Post</label>
                                    <input type="text" name="post" class="form-control"
                                        value="{{ $participant->post }}">
                                    @error('post')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <br>
                                <button type="submit" class="btn btn-primary">Update Event Participant</button>
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
