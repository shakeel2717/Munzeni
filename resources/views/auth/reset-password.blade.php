@extends('layouts.auth')
@section('form')
    <div class="text-center">
        <h4 class="font-size-18 mt-4">Reset Password</h4>
        <p class="text-muted">Now Set your new Password.</p>
    </div>
    <div class="p-2 mt-5">
        <form class="form-horizontal" action="{{ route('password.store') }}" method="POST">
            @csrf
            <input type="text" name="email" value="{{ $request->email }}">
            <input type="text" name="token" value="{{ $request->route('token') }}">
            <div class="form-group auth-form-group-custom mb-4">
                <i class="ri-lock-2-line auti-custom-input-icon"></i>
                <label for="password">New Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter password">
                <ul class="mt-2">
                    <li>Use from 8 to 15 characters</li>
                    <li>Use both uppercase and lowercase letters</li>
                    <li>Use a combination of numbers and English letter</li>
                </ul>
            </div>
            <div class="form-group auth-form-group-custom mb-4">
                <i class="ri-lock-2-line auti-custom-input-icon"></i>
                <label for="password_confirmation">Confirm New Password</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                    placeholder="Enter password">
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
        <p>© 2020 {{ env('APP_NAME') }}. All Rights Reserved</p>
    </div>
@endsection


{{-- <x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
