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
                            <h2>Update Counter</h2>
                        </div>
                        <div class="body">
                            <form id="post-form" action="{{ route('counter.update',$counter->id) }}" method="POST"
                                 novalidate>
                                @csrf
                                @method('PUT')

                                <!-- Best For, Duration, Certified in One Row -->
                                <div class="form-group">
                                    <label>Counter Name</label>
                                    <input type="text" name="title" class="form-control"
                                        value="{{ $counter->title }}">
                                    @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Number Of Counters</label>
                                    <input type="text" name="number" class="form-control"
                                        value="{{ $counter->number }}">
                                    @error('number')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                  <div class="form-group">
                                    <label>Icon Class</label>
                                    <input type="text" name="icon_class" class="form-control"
                                        value="{{ $counter->icon_class }}">
                                    @error('icon_class')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <br>
                                <button type="submit" class="btn btn-primary">Update Counter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
