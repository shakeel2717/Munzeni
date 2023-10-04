<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layout Project</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    @vite(['resources/js/app.js'])
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
</head>

<body>
    <section class="bg-dark p-3">
        <div class="container text-white d-flex justify-content-between align-items-center">
            <button class="navbar-toggler d-block d-lg-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="bi bi-list fs-1 text-white"></i>
            </button>
            <img src="{{ asset('assets/logo.png') }}" alt="Logo" width="200">
            <ul class="list-unstyled mb-0 d-flex gap-4 align-items-center">
                <li class="d-none d-md-block">
                    <h4 class="mb-0">${{ number_format(auth()->user()->getBalance(),2) }} USD</h4>
                </li>
                <li>
                    <div class="dropdown">
                        <a href="#" class="" id="notifications" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-bell fs-3 text-white"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notifications">
                            <li><a class="dropdown-item" href="#">No new Notification</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="dropdown">
                        <a href="#" class="" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-person-circle text-white fs-3"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="{{ route('user.profile.index') }}">Profile</a></li>
                            <li><a class="dropdown-item"
                                    href="{{ route('user.profile.index', ['tab' => 'password']) }}">Change Password</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('user.profile.index', ['tab' => 'kyc']) }}">KYC
                                    Verification</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                                @csrf
                            </form>
                            <li onclick="document.getElementById('logoutForm').submit()"><a class="dropdown-item"
                                    href="#">Sign Out</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    @if (!auth()->user()->authenticator)
        <section class="p-3 shadow-sm bg-secondary">
            <div class="container text-white d-flex justify-content-between align-items-center">
                <div class="profile-section text-white d-flex align-items-center gap-3">
                    <i class="bi bi-shield-lock fs-3"></i>
                    <p class="mb-0">For your Account Security, Please activate Google Authentication.</p>
                </div>
                <div class="profile-action-section">
                    <a href="{{ route('user.profile.index',['tab' => 'google']) }}" class="btn btn-primary px-4">Activate 2fa</a>
                </div>
            </div>
        </section>
    @endif
    <section>
        <nav class="d-block d-md-none position-fixed bottom-0 bg-dark w-100 left-0 p-2" style="z-index: 5">
            <ul class="list-unstyled d-flex px-2 justify-content-between align-items-center mb-0">
                <li class="text-white">
                    <a class="text-white" href="{{ route('user.dashboard.index') }}"><i
                            class="bi bi-house-door fs-2"></i></a>
                </li>
                <li class="text-white">
                    <a class="text-white" href="{{ route('user.history.deposits') }}">
                        <i class="bi bi-hourglass fs-2"></i></a>
                </li>
                <li class="text-white">
                    <div class="middle-button" style="margin-top: -20px">
                        <a class="btn btn-lg btn-primary rounded-circle" href="{{ route('user.trading.index') }}">
                            {{-- <i class="bi bi-house-door fs-1"></i> --}}
                            <img class="py-2" src="{{ asset('home.png') }}" alt="Home" width="25">
                        </a>
                    </div>
                </li>
                <li class="text-white">
                    <a class="text-white" href="{{ route('user.withdraw.create') }}">
                        <i class="bi bi-hammer fs-2"></i></a>
                </li>
                <li class="text-white">
                    <a class="text-white" href="{{ route('user.profile.index') }}">
                        <i class="bi bi-person-circle fs-2"></i></a>
                </li>
            </ul>
        </nav>
        <div class="container d-flex align-items-start">
            @include('inc.nav.user')
            <div class="content py-4 w-100">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-body" style="min-height: 60vh;">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <x-alert />
    @yield('scripts')
    @livewireScripts
    <script>
        function copyInputValue(inputId) {
            const inputElement = document.getElementById(inputId);
            if (inputElement) {
                inputElement.select();
                document.execCommand('copy');
            } else {
                alert('Input element not found!');
            }
        }
    </script>
</body>

</html>
