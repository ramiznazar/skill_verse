@extends('admin.layouts.main')

@section('content')
<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Attendance History - {{ $student->name }}</h2>
                <small class="text-muted">
                    Course: {{ $student->course->title ?? '-' }} | 
                    Batch: {{ $student->batch->title ?? '-' }} ({{ $student->batch->shift ?? '-' }})
                </small>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <a href="{{ route('student.attendance.index') }}" class="btn btn-sm btn-primary">⬅ Back</a>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="body">
                <form method="GET" action="{{ route('student.attendance.history', $student->id) }}" class="row">
                    <div class="col-md-6 mb-2">
                        <label class="font-weight-bold">Select Month</label>
                        <select name="month" class="form-control" onchange="this.form.submit()">
                            @foreach(range(1,12) as $m)
                                <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="font-weight-bold">Select Year</label>
                        <select name="year" class="form-control" onchange="this.form.submit()">
                            @foreach(range(now()->year-3, now()->year+1) as $y)
                                <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>

        {{-- ⚠️ Joining Date Check --}}
        @if(isset($joinedTooLate) && $joinedTooLate)
            <div class="alert alert-warning text-center">
                ⚠️ Attendance data is not available before the student's joining date —
                <strong>{{ \Carbon\Carbon::parse($student->joining_date)->format('d M Y') }}</strong>.
            </div>
        @else
            {{-- Summary Cards --}}
            @php
                $totalDays   = $daysInMonth;
                $presentDays = $attendances->whereIn('status', ['present','late'])->count();
                $absentDays  = $attendances->where('status','absent')->count();
                $leaveDays   = $attendances->where('status','leave')->count();
            @endphp

            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card shadow-sm text-center">
                        <div class="body">
                            <h6 class="text-muted">Total Days</h6>
                            <h3>{{ $totalDays }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm text-center">
                        <div class="body">
                            <h6 class="text-muted">Presents</h6>
                            <h3 class="text-success">{{ $presentDays }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm text-center">
                        <div class="body">
                            <h6 class="text-muted">Absents</h6>
                            <h3 class="text-danger">{{ $absentDays }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm text-center">
                        <div class="body">
                            <h6 class="text-muted">Leaves</h6>
                            <h3 class="text-warning">{{ $leaveDays }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Attendance Table --}}
            <div class="card">
                <div class="body table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Day</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($d = 1; $d <= $daysInMonth; $d++)
                                @php
                                    $record = $attendances->get($d);
                                    $dateStr = \Carbon\Carbon::createFromDate($year, $month, $d)->toDateString();
                                @endphp
                                <tr>
                                    <td>{{ $d }}</td>
                                    <td>{{ $dateStr }}</td>
                                    <td>
                                        @if ($record)
                                            @switch($record->status)
                                                @case('present')
                                                    <span class="badge badge-success">Present</span>
                                                    @break
                                                @case('absent')
                                                    <span class="badge badge-danger">Absent</span>
                                                    @break
                                                @case('leave')
                                                    <span class="badge badge-warning">Leave</span>
                                                    @break
                                                @case('late')
                                                    <span class="badge badge-info">Late</span>
                                                    @break
                                                @default
                                                    <span class="badge badge-secondary">-</span>
                                            @endswitch
                                        @else
                                            <span class="badge badge-light">Not Marked</span>
                                        @endif
                                    </td>
                                    <td>{{ $record->remarks ?? '-' }}</td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection