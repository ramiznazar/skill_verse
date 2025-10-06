@extends('admin.layouts.main')

@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Notifications</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    {{-- (Optional) Add button if you ever create notifications manually --}}
                    {{-- <a href="{{ route('admin.notifications.create') }}" class="btn btn-sm btn-primary">Create New</a> --}}
                </div>
            </div>
        </div>

        {{-- Alerts --}}
        @foreach (['store' => 'success', 'delete' => 'danger', 'update' => 'warning', 'status' => 'success'] as $key => $type)
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
                            <h2>All Notifications</h2>
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
                            {{-- 🔎 Search + 🔽 Filters (same pattern as Admissions) --}}
                            <form method="GET" action="{{ route('admin.notifications.table') }}" id="filterForm" class="mb-3">
                                <div class="input-group mb-2">
                                    <input type="text"
                                           name="search"
                                           value="{{ $search ?? request('search') }}"
                                           class="form-control"
                                           placeholder="Search title / message / type..."
                                           autocomplete="off">
                                </div>

                                <div class="row" style="margin-top: 15px;">
                                    <div class="col-md-3 mb-2">
                                        <select name="type" class="form-control">
                                            <option value="" {{ ($type ?? request('type')) === '' ? 'selected' : '' }}>All Types</option>
                                            @foreach ($types as $t)
                                                <option value="{{ $t }}"
                                                    {{ (string)($type ?? request('type')) === (string)$t ? 'selected' : '' }}>
                                                    {{ ucfirst($t) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <select name="status" class="form-control">
                                            <option value="" {{ ($status ?? request('status')) === '' ? 'selected' : '' }}>All Status</option>
                                            <option value="1" {{ ($status ?? request('status')) === '1' ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ ($status ?? request('status')) === '0' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <input type="date" name="date_from" class="form-control"
                                               value="{{ $dateFrom ?? request('date_from') }}" placeholder="From">
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <input type="date" name="date_to" class="form-control"
                                               value="{{ $dateTo ?? request('date_to') }}" placeholder="To">
                                    </div>
                                </div>
                            </form>

                            {{-- 📊 Table (mirroring Admissions look & feel) --}}
                            <form method="POST" action="{{ route('admin.notifications.bulkStatus') }}">
                                @csrf

                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th style="width:36px;">
                                                    <input type="checkbox" id="checkAll">
                                                </th>
                                                <th>#</th>
                                                <th>Title & Message</th>
                                                <th>Type</th>
                                                <th>Recipients</th>
                                                <th>Unread</th>
                                                <th>Read</th>
                                                <th>Status</th>
                                                <th>Created</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($notifications as $n)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" name="ids[]" value="{{ $n->id }}" class="row-check">
                                                    </td>
                                                    <td>{{ $loop->iteration + ($notifications->currentPage() - 1) * $notifications->perPage() }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-start">
                                                            <div class="mr-2" style="font-size:18px;">
                                                                <i class="{{ $n->icon ?: 'fa fa-bell' }}"></i>
                                                            </div>
                                                            <div>
                                                                <div class="font-weight-bold">{{ $n->title }}</div>
                                                                <div class="text-muted small text-truncate" style="max-width:420px;">
                                                                    {{ $n->message }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-secondary">{{ ucfirst($n->type) }}</span>
                                                    </td>
                                                    <td>{{ $n->recipients_count }}</td>
                                                    <td>
                                                        @if($n->unread_count > 0)
                                                            <span class="badge badge-warning">{{ $n->unread_count }}</span>
                                                        @else
                                                            <span class="text-muted">0</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $n->read_count }}</td>
                                                    <td>
                                                        <span class="badge badge-{{ $n->status ? 'success' : 'dark' }}">
                                                            {{ $n->status ? 'Active' : 'Inactive' }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $n->created_at->format('d M Y, h:i A') }}</td>
                                                    <td class="text-nowrap">
                                                        <a href="{{ route('admin.notifications.show', $n) }}"
                                                           class="btn btn-sm btn-icon btn-pure btn-default"
                                                           data-toggle="tooltip" data-original-title="View">
                                                            <i class="icon-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="10" class="text-center text-muted">No notifications found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                {{-- 📑 Pagination --}}
                                <div class="mt-3">
                                    {{ $notifications->links('pagination::bootstrap-4') }}
                                </div>

                                {{-- Bulk actions (same page bottom like Admissions style) --}}
                                <div class="d-flex gap-2 mt-3">
                                    <button name="status" value="1" class="btn btn-success btn-sm">Activate</button>
                                    <button name="status" value="0" class="btn btn-dark btn-sm">Deactivate</button>
                                </div>
                            </form>

                        </div> {{-- /.body --}}
                    </div> {{-- /.card --}}
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
    if (search) {
        search.addEventListener('input', () => {
            clearTimeout(t);
            t = setTimeout(() => form.submit(), 500);
        });
    }

    // bulk check
    const checkAll = document.getElementById('checkAll');
    if (checkAll) {
        checkAll.addEventListener('change', function(){
            document.querySelectorAll('.row-check').forEach(cb => cb.checked = this.checked);
        });
    }
});
</script>
@endsection
