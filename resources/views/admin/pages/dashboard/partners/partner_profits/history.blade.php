@extends('admin.layouts.main')

@section('content')
<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>{{ isset($partnerName) ? "$partnerName's Profit History" : 'Partner Profit History' }}</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <div class="d-flex justify-content-end align-items-center" style="gap:10px;">
                    <a href="{{ route('admin.partner_profits.index') }}"
                       class="btn btn-sm btn-primary" title="Back to Profits">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        {{-- Optional filters --}}
        <form method="GET" class="row mb-3">
            <div class="col-md-3">
                <select class="form-control" name="month">
                    <option value="">-- Month --</option>
                    @foreach (range(1,12) as $m)
                        <option value="{{ $m }}" {{ (string)request('month', $selectedMonth ?? '') === (string)$m ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-control" name="year">
                    <option value="">-- Year --</option>
                    @foreach (range(2023, now()->year) as $y)
                        <option value="{{ $y }}" {{ (string)request('year', $selectedYear ?? '') === (string)$y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-sm btn-primary"><i class="fas fa-filter"></i> Filter</button>
            </div>
        </form>

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>Profit History</h2>
                    </div>

                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Partner</th>
                                    <th>Period</th>
                                    <th>Amount (Rs)</th>
                                    <th>History Status</th>
                                    <th>Note</th>
                                    <th>Performed By</th>
                                    <th>Performed At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $row = 0; @endphp
                                @forelse($histories as $history)
                                    @php
                                        $h = strtolower($history->status ?? '');
                                    @endphp

                                    {{-- Only keep paid / balance history events --}}
                                    @continue(!in_array($h, ['paid','balance']))

                                    @php $row++; @endphp
                                    <tr>
                                        <td>{{ $row }}</td>

                                        <td>{{ $history->profit->partner->name ?? $partnerName ?? 'N/A' }}</td>

                                        <td class="text-center">
                                            <div>
                                                {{ $history->month
                                                    ? \Carbon\Carbon::create()->month($history->month)->format('F')
                                                    : '—' }}
                                            </div>
                                            <small class="text-muted">{{ $history->year ?? '—' }}</small>
                                        </td>

                                        {{-- event amount (paid or balance) --}}
                                        <td>{{ number_format((float)$history->amount, 2) }}</td>

                                        {{-- History Status badge: Paid or Balance only --}}
                                        <td>
                                            <span class="badge {{ $h === 'paid' ? 'badge-success' : 'badge-info' }}">
                                                {{ ucfirst($h) }}
                                            </span>
                                        </td>

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
                                        <td colspan="9" class="text-center text-muted">No history found.</td>
                                    </tr>
                                @endforelse

                                @if(($row ?? 0) === 0)
                                    <tr>
                                        <td colspan="9" class="text-center text-muted">No paid/balance entries found.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>{{-- end .body --}}
                </div>{{-- end .card --}}
            </div>
        </div>
    </div>
</div>
@endsection
