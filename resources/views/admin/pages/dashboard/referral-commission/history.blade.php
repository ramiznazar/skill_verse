@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>
                        Referral History — {{ $referral_name }}
                        @if ($referral_contact)
                            <small>({{ $referral_contact }})</small>
                        @endif
                    </h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('referral-commission.index') }}" class="btn btn-sm btn-secondary">Back to Referrals</a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Referral Commission History</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li>
                                    <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse">
                                        <i class="icon-refresh"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="full-screen">
                                        <i class="icon-size-fullscreen"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="body">
                            {{-- Filters --}}
                            <form method="GET" class="form-inline mb-3">
                                <div class="form-group mr-2">
                                    <label for="month">Month:</label>
                                    <select name="month" id="month" class="form-control ml-2">
                                        <option value="">All</option>
                                        @foreach (range(1, 12) as $m)
                                            <option value="{{ $m }}"
                                                {{ request('month') == $m ? 'selected' : '' }}>
                                                {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mr-2">
                                    <label for="year">Year:</label>
                                    <select name="year" id="year" class="form-control ml-2">
                                        <option value="">All</option>
                                        @for ($y = now()->year; $y >= 2020; $y--)
                                            <option value="{{ $y }}"
                                                {{ request('year') == $y ? 'selected' : '' }}>
                                                {{ $y }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>

                                <button class="btn btn-primary" type="submit">Filter</button>
                            </form>

                            {{-- History Table --}}
                            <div class="table-responsive">
                                <table class="table m-b-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Status</th>
                                            <th>Student</th>
                                            <th>Course</th>
                                            <th>Type</th>
                                            <th>Total Fee</th>
                                            <th>(%) Rate</th>
                                            <th>Commission</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($commissions as $commission)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>

                                                <td>
                                                    <span
                                                        class="badge
                        @if ($commission->status === 'paid') badge-success
                        @elseif ($commission->status === 'unpaid') badge-warning
                        @else badge-info @endif">
                                                        {{ ucfirst($commission->status) }}
                                                    </span>
                                                </td>

                                                <td>{{ optional($commission->admission)->name ?? '-' }}</td>
                                                <td>{{ optional(optional($commission->admission)->course)->title ?? '-' }}
                                                </td>
                                                <td>
                                                    @php $type = optional($commission->feeSubmission)->payment_type; @endphp
                                                    @if ($type)
                                                        <span
                                                            class="badge badge-{{ $type === 'full_fee' ? 'success' : 'warning' }}">
                                                            {{ str_replace('_', ' ', ucfirst($type)) }}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-secondary">N/A</span>
                                                    @endif
                                                </td>
                                                <td><strong>{{ number_format((float) (optional($commission->admission)->full_fee ?? 0), 2) }}</strong></td>
                                                <td>{{ rtrim(rtrim(number_format((float) $commission->commission_percentage, 2), '0'), '.') }}%
                                                </td>

                                                @php
                                                    // If paid, show the snapshot amount from history; else show current value
                                                    $displayAmount =
                                                        optional($commission->lastPaidHistory)->amount ??
                                                        $commission->commission_amount;
                                                @endphp
                                                <td><strong>{{ number_format((float) $displayAmount, 2) }}</strong>
                                                </td>

                                                <td>{{ $commission->created_at ? $commission->created_at->format('Y-m-d H:i') : '-' }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center">No history found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div> {{-- end table --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
