@extends('admin.layouts.main')

@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Student Admissions</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('admission.create') }}" class="btn btn-sm btn-primary">Create New</a>
                </div>
            </div>
        </div>

        {{-- Alerts --}}
        @foreach (['store' => 'success', 'delete' => 'danger', 'update' => 'warning'] as $key => $type)
            @if (session($key))
                <div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
                    {{ session($key) }}
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
            @endif
        @endforeach

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>All Admissions</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li><a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i
                                            class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>

                        <div class="body">

                            {{-- Search --}}
                            <form method="GET" action="{{ route('admission.index') }}" class="mb-3">
                                <div class="input-group">
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        class="form-control" placeholder="Search student...">
                                    {{-- <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">Search</button>
                                    </div> --}}
                                </div>
                            </form>

                            {{-- Filters --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <select id="filter-course" class="form-control">
                                        <option value="">Filter by Course</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ strtolower($course->title) }}">{{ $course->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select id="filter-batch" class="form-control">
                                        <option value="">Filter by Batch</option>
                                        @foreach ($batches as $batch)
                                            <option value="{{ strtolower($batch->title) }}">{{ $batch->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select id="filter-status" class="form-control">
                                        <option value="">Filter by Status</option>
                                        <option value="active">Active</option>
                                        <option value="unactive">Unactive</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select id="filter-payment" class="form-control">
                                        <option value="">Filter by Payment Type</option>
                                        <option value="full_fee">Full Payment</option>
                                        <option value="installment">Installment</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Table --}}
                            <div class="table-responsive">
                                <table class="table table-hover mb-0" id="admissionTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Course</th>
                                            <th>Batch</th>
                                            <th>Payment</th>
                                            <th>Fee</th>
                                            <th>Status</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($admissions as $admission)
                                            <tr data-status="{{ strtolower($admission->student_status) }}"
                                                data-payment="{{ strtolower($admission->payment_type) }}">
                                                <td>{{ $loop->iteration + ($admissions->currentPage() - 1) * $admissions->perPage() }}
                                                </td>
                                                <td><img src="{{ asset($admission->image ?? 'default-avatar.png') }}"
                                                        width="50" height="50"
                                                        style="border-radius:50%;object-fit:cover;"></td>
                                                <td>{{ $admission->name }}</td>
                                                <td>{{ $admission->course->title ?? '-' }}</td>
                                                <td>{{ $admission->batch->title ?? '-' }}</td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $admission->payment_type === 'full_fee' ? 'success' : 'warning' }}">
                                                        {{ ucfirst($admission->payment_type) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div>₨{{ number_format($admission->full_fee) }}</div>
                                                    @if ($admission->payment_type === 'installment')
                                                        <small class="text-muted">
                                                            @if ($admission->installment_1 > 0)
                                                                1st: {{ $admission->installment_1 }}
                                                            @endif

                                                            @if ($admission->installment_2 > 0)
                                                                | 2nd: {{ $admission->installment_2 }}
                                                            @endif

                                                            @if ($admission->installment_3 > 0)
                                                                | 3rd: {{ $admission->installment_3 }}
                                                            @endif
                                                        </small>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $admission->student_status === 'active' ? 'success' : 'secondary' }}">
                                                        {{ ucfirst($admission->student_status) }}
                                                    </span>
                                                </td>
                                                {{-- <td>@include('admin.pages.dashboard.admission.button')</td> --}}
                                                <td class="text-nowrap">
                                                    <div class="d-flex align-items-center" style="column-gap: 5px;">
                                                        {{-- Fee Submit --}}
                                                        <a href="{{ route('fee-submission.create', $admission->id) }}"
                                                            class="btn btn-sm btn-icon btn-pure btn-default on-default button-view"
                                                            data-toggle="tooltip" data-original-title="Submit Fee">
                                                            <i class="fas fa-money-check-alt"></i>
                                                        </a>

                                                        <!-- View Button -->
                                                        <a href="{{ route('admission.show', $admission->id) }}"
                                                            class="btn btn-sm btn-icon btn-pure btn-default on-default button-view"
                                                            data-toggle="tooltip" data-original-title="View">
                                                            <i class="icon-eye" aria-hidden="true"></i>
                                                        </a>

                                                        <!-- Edit Button -->
                                                        <a href="{{ route('admission.edit', $admission->id) }}"
                                                            class="btn btn-sm btn-icon btn-pure btn-default on-default button-edit"
                                                            data-toggle="tooltip" data-original-title="Edit">
                                                            <i class="icon-pencil" aria-hidden="true"></i>
                                                        </a>

                                                        <!-- Delete Button -->
                                                        <form action="{{ route('admission.destroy', $admission->id) }}"
                                                            method="POST" onsubmit="return confirm('Are you sure?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-icon btn-pure btn-default on-default button-remove"
                                                                data-toggle="tooltip" data-original-title="Remove">
                                                                <i class="icon-trash" aria-hidden="true"></i>
                                                            </button>
                                                    </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center text-muted">No admissions found.
                                                </td>
                                            </tr>
                                        @endforelse
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
            const tableRows = document.querySelectorAll("#admissionTable tbody tr");

            const searchInput = document.querySelector("input[name='search']");
            const courseFilter = document.getElementById("filter-course");
            const batchFilter = document.getElementById("filter-batch");
            const statusFilter = document.getElementById("filter-status");
            const paymentFilter = document.getElementById("filter-payment");

            // 🔹 Main function to check visibility
            function applyFilters() {
                let search = searchInput ? searchInput.value.toLowerCase() : "";
                let course = courseFilter.value.toLowerCase();
                let batch = batchFilter.value.toLowerCase();
                let status = statusFilter.value.toLowerCase();
                let payment = paymentFilter.value.toLowerCase();

                tableRows.forEach(function(row) {
                    let rowText = row.innerText.toLowerCase();
                    let courseCol = row.cells[3].innerText.toLowerCase();
                    let batchCol = row.cells[4].innerText.toLowerCase();
                    let statusCol = row.getAttribute("data-status");
                    let paymentCol = row.getAttribute("data-payment");

                    let visible =
                        (!search || rowText.includes(search)) &&
                        (!course || courseCol.includes(course)) &&
                        (!batch || batchCol.includes(batch)) &&
                        (!status || statusCol === status) &&
                        (!payment || paymentCol === payment);

                    row.style.display = visible ? "" : "none";
                });
            }

            // 🔹 Attach events
            if (searchInput) searchInput.addEventListener("keyup", applyFilters);
            [courseFilter, batchFilter, statusFilter, paymentFilter].forEach(el => {
                el.addEventListener("change", applyFilters);
            });
        });
    </script>
@endsection
