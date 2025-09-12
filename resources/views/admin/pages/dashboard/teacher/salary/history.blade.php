@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Salary History {{ $teacher ? ' - ' . $teacher->name : '' }}</h2>
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
                                        @foreach (range(1, 12) as $m)
                                            <option value="{{ $m }}"
                                                {{ request('month') == $m ? 'selected' : '' }}>
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
                                            <option value="{{ $y }}"
                                                {{ request('year') == $y ? 'selected' : '' }}>
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
                                            <th>Pay Type</th>
                                            <th>%</th>
                                            <th>Fixed</th>
                                            <th>Amount</th>
                                            <th>Performed By</th>
                                            <th>Performed At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($histories as $history)
                                            @php
                                                // We loaded with(['teacher','salary']) in controller
                                                $teacher = $history->teacher ?? null;
                                                $row = $history->salary; // monthly snapshot if exists
                                                $collected = (int) ($row->total_fee_collected ?? 0);

                                                // Determine pay type snapshot (fallback to teacher record if missing on history->salary)
                                                $payType = $row->pay_type ?? ($teacher->pay_type ?? 'percentage');

                                                // % snapshot + computed %
                                                $percent =
                                                    (int) ($row->percentage ??
                                                        (int) ($teacher->percentage ??
                                                            (is_numeric($teacher->salary ?? null)
                                                                ? $teacher->salary
                                                                : 0)));

                                                $pctAmt =
                                                    (int) ($row->computed_percentage_amount ??
                                                        (int) round($collected * ($percent / 100)));

                                                // Fixed snapshot
                                                $fixedAmt =
                                                    (int) ($row->computed_fixed_amount ??
                                                        (int) ($teacher->fixed_salary ?? 0));
                                            @endphp

                                            <tr>
                                                <td>{{ $loop->iteration }}</td>

                                                <td>
                                                    @php
                                                        $status = $history->status;
                                                        $badge = 'badge-warning';
                                                        if (
                                                            strtolower($status) === 'paid' ||
                                                            $status === 'Balance → Paid'
                                                        ) {
                                                            $badge = 'badge-success';
                                                        } elseif (strtolower($status) === 'balance') {
                                                            $badge = 'badge-info';
                                                        }
                                                    @endphp
                                                    <span class="badge {{ $badge }}">{{ $status }}</span>
                                                </td>

                                                <td>{{ \Carbon\Carbon::create()->month($history->month)->format('F') }}
                                                </td>
                                                <td>{{ $history->year }}</td>

                                                {{-- Pay Type --}}
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $payType === 'fixed' ? 'primary' : 'info' }}">
                                                        {{ ucfirst($payType) }}
                                                    </span>
                                                </td>

                                                {{-- Percentage column: show % and computed amount (if any) --}}
                                                <td>
                                                    {{ $percent }}%
                                                    @if ($pctAmt > 0)
                                                        <small class="text-muted d-block">≈ {{ number_format($pctAmt) }}
                                                            PKR</small>
                                                    @endif
                                                </td>

                                                {{-- Fixed column --}}
                                                <td>
                                                    {{ $fixedAmt > 0 ? number_format($fixedAmt) . ' PKR' : '—' }}
                                                </td>

                                                {{-- Entry amount for this history row (what was paid/balanced then) --}}
                                                <td><strong>{{ number_format((int) $history->amount) }} PKR</strong></td>

                                                <td>{{ $history->performedBy->name ?? '-' }}</td>
                                                <td>{{ $history->performed_at ? $history->performed_at->format('Y-m-d H:i') : '-' }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" class="text-center">No history found.</td>
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
