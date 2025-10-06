{{-- resources/views/admin/notifications/show.blade.php --}}
@extends('admin.layouts.main')

@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Notification Details</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('admin.notifications.table') }}" class="btn btn-sm btn-secondary">← Back to List</a>
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

                    {{-- Top card: notification meta --}}
                    <div class="card mb-3">
                        <div class="header d-flex justify-content-between align-items-center">
                            <h2 class="mb-0">Overview</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li><a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>

                        <div class="body">
                            <div class="d-flex align-items-start">
                                <div class="mr-3" style="font-size:28px;">
                                    <i class="{{ $notification->icon ?: 'fa fa-bell' }}"></i>
                                </div>
                                <div class="flex-fill">
                                    <div class="mb-2">
                                        <span class="badge badge-secondary">{{ ucfirst($notification->type) }}</span>
                                        <span class="badge badge-{{ $notification->status ? 'success' : 'dark' }}">{{ $notification->status ? 'Active' : 'Inactive' }}</span>
                                    </div>

                                    <h5 class="mb-1">{{ $notification->title }}</h5>

                                    @if($notification->message)
                                        <p class="mb-2">{{ $notification->message }}</p>
                                    @endif

                                    <div class="text-muted small">
                                        <span>Created: {{ $notification->created_at->format('d M Y, h:i A') }}</span>
                                        @if($notification->updated_at)
                                            <span class="ml-3">Updated: {{ $notification->updated_at->format('d M Y, h:i A') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Recipients table --}}
                    <div class="card">
                        <div class="header d-flex justify-content-between align-items-center">
                            <h2 class="mb-0">Recipients</h2>
                            {{-- (Optional) quick legend --}}
                            <div class="small">
                                <span class="badge badge-warning">Unread</span>
                                <span class="badge badge-success">Read</span>
                            </div>
                        </div>

                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Assigned</th>
                                            <th>Last Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recipients as $idx => $u)
                                            <tr>
                                                <td>{{ ($recipients->currentPage() - 1) * $recipients->perPage() + $idx + 1 }}</td>
                                                <td>{{ $u->name }}</td>
                                                <td>{{ $u->email }}</td>
                                                <td>
                                                    @if($u->is_read)
                                                        <span class="badge badge-success">Read</span>
                                                    @else
                                                        <span class="badge badge-warning">Unread</span>
                                                    @endif
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($u->assigned_at)->format('d M Y, h:i A') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($u->last_action_at)->format('d M Y, h:i A') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">No recipients found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            @if($recipients->hasPages())
                                <div class="mt-3">
                                    {{ $recipients->links('pagination::bootstrap-4') }}
                                </div>
                            @endif
                        </div>
                    </div>

                </div> {{-- /.col --}}
            </div>
        </div>
    </div>
@endsection
