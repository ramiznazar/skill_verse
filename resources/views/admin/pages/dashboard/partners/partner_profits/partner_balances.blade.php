@extends('admin.layouts.main')

@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Partner Balances</h2>
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
                            <h2><i class="fas fa-wallet text-info mr-2"></i> Balance Details</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li><a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>

                        <div class="body table-responsive">
                            <table class="table table-bordered table-hover mt-3">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Partner Name</th>
                                        <th>Total Balance (Rs)</th>
                                        <th>Last Updated</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($balances as $balance)
                                        @php
                                            $balanceColor = $balance->total_balance < 0 ? 'text-danger' : 'text-dark';
                                        @endphp
                                        <tr>
                                            <td>{{ $balance->partner->name ?? 'N/A' }}</td>
                                            <td><strong class="{{ $balanceColor }}">Rs {{ number_format($balance->total_balance, 2) }}</strong></td>
                                            <td>{{ $balance->updated_at->format('d M Y, h:i A') }}</td>
                                            <td>
                                                <a href="{{ route('admin.dashboard.partner_profits.history', $balance->partner_id) }}"
                                                   class="btn btn-sm btn-outline-info rounded-circle"
                                                   data-toggle="tooltip" data-placement="top" title="View Profit History">
                                                    <i class="fas fa-history"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">No balance records found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            @if ($balances->isEmpty())
                                <div class="alert alert-warning text-center">
                                    No balance data available.
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Enable Bootstrap Tooltips --}}
    @push('scripts')
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>
    @endpush

@endsection
