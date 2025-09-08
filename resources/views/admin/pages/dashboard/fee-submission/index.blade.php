@extends('admin.layouts.main')

@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Fee Submission</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('admission.index') }}" class="btn btn-sm btn-primary" title="">All Admissions</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Table Tools<small>Basic example without any additional modification classes</small></h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i
                                            class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                        role="button" aria-haspopup="true" aria-expanded="false"></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another Action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Course</th>
                                            <th>Fee Type</th>
                                            <th>Status</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($admissions as $admission)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $admission->name }}</td>
                                                <td>{{ $admission->course->title }}</td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $admission->payment_type === 'full_fee' ? 'success' : 'warning' }}">
                                                        {{ ucfirst($admission->payment_type) }}
                                                    </span>
                                                </td>
                                                <td>{{ $admission->fee_status }}</td>
                                                <td>
                                                    @php
                                                        // get latest fee by submission_date if you store it, else by created_at
                                                        $latestFee =
                                                            $admission
                                                                ->feeSubmissions()
                                                                ->latest('submission_date')
                                                                ->first() ??
                                                            $admission->feeSubmissions()->latest()->first();
                                                    @endphp

                                                    {{-- Show Submit Fee button ONLY if not complete --}}
                                                    @if (strtolower($admission->fee_status) !== 'complete')
                                                        <a href="{{ route('fee-submission.create', $admission->id) }}"
                                                            class="btn btn-sm btn-default" data-toggle="tooltip"
                                                            title="Submit Fee">
                                                            <i class="fas fa-money-check-alt"></i>
                                                        </a>
                                                    @endif

                                                    @if ($latestFee)
                                                        <button type="button" class="btn btn-sm btn-info mt-1"
                                                            data-toggle="modal"
                                                            data-target="#receiptModal{{ $admission->id }}">
                                                            View Receipt
                                                        </button>

                                                        <div class="modal fade" id="receiptModal{{ $admission->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="receiptModalLabel{{ $admission->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-primary text-white">
                                                                        <h5 class="modal-title"
                                                                            id="receiptModalLabel{{ $admission->id }}">
                                                                            Receipt - #{{ $latestFee->receipt_no }}
                                                                        </h5>
                                                                        <button type="button" class="close text-white"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p><strong>Student:</strong> {{ $admission->name }}
                                                                        </p>
                                                                        <p><strong>Course:</strong>
                                                                            {{ $admission->course->title ?? 'N/A' }}</p>
                                                                        <p><strong>Fee Type:</strong>
                                                                            {{ ucfirst($latestFee->payment_type) }}</p>
                                                                        <p><strong>Amount Paid:</strong>
                                                                            {{ number_format($latestFee->amount) }} PKR</p>
                                                                        <p><strong>Payment Method:</strong>
                                                                            {{ ucfirst($latestFee->payment_method ?? 'N/A') }}
                                                                        </p>
                                                                        <p><strong>Date:</strong>
                                                                            {{ \Carbon\Carbon::parse($latestFee->submission_date ?? $latestFee->created_at)->format('d M Y') }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <a href="{{ route('fee-submission.download-receipt', $latestFee->id) }}"
                                                                            class="btn btn-primary">Download PDF</a>
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
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
