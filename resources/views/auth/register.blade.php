@extends('layouts.auth')
@section('form')
    <div class="text-center">
        <h4 class="font-size-18 mt-4">Register account</h4>
        <p class="text-muted">Get your free {{ env('APP_NAME') }} account now.</p>
    </div>
    <div class="p-2">
        <form class="form-horizontal" action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group auth-form-group-custom ">
                <i class="ri-user-line auti-custom-input-icon"></i>
                <label for="name">Full Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Full Name">
            </div>
            <div class="form-group auth-form-group-custom ">
                <i class="ri-user-shared-fill auti-custom-input-icon"></i>
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username">
            </div>
            <div class="form-group auth-form-group-custom">
                <i class="ri-user-shared-fill auti-custom-input-icon"></i>
                <label for="refer">Referral Code</label>
                <input type="text" name="refer" class="form-control" id="refer" placeholder="Enter Referral"
                    value="{{ $refer }}" readonly>
            </div>
            <div class="form-group auth-form-group-custom ">
                <i class="ri-mail-line auti-custom-input-icon"></i>
                <label for="useremail">Email</label>
                <input type="email" name="email" class="form-control" id="useremail" placeholder="Enter email">
            </div>
            <div class="form-group auth-form-group-custom ">
                <i class="ri-lock-2-line auti-custom-input-icon"></i>
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter password">
            </div>
            <div class="form-group auth-form-group-custom ">
                <i class="ri-lock-2-line auti-custom-input-icon"></i>
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                    placeholder="Enter password">
            </div>
            <div class="text-center">
                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Create Account</button>
            </div>
            <div class="mt-4 text-center">
                <p class="mb-0">By registering you agree to the Nazox <a href="#" class="text-primary">Terms of
                        Use</a></p>
            </div>
        </form>
    </div>
    <div class="mt-5 text-center">
        <p>Already have an account ? <a href="{{ route('login') }}" class="font-weight-medium text-primary"> Login</a> </p>
        <p>© {{ date('Y') }} {{ env('APP_NAME') }}. All Rights Reserved</p>
    </div>
@endsection
