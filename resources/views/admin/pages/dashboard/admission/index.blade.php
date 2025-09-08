@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Student Admissions</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('admission.create') }}" class="btn btn-sm btn-primary" title="">Create New</a>
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
                            <h2>All Admissions</h2>
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
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Course</th>
                                            <th>Batch</th>
                                            <th>Payment</th>
                                            <th>Fee</th>
                                            <th>Status</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @forelse($admissions as $admission)
                                            <tr>
                                                <td>{{ $loop->remaining + 1 }}</td>


                                                {{-- Image --}}
                                                <td>
                                                    <img src="{{ asset($admission->image ?? 'default-avatar.png') }}"
                                                        width="50" height="50"
                                                        style="border-radius: 50%; object-fit: cover;">
                                                </td>
                                                <td>{{ $admission->name }}</td>
                                                <td>{{ $admission->course->title ?? '-' }}</td>
                                                <td>{{ $admission->batch->title ?? '-' }}</td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $admission->payment_type === 'full_fee' ? 'success' : 'warning' }}">
                                                        {{ ucfirst($admission->payment_type) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div>Fee: ₨{{ number_format($admission->full_fee) }}</div>
                                                    @if ($admission->payment_type === 'installment')
                                                        <div style="font-size: 12px; color: #666;">
                                                            1st: {{ $admission->installment_1 }}<br>
                                                            2nd: {{ $admission->installment_2 }}<br>
                                                            3rd: {{ $admission->installment_3 }}
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $admission->student_status === 'active' ? 'success' : 'secondary' }}">
                                                        {{ ucfirst($admission->student_status) }}
                                                    </span>
                                                </td>

                                                {{-- Options --}}
                                                <td class="text-nowrap">
                                                    <div class="d-flex align-items-center" style="column-gap: 5px;">
                                                        {{-- Fee Submit --}}
                                                        <a href="{{ route('fee-submission.create', $admission->id) }}"
                                                            class="btn btn-sm btn-icon btn-pure btn-default on-default button-view"
                                                            data-toggle="tooltip" data-original-title="Submit Fee">
                                                            <i class="fas fa-money-check-alt"></i>
                                                        </a>

                                                        <!-- Edit Button -->
                                                        <a href="{{ route('admission.edit', $admission->id) }}"
                                                            class="btn btn-sm btn-icon btn-pure btn-default on-default button-edit"
                                                            data-toggle="tooltip" data-original-title="Edit">
                                                            <i class="icon-pencil" aria-hidden="true"></i>
                                                        </a>

                                                        <!-- Delete Button -->
                                                        <form action="{{ route('admission.destroy', $admission->id) }}"
                                                            method="POST" onsubmit="return confirm('Are you sure?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-icon btn-pure btn-default on-default button-remove"
                                                                data-toggle="tooltip" data-original-title="Remove">
                                                                <i class="icon-trash" aria-hidden="true"></i>
                                                            </button>
                                                    </div>
                                                    </form>
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
