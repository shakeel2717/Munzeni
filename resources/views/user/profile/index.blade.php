@extends('layouts.app')
@section('title', 'Withdraw Request')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                        role="tab" aria-controls="home" aria-selected="true">My Profile</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                        role="tab" aria-controls="profile" aria-selected="false">Change Password</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button"
                        role="tab" aria-controls="contact" aria-selected="false">Google Authenticator</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="kyc-tab" data-bs-toggle="tab" data-bs-target="#kyc" type="button"
                        role="tab" aria-controls="kyc" aria-selected="false">KYC Verification</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="card-body">
                        <h4>Update Profile Record</h4>
                        <hr>
                        <form action="{{ route('user.profile.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Full Name" value="{{ auth()->user()->name }}">
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control"
                                    placeholder="Username" value="{{ auth()->user()->username }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email"
                                    value="{{ auth()->user()->email }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="upliner">Upliner</label>
                                <input type="text" name="upliner" id="upliner" class="form-control"
                                    placeholder="Upliner Name" value="{{ auth()->user()->refer }}" readonly>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update Profile Record</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="card-body">
                        <h4>Change Your Password</h4>
                        <hr>
                        <form action="{{ route('user.password.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="current_password">Current Password</label>
                                <input type="password" name="current_password" id="current_password" class="form-control"
                                    placeholder="Current Password">
                            </div>
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="New Password">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm New Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control" placeholder="Confirm New Password">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                <div class="tab-pane fade" id="kyc" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="card-body">
                        <h4>Complete Your KYC</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-body border border-primary">
                                    <h4 class="mb-0 text-danger"> <i class="ri-close-circle-fill fs-lage"></i> KYC is Pending</h4>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('user.kyc.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="front">Front Side Document</label>
                                <input type="file" name="front" id="front" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="back">Back Side Document</label>
                                <input type="file" name="back" id="back" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit for Approval</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
