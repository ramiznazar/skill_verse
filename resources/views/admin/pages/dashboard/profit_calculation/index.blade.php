@extends('admin.layouts.main')

@section('content')
<div id="main-content">
  <div class="block-header">
    <div class="row clearfix">
      <div class="col-md-6"><h2>Monthly Profits</h2></div>
      <div class="col-md-6 text-right">
        <form method="POST" action="{{ route('admin.dashboard.profit.calculateThisMonth') }}">
          @csrf
          <button class="btn btn-sm btn-success">Calculate This Month</button>
        </form>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="card">
      <div class="body table-responsive">
        @if(session('store'))<div class="alert alert-success">{{ session('store') }}</div>@endif
        <table class="table table-hover">
          <thead>
            <tr><th>#</th><th>Month</th><th>Income</th><th>Expense</th><th>Net Profit</th><th>Actions</th></tr>
          </thead>
          <tbody>
            @forelse($profits as $p)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->month }}/{{ $p->year }}</td>
                <td>Rs. {{ number_format($p->total_income,2) }}</td>
                <td>Rs. {{ number_format($p->total_expense,2) }}</td>
                <td>Rs. {{ number_format($p->net_profit,2) }}</td>
                <td>
                  <a href="{{ route('admin.dashboard.partner-profits.distribute', $p->id) }}" class="btn btn-sm btn-primary">Distribute</a>
                </td>
              </tr>
            @empty
              <tr><td colspan="6" class="text-center">No profit records.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
