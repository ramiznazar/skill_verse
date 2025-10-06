@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Courses</h2>
                </div>
                @if (Auth::user()->role !== 'administrator')
                    <div class="col-md-6 col-sm-12 text-right">
                        <a href="{{ route('course.create') }}" class="btn btn-sm btn-primary" title="">Create New</a>
                    </div>
                @endif
            </div>
        </div>
        {{-- Store --}}
        @if (session('store'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('store') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        {{-- Delete --}}
        @if (session('delete'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('delete') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        {{-- Update --}}
        @if (session('update'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('update') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>All Courses</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i
                                            class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table m-b-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Title</th>
                                            {{-- <th>Slug</th> --}}
                                            <th>Category</th>
                                            <th>Duration</th>
                                            <th>FullFee</th>
                                            <th>Discount%</th>
                                            <th>MinFee</th>
                                            {{-- <th>Short Des</th> --}}
                                            {{-- <th>Des</th> --}}
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($courses as $course)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><span><img src="{{ asset($course->image) }}" width="60"
                                                            height="60" style="border-radius: 50%;"
                                                            alt=""></span></td>
                                                <td>{{ $course->title }}</td>
                                                {{-- <td>{{ $course->slug }}</td> --}}
                                                <td><span
                                                        class="text-info">{{ $course->courseCategory->name ?? 'N/A' }}</span>
                                                </td>
                                                <td>{{ $course->duration }}</td>
                                                <td>{{ $course->full_fee }}</td>
                                                <td>{{ $course->discount }}%</td>
                                                <td>{{ intval($course->min_fee) }}</td>
                                                {{-- <td>{{ \Illuminate\Support\Str::words($course->short_description, 5, '...') }} --}}
                                                {{-- <td>{{ \Illuminate\Support\Str::words($course->description, 7, '...') }} --}}
                                                </td>
                                                {{-- <td><span class="badge badge-success">Admit</span></td> --}}
                                                <td class="actions">
                                                    <div class="d-flex align-items-center" style="column-gap: 5px;">
                                                        {{-- Add LMS --}}
                                                        <a href="{{ route('course-lms.index', $course->id) }}"
                                                            class="btn btn-sm btn-icon btn-pure btn-default on-default button-edit"
                                                            data-toggle="tooltip" data-original-title="Add LMS Course">
                                                            <i class="fas fa-graduation-cap" aria-hidden="true"></i>
                                                        </a>

                                                        {{-- Add Language --}}
                                                        <a href="{{ route('course-outline.index', $course->id) }}"
                                                            class="btn btn-sm btn-icon btn-pure btn-default on-default button-edit"
                                                            data-toggle="tooltip"
                                                            data-original-title="Add Programming Language">
                                                            <i class="fas fa-code" aria-hidden="true"></i>
                                                        </a>

                                                        {{-- View Course --}}
                                                        <a href="{{ route('course.show', $course->id) }}"
                                                            class="btn btn-sm btn-icon btn-pure btn-default"
                                                            data-toggle="tooltip" data-original-title="View">
                                                            <i class="icon-eye"></i>
                                                        </a>

                                                         @if (Auth::user()->role !== 'administrator')
                                                        <!-- Edit Button -->
                                                        <a href="{{ route('course.edit', $course->id) }}"
                                                            class="btn btn-sm btn-icon btn-pure btn-default on-default button-edit"
                                                            data-toggle="tooltip" data-original-title="Edit">
                                                            <i class="icon-pencil" aria-hidden="true"></i>
                                                        </a>

                                                        <!-- Delete Button -->
                                                        <form action="{{ route('course.destroy', $course->id) }}"
                                                            method="POST" onsubmit="return confirm('Are you sure?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-icon btn-pure btn-default on-default button-remove"
                                                                data-toggle="tooltip" data-original-title="Remove">
                                                                <i class="icon-trash" aria-hidden="true"></i>
                                                            </button>
                                                        </form>
                                                        @endif

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('additional-javascript')
    <script>
        $('.sparkbar').sparkline('html', {
            type: 'bar'
        });
    </script>
@endsection
