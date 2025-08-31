@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Follow-ups • {{ $lead->name }} @if ($lead->course)
                            <small class="text-muted">({{ $lead->course->title }})</small>
                        @endif
                    </h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('lead-followups.create', $lead->id) }}" class="btn btn-sm btn-primary">Create New</a>
                    <a href="{{ route('lead.index') }}" class="btn btn-sm btn-secondary">All Leads</a>
                </div>
            </div>
        </div>

        {{-- flashes --}}
        @foreach (['store' => 'success', 'update' => 'warning', 'delete' => 'danger'] as $key => $type)
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
                            <h2>Follow-ups ({{ $followUps->total() }})</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table m-b-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>When</th>
                                            <th>Method</th>
                                            <th>Status</th>
                                            <th>Note</th>
                                            <th>By</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($followUps as $i => $fu)
                                            <tr>
                                                <td>{{ $followUps->firstItem() + $i }}</td>
                                                <td>{{ optional($fu->followed_at)->format('d M Y, h:i A') ?? '-' }}</td>
                                                <td>{{ $fu->contact_method === 'in_person' ? 'In-person' : ucfirst(str_replace('_', ' ', $fu->contact_method ?? '-')) }}
                                                </td>
                                                <td>{{ $fu->status ? ucwords(str_replace('_', ' ', $fu->status)) : '-' }}
                                                </td>
                                                <td style="max-width:480px; white-space:normal;">{{ $fu->note ?? '-' }}
                                                </td>
                                                <td>{{ $fu->user->name ?? '-' }}</td>
                                                <td class="text-nowrap">
                                                    <a href="{{ route('lead-followups.edit', [$lead->id, $fu->id]) }}"
                                                        class="btn btn-sm btn-icon btn-pure btn-default" title="Edit">
                                                        <i class="icon-pencil"></i>
                                                    </a>
                                                    <form
                                                        action="{{ route('lead-followups.destroy', [$lead->id, $fu->id]) }}"
                                                        method="POST" style="display:inline"
                                                        onsubmit="return confirm('Delete this follow-up?')">
                                                        @csrf @method('DELETE')
                                                        <button class="btn btn-sm btn-icon btn-pure btn-default"
                                                            title="Delete">
                                                            <i class="icon-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">No follow-ups yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3">
                                {{ $followUps->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
