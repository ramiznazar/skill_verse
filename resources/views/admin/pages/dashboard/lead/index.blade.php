@extends('admin.layouts.main')

@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Leads</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('lead.create') }}" class="btn btn-sm btn-primary">Create New</a>
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
                            <h2>All Leads</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li><a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i
                                            class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>

                        <div class="body">

                            {{-- 🔎 Search + 🔽 Filters --}}
                            <form method="GET" action="{{ route('lead.index') }}" id="filterForm" class="mb-3">
                                <div class="input-group mb-2">
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        class="form-control" placeholder="Search by name, phone, address..."
                                        autocomplete="off">
                                </div>

                                <div class="row" style="margin-top: 15px;">
                                    {{-- Course --}}
                                    <div class="col-md-3 mb-2">
                                        <select name="course_id" class="form-control">
                                            <option value="">Filter by Course</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}"
                                                    {{ (string) request('course_id') === (string) $course->id ? 'selected' : '' }}>
                                                    {{ $course->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Lead Type --}}
                                    <div class="col-md-3 mb-2">
                                        <select name="lead_type" class="form-control">
                                            <option value="">All Lead Types</option>
                                            <option value="admin" {{ request('lead_type') === 'admin' ? 'selected' : '' }}>
                                                Admin</option>
                                            <option value="website"
                                                {{ request('lead_type') === 'website' ? 'selected' : '' }}>Website</option>
                                        </select>
                                    </div>

                                    {{-- Referral Type --}}
                                    <div class="col-md-3 mb-2">
                                        <select name="referral_type" class="form-control">
                                            <option value="">All Referral Types</option>
                                            <option value="ads"
                                                {{ request('referral_type') === 'ads' ? 'selected' : '' }}>Ads</option>
                                            <option value="referral"
                                                {{ request('referral_type') === 'referral' ? 'selected' : '' }}>Referral
                                            </option>
                                            <option value="other"
                                                {{ request('referral_type') === 'other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>

                                    {{-- Status --}}
                                    <div class="col-md-3 mb-2">
                                        <select name="status" class="form-control">
                                            <option value="">All Status</option>
                                            <option value="new" {{ request('status') === 'new' ? 'selected' : '' }}>New
                                            </option>
                                            <option value="contacted"
                                                {{ request('status') === 'contacted' ? 'selected' : '' }}>Contacted
                                            </option>
                                            <option value="converted"
                                                {{ request('status') === 'converted' ? 'selected' : '' }}>Converted
                                            </option>
                                            <option value="lost" {{ request('status') === 'lost' ? 'selected' : '' }}>
                                                Lost</option>
                                            <option value="interested"
                                                {{ request('status') === 'interested' ? 'selected' : '' }}>Interested
                                            </option>
                                            <option value="not_interested"
                                                {{ request('status') === 'not_interested' ? 'selected' : '' }}>Not
                                                Interested</option>
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
                                            <th>Name</th>
                                            <th>Course</th>
                                            <th>Lead Type</th>
                                            <th>Phone</th>
                                            <th>Referral Type</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($leads as $lead)
                                            <tr>
                                                <td>{{ $loop->iteration + ($leads->currentPage() - 1) * $leads->perPage() }}
                                                </td>
                                                <td>{{ $lead->name }}</td>
                                                <td>{{ $lead->course->title ?? '-' }}</td>

                                                <td><span
                                                        class="badge badge-primary">{{ ucfirst($lead->lead_type) }}</span>
                                                </td>
                                                <td>{{ $lead->phone }}</td>
                                                <td><span
                                                        class="badge badge-info">{{ ucfirst($lead->referral_type) }}</span>
                                                </td>
                                                <td>{{ $lead->address }}</td>

                                                {{-- Status --}}
                                                <td>
                                                    @switch($lead->status)
                                                        @case('new')
                                                            <span class="badge badge-secondary">New</span>
                                                        @break

                                                        @case('contacted')
                                                            <span class="badge badge-warning">Contacted</span>
                                                        @break

                                                        @case('converted')
                                                            <span class="badge badge-success">Converted</span>
                                                        @break

                                                        @case('lost')
                                                            <span class="badge badge-danger">Lost</span>
                                                        @break

                                                        @case('interested')
                                                            <span class="badge badge-info">Interested</span>
                                                        @break

                                                        @case('not_interested')
                                                            <span class="badge badge-dark">Not Interested</span>
                                                        @break

                                                        @default
                                                            <span class="badge badge-light">-</span>
                                                    @endswitch
                                                </td>

                                                <td class="text-nowrap">
                                                    <div class="d-flex align-items-center" style="column-gap: 5px;">

                                                        <a href="{{ route('lead-followups.index', $lead->id) }}"
                                                            class="btn btn-sm btn-icon btn-pure btn-info"
                                                            title="Follow-ups">
                                                            <i class="fas fa-comments"></i>
                                                        </a>
                                                        <a href="{{ route('admission.create', ['lead_id' => $lead->id]) }}"
                                                            class="btn btn-sm btn-icon btn-pure btn-success"
                                                            data-toggle="tooltip" title="Convert to Admission">
                                                            <i class="fas fa-user-plus"></i>
                                                        </a>
                                                        <a href="{{ route('lead.edit', $lead->id) }}"
                                                            class="btn btn-sm btn-icon btn-pure btn-default"
                                                            data-toggle="tooltip" data-original-title="Edit">
                                                            <i class="icon-pencil"></i>
                                                        </a>
                                                        <form action="{{ route('lead.destroy', $lead->id) }}"
                                                            method="POST" onsubmit="return confirm('Are you sure?')">
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
                                                    <td colspan="9" class="text-center text-muted">No leads found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                {{-- 📑 Pagination --}}
                                <div class="mt-3">
                                    {{ $leads->links('pagination::bootstrap-4') }}
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
            document.addEventListener('DOMContentLoaded', function() {
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
