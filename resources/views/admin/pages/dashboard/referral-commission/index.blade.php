@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Commission</h2>
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
                            <h2>Referral Commission</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i
                                            class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table mt-4">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Referral Name</th>
                                            <th>Referred Student</th>
                                            <th>Contact</th>
                                            <th>Commission (%)</th>
                                            <th>Commission Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($commissions as $commission)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $commission->referral_name }}</td>
                                                <td>{{ $commission->admission->name }} <span
                                                        class="text-primary">({{ $commission->admission->course->title ?? 'N/A' }})</span>
                                                </td>
                                                <td>{{ $commission->referral_contact }}</td>
                                                <td>{{ $commission->commission_percentage }}%</td>
                                                <td>{{ number_format($commission->commission_amount) }} PKR</td>
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
