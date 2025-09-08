@extends('admin.layouts.main')

@section('content')
<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-6">
                <h2>All Partners - Profit History</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <div class="d-flex justify-content-end align-items-center" style="gap: 10px;">
                    <a href="{{ route('admin.partner_profits.index') }}"
                       class="btn btn-sm btn-outline-primary rounded-pill shadow-sm" title="Back to Profits">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        {{-- Unified Filters --}}
        <form method="GET" class="row mb-3">
            <div class="col-md-3">
                <select name="month" class="form-control" onchange="this.form.submit()">
                    <option value="">-- Month --</option>
                    @foreach (range(1,12) as $m)
                        <option value="{{ $m }}" {{ (string)request('month') === (string)$m ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="year" class="form-control" onchange="this.form.submit()">
                    <option value="">-- Year --</option>
                    @foreach (range(now()->year, 2022) as $y)
                        <option value="{{ $y }}" {{ (string)request('year') === (string)$y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search Partner..."
                       value="{{ request('search') }}" onkeydown="if(event.key==='Enter'){this.form.submit()}">
            </div>
            <div class="col-md-2 mt-2 mt-md-0">
                <button class="btn btn-sm btn-primary w-100"><i class="fas fa-filter"></i> Filter</button>
            </div>
        </form>

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header d-flex justify-content-between align-items-center">
                        <h2>Profit History</h2>
                    </div>

                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Partner</th>
                                    <th>Period</th> {{-- Month on top, Year below --}}
                                    <th>Amount (Rs)</th> {{-- event amount --}}
                                    <th>History Status</th> {{-- Paid or Balance --}}
                                    <th>Note</th>
                                    <th>Performed By</th>
                                    <th>Performed At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($histories as $index => $history)
                                    @php
                                        $h = strtolower($history->status ?? '');
                                        $ps = strtolower($history->profit->status ?? '');
                                    @endphp
                                    <tr>
                                        <td>{{ $histories->firstItem() + $index }}</td>

                                        <td>{{ $history->profit->partner->name ?? 'N/A' }}</td>

                                        <td class="text-center">
                                            <div>
                                                {{ $history->month
                                                    ? \Carbon\Carbon::create()->month($history->month)->format('F')
                                                    : '—' }}
                                            </div>
                                            <small class="text-muted">{{ $history->year ?? '—' }}</small>
                                        </td>

                                        <td>{{ number_format((float)$history->amount, 2) }}</td>

                                        <td>
                                            <span class="badge {{ $h === 'paid' ? 'badge-success' : 'badge-info' }}">
                                                {{ ucfirst($h ?: '—') }}
                                            </span>
                                        </td>

                                        {{-- <td>
                                            <span class="badge
                                                @if($ps === 'paid') badge-success
                                                @elseif($ps === 'balance') badge-info
                                                @elseif($ps === 'unpaid') badge-warning
                                                @else badge-secondary @endif">
                                                {{ ucfirst($history->profit->status ?? '—') }}
                                            </span>
                                        </td> --}}

                                        <td>{{ $history->note ?? '—' }}</td>

                                        <td>{{ $history->performedBy->name ?? '—' }}</td>

                                        <td>
                                            @if($history->performed_at)
                                                {{ \Carbon\Carbon::parse($history->performed_at)->format('d M Y h:i A') }}
                                            @else
                                                {{ optional($history->created_at)->format('d M Y h:i A') ?? '—' }}
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No history found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{-- Pagination --}}
                        @if(method_exists($histories, 'links'))
                            <div class="mt-3">
                                {{ $histories->links() }}
                            </div>
                        @endif
                    </div> {{-- .body --}}
                </div> {{-- .card --}}
            </div>
        </div>
    </div>
</div>
@endsection
