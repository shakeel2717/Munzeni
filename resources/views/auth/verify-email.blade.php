@extends('layouts.auth')
@section('form')
    <div class="text-center">
        <h4 class="font-size-18 mt-4">Verify Email Account</h4>
        <p class="text-muted">Thanks for signing up! Before getting started, could you verify your email address by clicking
            on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.</p>
    </div>
    @if (session('status') == 'verification-link-sent')
        <p class="mb-4 p-2 text-success">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </p>
    @endif
    <div class="d-flex justify-content-center">
        <div class="p-2 mt-2">
            <form class="form-horizontal" action="{{ route('verification.send') }}" method="POST">
                @csrf
                <div class="text-center">
                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Resend Verification
                        Email</button>
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
