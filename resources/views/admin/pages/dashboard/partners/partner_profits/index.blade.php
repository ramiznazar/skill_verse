@extends('admin.layouts.main')

@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Partner Profits</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    {{-- Generate Monthly --}}
                    <form method="POST" action="{{ route('admin.partner_profits.generate_monthly') }}"
                        style="display:inline-block;">
                        @csrf
                        <input type="hidden" name="month" value="{{ request('month') ?: $selectedMonth ?? now()->month }}">
                        <input type="hidden" name="year" value="{{ request('year') ?: $selectedYear ?? now()->year }}">
                        <button type="submit" class="btn btn-sm btn-primary">Generate Monthly</button>
                    </form>

                    {{-- Balances --}}
                    <a href="{{ route('admin.partner_profits.partner_balances.index') }}" class="btn btn-sm btn-info">
                        Partner Balances
                    </a>

                    {{-- Full History --}}
                    @if (Auth::user()->role !== 'partner')
                        <a href="{{ route('admin.partner_profits.full_history', request()->query()) }}"
                            class="btn btn-sm btn-secondary">
                            Full History
                        </a>
                    @endif

                </div>
            </div>
        </div>

        <div class="container-fluid">
            {{-- Summary Row --}}
            @isset($summary)
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="alert alert-light border">
                            <div><strong>Total Fees:</strong> Rs {{ number_format($summary['fees'] ?? 0, 2) }}</div>
                            <div><strong>Total Expenses:</strong> Rs {{ number_format($summary['expenses'] ?? 0, 2) }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-light border">
                            <div><strong>Net Profit:</strong>
                                @php $np = $summary['netProfit'] ?? 0; @endphp
                                <span class="{{ $np < 0 ? 'text-danger' : 'text-success' }}">
                                    Rs {{ number_format($np, 2) }}
                                </span>
                            </div>
                            <div><small>({{ \Carbon\Carbon::create()->month($selectedMonth ?? now()->month)->format('F') }}
                                    {{ $selectedYear ?? now()->year }})</small></div>
                        </div>
                    </div>
                </div>
            @endisset

            {{-- Flash Messages --}}
            @foreach (['store' => 'success', 'update' => 'warning', 'delete' => 'danger', 'success' => 'success', 'error' => 'danger', 'info' => 'info'] as $msg => $type)
                @if (session($msg))
                    <div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
                        {{ session($msg) }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            @endforeach

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><i class="fas fa-wallet text-info mr-2"></i> All Partner Profits</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li><a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i
                                            class="fas fa-sync-alt"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i class="fas fa-expand"></i></a></li>
                            </ul>
                        </div>

                        <div class="body">
                            <!-- Filters -->
                            <form method="GET" action="{{ route('admin.partner_profits.index') }}" class="row mb-3">
                                <div class="col-md-3">
                                    <select class="form-control" name="month">
                                        <option value="">-- Select Month --</option>
                                        @foreach (range(1, 12) as $m)
                                            <option value="{{ $m }}"
                                                {{ (string) request('month', $selectedMonth ?? '') === (string) $m ? 'selected' : '' }}>
                                                {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" name="year">
                                        <option value="">-- Select Year --</option>
                                        @foreach (range(2023, now()->year) as $y)
                                            <option value="{{ $y }}"
                                                {{ (string) request('year', $selectedYear ?? '') === (string) $y ? 'selected' : '' }}>
                                                {{ $y }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-sm btn-primary"><i class="fas fa-filter"></i> Filter</button>
                                </div>
                            </form>

                            <!-- Profits Table -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover mt-3">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>Period</th>
                                            <th>% / Rate</th>
                                            <th>Total Share</th>
                                            <th>Balance</th>
                                            <th>Paid</th>
                                            <th>Unpaid</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($profits as $profit)
                                            <tr>
                                                <td>{{ $profit->partner->name ?? '—' }}</td>
                                                <td class="">
                                                    <div>{{ \Carbon\Carbon::create()->month($profit->month)->format('F') }}
                                                    </div>
                                                    <small class="text-muted">{{ $profit->year }}</small>
                                                </td>

                                                <td>{{ number_format((float) ($profit->partner->percentage ?? 0), 2) }}%
                                                </td>

                                                <td>{{ number_format((float) $profit->amount, 2) }}</td>
                                                <td class="text-warning">
                                                    {{ number_format((float) ($profit->balance_amount ?? 0), 2) }}</td>
                                                <td class="text-success">
                                                    {{ number_format((float) ($profit->settled ?? 0), 2) }} PKR</td>

                                                <td class="text-danger">{{ number_format((float) ($profit->due ?? 0), 2) }}
                                                    PKR</td>

                                                <td>
                                                    <span
                                                        class="badge
                            @if (($profit->derived_status ?? 'unpaid') === 'paid') badge-success
                            @elseif(($profit->derived_status ?? '') === 'balance') badge-info
                            @else badge-warning @endif">
                                                        {{ ucfirst($profit->derived_status ?? 'unpaid') }}
                                                    </span>
                                                </td>

                                                <td>
                                                    @if (Auth::user()->role !== 'partner')
                                                        {{-- Paid (server flashes message if no due) --}}
                                                        <form method="POST"
                                                            action="{{ route('admin.partner_profits.mark_as_paid', $profit->id) }}"
                                                            style="display:inline-block;">
                                                            @csrf @method('PUT')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-success">Paid</button>
                                                        </form>

                                                        {{-- Balance --}}
                                                        <form method="POST"
                                                            action="{{ route('admin.partner_profits.move_to_balance', $profit->id) }}"
                                                            style="display:inline-block;">
                                                            @csrf @method('PUT')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-warning">Balance</button>
                                                        </form>
                                                    @endif

                                                    {{-- History (everyone can see their own history) --}}
                                                    <a href="{{ route('admin.partner_profits.history', $profit->partner_id) }}"
                                                        class="btn btn-sm btn-info">
                                                        History
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" class="text-center">No profits found.</td>
                                            </tr>
                                        @endforelse
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
