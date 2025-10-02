@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Batches</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('batch.create') }}" class="btn btn-sm btn-primary" title="">Create New</a>
                </div>
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
                            <h2>All Batches</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i
                                            class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>
                        <div class="body">
                            {{-- Filter --}}
                            <form method="GET" action="{{ route('batch.index') }}" id="filterForm" class="mb-3">
                                <div class="input-group mb-2">
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        class="form-control" placeholder="Search batch/teacher/course..."
                                        autocomplete="off">
                                </div>

                                <div class="row" style="margin-top: 15px">
                                    {{-- Course Filter --}}
                                    <div class="col-md-4 mb-2">
                                        <select name="course_id" class="form-control">
                                            <option value="">Filter by Course</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}"
                                                    {{ (string) request('course_id') === (string) $course->id ? 'selected' : '' }}>
                                                    {{ $course->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Status Filter --}}
                                    <div class="col-md-4 mb-2">
                                        <select name="status" class="form-control">
                                            <option value="">All Status</option>
                                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="completed"
                                                {{ request('status') === 'completed' ? 'selected' : '' }}>Completed
                                            </option>
                                            <option value="cancelled"
                                                {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled
                                            </option>
                                        </select>
                                    </div>

                                    {{-- Shift Filter --}}
                                    <div class="col-md-4 mb-2">
                                        <select name="shift" class="form-control">
                                            <option value="">All Shifts</option>
                                            <option value="morning" {{ request('shift') === 'morning' ? 'selected' : '' }}>
                                                Morning</option>
                                            <option value="evening" {{ request('shift') === 'evening' ? 'selected' : '' }}>
                                                Evening</option>
                                        </select>
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table m-b-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Course</th>
                                            <th>Title</th>
                                            <th>Teacher</th>
                                            <th>Shift</th>
                                            <th>Timing</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Capacity</th>
                                            <th>Status</th>
                                            <th>Note</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($batches as $batch)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td> <span class="text-primary">{{ $batch->course->title ?? 'N/A' }}</span>
                                                </td>
                                                <td>{{ $batch->title ?? '-' }}</td>
                                                <td>{{ $batch->teacher->name ?? '-' }}</td>
                                                <td><span
                                                        class="badge badge-info text-uppercase">{{ $batch->shift }}</span>
                                                </td>
                                                <td>{{ $batch->timing }}</td>
                                                <td>{{ \Carbon\Carbon::parse($batch->start_date)->format('d M, Y') }}</td>
                                                <td>
                                                    @if ($batch->end_date)
                                                        {{ \Carbon\Carbon::parse($batch->end_date)->format('d M, Y') }}
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                <td>{{ $batch->capacity ?? '-' }}</td>

                                                {{-- Status --}}
                                                <td>
                                                    @if ($batch->status === 'active')
                                                        <span class="badge badge-success">Active</span>
                                                    @elseif ($batch->status === 'completed')
                                                        <span class="badge badge-secondary">Completed</span>
                                                    @else
                                                        <span class="badge badge-danger">Cancelled</span>
                                                    @endif
                                                </td>
                                                <td>{{ $batch->note }}</td>

                                                {{-- Options --}}
                                                <td class="actions">
                                                    <div class="d-flex align-items-center" style="column-gap: 5px;">
                                                        <!-- Edit -->
                                                        <a href="{{ route('batch.edit', $batch->id) }}"
                                                            class="btn btn-sm btn-icon btn-pure btn-default on-default button-edit"
                                                            data-toggle="tooltip" data-original-title="Edit">
                                                            <i class="icon-pencil" aria-hidden="true"></i>
                                                        </a>

                                                        <!-- Delete -->
                                                        <form action="{{ route('batch.destroy', $batch->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Are you sure you want to delete this batch?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-icon btn-pure btn-default on-default button-remove"
                                                                data-toggle="tooltip" data-original-title="Remove">
                                                                <i class="icon-trash" aria-hidden="true"></i>
                                                            </button>
                                                        </form>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('filterForm');
            const search = form.querySelector('input[name="search"]');
            const selects = form.querySelectorAll('select');

            // auto-submit on select change
            selects.forEach(sel => sel.addEventListener('change', () => form.submit()));

            // debounce search typing → submit after 500ms
            let t;
            search && search.addEventListener('input', () => {
                clearTimeout(t);
                t = setTimeout(() => form.submit(), 500);
            });
        });
    </script>
@endsection
