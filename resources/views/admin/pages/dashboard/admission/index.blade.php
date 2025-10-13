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
                                <li><a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse">
                                        <i class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>

                        <div class="body">

                            {{-- 🔎 Search + 🔽 Filters --}}
                            <form method="GET" action="{{ route('admission.index') }}" id="filterForm" class="mb-3">
                                <div class="input-group mb-2">
                                    <input type="text" name="search" value="{{ request('search') }}"
                                           class="form-control" placeholder="Search student..." autocomplete="off">
                                </div>

                                <div class="row" style="margin-top: 15px;" >
                                    <div class="col-md-3 mb-2">
                                        <select name="course_id" class="form-control">
                                            <option value="">Filter by Course</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}"
                                                    {{ (string)request('course_id') === (string)$course->id ? 'selected' : '' }}>
                                                    {{ $course->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <select name="batch_id" class="form-control">
                                            <option value="">Filter by Batch</option>
                                            @foreach ($batches as $batch)
                                                <option value="{{ $batch->id }}"
                                                    {{ (string)request('batch_id') === (string)$batch->id ? 'selected' : '' }}>
                                                    {{ $batch->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <select name="status" class="form-control">
                                            <option value="all" {{ request('status', 'all') === 'all' ? 'selected' : '' }}>All Student Status</option>
                                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="unactive" {{ request('status') === 'unactive' ? 'selected' : '' }}>Unactive</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <select name="payment" class="form-control">
                                            <option value="" {{ request('payment') ? '' : 'selected' }}>All Payment Types</option>
                                            <option value="full_fee" {{ request('payment') === 'full_fee' ? 'selected' : '' }}>Full Payment</option>
                                            <option value="installment" {{ request('payment') === 'installment' ? 'selected' : '' }}>Installment</option>
                                        </select>
                                    </div>
                                </div>
                            </form>

                            {{-- 📊 Table --}}
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            {{-- <th>Image</th> --}}
                                            <th>Name</th>
                                            <th>Course</th>
                                            <th>Mode</th>
                                            <th>Batch</th>
                                            <th>Payment</th>
                                            <th>Fee</th>
                                            <th>Status</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($admissions as $admission)
                                            <tr>
                                                <td>{{ $loop->iteration + ($admissions->currentPage() - 1) * $admissions->perPage() }}</td>
                                                {{-- <td><img src="{{ asset($admission->image ?? 'default-avatar.png') }}"
                                                         width="50" height="50"
                                                         style="border-radius:50%;object-fit:cover;"></td> --}}
                                                <td>{{ $admission->name }}</td>
                                                <td>{{ $admission->course->title ?? '-' }}</td>
                                                <td>{{ $admission->batch->title ?? '-' }}</td>
                                                 <td>
                                                    <span
                                                        class="badge badge-{{ $admission->mode === 'physical' ? 'success' : 'warning' }}">
                                                        {{ ucfirst($admission->mode) }}
                                                    </span>
                                                </td>
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
                                                <td class="text-nowrap">
                                                    <div class="d-flex align-items-center" style="column-gap: 5px;">
                                                        <a href="{{ route('fee-submission.create', $admission->id) }}"
                                                           class="btn btn-sm btn-icon btn-pure btn-default"
                                                           data-toggle="tooltip" data-original-title="Submit Fee">
                                                            <i class="fas fa-money-check-alt"></i>
                                                        </a>
                                                        <a href="{{ route('admission.show', $admission->id) }}"
                                                           class="btn btn-sm btn-icon btn-pure btn-default"
                                                           data-toggle="tooltip" data-original-title="View">
                                                            <i class="icon-eye"></i>
                                                        </a>
                                                        <a href="{{ route('admission.edit', $admission->id) }}"
                                                           class="btn btn-sm btn-icon btn-pure btn-default"
                                                           data-toggle="tooltip" data-original-title="Edit">
                                                            <i class="icon-pencil"></i>
                                                        </a>
                                                        <form action="{{ route('admission.destroy', $admission->id) }}"
                                                              method="POST"
                                                              onsubmit="return confirm('Are you sure?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    class="btn btn-sm btn-icon btn-pure btn-default"
                                                                    data-toggle="tooltip" data-original-title="Remove">
                                                                <i class="icon-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center text-muted">No admissions found.</td>
                                            </tr>
                                        @endforelse
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
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('filterForm');
    const search = form.querySelector('input[name="search"]');
    const selects = form.querySelectorAll('select');

    // auto-submit on select change
    selects.forEach(sel => sel.addEventListener('change', () => form.submit()));

    // debounce search typing
    let t;
    search && search.addEventListener('input', () => {
        clearTimeout(t);
        t = setTimeout(() => form.submit(), 500);
    });
});
</script>
@endsection
