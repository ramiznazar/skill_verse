@extends('admin.layouts.main')
@section('content')
<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Student Details</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <a href="{{ route('admission.index') }}" class="btn btn-sm btn-primary">All Admissions</a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="body">
                <div class="row mb-4">
                    <div class="col-md-3 text-center">
                        @if($admission->image)
                            <img src="{{ asset($admission->image) }}" 
                                 class="img-thumbnail" width="150" height="150">
                        @else
                            <img src="https://via.placeholder.com/150" class="img-thumbnail">
                        @endif
                    </div>
                    <div class="col-md-9">
                        <h4>{{ $admission->name }}</h4>
                        <p><strong>Course:</strong> {{ $admission->course->title ?? 'N/A' }}</p>
                        <p><strong>Batch:</strong> {{ $admission->batch->title ?? 'N/A' }}</p>
                        <p><strong>Status:</strong> {{ ucfirst($admission->student_status) }}</p>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <p><strong>CNIC:</strong> {{ $admission->cnic }}</p>
                        <p><strong>Guardian Name:</strong> {{ $admission->guardian_name }}</p>
                        <p><strong>Guardian Contact:</strong> {{ $admission->guardian_contact }}</p>
                        <p><strong>DOB:</strong> {{ $admission->dob }}</p>
                        <p><strong>Gender:</strong> {{ ucfirst($admission->gender) }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Email:</strong> {{ $admission->email }}</p>
                        <p><strong>Phone:</strong> {{ $admission->phone }}</p>
                        <p><strong>Joining Date:</strong> {{ $admission->joining_date }}</p>
                        <p><strong>Qualification:</strong> {{ ucfirst($admission->qualification) }}</p>
                        <p><strong>Last Institute:</strong> {{ $admission->last_institute }}</p>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Referral Type:</strong> {{ ucfirst($admission->referral_type) }}</p>
                        <p><strong>Referral Source:</strong> {{ $admission->referral_source }}</p>
                        <p><strong>Source Contact:</strong> {{ $admission->referral_source_contact }}</p>
                        <p><strong>Source Commission:</strong> {{ $admission->referral_source_commission }}%</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Address:</strong> {{ $admission->address }}</p>
                        <p><strong>Total Fee:</strong> ₨{{ number_format($admission->full_fee) }}</p>
                        <p><strong>Payment Type:</strong> {{ ucfirst($admission->payment_type) }}</p>
                        <p><strong>Installments:</strong>
                            1: ₨{{ $admission->installment_1 ?? 0 }},
                            2: ₨{{ $admission->installment_2 ?? 0 }},
                            3: ₨{{ $admission->installment_3 ?? 0 }}
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
