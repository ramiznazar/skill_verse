@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Course Outlines</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('course-outline.create', $course->id) }}" class="btn btn-sm btn-primary" title="">Create New</a>
                </div>
            </div>
        </div>

        {{-- Flash Messages --}}
        @foreach (['store' => 'success', 'delete' => 'danger', 'update' => 'warning'] as $key => $type)
            @if (session($key))
                <div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
                    {{ session($key) }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        @endforeach

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>All Course Outlines</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li><a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table m-b-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Course Name</th>
                                            <th>Week</th>
                                            <th>Topics</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($outlines as $outline)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $outline->course->title }}</td>
                                                <td><strong>{{ $outline->week }}</strong></td>
                                                <td>
                                                    <ul class="mb-0 pl-3">
                                                        @foreach ($outline->topics as $topic)
                                                            <li>{{ $topic['topic'] }} – <small>{{ $topic['time'] }}</small></li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td class="actions">
                                                    <div class="d-flex align-items-center">
                                                        {{-- Edit --}}
                                                        <a href="{{ route('course-outline.edit', [$course->id, $outline->id]) }}"
                                                           class="btn btn-sm btn-icon btn-pure btn-default on-default button-edit"
                                                           data-toggle="tooltip" data-original-title="Edit">
                                                            <i class="icon-pencil" aria-hidden="true"></i>
                                                        </a>

                                                        {{-- Delete --}}
                                                        <form action="{{ route('course-outline.destroy', $outline->id) }}"
                                                              method="POST" onsubmit="return confirm('Are you sure?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    class="btn btn-sm btn-icon btn-pure btn-default on-default button-remove"
                                                                    data-toggle="tooltip" data-original-title="Remove"
                                                                    style="margin-left: 6px;">
                                                                <i class="icon-trash" aria-hidden="true"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if ($outlines->isEmpty())
                                            <tr>
                                                <td colspan="5" class="text-center">No course outlines found.</td>
                                            </tr>
                                        @endif
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
        $('.sparkbar').sparkline('html', { type: 'bar' });
    </script>
@endsection
