@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Gallery Images</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('gallary-image.create') }}" class="btn btn-sm btn-primary">Add New Image</a>
                </div>
            </div>
        </div>

        {{-- Success Messages --}}
        @if (session('store'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('store') }}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif

        @if (session('update'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('update') }}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif

        @if (session('delete'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('delete') }}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>All Gallery Images</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li><a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i
                                            class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>

                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Images</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($galleryImages as $image)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $image->gallaryCategory->title ?? '-' }}</td>
                                                <td>
                                                    @if ($image->images && is_array($image->images))
                                                        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                                                            @foreach ($image->images as $img)
                                                                <img src="{{ asset($img) }}" alt="Gallery Image"
                                                                    width="80" height="60"
                                                                    style="object-fit: cover; border: 1px solid #ddd;">
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <span class="text-muted">No images</span>
                                                    @endif

                                                </td>
                                                <td class="actions">
                                                    <div class="d-flex align-items-center">
                                                        <!-- Edit Button -->
                                                        <a href="{{ route('gallary-image.edit', $image->id) }}"
                                                            class="btn btn-sm btn-icon btn-pure btn-default on-default button-edit"
                                                            data-toggle="tooltip" data-original-title="Edit">
                                                            <i class="icon-pencil" aria-hidden="true"></i>
                                                        </a>

                                                        <!-- Delete Button -->
                                                        <form action="{{ route('gallary-image.destroy', $image->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Are you sure to delete this?')">
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


                                @if ($galleryImages->isEmpty())
                                    <p class="text-muted mt-3">No images found.</p>
                                @endif
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
