@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Profit</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    {{-- <a href="{{ route('batch.create') }}" class="btn btn-sm btn-primary" title="">Create New</a> --}}
                    <form action="{{ route('admin.dashboard.profit.calculate') }}" method="POST" style="display: inline-block;">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">Calculate This Month Profit</button>
                    </form>
                </div>
            </div>
        </div>
        {{-- Store --}}
        @if (session('store'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('store') }}
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
                            <h2>All Profits</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i
                                            class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <form method="GET">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <select name="month" class="form-control">
                                                <option value="">-- Select Month --</option>
                                                @foreach (range(1, 12) as $m)
                                                    <option value="{{ $m }}"
                                                        {{ request('month') == $m ? 'selected' : '' }}>
                                                        {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="number" name="year" value="{{ request('year') }}"
                                                class="form-control" placeholder="Year">
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-primary">Filter</button>
                                        </div>
                                    </div>
                                </form>

                                <table class="table mt-4">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Month</th>
                                            <th>Year</th>
                                            <th>Total Income</th>
                                            <th>Total Expense</th>
                                            <th>Net Profit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($profits as $profit)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ \Carbon\Carbon::create()->month($profit->month)->format('F') }}</td>
                                                <td>{{ $profit->year }}</td>
                                                <td>{{ number_format($profit->total_income) }} PKR</td>
                                                <td>{{ number_format($profit->total_expense) }} PKR</td>
                                                <td><strong>{{ number_format($profit->net_profit) }} PKR</strong></td>
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
