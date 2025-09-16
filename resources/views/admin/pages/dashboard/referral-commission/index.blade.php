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
                    {{-- <form action="{{ route('admin.dashboard.profit.calculate') }}" method="POST"
                        style="display: inline-block;">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">Calculate This Month Profit</button>
                    </form> --}}
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
                                            <th>Contact</th>
                                            <th>Students</th>
                                            <th>Total Fee</th>
                                            <th>Avg %</th>
                                            <th>Total Amount</th>
                                            <th>Paid</th>
                                            <th>Unpaid</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($referrers as $i => $ref)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>{{ $ref->referral_name ?? 'N/A' }}</td>
                                                <td>{{ $ref->referral_contact ?? 'N/A' }}</td>
                                                <td>{{ $ref->total_students }}</td>

                                                <td><strong>{{ number_format((float) $ref->total_student_fee) }}</strong>
                                                </td>
                                                <td>{{ rtrim(rtrim(number_format((float) $ref->avg_pct, 2), '0'), '.') }}%
                                                </td>
                                                <td><strong>{{ number_format((float) $ref->total_amount) }}</strong></td>

                                                <td class="text-success">{{ number_format((float) $ref->paid_total, 2) }}
                                                    PKR</td>
                                                <td class="text-danger">{{ number_format((float) $ref->unpaid_total, 2) }}
                                                    PKR</td>

                                                <td>
                                                    {{-- Bulk Paid for this referrer (nullable-safe key) --}}
                                                    <form method="POST" action="{{ route('referral-commission.paid') }}"
                                                        style="display:inline-block;">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="referral_name"
                                                            value="{{ $ref->referral_name }}">
                                                        <input type="hidden" name="contact_key"
                                                            value="{{ $ref->contact_key }}"> {{-- '' when NULL --}}
                                                        <button type="submit" class="btn btn-sm btn-success">Paid</button>
                                                    </form>

                                                    {{-- History: pass key as well (make route param optional) --}}
                                                    <a href="{{ route('referral-commission.history', [$ref->referral_name, $ref->contact_key]) }}"
                                                        class="btn btn-sm btn-info">
                                                        History
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" class="text-center">No referral commissions found.</td>
                                            </tr>
                                        @endforelse
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
