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
                        <a href="{{ route('expense.create') }}" class="btn btn-sm btn-primary">Create New</a>
                    @endif
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
            <div class="card">
                <div class="header">
                    <h2>All Expenses</h2>
                </div>
                <div class="body">

                    {{-- 🔎 Filters --}}
                    <form method="GET" action="{{ route('expense.index') }}" id="filterForm" class="mb-3">
                        <div class="input-group mb-2">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                                placeholder="Search expense title or purpose...">
                        </div>

                        <div class="row" style="margin-top:15px;">
                            <div class="col-md-4 mb-2">
                                <input type="month" name="month" value="{{ request('month') }}" class="form-control"
                                    placeholder="Filter by Month">
                            </div>

                            <div class="col-md-4 mb-2">
                                <select name="type" class="form-control">
                                    <option value="">All Types</option>
                                    <option value="essential" {{ request('type') === 'essential' ? 'selected' : '' }}>
                                        Essential</option>
                                    <option value="non-essential"
                                        {{ request('type') === 'non-essential' ? 'selected' : '' }}>Non-Essential</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-2">
                                <select name="ref_type" class="form-control">
                                    <option value="">All Categories</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat }}"
                                            {{ request('ref_type') === $cat ? 'selected' : '' }}>
                                            {{ ucfirst($cat) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>

                    {{-- 💰 Totals --}}
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="alert alert-info mb-0">
                                <strong>Total Expenses:</strong> ₨ {{ number_format($totalExpense) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="alert alert-success mb-0">
                                <strong>Essential Total:</strong> ₨ {{ number_format($essentialTotal) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="alert alert-danger mb-0">
                                <strong>Non-Essential Total:</strong> ₨ {{ number_format($nonEssentialTotal) }}
                            </div>
                        </div>
                    </div>

                    {{-- 📊 Table --}}
                    <div class="table-responsive">
                        <table class="table table-hover m-b-0">
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
                                        <td>{{ $loop->iteration + ($expenses->currentPage() - 1) * $expenses->perPage() }}
                                        </td>
                                        <td>{{ $expense->title }}</td>
                                        <td>₨ {{ number_format($expense->amount) }}</td>
                                        <td>
                                            <span
                                                class="badge badge-{{ $expense->type === 'essential' ? 'success' : 'danger' }}">
                                                {{ ucfirst($expense->type) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($expense->ref_type)
                                                <span class="badge badge-info">{{ ucfirst($expense->ref_type) }}</span>
                                            @else
                                                <span class="badge badge-secondary">N/A</span>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($expense->date)->format('d-M-Y') }}</td>
                                        <td>{{ $expense->purpose }}</td>

                                        @if (Auth::user()->role !== 'partner')
                                            <td>
                                                <div class="d-flex align-items-center" style="column-gap: 5px;">
                                                    <a href="{{ route('expense.edit', $expense->id) }}"
                                                        class="btn btn-sm btn-icon btn-pure btn-default" title="Edit">
                                                        <i class="icon-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('expense.destroy', $expense->id) }}"
                                                        method="POST" onsubmit="return confirm('Are you sure?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-icon btn-pure btn-default" title="Delete">
                                                            <i class="icon-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">No expenses found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- 📑 Pagination --}}
                    <div class="mt-3">
                        {{ $expenses->links('pagination::bootstrap-4') }}
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
            const inputs = form.querySelectorAll('input, select');
            let timeout;

            inputs.forEach(el => {
                el.addEventListener('change', () => form.submit());
                if (el.type === 'text') {
                    el.addEventListener('input', () => {
                        clearTimeout(timeout);
                        timeout = setTimeout(() => form.submit(), 500);
                    });
                }
            });
        });
    </script>
@endsection
