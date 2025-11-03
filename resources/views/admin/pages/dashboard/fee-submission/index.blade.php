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
                            {{-- Search --}}
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
                                        <select name="student_status" id="filter-student-status" class="form-control">
                                            <option value="">All Student Status</option>
                                            <option value="active"
                                                {{ request('student_status') === 'active' ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="unactive"
                                                {{ request('student_status') === 'unactive' ? 'selected' : '' }}>Unactive
                                            </option>
                                            <option value="completed"
                                                {{ request('student_status') === 'completed' ? 'selected' : '' }}>Completed
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-9 mb-2">
                                        <input type="month" name="month" value="{{ request('month') }}"
                                            class="form-control">
                                    </div>

                                    <div class="col-md-3 text-right mb-2 ml-auto">
                                        <a href="{{ route('fee-submission.index') }}" class="btn btn-warning"
                                            style="width:220px;">
                                            Reset
                                        </a>
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
                                            <th>Student Status</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($admissions as $admission)
                                            @php
                                                // prepare course-wise data arrays
                                                $courseTitles = [];
                                                $feeTypes = [];
                                                $statuses = [];

                                                if ($admission->courses && $admission->courses->count() > 0) {
                                                    foreach ($admission->courses as $course) {
                                                        // 🧮 Calculate the real total fee correctly (fixes installment issue)
                                                        $installmentTotal = collect([
                                                            $course->pivot->installment_1,
                                                            $course->pivot->installment_2,
                                                            $course->pivot->installment_3,
                                                            $course->pivot->installment_4,
                                                        ])
                                                            ->filter()
                                                            ->sum();

                                                        // ✅ Use the total of installments if present, otherwise use course_fee or full_fee
                                                        $fee =
                                                            $installmentTotal > 0
                                                                ? $installmentTotal
                                                                : ($course->pivot->course_fee ?:
                                                                $admission->full_fee);

                                                        $type =
                                                            $course->pivot->payment_type ?? $admission->payment_type;

                                                        // ✅ Find all payments submitted for this course
                                                        $paidInstallments = $admission->feeSubmissions
                                                            ->where('course_id', $course->id)
                                                            ->pluck('payment_type')
                                                            ->toArray();

                                                        // ✅ Determine expected installments for this course
                                                        $installmentFields = [
                                                            'installment_1',
                                                            'installment_2',
                                                            'installment_3',
                                                            'installment_4',
                                                        ];
                                                        $expected = [];
                                                        foreach ($installmentFields as $field) {
                                                            if (
                                                                !empty($course->pivot->$field) &&
                                                                $course->pivot->$field > 0
                                                            ) {
                                                                $expected[] = $field;
                                                            }
                                                        }

                                                        // ✅ Determine per-course fee status
                                                        if ($type === 'full_fee') {
                                                            $courseStatus = !empty($paidInstallments)
                                                                ? 'complete'
                                                                : 'pending';
                                                        } else {
                                                            if (count($expected) === 0) {
                                                                $courseStatus = 'pending';
                                                            } else {
                                                                $paidCount = count(
                                                                    array_intersect($expected, $paidInstallments),
                                                                );
                                                                $allPaid = $paidCount === count($expected);
                                                                $nonePaid = $paidCount === 0;

                                                                if ($allPaid) {
                                                                    $courseStatus = 'complete';
                                                                } elseif ($nonePaid) {
                                                                    $courseStatus = 'pending';
                                                                } else {
                                                                    $courseStatus = 'uncomplete';
                                                                }
                                                            }
                                                        }

                                                        // 🏷️ Course name + correct fee
                                                        $courseTitles[] =
                                                            "<div><span class='text-dark'>{$course->title}</span> 
        <small class='text-muted'>(₨" .
                                                            number_format($fee) .
                                                            ')</small></div>';

                                                        // 💰 Fee Type label
                                                        $feeTypes[] =
                                                            "<div><span class='badge badge-" .
                                                            ($type === 'full_fee' ? 'success' : 'warning') .
                                                            "'>" .
                                                            ucfirst($type) .
                                                            '</span></div>';

                                                        // Course-specific Status label
                                                        $statuses[] =
                                                            "<div><span class='badge badge-" .
                                                            ($courseStatus === 'complete'
                                                                ? 'success'
                                                                : ($courseStatus === 'pending'
                                                                    ? 'danger'
                                                                    : 'warning')) .
                                                            "'>" .
                                                            ucfirst($courseStatus) .
                                                            '</span></div>';
                                                    }
                                                } elseif (isset($admission->course)) {
                                                    // fallback for single course admission
                                                    $courseTitles[] =
                                                        "<div><span class='text-primary'>{$admission->course->title}</span> <small class='text-muted'>(₨" .
                                                        number_format($admission->full_fee) .
                                                        ')</small></div>';
                                                    $feeTypes[] =
                                                        "<div><span class='badge badge-" .
                                                        ($admission->payment_type === 'full_fee'
                                                            ? 'success'
                                                            : 'warning') .
                                                        "'>" .
                                                        ucfirst($admission->payment_type) .
                                                        '</span></div>';
                                                    $statuses[] =
                                                        "<div><span class='badge badge-" .
                                                        ($admission->fee_status === 'complete'
                                                            ? 'success'
                                                            : ($admission->fee_status === 'pending'
                                                                ? 'danger'
                                                                : 'warning')) .
                                                        "'>" .
                                                        ucfirst($admission->fee_status) .
                                                        '</span></div>';
                                                } else {
                                                    $courseTitles[] =
                                                        "<div><small class='text-muted'>No course</small></div>";
                                                    $feeTypes[] = '<div>-</div>';
                                                    $statuses[] = '<div>-</div>';
                                                }
                                            @endphp


                                            <tr data-status="{{ strtolower($admission->fee_status) }}"
                                                data-payment="{{ strtolower($admission->payment_type) }}"
                                                data-course="{{ strtolower(strip_tags(implode(', ', $courseTitles))) }}">
                                                <td>{{ $loop->iteration + ($admissions->currentPage() - 1) * $admissions->perPage() }}
                                                </td>
                                                <td>{{ $admission->name }}</td>

                                                {{-- 📘 Courses --}}
                                                <td>{!! implode('', $courseTitles) !!}</td>

                                                {{-- 💰 Fee Type --}}
                                                <td style="line-height: 1.9; font-size: 13px;">{!! implode('', $feeTypes) !!}</td>

                                                {{-- 📊 Status --}}
                                                {{-- <td style="line-height: 1.9; font-size: 13px;">{!! implode('', $statuses) !!}</td> --}}
                                                {{-- 📊 Status --}}
                                                <td>
                                                    @php
                                                        $status = strtolower($admission->fee_status);
                                                        $badgeClass = match ($status) {
                                                            'complete' => 'success',
                                                            'uncomplete' => 'warning',
                                                            'pending' => 'danger',
                                                            default => 'secondary',
                                                        };
                                                    @endphp

                                                    <span class="badge badge-{{ $badgeClass }}">
                                                        {{ ucfirst($status) }}
                                                    </span>
                                                </td>

                                                <td>
                                                    @php
                                                        switch ($admission->student_status) {
                                                            case 'active':
                                                                $badge = 'success'; // green
                                                                break;
                                                            case 'completed':
                                                                $badge = 'info'; // blue
                                                                break;
                                                            default:
                                                                $badge = 'secondary'; // gray for unactive
                                                        }
                                                    @endphp

                                                    <span class="badge badge-{{ $badge }}">
                                                        {{ ucfirst($admission->student_status) }}
                                                    </span>
                                                </td>
                                                {{-- ⚙️ Actions --}}
                                                <td>
                                                    @if ($admission->payment_type === 'installment')
                                                        <button class="btn btn-sm btn-info toggle-installments">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    @endif
                                                    @include('admin.pages.dashboard.fee-submission.button')
                                                </td>
                                            </tr>

                                            {{-- Hidden Installment Details (unchanged logic) --}}
                                            @if (
                                                $admission->payment_type === 'installment' ||
                                                    $admission->courses->where('pivot.payment_type', 'installment')->count() > 0)
                                                @php
                                                    // gather all course installments (if multiple)
                                                    $installmentGroups = [];

                                                    if ($admission->courses && $admission->courses->count() > 0) {
                                                        foreach ($admission->courses as $course) {
                                                            $type =
                                                                $course->pivot->payment_type ??
                                                                $admission->payment_type;
                                                            if ($type !== 'installment') {
                                                                continue;
                                                            }

                                                            $fee = $course->pivot->course_fee ?? $admission->full_fee;
                                                            $paid = $admission->feeSubmissions
                                                                ->where('course_id', $course->id)
                                                                ->pluck('payment_type')
                                                                ->toArray();

                                                            $installments = [];
                                                            foreach (range(1, 4) as $n) {
                                                                $field = "installment_$n";
                                                                if (
                                                                    !empty($course->pivot->$field) &&
                                                                    $course->pivot->$field > 0
                                                                ) {
                                                                    $label =
                                                                        $n === 1
                                                                            ? '1st Installment'
                                                                            : ($n === 2
                                                                                ? '2nd Installment'
                                                                                : ($n === 3
                                                                                    ? '3rd Installment'
                                                                                    : "{$n}th Installment"));
                                                                    $installments[] = [
                                                                        'label' => $label,
                                                                        'amount' => $course->pivot->$field,
                                                                        'key' => $field,
                                                                    ];
                                                                }
                                                            }

                                                            $installmentGroups[] = [
                                                                'course' => $course->title,
                                                                'fee' => $fee,
                                                                'installments' => $installments,
                                                                'paid' => $paid,
                                                            ];
                                                        }
                                                    } else {
                                                        // fallback for single course
                                                        $paid = $admission->feeSubmissions
                                                            ->pluck('payment_type')
                                                            ->toArray();
                                                        $installments = [];
                                                        foreach (range(1, 4) as $n) {
                                                            $field = "installment_$n";
                                                            if (!empty($admission->$field) && $admission->$field > 0) {
                                                                $label =
                                                                    $n === 1
                                                                        ? '1st Installment'
                                                                        : ($n === 2
                                                                            ? '2nd Installment'
                                                                            : ($n === 3
                                                                                ? '3rd Installment'
                                                                                : "{$n}th Installment"));
                                                                $installments[] = [
                                                                    'label' => $label,
                                                                    'amount' => $admission->$field,
                                                                    'key' => $field,
                                                                ];
                                                            }
                                                        }

                                                        $installmentGroups[] = [
                                                            'course' =>
                                                                optional($admission->course)->title ?? 'Course Fee',
                                                            'fee' => $admission->full_fee,
                                                            'installments' => $installments,
                                                            'paid' => $paid,
                                                        ];
                                                    }
                                                @endphp

                                                <tr class="installment-details d-none">
                                                    <td colspan="6">
                                                        @foreach ($installmentGroups as $group)
                                                            <div class="mb-3">
                                                                {{-- <h6 class="text-primary mb-2">{{ $group['course'] }}</h6> --}}
                                                                <table class="table table-sm table-bordered mb-0">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Full Fee</th>
                                                                            @foreach ($group['installments'] as $inst)
                                                                                <th>{{ $inst['label'] }}</th>
                                                                            @endforeach
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>₨{{ number_format($group['fee']) }}</td>
                                                                            @foreach ($group['installments'] as $inst)
                                                                                <td>
                                                                                    ₨{{ number_format($inst['amount']) }}<br>
                                                                                    <span
                                                                                        class="badge badge-{{ in_array($inst['key'], $group['paid']) ? 'success' : 'danger' }}">
                                                                                        {{ in_array($inst['key'], $group['paid']) ? 'PAID' : 'UNPAID' }}
                                                                                    </span>
                                                                                </td>
                                                                            @endforeach
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        @endforeach
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
