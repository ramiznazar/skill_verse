@extends('admin.layouts.main')

@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Collector History<h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('fee-collector.index') }}" class="btn btn-sm btn-primary">Back to Table</a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Filtered Submissions</h2>
                        </div>

                        <div class="body">
                            <form method="GET" class="form-inline mb-3">
                                <div class="form-group mr-2">
                                    <label for="month">Month:</label>
                                    <select name="month" id="month" class="form-control ml-2">
                                        <option value="">All</option>
                                        @foreach (range(1, 12) as $m)
                                            <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
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
                                            <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                                                {{ $y }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Filter</button>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-bordered m-b-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Student Name</th>
                                            <th>Course</th>
                                            <th>Fee (PKR)</th>
                                            <th>Payment Type</th>
                                            <th>Payment Method</th>
                                            <th>Submission Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($submissions as $index => $submission)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $submission->admission->name ?? 'N/A' }}</td>
                                                <td>{{ $submission->admission->course->title ?? 'N/A' }}</td>
                                                <td>{{ number_format($submission->amount) }}</td>
                                                <td>{{ ucfirst($submission->payment_method) }}</td>
                                                <td>{{ $submission->payment_type }}</td>
                                                <td>{{ \Carbon\Carbon::parse($submission->submission_date)->format('d M Y') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No records found.</td>
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
