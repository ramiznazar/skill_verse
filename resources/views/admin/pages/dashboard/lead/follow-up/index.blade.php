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
                                <div class="timeline">
                                    @forelse ($followUps as $fu)
                                        <div class="timeline-item mb-4 p-3 border rounded shadow-sm">
                                            <div class="d-flex justify-content-between">
                                                <strong>{{ optional($fu->followed_at)->format('d M Y, h:i A') ?? '-' }}</strong>
                                                <span
                                                    class="badge badge-{{ $fu->status === 'interested' ? 'info' : ($fu->status === 'not_interested' ? 'dark' : ($fu->status === 'converted' ? 'success' : ($fu->status === 'lost' ? 'danger' : 'secondary'))) }}">
                                                    {{ ucwords(str_replace('_', ' ', $fu->status)) }}
                                                </span>
                                            </div>
                                            <div class="mt-2">
                                                <span
                                                    class="badge badge-primary">{{ ucfirst(str_replace('_', ' ', $fu->contact_method)) }}</span>
                                                <p class="mt-2 mb-1">{{ $fu->note ?? '-' }}</p>
                                                <small class="text-muted">By: {{ $fu->user->name ?? '-' }}</small>
                                            </div>
                                            <div class="mt-2 d-flex">
                                                <a href="{{ route('lead-followups.edit', [$lead->id, $fu->id]) }}"
                                                    class="btn btn-sm btn-outline-warning mr-2">Edit</a>
                                                <form action="{{ route('lead-followups.destroy', [$lead->id, $fu->id]) }}"
                                                    method="POST" onsubmit="return confirm('Delete this follow-up?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-muted">No follow-ups yet.</p>
                                    @endforelse
                                </div>

                                {{-- Pagination --}}
                                <div class="mt-3">
                                    {{ $followUps->links('pagination::bootstrap-4') }}
                                </div>

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
