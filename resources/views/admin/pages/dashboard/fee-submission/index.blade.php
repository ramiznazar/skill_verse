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
                            <h2>Fee Submission</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li><a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse">
                                        <i class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>
                        <div class="body">

                            {{-- Filter Buttons --}}
                            <button type="button" class="btn btn-sm btn-default btn-filter" data-target="all">All</button>
                            <button type="button" class="btn btn-sm btn-success btn-filter"
                                data-target="complete">Completed</button>
                            <button type="button" class="btn btn-sm btn-warning btn-filter"
                                data-target="uncomplete">Remaining</button>
                            <button type="button" class="btn btn-sm btn-danger btn-filter"
                                data-target="pending">Pending</button>

                            {{-- Search Bar --}}
                            <div class="mt-3 mb-3">
                                <input type="text" id="searchInput" class="form-control" placeholder="Search student...">
                            </div>

                            {{-- Table --}}
                            <div class="table-responsive">
                                <table class="table table-hover mb-0" id="feeTable">
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
                                            <tr data-status="{{ strtolower($admission->fee_status) }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $admission->name }}</td>
                                                <td>{{ $admission->course->title }}</td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $admission->payment_type === 'full_fee' ? 'success' : 'warning' }}">
                                                        {{ ucfirst($admission->payment_type) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $admission->fee_status === 'complete' ? 'success' : ($admission->fee_status === 'pending' ? 'danger' : 'warning') }}">
                                                        {{ ucfirst($admission->fee_status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    {{-- existing buttons (Submit Fee, History, Receipt) --}}
                                                    @include('admin.pages.dashboard.fee-submission.button')
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- Pagination --}}
                            <div class="mt-3">
                                {{ $admissions->links('pagination::bootstrap-4') }}

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
        document.addEventListener("DOMContentLoaded", function() {
            // Search filter
            document.getElementById("searchInput").addEventListener("keyup", function() {
                let value = this.value.toLowerCase();
                document.querySelectorAll("#feeTable tbody tr").forEach(function(row) {
                    row.style.display = row.innerText.toLowerCase().includes(value) ? "" : "none";
                });
            });

            // Status filter
            document.querySelectorAll(".btn-filter").forEach(function(btn) {
                btn.addEventListener("click", function() {
                    let target = this.dataset.target;
                    document.querySelectorAll("#feeTable tbody tr").forEach(function(row) {
                        if (target === "all" || row.dataset.status === target) {
                            row.style.display = "";
                        } else {
                            row.style.display = "none";
                        }
                    });
                });
            });
        });
    </script>
@endsection
