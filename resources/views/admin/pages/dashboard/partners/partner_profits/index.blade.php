@extends('admin.layouts.main')

@section('content')
<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Partner Profits</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <div class="d-flex justify-content-end align-items-center gap-2">
                    <form method="POST" action="{{ route('admin.dashboard.partner_profits.generate_monthly') }}">
                        @csrf
                        <button class="btn btn-sm btn-outline-primary rounded-pill shadow-sm" title="Generate Monthly Profit">
                            <i class="fas fa-sync-alt"></i> Generate Monthly
                        </button>
                    </form>

                    <a href="{{ route('admin.dashboard.partner_profits.full_history', array_merge(request()->query(), ['full' => 1])) }}"
                       class="btn btn-sm btn-outline-secondary rounded-pill shadow-sm" title="View Full History">
                        <i class="fas fa-list-alt"></i> Full History
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Flash Messages --}}
    @foreach (['store' => 'success', 'update' => 'warning', 'delete' => 'danger'] as $msg => $type)
        @if (session($msg))
            <div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
                {{ session($msg) }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    @endforeach

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2><i class="fas fa-wallet text-info mr-2"></i> All Partner Profits</h2>
                        <ul class="header-dropdown dropdown dropdown-animated scale-left">
                            <li><a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="fas fa-sync-alt"></i></a></li>
                            <li><a href="javascript:void(0);" class="full-screen"><i class="fas fa-expand"></i></a></li>
                        </ul>
                    </div>

                    <div class="body">
                        <!-- Filters -->
                        <form method="GET" action="{{ route('admin.dashboard.partner_profits.index') }}" class="row mb-3">
                            <div class="col-md-3">
                                <select class="form-control" name="month">
                                    <option value="">-- Select Month --</option>
                                    @foreach (range(1, 12) as $m)
                                        <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" name="year">
                                    <option value="">-- Select Year --</option>
                                    @foreach (range(2023, now()->year) as $y)
                                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
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
                                        <th>Partner</th>
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>History</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($profits as $profit)
                                        <tr>
                                            <td>{{ $profit->partner->name }}</td>
                                            <td>{{ \Carbon\Carbon::create()->month($profit->calculation->month)->format('F') }}</td>
                                            <td>{{ $profit->calculation->year }}</td>
                                            <td>Rs {{ number_format($profit->amount, 2) }}</td>
                                            <td>
                                                <span class="badge 
                                                    @if ($profit->status == 'paid') badge-success
                                                    @elseif($profit->status == 'balance') badge-info
                                                    @else badge-warning @endif">
                                                    {{ ucfirst($profit->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.dashboard.partner_profits.history', $profit->partner_id) }}"
                                                   class="btn btn-sm btn-outline-dark" title="View History">
                                                    <i class="fas fa-history"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    @if ($profit->status == 'unpaid')
                                                        <a href="{{ route('admin.dashboard.partner_profits.mark_as_paid', $profit->id) }}"
                                                           class="btn btn-sm btn-outline-success" title="Mark as Paid">
                                                            <i class="fas fa-check-circle"></i>
                                                        </a>

                                                        <a href="{{ route('admin.dashboard.partner_profits.move_to_balance', $profit->id) }}"
                                                           class="btn btn-sm btn-outline-info" title="Move to Balance">
                                                            <i class="fas fa-arrow-right"></i>
                                                        </a>
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No profits found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            @if ($profits->isEmpty())
                                <div class="alert alert-warning text-center">
                                    No recent profit data available. Click <strong>"Generate Monthly"</strong> to create profits.
                                </div>
                            @endif
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
