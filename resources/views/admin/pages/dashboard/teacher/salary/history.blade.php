@extends('admin.layouts.main')
@section('content')

<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Salary History {{ $teacher ? ' - '.$teacher->name : '' }}</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <a href="{{ route('teacher-salary.index') }}" class="btn btn-sm btn-secondary">Back to Salaries</a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>Teacher Salary History</h2>
                        <ul class="header-dropdown dropdown dropdown-animated scale-left">
                            <li> 
                                <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse">
                                    <i class="icon-refresh"></i>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="full-screen">
                                    <i class="icon-size-fullscreen"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="body">
                        {{-- Filters --}}
                        <form method="GET" class="form-inline mb-3">
                            <div class="form-group mr-2">
                                <label for="month">Month:</label>
                                <select name="month" id="month" class="form-control ml-2">
                                    <option value="">All</option>
                                    @foreach (range(1,12) as $m)
                                        <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mr-2">
                                <label for="year">Year:</label>
                                <select name="year" id="year" class="form-control ml-2">
                                    <option value="">All</option>
                                    @for ($y = now()->year; $y >= 2020; $y--)
                                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                                            {{ $y }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <button class="btn btn-primary" type="submit">Filter</button>
                        </form>

                        {{-- History Table --}}
                        <div class="table-responsive">
                            <table class="table m-b-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Status</th>
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th>Amount</th>
                                        <th>Performed By</th>
                                        <th>Performed At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($histories as $history)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <span class="badge 
                                                    @if ($history->status === 'paid') badge-success 
                                                    @elseif ($history->status === 'balance') badge-info 
                                                    @else badge-warning @endif">
                                                    {{ ucfirst($history->status) }}
                                                </span>
                                            </td>
                                            <td>{{ \Carbon\Carbon::create()->month($history->month)->format('F') }}</td>
                                            <td>{{ $history->year }}</td>
                                            <td><strong>{{ number_format($history->amount) }} PKR</strong></td>
                                            <td>{{ $history->performedBy->name ?? '-' }}</td>
                                            <td>{{ $history->performed_at ? $history->performed_at->format('Y-m-d H:i') : '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No history found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div> {{-- end table --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
