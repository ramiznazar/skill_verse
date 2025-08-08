@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Fee Colecting</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="javascript:void(0);" class="btn btn-sm btn-primary" title="">Create New</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Fee Collector</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i
                                            class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>
                        <div class="body">
                            <button type="button" class="btn btn-sm btn-default btn-filter" data-target="all">All</button>
                            <button type="button" class="btn btn-sm btn-success btn-filter" data-target="hand">By
                                Hand</button>
                            <button type="button" class="btn btn-sm btn-info btn-filter" data-target="account">By
                                Account</button>

                            <div class="table-responsive mt-3">
                                <table class="table table-filter table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Student</th>
                                            <th>Course</th>
                                            <th>Amount</th>
                                            <th>Payment Type</th>
                                            <th>Method</th>
                                            <th>Collector</th>
                                            <th>History</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($groupedSubmissions as $key => $group)
                                            @php
                                                $first = $group->first();
                                                $totalAmount = $group->sum('amount');
                                            @endphp
                                            <tr data-status="{{ $first->payment_method }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $first->admission->name ?? 'N/A' }}</td>
                                                <td>{{ $first->admission->course->title ?? 'N/A' }}</td>
                                                <td>{{ number_format($totalAmount) }} PKR</td>
                                                <td>{{ ucfirst(str_replace('_', ' ', $first->payment_type)) }}</td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $first->payment_method === 'hand' ? 'success' : 'info' }}">
                                                        {{ ucfirst($first->payment_method) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($first->payment_method === 'hand')
                                                        <strong>Collected By:</strong> {{ $first->user->name ?? 'N/A' }}
                                                    @elseif ($first->payment_method === 'account')
                                                        <strong>Account:</strong> {{ $first->account->name ?? 'N/A' }}<br>
                                                        <strong>Number:</strong> {{ $first->account->number ?? 'N/A' }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($first->payment_method === 'hand' && $first->user_id)
                                                        <a href="{{ route('collector.history', $first->user_id) }}"
                                                            class="btn btn-sm btn-info">
                                                            <i class="fa fa-history"></i>
                                                        </a>
                                                    @elseif ($first->payment_method === 'account' && $first->account_id)
                                                        <a href="{{ route('account.history', $first->account_id) }}"
                                                            class="btn btn-sm btn-info">
                                                            <i class="fa fa-history"></i>
                                                        </a>
                                                    @endif
                                                </td>

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.star').on('click', function() {
                $(this).toggleClass('star-checked');
            });

            $('.ckbox label').on('click', function() {
                $(this).parents('tr').toggleClass('selected');
            });

            $('.btn-filter').on('click', function() {
                var $target = $(this).data('target');
                if ($target != 'all') {
                    $('.table tr').css('display', 'none');
                    $('.table tr[data-status="' + $target + '"]').fadeIn('slow');
                } else {
                    $('.table tr').css('display', 'none').fadeIn('slow');
                }
            });
        });
    </script>
@endsection
