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
                        <a href="{{ route('admin.dashboard.partner_profits.index') }}"
                           class="btn btn-sm btn-outline-primary rounded-pill shadow-sm">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>


        <div class="container-fluid">
            <!-- Filter Section -->
            <div class="row mb-3">
                <div class="col-md-3">
                    <form method="GET" action="">
                        <select name="month" class="form-control" onchange="this.form.submit()">
                            <option value="">-- Select Month --</option>
                            @foreach (range(1, 12) as $m)
                                <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                    {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <div class="col-md-3">
                    <form method="GET" action="">
                        <select name="year" class="form-control" onchange="this.form.submit()">
                            <option value="">-- Select Year --</option>
                            @foreach (range(date('Y'), 2022) as $y)
                                <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                                    {{ $y }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <div class="col-md-4">
                    <form method="GET" action="">
                        <input type="text" name="search" class="form-control" placeholder="Search Partner..."
                            value="{{ request('search') }}">
                    </form>
                </div>
            </div>

            <!-- Table Section -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header d-flex justify-content-between align-items-center">
                            <h2>Profit History</h2>
                            {{-- Optional Export Button --}}
                            {{-- <a href="{{ route('admin.dashboard.partner_profits.export') }}" class="btn btn-sm btn-success">Export Excel</a> --}}
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
                                        <th>Action</th>
                                        <th>Status</th>
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

                                            <td>
                                                <span
                                                    class="badge 
                                                @if ($history->action === 'marked_paid') badge-success
                                                @elseif($history->action === 'moved_to_balance') badge-warning
                                                @elseif($history->action === 'updated') badge-primary
                                                @else badge-secondary @endif">
                                                    {{ ucfirst(str_replace('_', ' ', $history->action)) }}
                                                </span>
                                            </td>

                                            <td>
                                                <span
                                                    class="badge 
                                                @if ($history->profit->status === 'paid') badge-success
                                                @elseif($history->profit->status === 'unpaid') badge-danger
                                                @elseif($history->profit->status === 'balance') badge-warning
                                                @else badge-secondary @endif">
                                                    {{ ucfirst($history->profit->status) }}
                                                </span>
                                            </td>

                                            <td>{{ $history->created_at->format('d M Y h:i A') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No history found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            {{-- Pagination --}}
                           

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
