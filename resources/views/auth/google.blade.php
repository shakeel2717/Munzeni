@extends('layouts.auth')
@section('form')
    <div class="text-center">
        <h4 class="font-size-18 mt-4">Google Authenticator Enabled</h4>
        <p class="text-muted">Please Provide Google Authentication Code to continue to your account</p>
    </div>
    <div class="p-2 mt-5">
        <form class="form-horizontal" action="{{ route('user.google.code.req') }}" method="POST">
            @csrf
            <div class="form-group auth-form-group-custom mb-4">
                <i class="ri-mail-line auti-custom-input-icon"></i>
                <label for="code">Google Authentication Code</label>
                <input type="text" name="code" class="form-control" id="code" placeholder="Google Authentication Code">
            </div>
            <div class="text-center">
                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Proceed to Dashboard</button>
            </div>
        </form>
    </div>
    <hr>
    <form class="form-horizontal" action="{{ route('logout') }}" method="POST">
        @csrf
        <div class="text-center">
            <button class="btn btn-danger w-md waves-effect waves-light" type="submit">Sign Out</button>
        </div>
    </form>
    <div class="mt-5 text-center">
        <p>© 2021 {{ env('APP_NAME') }}. All Rights Reserved</p>
    </div>
@endsection
