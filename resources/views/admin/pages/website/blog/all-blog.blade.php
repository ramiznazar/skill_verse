@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Blog Posts</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('blog.create') }}" class="btn btn-sm btn-primary" title="">Create New</a>
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
                            <h2>All Blog Lists</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table m-b-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Title & Date</th>
                                            <th>Best For</th>
                                            <th>Duration</th>
                                            <th>Certified</th>
                                            <th>Description</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($blogs as $blog)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><img src="{{ asset($blog->image) }}" width="100" alt=""></td>
                                                <td>
                                                    <strong class="text-info">{{ $blog->title }}</strong> <br>
                                                    <small class="text-muted">{{ $blog->date }}</small>
                                                </td>
                                                <td>{{ $blog->best_for }}</td>
                                                <td>{{ $blog->duration }}</td>
                                                <td>
                                                    @if ($blog->is_certified)
                                                        <span class="badge badge-success">Certified</span>
                                                    @else
                                                        <span class="badge badge-secondary">Not Certified</span>
                                                    @endif
                                                </td>
                                                <td>{{ $blog->description }}</td>
                                                <td class="actions">
                                                    <div class="d-flex align-items-center">
                                                        <!-- Edit Button -->
                                                        <a href="{{ route('blog.edit', $blog->id) }}"
                                                            class="btn btn-sm btn-icon btn-pure btn-default on-default button-edit"
                                                            data-toggle="tooltip" data-original-title="Edit">
                                                            <i class="icon-pencil" aria-hidden="true"></i>
                                                        </a>
                                                        <!-- Delete Button -->
                                                        <form action="{{ route('blog.destroy', $blog->id) }}"
                                                            method="POST" onsubmit="return confirm('Are you sure?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-icon btn-pure btn-default on-default button-remove"
                                                                data-toggle="tooltip" data-original-title="Remove"
                                                                style="margin-left: 6px;">
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
