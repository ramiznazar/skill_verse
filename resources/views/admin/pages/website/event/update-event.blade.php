@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Events</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('event.index') }}" class="btn btn-sm btn-primary" title="">All Events</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Update Event</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" action="{{ route('event.update', $event->id) }}" method="post"
                                enctype="multipart/form-data" novalidate>
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Current Image</label>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="card">
                                            <div class="header">
                                                <img src="{{ asset($event->image) }}" class="img-fluid rounded"
                                                    style="width:100%; height: 250px; object-fit: cover;" alt="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mt-3">
                                        <label>New Image</label>
                                        <input type="file" name="image" accept="image/*" class="form-control">
                                        @error('image')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Additional Images Section --}}
                                <div class="form-group mt-4">
                                    <label>Current Additional Images</label>
                                    <div class="row">
                                        @if ($event->additional_images)
                                            @foreach (json_decode($event->additional_images) as $img)
                                                <div class="col-md-3 mb-3">
                                                    <img src="{{ asset('assets/admin/images/code/event/' . $img) }}"
                                                        class="img-fluid rounded" style="height: 150px; object-fit: cover;"
                                                        alt="">
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="text-muted">No additional images.</p>
                                        @endif
                                    </div>

                                    <label class="mt-3">Add More Images</label>
                                    <input type="file" name="additional_images[]" accept="image/*" multiple
                                        class="form-control">
                                    @error('additional_images')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" value="{{ $event->title }}">
                                    @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Starting Time</label>
                                            <input type="text" name="start_time" class="form-control"
                                                value="{{ $event->start_time }}">
                                            @error('start_time')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Finishing Time</label>
                                            <input type="text" name="end_time" class="form-control"
                                                value="{{ $event->end_time }}">
                                            @error('end_time')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input type="date" name="date" class="form-control"
                                                value="{{ $event->date }}">
                                            @error('date')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control"
                                        value="{{ $event->address }}">
                                    @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Map URL</label>
                                    <input type="text" name="map" class="form-control" value="{{ $event->map }}">
                                    @error('map')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" rows="5">{{ $event->description }}</textarea>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- ✅ New Fields --}}

                                <div class="form-group">
                                    <label>Topics</label>
                                    <input type="text" name="topics" class="form-control" value="{{ $event->topics }}">
                                    @error('topics')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Speakers</label>
                                    <input type="text" name="speakers" class="form-control"
                                        value="{{ $event->speakers }}">
                                    @error('speakers')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Audience</label>
                                    <input type="text" name="audience" class="form-control"
                                        value="{{ $event->audience }}">
                                    @error('audience')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Quote</label>
                                    <textarea name="quote" class="form-control" rows="2">{{ $event->quote }}</textarea>
                                    @error('quote')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Quote By</label>
                                    <input type="text" name="quote_by" class="form-control"
                                        value="{{ $event->quote_by }}">
                                    @error('quote_by')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <br>
                                <button type="submit" class="btn btn-primary">Update Event</button>
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
