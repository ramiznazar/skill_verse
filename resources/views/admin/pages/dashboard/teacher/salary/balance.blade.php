@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Teachers Balance</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('teacher-salary.index') }}" class="btn btn-sm btn-primary" title="">Back to Teachers</a>
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
        {{-- Delete --}}
        @if (session('delete'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('delete') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        {{-- Update --}}
        @if (session('update'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('update') }}
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
                            <h2>Balances</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i
                                            class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table m-b-0">
                                    <thead class="">
                                        <tr>
                                            <th>#</th>
                                            <th>Teacher Name</th>
                                            <th>Month</th>
                                            <th>Year</th>
                                            <th>Amount (PKR)</th>
                                            <th>Created At</th>
                                            <th>Status</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($balances as $balance)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $balance->teacher->name ?? 'N/A' }}</td>
                                                <td>{{ \Carbon\Carbon::create()->month($balance->month)->format('F') }}</td>
                                                <td>{{ $balance->year }}</td>
                                                <td>{{ number_format($balance->amount, 2) }}</td>
                                                <td>{{ $balance->created_at->format('d M Y') }}</td>
                                                <td>
                                                    <span
                                                        class="badge 
                                                          {{ $balance->status === 'paid' ? 'badge-success' : 'badge-warning' }}">
                                                        {{ $balance->status }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <form action="{{ route('teacher-balance.status-paid', $balance->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button class="btn btn-sm btn-success">
                                                        Mark as Paid</button>
                                                    </form>
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
        $('.sparkbar').sparkline('html', {
            type: 'bar'
        });
    </script>
@endsection
