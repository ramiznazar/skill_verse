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
                                    <thead class="">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Month</th>
                                            <th>Students</th>
                                            <th>Collected</th>
                                            <th>Pay Type</th>
                                            <th>%</th>
                                            <th>Fixed</th>
                                            <th>Payable</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($salaries as $salary)
                                            @php
                                                // Safe defaults + fallbacks for legacy rows
                                                $teacher = $salary->teacher ?? null;
                                                $collected = (int) ($salary->total_fee_collected ?? 0);

                                                $payType = $salary->pay_type ?? ($teacher->pay_type ?? 'percentage'); // fallback to teacher if row missing snapshot

                                                $percent = (int) ($salary->percentage ?? 0);
                                                $pctAmount =
                                                    (int) ($salary->computed_percentage_amount ??
                                                        (int) round($collected * ($percent / 100)));

                                                $fixedAmount =
                                                    (int) ($salary->computed_fixed_amount ??
                                                        (int) ($teacher->fixed_salary ?? 0));

                                                // Actual payable for this row (what your flows use)
                                                $payable =
                                                    (int) ($salary->salary_amount ??
                                                        ($payType === 'fixed' ? $fixedAmount : $pctAmount));
                                            @endphp

                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $teacher->name ?? 'N/A' }}</td>
                                                <td>{{ \Carbon\Carbon::create()->month($salary->month)->format('F') }}
                                                    {{ $salary->year }}</td>

                                                <td>{{ $salary->total_students }}</td>
                                                <td>{{ number_format($collected) }} PKR</td>

                                                {{-- Pay Type --}}
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $payType === 'fixed' ? 'primary' : 'info' }}">
                                                        {{ ucfirst($payType) }}
                                                    </span>
                                                </td>

                                                {{-- Percentage column: show % and approx computed amount --}}
                                                <td>
                                                    {{ $percent }}%
                                                    @if ($pctAmount > 0)
                                                        <small class="text-muted d-block">≈ {{ number_format($pctAmount) }}
                                                            PKR</small>
                                                    @endif
                                                </td>

                                                {{-- Fixed column --}}
                                                <td>
                                                    {{ $fixedAmount > 0 ? number_format($fixedAmount) . ' PKR' : '—' }}
                                                </td>

                                                {{-- Payable (actual) --}}
                                                <td><strong>{{ number_format($payable) }} PKR</strong></td>

                                                <td>
                                                    <span
                                                        class="badge
                        @if ($salary->status == 'paid') badge-success
                        @elseif($salary->status == 'balance') badge-info
                        @else badge-warning @endif">
                                                        {{ ucfirst($salary->status) }}
                                                    </span>
                                                </td>

                                                <td>
                                                    {{-- Paid --}}
                                                    <form method="POST"
                                                        action="{{ route('teacher-salary.status-paid', $salary->id) }}"
                                                        style="display:inline-block;">
                                                        @csrf @method('PUT')
                                                        <button type="submit" class="btn btn-sm btn-success">
                                                            Paid
                                                        </button>
                                                    </form>

                                                    {{-- Balance --}}
                                                    <form method="POST"
                                                        action="{{ route('teacher-salary.status-balance', $salary->id) }}"
                                                        style="display:inline-block;">
                                                        @csrf @method('PUT')
                                                        <button type="submit" class="btn btn-sm btn-warning">
                                                            Balance
                                                        </button>
                                                    </form>

                                                    {{-- View History for this teacher --}}
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
document.addEventListener('DOMContentLoaded', function () {
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