@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Event Participants</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('event-participant.create', $event->id) }}" class="btn btn-sm btn-primary"
                        title="">Create New</a>
                </div>
            </div>
        </div>

        {{-- Flash Messages --}}
        @if (session('store'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('store') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('delete'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('delete') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

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
                            <h2>All Participants</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table m-b-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Iamge</th>
                                            <th>Name</th>
                                            <th>Post</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($participants as $participant)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><img src="{{ asset($participant->image) }}" width="100"
                                                        alt=""></td>
                                                <td>{{ $participant->name }}</td>
                                                <td>{{ $participant->post }}</td>
                                                <td class="actions">
                                                    <div class="d-flex align-items-center" style="gap: 5px;">
                                                        <!-- Edit Button -->
                                                        <a href="{{ route('event-participant.edit', ['event_id' => $event->id, 'id' => $participant->id]) }}"
                                                            class="btn btn-sm btn-icon btn-pure btn-default on-default button-edit"
                                                            data-toggle="tooltip" data-original-title="Edit">
                                                            <i class="icon-pencil" aria-hidden="true"></i>
                                                        </a>
                                                        <!-- Delete Button -->
                                                        <form
                                                            action="{{ route('event-participant.destroy', $participant->id) }}"
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
                                        @endforeach
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
