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
                            <h2>Add New Event</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" action="{{ route('event.store') }}" method="post"
                                enctype="multipart/form-data" novalidate>
                                @csrf

                                <div class="row">
                                    {{-- Single Image --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Main Image</label>
                                            <input type="file" name="image" accept="image/*" class="form-control">
                                            @error('image')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Additional Images --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Additional Images</label>
                                            <input type="file" name="additional_images[]" accept="image/*" multiple
                                                class="form-control">
                                            @error('additional_images')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" value="{{ old('title') }}"
                                        placeholder="Enter Event Title">
                                    @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="row">
                                    {{-- Start Time --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Starting Time</label>
                                            <input type="text" name="start_time" class="form-control"
                                                value="{{ old('start_time') }}" placeholder="e.g. 10:00 AM">
                                            @error('start_time')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- End Time --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Finishing Time</label>
                                            <input type="text" name="end_time" class="form-control"
                                                value="{{ old('end_time') }}" placeholder="e.g. 8:00 PM">
                                            @error('end_time')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Date --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input type="date" name="date" class="form-control"
                                                value="{{ old('date') }}">
                                            @error('date')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Address --}}
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control" value="{{ old('address') }}"
                                        placeholder="Enter Event Address">
                                    @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Map --}}
                                <div class="form-group">
                                    <label>Map URL</label>
                                    <input type="text" name="map" class="form-control" value="{{ old('map') }}"
                                        placeholder="Enter Map URL">
                                    @error('map')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Description --}}
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" rows="5">{{ old('description') }}</textarea>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Topics --}}
                                <div class="form-group">
                                    <label>Topics</label>
                                    <textarea name="topics" class="form-control" rows="2"
                                        placeholder="e.g. Web design & development, Graphics design">{{ old('topics') }}</textarea>
                                    @error('topics')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Speakers --}}
                                <div class="form-group">
                                    <label>Speakers</label>
                                    <input type="text" name="speakers" class="form-control"
                                        value="{{ old('speakers') }}" placeholder="e.g. Hafiz Sameer, Sarah Lee">
                                    @error('speakers')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Audience --}}
                                <div class="form-group">
                                    <label>Audience</label>
                                    <input type="text" name="audience" class="form-control"
                                        value="{{ old('audience') }}"
                                        placeholder="e.g. Students, Designers, Freelancers">
                                    @error('audience')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Quote --}}
                                <div class="form-group">
                                    <label>Quote</label>
                                    <textarea name="quote" class="form-control" rows="2" placeholder="Enter motivational quote">{{ old('quote') }}</textarea>
                                    @error('quote')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Quote By --}}
                                <div class="form-group">
                                    <label>Quote By</label>
                                    <input type="text" name="quote_by" class="form-control"
                                        value="{{ old('quote_by') }}" placeholder="e.g. Hafiz Sameer, CEO, Skillverse">
                                    @error('quote_by')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <br>
                                <button type="submit" class="btn btn-primary">Add Event</button>
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
