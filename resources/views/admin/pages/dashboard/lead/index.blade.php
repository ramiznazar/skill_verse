@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Leads</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('lead.create') }}" class="btn btn-sm btn-primary" title="">Create New</a>
                </div>
            </div>
        </div>
        {{-- Store --}}
        @if (session('store'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('store') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        {{-- Delete --}}
        @if (session('delete'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('delete') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        {{-- Update --}}
        @if (session('update'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('update') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>All Leads</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i
                                            class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">

                                <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Course</th>
                                            <th>Lead Type</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($leads as $lead)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $lead->name }}</td>
                                                <td>{{ $lead->course->title ?? '-' }}</td>
                                                <td>{{ $lead->lead_type }}</td>
                                                <td>{{ $lead->phone }}</td>
                                                <td>{{ $lead->email }}</td>
                                                <td>{{ $lead->address }}</td>

                                                <td class="text-nowrap">
                                                    <div class="d-flex align-items-center" style="column-gap: 5px;">
                                                        <!-- Move to Admission -->
                                                        <a href="{{ route('admission.create', ['lead_id' => $lead->id]) }}"
                                                            class="btn btn-sm btn-icon btn-pure btn-success"
                                                            data-toggle="tooltip" title="Convert to Admission">
                                                            <i class="fas fa-user-plus"></i>
                                                        </a>
                                                        
                                                        <!-- Edit Button -->
                                                        <a href="{{ route('lead.edit', $lead->id) }}"
                                                            class="btn btn-sm btn-icon btn-pure btn-default on-default button-edit"
                                                            data-toggle="tooltip" data-original-title="Edit">
                                                            <i class="icon-pencil" aria-hidden="true"></i>
                                                        </a>

                                                        <!-- Delete Button -->
                                                        <form action="{{ route('lead.destroy', $lead->id) }}"
                                                            method="POST" onsubmit="return confirm('Are you sure?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-icon btn-pure btn-default on-default button-remove"
                                                                data-toggle="tooltip" data-original-title="Remove">
                                                                <i class="icon-trash" aria-hidden="true"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center text-muted">No leads found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

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
        $('.sparkbar').sparkline('html', {
            type: 'bar'
        });
    </script>
@endsection
