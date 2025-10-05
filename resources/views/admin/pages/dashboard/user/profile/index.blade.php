@extends('admin.layouts.main')

@section('content')
<style>
    /* ===== Profile Styling ===== */
    .profile-card {
        position: relative;
        background: #fff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    .profile-cover {
        background: linear-gradient(135deg, #FEB800, #a7852f);
        height: 180px;
    }
    .profile-avatar {
        position: absolute;
        top: 100px;
        left: 50%;
        transform: translateX(-50%);
        border: 4px solid #fff;
        border-radius: 50%;
        width: 130px;
        height: 130px;
        object-fit: cover;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }
    .profile-avatar:hover {
        transform: translateX(-50%) scale(1.05);
    }
    .profile-body {
        padding: 100px 30px 40px;
        text-align: center;
    }
    .profile-name {
        font-size: 1.6rem;
        font-weight: 600;
        color: #2c3e50;
    }
    .profile-role {
        color: #6c757d;
        font-weight: 500;
        margin-bottom: 25px;
        text-transform: capitalize;
    }

    /* ===== Info Section ===== */
    .profile-info {
        text-align: left;
        max-width: 700px;
        margin: 0 auto;
    }
    .profile-info .info-row {
        background: #f8f9fc;
        border-radius: 8px;
        padding: 12px 18px;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
    }
    .profile-info .info-row:hover {
        background: #eef3ff;
    }
    .profile-info i {
        font-size: 18px;
        min-width: 22px;
        margin-right: 10px;
    }
    .profile-info strong {
        color: #2e59d9;
    }

    /* ===== Button ===== */
    .edit-btn {
        margin-top: 25px;
        padding: 10px 25px;
        border-radius: 50px;
        background: linear-gradient(135deg, #4e73df, #1cc88a);
        border: none;
        color: white;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    .edit-btn:hover {
        background: linear-gradient(135deg, #1cc88a, #4e73df);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
    }

    @media (max-width: 767px) {
        .profile-info .col-md-6 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
</style>

<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-12">
                <h2 class="mb-3">My Profile</h2>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-10">
                <div class="profile-card">
                    {{-- Cover --}}
                    <div class="profile-cover"></div>

                    {{-- Profile Image --}}
                    <img 
                        src="{{ $user->image ? asset($user->image) : asset('default-avatar.png') }}" 
                        alt="User Avatar"
                        class="profile-avatar"
                    >

                    {{-- Content --}}
                    <div class="profile-body">
                        <h4 class="profile-name">{{ $user->name }}</h4>
                        <p class="profile-role">{{ ucfirst($user->role) }}</p>

                        {{-- Info Section --}}
                        <div class="profile-info">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="info-row">
                                        <i class="icon-user text-primary"></i>
                                        <span><strong>Username:</strong> {{ $user->username }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="info-row">
                                        <i class="icon-envelope text-success"></i>
                                        <span><strong>Email:</strong> {{ $user->email }}</span>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="info-row">
                                        <i class="icon-call-out text-info"></i>
                                        <span><strong>Phone:</strong> {{ $user->phone ?? '—' }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="info-row">
                                        <i class="icon-calendar text-warning"></i>
                                        <span><strong>Joined On:</strong> {{ $user->created_at->format('d M, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Edit Button --}}
                        <a href="{{ route('profile.edit') }}" class="edit-btn">
                            <i class="icon-pencil"></i> Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
