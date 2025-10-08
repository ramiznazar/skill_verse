@extends('admin.layouts.main')

@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Fee Submission</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('admission.index') }}" class="btn btn-sm btn-primary">All Admissions</a>
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
                            {{-- 🔎 Search --}}
                            <form method="GET" action="{{ route('fee-submission.index') }}" id="filterForm"
                                class="mb-3">
                                <div class="input-group mb-2">
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        class="form-control" placeholder="Search student..." autocomplete="off">
                                </div>

                                <div class="row" style="margin-top: 15px">
                                    <div class="col-md-3 mb-2">
                                        <select name="course_id" id="filter-course" class="form-control">
                                            <option value="">Filter by Course</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}"
                                                    {{ (string) request('course_id') === (string) $course->id ? 'selected' : '' }}>
                                                    {{ $course->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <select name="status" id="filter-status" class="form-control">
                                            <option value="all"
                                                {{ request('status', 'all') === 'all' ? 'selected' : '' }}>All Fees Status
                                            </option>
                                            <option value="complete"
                                                {{ request('status') === 'complete' ? 'selected' : '' }}>Completed</option>
                                            <option value="uncomplete"
                                                {{ request('status') === 'uncomplete' ? 'selected' : '' }}>Remaining
                                            </option>
                                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>
                                                Pending</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <select name="payment" id="filter-payment" class="form-control">
                                            <option value="" {{ request('payment') ? '' : 'selected' }}>All Payment
                                                Types</option>
                                            <option value="full_fee"
                                                {{ request('payment') === 'full_fee' ? 'selected' : '' }}>Full Payment
                                            </option>
                                            <option value="installment"
                                                {{ request('payment') === 'installment' ? 'selected' : '' }}>Installment
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <input type="month" name="month" value="{{ request('month') }}"
                                            class="form-control">
                                    </div>

                                </div>
                            </form>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="alert alert-success mb-0">
                                        <strong>Total Collected Fee:</strong> ₨ {{ number_format($totalCollected) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="alert alert-warning mb-0">
                                        <strong>Total Remaining Fee:</strong> ₨ {{ number_format($totalRemaining) }}
                                    </div>
                                </div>
                            </div>

                            {{-- 📊 Table --}}
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
                                            <tr data-status="{{ strtolower($admission->fee_status) }}"
                                                data-payment="{{ strtolower($admission->payment_type) }}"
                                                data-course="{{ strtolower($admission->course->title) }}">
                                                <td>{{ $loop->iteration + ($admissions->currentPage() - 1) * $admissions->perPage() }}
                                                </td>
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
                                                    {{-- Expand Button --}}
                                                    @if ($admission->payment_type === 'installment')
                                                        <button class="btn btn-sm btn-info toggle-installments">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    @endif

                                                    @include('admin.pages.dashboard.fee-submission.button')
                                                </td>
                                            </tr>

                                            {{-- Hidden Installments Row --}}
                                            @if ($admission->payment_type === 'installment')
                                                @php
                                                    // Collect all submissions for this student
                                                    $paidInstallments = $admission->feeSubmissions
                                                        ->pluck('payment_type')
                                                        ->toArray();

                                                    // Installments list with label + amount
                                                    $installments = [];
                                                    if ($admission->installment_1 > 0) {
                                                        $installments[] = [
                                                            'label' => '1st Installment',
                                                            'amount' => $admission->installment_1,
                                                            'key' => 'installment_1',
                                                        ];
                                                    }
                                                    if ($admission->installment_2 > 0) {
                                                        $installments[] = [
                                                            'label' => '2nd Installment',
                                                            'amount' => $admission->installment_2,
                                                            'key' => 'installment_2',
                                                        ];
                                                    }
                                                    if ($admission->installment_3 > 0) {
                                                        $installments[] = [
                                                            'label' => '3rd Installment',
                                                            'amount' => $admission->installment_3,
                                                            'key' => 'installment_3',
                                                        ];
                                                    }
                                                    if (
                                                        property_exists($admission, 'installment_4') &&
                                                        $admission->installment_4 > 0
                                                    ) {
                                                        $installments[] = [
                                                            'label' => '4th Installment',
                                                            'amount' => $admission->installment_4,
                                                            'key' => 'installment_4',
                                                        ];
                                                    }
                                                @endphp

                                                <tr class="installment-details d-none">
                                                    <td colspan="6">
                                                        <table class="table table-sm table-bordered mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Full Fee</th>
                                                                    @foreach ($installments as $inst)
                                                                        <th>{{ $inst['label'] }}</th>
                                                                    @endforeach
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    {{-- Full Fee --}}
                                                                    <td>₨{{ number_format($admission->full_fee) }}</td>

                                                                    {{-- Dynamic Installments --}}
                                                                    @foreach ($installments as $inst)
                                                                        <td>
                                                                            ₨{{ number_format($inst['amount']) }}
                                                                            <br>
                                                                            <span
                                                                                class="badge badge-{{ in_array($inst['key'], $paidInstallments) ? 'success' : 'danger' }}">
                                                                                {{ in_array($inst['key'], $paidInstallments) ? 'Paid' : 'Unpaid' }}
                                                                            </span>
                                                                        </td>
                                                                    @endforeach
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- 📑 Pagination --}}
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
            const tableRows = document.querySelectorAll("#feeTable tbody tr");

            const searchInput = document.querySelector("input[name='search']");
            const courseFilter = document.getElementById("filter-course");
            const statusFilter = document.getElementById("filter-status");
            const paymentFilter = document.getElementById("filter-payment");

            function applyFilters() {
                let search = searchInput ? searchInput.value.toLowerCase() : "";
                let course = courseFilter.value.toLowerCase();
                let status = statusFilter.value.toLowerCase();
                let payment = paymentFilter.value.toLowerCase();

                tableRows.forEach(function(row) {
                    let rowText = row.innerText.toLowerCase();
                    let courseCol = row.getAttribute("data-course");
                    let statusCol = row.getAttribute("data-status");
                    let paymentCol = row.getAttribute("data-payment");

                    let visible =
                        (!search || rowText.includes(search)) &&
                        (!course || courseCol.includes(course)) &&
                        (!status || statusCol === status) &&
                        (!payment || paymentCol === payment);

                    row.style.display = visible ? "" : "none";
                });
            }

            if (searchInput) searchInput.addEventListener("keyup", applyFilters);
            [courseFilter, statusFilter, paymentFilter].forEach(el => {
                el.addEventListener("change", applyFilters);
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('filterForm');
            const search = form.querySelector('input[name="search"]');
            const selects = form.querySelectorAll('select, input[type="month"]');

            // auto-submit on change (includes month input now)
            selects.forEach(el => el.addEventListener('change', () => form.submit()));

            // debounce search typing → submit after 500ms of inactivity
            let t;
            search && search.addEventListener('input', () => {
                clearTimeout(t);
                t = setTimeout(() => form.submit(), 500);
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".toggle-installments").forEach(function(button) {
                button.addEventListener("click", function() {
                    const row = this.closest("tr");
                    const detailsRow = row.nextElementSibling;

                    if (detailsRow && detailsRow.classList.contains("installment-details")) {
                        detailsRow.classList.toggle("d-none");

                        // change icon
                        const icon = this.querySelector("i");
                        if (icon.classList.contains("fa-plus")) {
                            icon.classList.remove("fa-plus");
                            icon.classList.add("fa-minus");
                        } else {
                            icon.classList.remove("fa-minus");
                            icon.classList.add("fa-plus");
                        }
                    }
                });
            });
        });
    </script>
@endsection
