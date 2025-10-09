@extends('admin.layouts.main')

@section('content')
<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Lead Details</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <a href="{{ route('lead.index') }}" class="btn btn-sm btn-primary">All Leads</a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="body">

                {{-- Lead Basic Info --}}
                <div class="row mb-4">
                    <div class="col-md-12">
                        <h4 class="mb-2">{{ $lead->name ?? 'N/A' }}</h4>
                        <p><strong>Course:</strong> {{ $lead->course->title ?? 'N/A' }}</p>
                        <p><strong>Lead Type:</strong> {{ ucfirst($lead->lead_type ?? '-') }}</p>
                        <p><strong>Status:</strong> 
                            <span class="badge 
                                @switch($lead->status)
                                    @case('new') badge-secondary @break
                                    @case('contacted') badge-warning @break
                                    @case('converted') badge-success @break
                                    @case('lost') badge-danger @break
                                    @case('interested') badge-info @break
                                    @default badge-light
                                @endswitch
                            ">
                                {{ ucfirst($lead->status) }}
                            </span>
                        </p>
                    </div>
                </div>

                <hr>

                {{-- Personal Information --}}
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Guardian Name:</strong> {{ $lead->guardian_name ?? 'N/A' }}</p>
                        <p><strong>Guardian Contact:</strong> {{ $lead->guardian_contact ?? 'N/A' }}</p>
                        <p><strong>CNIC:</strong> {{ $lead->cnic ?? 'N/A' }}</p>
                        <p><strong>DOB:</strong> {{ $lead->dob ?? 'N/A' }}</p>
                        <p><strong>Gender:</strong> {{ ucfirst($lead->gender ?? '-') }}</p>
                        <p><strong>Qualification:</strong> {{ $lead->qualification ?? 'N/A' }}</p>
                    </div>

                    <div class="col-md-6">
                        <p><strong>Email:</strong> {{ $lead->email ?? 'N/A' }}</p>
                        <p><strong>Phone:</strong> {{ $lead->phone ?? 'N/A' }}</p>
                        <p><strong>Address:</strong> {{ $lead->address ?? 'N/A' }}</p>
                        <p><strong>Referral Type:</strong> {{ ucfirst($lead->referral_type ?? '-') }}</p>
                        <p><strong>Referral Source:</strong> {{ $lead->referral_source ?? 'N/A' }}</p>
                        <p><strong>Referral Contact:</strong> {{ $lead->referral_source_contact ?? 'N/A' }}</p>
                    </div>
                </div>

                <hr>

                {{-- Follow-ups Section --}}
                <div class="row">
                    <div class="col-12">
                        <h5 class="mb-3">Follow-Ups</h5>
                        @if($lead->followUps->count() > 0)
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Contact Method</th>
                                        <th>Status</th>
                                        <th>Note</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lead->followUps as $index => $follow)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ ucfirst($follow->contact_method) }}</td>
                                            <td><span class="badge badge-info">{{ ucfirst($follow->status ?? '-') }}</span></td>
                                            <td>{{ $follow->note ?? '-' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($follow->followed_at)->format('d M Y, h:i A') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-muted">No follow-ups found for this lead.</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
