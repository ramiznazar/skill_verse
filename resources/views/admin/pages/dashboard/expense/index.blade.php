@extends('admin.layouts.main')
@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Expenses</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    @if (Auth::user()->role !== 'partner')
                        <a href="{{ route('expense.create') }}" class="btn btn-sm btn-primary" title="">Create New</a>
                    @endif
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
                            <h2>All Expenses</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i
                                            class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table m-b-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Amount</th>
                                            <th>Type</th>
                                            <th>Category</th>
                                            <th>Date</th>
                                            <th>Purpose</th>
                                            @if (Auth::user()->role !== 'partner')
                                                <th>Actions</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($expenses as $expense)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $expense->title }}</td>
                                                <td>{{ number_format((float) $expense->amount) }}</td>
                                                <td>
                                                    @if ($expense->type === 'essential')
                                                        <span class="badge badge-success">Essential</span>
                                                    @else
                                                        <span class="badge badge-danger">Non-Essential</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($expense->ref_type)
                                                        <span
                                                            class="badge badge-info">{{ ucfirst($expense->ref_type) }}</span>
                                                    @else
                                                        <span class=" badge badge-warning">None</span>
                                                    @endif
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($expense->date)->format('d-M-Y') }}</td>
                                                <td>{{ $expense->purpose }}</td>
                                                @if (Auth::user()->role !== 'partner')
                                                    <td class="actions">
                                                        <div class="d-flex align-items-center" style="column-gap: 5px;">
                                                            <a href="{{ route('expense.edit', $expense->id) }}"
                                                                class="btn btn-sm btn-icon btn-pure btn-default on-default button-edit"
                                                                data-toggle="tooltip" title="Edit">
                                                                <i class="icon-pencil" aria-hidden="true"></i>
                                                            </a>
                                                            <form action="{{ route('expense.destroy', $expense->id) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Are you sure you want to delete this expense?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-icon btn-pure btn-default on-default button-remove"
                                                                    data-toggle="tooltip" title="Remove">
                                                                    <i class="icon-trash" aria-hidden="true"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">No expenses found.</td>
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
