@extends('layouts.app')
@section('title', 'Withdraw Request')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ !isset($_GET['tab']) ? 'active' : '' }}" id="home-tab" data-bs-toggle="tab"
                        data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"> <i
                            class="bi bi-person-circle"></i> My
                        Profile</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ isset($_GET['tab']) && $_GET['tab'] == 'password' ? 'show active' : '' }}"
                        id="password-tab" data-bs-toggle="tab" data-bs-target="#password" type="button" role="tab"
                        aria-controls="password" aria-selected="false"><i class="bi bi-key"></i> Change
                        Password</button>
                </li>
                {{-- <li class="nav-item" role="presentation">
                    <button class="nav-link {{ isset($_GET['tab']) && $_GET['tab'] == 'google' ? 'show active' : '' }}"
                        id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab"
                        aria-controls="contact" aria-selected="false"><i class="bi bi-shield-lock-fill"></i> Google
                        Authenticator</button>
                </li> --}}
                {{-- <li class="nav-item" role="presentation">
                    <button class="nav-link {{ isset($_GET['tab']) && $_GET['tab'] == 'kyc' ? 'show active' : '' }}"
                        id="kyc-tab" data-bs-toggle="tab" data-bs-target="#kyc" type="button" role="tab"
                        aria-controls="kyc" aria-selected="false"><i class="bi bi-file-person"></i> KYC
                        Verification</button>
                </li> --}}
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade {{ !isset($_GET['tab']) ? 'show active' : '' }}" id="home" role="tabpanel"
                    aria-labelledby="home-tab">
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
                <div class="tab-pane fade {{ isset($_GET['tab']) && $_GET['tab'] == 'password' ? 'show active' : '' }}"
                    id="password" role="tabpanel" aria-labelledby="password-tab">
                    <div class="card-body">
                        <h4>Change Your Password</h4>
                        <hr>
                        <form action="{{ route('user.password.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="current_password">Current Password</label>
                                <input type="password" name="current_password" id="current_password"
                                    class="form-control" placeholder="Current Password">
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
                <div class="tab-pane fade {{ isset($_GET['tab']) && $_GET['tab'] == 'google' ? 'show active' : '' }}"
                    id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="card-body">
                        <h4>Manage Google Authentication</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-8 mx-auto">
                                <div class="card-body border border-primary mb-4">
                                    @if (auth()->user()->authenticator)
                                        <h4 class="mb-0 text-success"> <i class="ri-close-circle-fill fs-lage"></i>
                                            Authentication Enabled</h4>
                                        <form action="{{ route('user.google.deactivate') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="code">Provide Google Authentication Code</label>
                                                <input type="text" name="code" id="code"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Deactivate
                                                    Authenticator</button>
                                            </div>
                                        </form>
                                    @else
                                        <h4 class="mb-0 text-danger"> <i class="ri-close-circle-fill fs-lage"></i>
                                            Authentication Disabled</h4>
                                        <form action="{{ route('user.google.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group text-center">
                                                <h5 class="mb-3">Scan QR and Get Google Authentication Code</h5>
                                                <img src="{{ $authentication->getQR(env('APP_NAME') . ' ' . auth()->user()->username, $secret) }}"
                                                    alt="Google Authentication Code">
                                            </div>
                                            <div class="form-group">
                                                <label for="referLink">Copy Secret Code</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="secret"
                                                        id="referLink" value="{{ $secret }}" readonly>
                                                    <button type="button" onclick="copyInputValue('referLink')"
                                                        class="btn btn-primary">Copy</button>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="code">Provide Google Authentication Code</label>
                                                <input type="text" name="code" id="code"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Activate
                                                    Authenticator</button>
                                            </div>
                                        </form>
                                    @endif
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="tab-pane fade {{ isset($_GET['tab']) && $_GET['tab'] == 'kyc' ? 'show active' : '' }}"
                    id="kyc" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="card-body">
                        <h4>Complete Your KYC</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-body border border-primary">
                                    <h4 class="mb-0"> <i class="ri-close-circle-fill fs-lage"></i> KYC is
                                        {{ auth()->user()->kyc_status }}</h4>
                                </div>
                            </div>
                        </div>
                        @if (auth()->user()->kyc_status != 'approved')
                            <form action="{{ route('user.kyc.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="dob">Date Of Birth</label>
                                    <input type="date" name="dob" id="dob" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" name="mobile" id="mobile" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select name="gender" class="form-control" id="gender">
                                        <option value="male">Male</option>
                                        <option value="female">FeMale</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="country">Country Name</label>
                                    <input type="text" name="country" id="country" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="address">Complete Address</label>
                                    <input type="text" name="address" id="address" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="zip">ZIP Code</label>
                                    <input type="text" name="zip" id="zip" class="form-control">
                                </div>
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
