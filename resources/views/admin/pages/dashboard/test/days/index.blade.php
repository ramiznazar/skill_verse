@extends('admin.layouts.main')

@section('content')
<div id="main-content">

    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Interview Days</h2>
            </div>

            <div class="col-md-6 col-sm-12 text-right">
                <a href="{{ route('test.days.create') }}" class="btn btn-primary btn-sm">Add New Day</a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">

                <div class="card">
                    <div class="header">
                        <h2>All Interview Days</h2>
                    </div>

                    <div class="body">
                        <div class="table-responsive">
                                <table class="table m-b-0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Slots Summary</th>
                                        <th>Status</th>
                                        <th>Note</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($days as $day)
                                        @php
                                            $slots = json_decode($day->slots, true);
                                        @endphp
                                        

                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <td>
                                                <strong>{{ $day->test_date }}</strong>
                                            </td>

                                            <td>
                                                {{-- If no slots --}}
                                                @if(!$slots || count($slots) == 0)
                                                    <span class="badge badge-secondary">No Slots</span>
                                                @else
                                                    @foreach ($slots as $slot)
                                                        <div class="mb-1">
                                                            <span class="badge badge-info">
                                                                {{ $slot['time'] }}
                                                            </span>

                                                            <span class="badge badge-primary">
                                                                {{ $slot['booked'] }}/{{ $slot['capacity'] }}
                                                            </span>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </td>

                                            <td>
                                                @if($day->is_open)
                                                    <span class="badge badge-success">Open</span>
                                                @else
                                                    <span class="badge badge-danger">Closed</span>
                                                @endif
                                            </td>

                                            <td>{{ $day->note ?? '-' }}</td>

                                            <td>
                                                <a href="{{ route('test.days.edit', $day->id) }}" 
                                                   class="btn btn-sm btn-info">
                                                   <i class="icon-pencil"></i>
                                                </a>

                                                <form action="{{ route('test.days.delete', $day->id) }}"
                                                      method="POST"
                                                      style="display:inline-block;"
                                                      onsubmit="return confirm('Are you sure?')">

                                                    @csrf @method('DELETE')

                                                    <button class="btn btn-sm btn-danger">
                                                        <i class="icon-trash"></i>
                                                    </button>

                                                </form>
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
