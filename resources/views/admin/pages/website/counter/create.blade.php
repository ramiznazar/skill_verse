@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Counters</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('counter.index') }}" class="btn btn-sm btn-primary" title="">All Counter</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Create New Counter</h2>
                        </div>
                        <div class="body">
                            <form id="post-form" action="{{ route('counter.store') }}" method="POST"
                                 novalidate>
                                @csrf

                                <!-- Best For, Duration, Certified in One Row -->
                                <div class="form-group">
                                    <label>Counter Name</label>
                                    <input type="text" name="title" class="form-control"
                                        value="{{ old('title') }}">
                                    @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Number Of Counters</label>
                                    <input type="text" name="number" class="form-control"
                                    value="{{ old('number') }}">
                                    @error('number')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Icon Class</label>
                                    <input type="text" name="icon_class" class="form-control"
                                        value="{{ old('icon_class') }}">
                                    @error('icon_class')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <br>
                                <button type="submit" class="btn btn-primary">Add Counter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
