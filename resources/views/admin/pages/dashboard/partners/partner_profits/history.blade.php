@extends('admin.layouts.main')

@section('content')
<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>
                    {{ isset($partnerName) ? "$partnerName's Profit History" : 'All Partners - Profit History' }}

                </h2>
 
            </div>
   <div class="col-md-6 col-sm-12 text-right">
                    <div class="d-flex justify-content-end align-items-center" style="gap: 10px;">
                        <a href="{{ route('admin.dashboard.partner_profits.index') }}"
                           class="btn btn-sm btn-outline-primary rounded-pill shadow-sm">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
        </div>
    </div>

    <div class="container-fluid">
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
                                    <th>Partner Name</th>
                                    <th>Month</th>
                                    <th>Year</th>
                                    <th>Profit Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($histories as $key => $history)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $history->profit->partner->name ?? 'N/A' }}</td>
                                        <td>{{ $history->profit->calculation->month ?? '-' }}</td>
                                        <td>{{ $history->profit->calculation->year ?? '-' }}</td>
                                        <td>{{ number_format($history->amount, 2) }}</td>

                                        {{-- ✅ Profit Status --}}
                                        <td>
                                            @php $status = $history->profit->status ?? 'unknown'; @endphp
                                            <span class="badge
                                                @if($status === 'paid') badge-success
                                                @elseif($status === 'unpaid') badge-danger
                                                @elseif($status === 'balance') badge-warning
                                                @else badge-secondary
                                                @endif">
                                                {{ ucfirst($status) }}
                                            </span>
                                        </td>

                                        {{-- ✅ Action History --}}
                                        <td>
                                            <span class="badge
                                                @if($history->action === 'marked_paid') badge-primary
                                                @elseif($history->action === 'moved_to_balance') badge-info
                                                @elseif($history->action === 'updated') badge-dark
                                                @else badge-light
                                                @endif">
                                                {{ ucfirst(str_replace('_', ' ', $history->action)) }}
                                            </span>
                                        </td>

                                        <td>{{ $history->created_at->format('d M Y h:i A') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">No history found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div> {{-- end .body --}}
                </div> {{-- end .card --}}
            </div> {{-- end .col --}}
        </div> {{-- end .row --}}
    </div> {{-- end .container --}}
</div> {{-- end #main-content --}}
@endsection
