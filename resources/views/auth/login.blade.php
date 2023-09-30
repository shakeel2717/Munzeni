@extends('layouts.auth')
@section('form')
    <div class="text-center">
        <h4 class="font-size-18 mt-4">Register account</h4>
        <p class="text-muted">Get access to your {{ env('APP_NAME') }} account now.</p>
    </div>
    <div class="p-2 mt-5">
        <form class="form-horizontal" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group auth-form-group-custom mb-4">
                <i class="ri-user-shared-fill auti-custom-input-icon"></i>
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username">
            </div>
            <div class="form-group auth-form-group-custom mb-4">
                <i class="ri-lock-2-line auti-custom-input-icon"></i>
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter password">
            </div>
            <div class="text-">
                <p><a href="{{ route('password.request') }}">Forget Password?</a></p>
            </div>
            <div class="text-center">
                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Sign In</button>
            </div>
        </form>
    </div>
    <div class="mt-5 text-center">
        <p>Don't have an account ? <a href="{{ route('register') }}" class="font-weight-medium text-primary"> Create
                Account</a> </p>
        <p>© {{ date('Y') }} {{ env('APP_NAME') }}. All Rights Reserved</p>
    </div>
@endsection
