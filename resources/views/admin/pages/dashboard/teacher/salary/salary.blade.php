@php
    use App\Models\FeeSubmission;
@endphp
@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Teacher Salaries</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('teacher.balance') }}" class="btn btn-sm btn-primary" title="">Teacher Balances</a>
                </div>
            </div>
        </div>
        {{-- Paid --}}
        @if (session('paid'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('paid') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        {{-- Balance --}}
        @if (session('balance'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('balance') }}
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
                            <h2>Salary</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i
                                            class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>

                        <div class="body">
                            <form method="GET" action="{{ route('teacher-salary.index') }}" id="filterForm"
                                class="mb-3">

                                {{-- 🔎 Search Teacher --}}
                                <div class="input-group mb-2">
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        class="form-control" placeholder="Search teacher..." autocomplete="off">
                                </div>

                                <div class="row" style="margin-top: 15px;">
                                    {{-- 📅 Month --}}
                                    <div class="col-md-4 mb-2">
                                        <select name="month" class="form-control">
                                            <option value="">All Months</option>
                                            @foreach (range(1, 12) as $m)
                                                <option value="{{ $m }}"
                                                    {{ request('month') == $m ? 'selected' : '' }}>
                                                    {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- 📅 Year --}}
                                    <div class="col-md-4 mb-2">
                                        <select name="year" class="form-control">
                                            <option value="">All Years</option>
                                            @for ($y = now()->year; $y >= 2020; $y--)
                                                <option value="{{ $y }}"
                                                    {{ request('year') == $y ? 'selected' : '' }}>
                                                    {{ $y }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    {{-- 💳 Status --}}
                                    <div class="col-md-4 mb-2">
                                        <select name="status" class="form-control">
                                            <option value="all"
                                                {{ request('status', 'all') === 'all' ? 'selected' : '' }}>All Status
                                            </option>
                                            <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>
                                                Paid</option>
                                            <option value="balance"
                                                {{ request('status') === 'balance' ? 'selected' : '' }}>Balance</option>
                                            <option value="pending"
                                                {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                                        </select>
                                    </div>
                                </div>
                            </form>


                            <div class="table-responsive">
                                <table class="table m-b-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Teacher</th>
                                            <th>Month</th>
                                            <th>Students</th>
                                            <th>Collected</th>
                                            <th>Pay Type</th>
                                            <th>Physical</th>
                                            <th>Online</th>
                                            <th>Total Payable</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($salaries as $salary)
                                            @php
                                                $teacher = $salary->teacher ?? null;
                                                $payType = $salary->pay_type ?? ($teacher->pay_type ?? 'percentage');
                                                $percent = (int) ($salary->percentage ?? 0);
                                                $fixedAmount =
                                                    (int) ($salary->computed_fixed_amount ??
                                                        ($teacher->fixed_salary ?? 0));

                                                // Accurate collected breakdown from FeeSubmission (gross physical + online)
                                                $physicalCollected = FeeSubmission::whereHas('admission', function (
                                                    $q,
                                                ) use ($salary) {
                                                    $q->where('mode', 'physical')->whereHas('batch', function ($b) use (
                                                        $salary,
                                                    ) {
                                                        $b->where('teacher_id', $salary->teacher_id);
                                                    });
                                                })
                                                    ->whereMonth('submission_date', $salary->month)
                                                    ->whereYear('submission_date', $salary->year)
                                                    ->sum('amount');

                                                $onlineCollected = FeeSubmission::whereHas('admission', function (
                                                    $q,
                                                ) use ($salary) {
                                                    $q->where('mode', 'online')->whereHas('batch', function ($b) use (
                                                        $salary,
                                                    ) {
                                                        $b->where('teacher_id', $salary->teacher_id);
                                                    });
                                                })
                                                    ->whereMonth('submission_date', $salary->month)
                                                    ->whereYear('submission_date', $salary->year)
                                                    ->sum('amount');

                                                // Gross total (for display)
                                                $collected = (int) ($physicalCollected + $onlineCollected);

                                                // Students
                                                $physicalStudents = (int) ($salary->total_students ?? 0);
                                                $onlineStudents = (int) ($salary->total_online_students ?? 0);
                                                $totalStudents = $physicalStudents + $onlineStudents;

                                                // Online bonus (teacher’s share)
                                                $onlineBonus = (int) ($salary->online_bonus ?? 0);

                                                // For percentage teachers → compute teacher’s share from physical only
                                                $physicalPercentAmount = (int) round(
                                                    $physicalCollected * ($percent / 100),
                                                );

                                                // Total payable to teacher (main + online)
                                                $totalPayable = (int) ($salary->salary_amount ?? 0) + $onlineBonus;
                                            @endphp


                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $teacher->name ?? 'N/A' }}</td>
                                                <td>
                                                    {{ \Carbon\Carbon::create()->month($salary->month)->format('F') }}
                                                    {{ $salary->year }}
                                                </td>

                                                {{-- Total Students --}}
                                                <td>
                                                    {{ $totalStudents }}
                                                    <small class="text-muted d-block">
                                                        Phys: {{ $physicalStudents }} | Online: {{ $onlineStudents }}
                                                    </small>
                                                </td>

                                                {{-- Total Collected --}}
                                                <td>
                                                    ₨{{ number_format($collected) }}
                                                    <small class="text-muted d-block">
                                                        Phys: ₨{{ number_format($physicalCollected) }}, Online:
                                                        ₨{{ number_format($onlineCollected) }}
                                                    </small>
                                                </td>

                                                {{-- Pay Type --}}
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $payType === 'fixed' ? 'primary' : 'info' }}">
                                                        {{ ucfirst($payType) }}
                                                    </span>
                                                </td>

                                                {{-- Physical --}}
                                                <td>
                                                    @if ($payType === 'fixed')
                                                        <span class="text-muted">Fixed
                                                            ₨{{ number_format($fixedAmount) }}</span>
                                                    @else
                                                        {{ $percent }}%
                                                        <small class="text-muted d-block">
                                                            ≈ ₨{{ number_format($physicalPercentAmount) }}
                                                        </small>
                                                    @endif
                                                </td>

                                                {{-- Online --}}
                                                <td>
                                                    @if ($onlineStudents > 0)
                                                        <span class="text-success">
                                                            ₨{{ number_format($onlineBonus) }}
                                                        </span>
                                                        @if ($payType === 'fixed')
                                                            <small class="text-muted d-block">
                                                                {{ $percent }}%
                                                            </small>
                                                        @endif
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </td>

                                                {{-- Payable --}}
                                                <td><strong>₨{{ number_format($totalPayable) }}</strong></td>

                                                {{-- Status --}}
                                                <td>
                                                    <span
                                                        class="badge
                        @if ($salary->status == 'paid') badge-success
                        @elseif($salary->status == 'balance') badge-info
                        @else badge-warning @endif">
                                                        {{ ucfirst($salary->status) }}
                                                    </span>
                                                </td>

                                                {{-- Actions --}}
                                                <td>
                                                    <form method="POST"
                                                        action="{{ route('teacher-salary.status-paid', $salary->id) }}"
                                                        style="display:inline-block;">
                                                        @csrf @method('PUT')
                                                        <button type="submit" class="btn btn-sm btn-success">Paid</button>
                                                    </form>

                                                    <form method="POST"
                                                        action="{{ route('teacher-salary.status-balance', $salary->id) }}"
                                                        style="display:inline-block;">
                                                        @csrf @method('PUT')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-warning">Balance</button>
                                                    </form>

                                                    <a href="{{ route('teacher-salary.history', $salary->teacher_id) }}"
                                                        class="btn btn-sm btn-info">
                                                        History
                                                    </a>
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
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('filterForm');
            const search = form.querySelector('input[name="search"]');
            const selects = form.querySelectorAll('select');

            // auto-submit on select change
            selects.forEach(sel => sel.addEventListener('change', () => form.submit()));

            // debounce search typing
            let t;
            if (search) {
                search.addEventListener('input', () => {
                    clearTimeout(t);
                    t = setTimeout(() => form.submit(), 500);
                });
            }
        });
    </script>
@endsection
