@extends('layouts.auth')
@section('form')
    <div class="text-center">
        <h4 class="font-size-18 mt-4">Forgot password</h4>
        <p class="text-muted">Forgot your password? No problem. Just let us know your email address and we will email you a
            password reset link that will allow you to choose a new one.</p>
    </div>
    <div class="p-2 mt-5">
        <form class="form-horizontal" action="{{ route('password.request') }}" method="POST">
            @csrf
            <div class="form-group auth-form-group-custom mb-4">
                <i class="ri-mail-line auti-custom-input-icon"></i>
                <label for="useremail">Email</label>
                <input type="email" name="email" class="form-control" id="useremail" placeholder="Enter email">
            </div>
            <div class="text-center">
                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Email Password Reset
                    Link</button>
            </div>
        </form>
    </div>
    <div class="mt-5 text-center">
        <p>Remember your account ? <a href="{{ route('login') }}" class="font-weight-medium text-primary"> Try Login</a>
        </p>
        <p>© {{ date('Y') }} {{ env('APP_NAME') }}. All Rights Reserved</p>
    </div>
@endsection