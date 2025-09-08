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
                        <a href="{{ route('admin.partner_profits.index') }}"
                            class="btn btn-sm btn-outline-primary rounded-pill shadow-sm" title="Back to Profits">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Flash Messages --}}
        @foreach (['store' => 'success', 'update' => 'warning', 'delete' => 'danger', 'paid' => 'success'] as $msg => $type)
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
                                <li><a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i
                                            class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>

                        <div class="body table-responsive">
                            <table class="table table-bordered table-hover mt-3">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Partner Name</th>
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th>Amount (Rs)</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                        @if (Auth::user()->role !== 'partner')
                                            <th>Options</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($balances as $balance)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $balance->partner->name ?? 'N/A' }}</td>
                                            <td>{{ \Carbon\Carbon::create()->month($balance->month)->format('F') }}</td>
                                            <td>{{ $balance->year }}</td>
                                            <td><strong>Rs {{ number_format((float) $balance->amount, 2) }}</strong></td>
                                            <td>{{ $balance->created_at?->format('d M Y, h:i A') }}</td>
                                            <td>
                                                <span
                                                    class="badge
                                                {{ $balance->status === 'paid' ? 'badge-success' : 'badge-warning' }}">
                                                    {{ ucfirst($balance->status) }}
                                                </span>
                                            </td>
                                            @if (Auth::user()->role !== 'partner')
                                            <td>
                                                <div class="d-flex align-items-center" style="gap: 8px;">
                                                        <form method="POST"
                                                            action="{{ route('admin.partner_profits.partner_balances.status_paid', $balance->id) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <button class="btn btn-sm btn-success" title="Mark as Paid">
                                                                Mark as Paid
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                                @endif
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted">No balance records found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            {{-- @if ($balances->isEmpty())
                            <div class="alert alert-warning text-center">
                                No balance data available.
                            </div>
                        @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional-javascript')
    @push('scripts')
        <script>
            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>
    @endpush
@endsection
