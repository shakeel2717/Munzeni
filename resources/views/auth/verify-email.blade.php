@extends('layouts.auth')
@section('form')
    <div class="text-center">
        <h4 class="font-size-18 mt-4">Verify Email Account</h4>
        <p class="text-muted">Thanks for signing up! Before getting started, Please verify your email address or Phone
            Number. We sent you 6 digit veification code to your registered email or phone number.</p>
    </div>
    @if (session('status') == 'verification-link-sent')
        <p class="mb-4 p-2 text-success">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </p>
    @endif
    <div class="d-flex justify-content-center">
        <div class="p-2 mt-2">
            <form class="" action="{{ route('verification.verify') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="verification_code">Verification Code</label>
                    <input type="text" name="verification_code" class="form-control" id="verification_code" placeholder="6 Digit Code">
                </div>
                <div class="text-center">
                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Verify Account</button>
                </div>
            </form>
        </div>
    </div>
    <hr>
    <div class="d-flex justify-content-center">
        <div class="p-2 mt-2">
            <form class="form-horizontal" action="{{ route('verification.resent') }}" method="POST">
                @csrf
                <div class="text-center">
                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Resend
                        Verification</button>
                </div>
            </form>
        </div>
        <div class="p-2 mt-2">
            <form class="form-horizontal" action="{{ route('logout') }}" method="POST">
                @csrf
                <div class="text-center">
                    <button class="btn btn-danger w-md waves-effect waves-light" type="submit">Sign Out</button>
                </div>
            </form>
        </div>
    </div>
    <div class="mt-5 text-center">
        <p>© 2021 {{ env('APP_NAME') }}. All Rights Reserved</p>
    </div>
@endsection
