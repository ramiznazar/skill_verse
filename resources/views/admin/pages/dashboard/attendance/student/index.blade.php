@extends('admin.layouts.main')

@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Student Attendance</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    {{-- Bulk Mark All button visible only when filters are applied --}}
                    @if ($selectedCourseId && $selectedShift && $date)
                        <form method="POST" action="{{ route('student.attendance.bulkPresent') }}" class="d-inline">
                            @csrf
                            <input type="hidden" name="course_id" value="{{ $selectedCourseId }}">
                            <input type="hidden" name="shift" value="{{ $selectedShift }}">
                            <input type="hidden" name="date" value="{{ $date }}">
                            <button type="submit" class="btn btn-sm btn-success">
                                <i class="icon-check"></i> Mark All Present
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        {{-- Alerts --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        @endif

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Attendance Records</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li><a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i
                                            class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>

                        <div class="body">

                            {{-- 🔎 Filters --}}
                            <form method="GET" action="{{ route('student.attendance.index') }}" id="filterForm"
                                class="mb-3">
                                <div class="row" style="margin-top: 15px;">

                                    <div class="col-md-12 mb-2">
                                        <input type="text" name="search" class="form-control"
                                            value="{{ $search }}" placeholder="Search student...">
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <select name="course_id" class="form-control">
                                            <option value="">Filter by Course</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}"
                                                    {{ (string) $selectedCourseId === (string) $course->id ? 'selected' : '' }}>
                                                    {{ $course->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <select name="shift" class="form-control">
                                            <option value="">Filter by Shift</option>
                                            <option value="morning" {{ $selectedShift === 'morning' ? 'selected' : '' }}>
                                                Morning</option>
                                            <option value="evening" {{ $selectedShift === 'evening' ? 'selected' : '' }}>
                                                Evening</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <input type="date" name="date" class="form-control"
                                            value="{{ $date }}">
                                    </div>
                                </div>
                            </form>

                            {{-- 📊 Summary --}}
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <div class="card border-0 shadow-sm text-center">
                                        <div class="card-body">
                                            <h6 class="fw-bold mb-1 text-muted">Total</h6>
                                            <h3 class="fw-bold text-dark">{{ $totalStudents }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card border-0 shadow-sm text-center">
                                        <div class="card-body">
                                            <h6 class="fw-bold mb-1 text-muted">Present</h6>
                                            <h3 class="fw-bold text-success">{{ $totalPresents }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card border-0 shadow-sm text-center">
                                        <div class="card-body">
                                            <h6 class="fw-bold mb-1 text-muted">Absent</h6>
                                            <h3 class="fw-bold text-danger">{{ $totalAbsents }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card border-0 shadow-sm text-center">
                                        <div class="card-body">
                                            <h6 class="fw-bold mb-1 text-muted">Leave</h6>
                                            <h3 class="fw-bold text-warning">{{ $totalLeaves }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- 📋 Attendance Table --}}
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Course</th>
                                            <th>Batch</th>
                                            <th>Status ({{ $date }})</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($admissions as $student)
                                            @php $attendance = $attendances[$student->id] ?? null; @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $student->name }}</td>
                                                <td>{{ $student->course->title ?? '-' }}</td>
                                                <td>{{ $student->batch->title ?? '-' }}
                                                    <small
                                                        class="text-muted">({{ ucfirst($student->batch->shift ?? '-') }})</small>
                                                </td>
                                                <td>
                                                    @if (!$attendance)
                                                        <span class="badge badge-secondary">Not Marked</span>
                                                    @else
                                                        <span
                                                            class="badge badge-{{ $attendance->status === 'present'
                                                                ? 'success'
                                                                : ($attendance->status === 'absent'
                                                                    ? 'danger'
                                                                    : ($attendance->status === 'leave'
                                                                        ? 'warning'
                                                                        : 'info')) }}">
                                                            {{ ucfirst($attendance->status) }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{-- Action buttons --}}
                                                    <form method="POST"
                                                        action="{{ route('student.attendance.markPresent') }}"
                                                        class="d-inline">
                                                        @csrf
                                                        <input type="hidden" name="admission_id"
                                                            value="{{ $student->id }}">
                                                        <input type="hidden" name="date" value="{{ $date }}">
                                                        <button type="submit"
                                                            class="btn btn-sm btn-success">Present</button>
                                                    </form>
                                                    <form method="POST"
                                                        action="{{ route('student.attendance.markAbsent') }}"
                                                        class="d-inline">
                                                        @csrf
                                                        <input type="hidden" name="admission_id"
                                                            value="{{ $student->id }}">
                                                        <input type="hidden" name="date"
                                                            value="{{ $date }}">
                                                        <button type="submit" class="btn btn-sm btn-dark">Absent</button>
                                                    </form>

                                                    <!-- Leave Button triggers modal -->
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        data-toggle="modal" data-target="#leaveModal"
                                                        data-student="{{ $student->id }}">
                                                        Leave
                                                    </button>

                                                    <form method="POST"
                                                        action="{{ route('student.attendance.markLate') }}"
                                                        class="d-inline">
                                                        @csrf
                                                        <input type="hidden" name="admission_id"
                                                            value="{{ $student->id }}">
                                                        <input type="hidden" name="date"
                                                            value="{{ $date }}">
                                                        <button type="submit"
                                                            class="btn btn-sm btn-warning">Late</button>
                                                    </form>
                                                    {{-- 🔗 History --}}
                                                    <a href="{{ route('student.attendance.history', $student->id) }}"
                                                        class="btn btn-sm btn-info">
                                                        History
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">No students found for
                                                    this filter.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Leave Modal -->
                            <div class="modal fade" id="leaveModal" tabindex="-1" role="dialog"
                                aria-labelledby="leaveModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form method="POST" action="{{ route('student.attendance.markLeave') }}">
                                            @csrf
                                            <div class="modal-header bg-warning text-dark">
                                                <h5 class="modal-title" id="leaveModalLabel">Mark Leave</h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="admission_id" id="leaveStudentId">
                                                <input type="hidden" name="date" value="{{ $date }}">

                                                <div class="form-group">
                                                    <label for="remarks">Remarks (Optional)</label>
                                                    <textarea name="remarks" id="leaveRemarks" class="form-control" rows="3"
                                                        placeholder="Enter reason for leave..."></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-warning">Save Leave</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
            const selects = form.querySelectorAll('select');
            const inputs = form.querySelectorAll('input[type=text], input[type=date]');

            selects.forEach(sel => sel.addEventListener('change', () => form.submit()));
            inputs.forEach(inp => inp.addEventListener('change', () => form.submit()));
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#leaveModal').on('show.bs.modal', function(event) {
                const button = $(event.relatedTarget);
                const studentId = button.data('student');
                $('#leaveStudentId').val(studentId);
                $('#leaveRemarks').val('');
            });
        });
    </script>
@endsection
