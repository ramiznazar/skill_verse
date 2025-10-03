@extends('admin.layouts.main')

@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Student Attendance</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('student.attendance.create') }}" class="btn btn-sm btn-primary">Mark New Attendance</a>
                </div>
            </div>
        </div>

        {{-- Alerts --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        @endif

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>All Attendance Records</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li><a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse">
                                        <i class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>

                        <div class="body">

                            {{-- 🔎 Search + Filters --}}
                            <form method="GET" action="{{ route('student.attendance.index') }}" id="filterForm"
                                class="mb-3">
                                <div class="input-group mb-2">
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        class="form-control" placeholder="Search student..." autocomplete="off">
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-3 mb-2">
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

                                    <div class="col-md-3 mb-2">
                                        <select name="shift" class="form-control">
                                            <option value="">Filter by Shift</option>
                                            <option value="morning" {{ request('shift') === 'morning' ? 'selected' : '' }}>
                                                Morning</option>
                                            <option value="evening" {{ request('shift') === 'evening' ? 'selected' : '' }}>
                                                Evening</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <input type="date" name="date" value="{{ request('date') }}"
                                            class="form-control" placeholder="Filter by Date">
                                    </div>

                                    {{-- Instead of dropdown, show status as buttons --}}
                                    <div class="col-md-3 mb-2">
                                        <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                                            @foreach (['all' => 'All', 'present' => 'Present', 'absent' => 'Absent', 'late' => 'Late', 'leave' => 'Leave'] as $key => $label)
                                                <label
                                                    class="btn btn-sm btn-outline-primary {{ request('status', 'all') === $key ? 'active' : '' }}">
                                                    <input type="radio" name="status" value="{{ $key }}"
                                                        autocomplete="off"
                                                        {{ request('status', 'all') === $key ? 'checked' : '' }}>
                                                    {{ $label }}
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </form>

                            {{-- 📊 Table --}}
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Student</th>
                                            <th>Course</th>
                                            <th>Batch</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($attendances as $attendance)
                                            <tr>
                                                <td>{{ $loop->iteration + ($attendances->currentPage() - 1) * $attendances->perPage() }}
                                                </td>
                                                <td>{{ $attendance->admission->name ?? '-' }}</td>
                                                <td>{{ $attendance->admission->course->title ?? '-' }}</td>
                                                <td>{{ $attendance->admission->batch->title ?? '-' }}</td>
                                                <td>{{ $attendance->date }}</td>
                                                <td>
                                                    <span
                                                        class="badge 
                                                    @if ($attendance->status === 'present') badge-success
                                                    @elseif($attendance->status === 'absent') badge-danger
                                                    @elseif($attendance->status === 'late') badge-warning
                                                    @else badge-info @endif">
                                                        {{ ucfirst($attendance->status) }}
                                                    </span>
                                                </td>
                                                <td>{{ $attendance->remarks ?? '-' }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">No attendance records
                                                    found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- 📑 Pagination --}}
                            <div class="mt-3">
                                {{ $attendances->links('pagination::bootstrap-4') }}
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
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('filterForm');
            const search = form.querySelector('input[name="search"]');
            const selects = form.querySelectorAll('select');
            const radios = form.querySelectorAll('input[type=radio][name=status]');

            // auto-submit on select change
            selects.forEach(sel => sel.addEventListener('change', () => form.submit()));

            // auto-submit on radio change
            radios.forEach(r => r.addEventListener('change', () => form.submit()));

            // debounce search typing
            let t;
            search && search.addEventListener('input', () => {
                clearTimeout(t);
                t = setTimeout(() => form.submit(), 500);
            });
        });
    </script>
@endsection
