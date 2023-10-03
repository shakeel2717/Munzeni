<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layout Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
    @vite(['resources/js/app.js'])
    @livewireStyles
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
                            <li><a class="dropdown-item" href="{{ route('user.profile.index') }}">Change Password</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                                @csrf
                            </form>
                            <li onclick="document.getElementById('logoutForm').submit()"><a class="dropdown-item" href="#">Sign Out</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <section class="p-3 shadow-sm bg-white">
        <div class="container text-white d-flex justify-content-between align-items-center">
            <div class="profile-section text-dark d-flex align-items-center gap-3">
                <i class="bi bi-person-circle fs-3"></i>
                <p class="mb-0">Hello, Fill in your account details to make your first deposit</p>
            </div>
            <div class="profile-action-section">
                <button class="btn btn-primary px-4">Complete Profile</button>
            </div>
        </div>
    </section>
    <section>
        <div class="container d-flex align-items-start">
            @include('inc.nav.user')
            <div class="content py-4 w-100">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-body shadow-sm border-0 mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="titles">
                                    <h2>Download the Munzeni Mobile App</h2>
                                    <p class="mb-0">And Trade while you are on the go</p>
                                </div>
                                <div class="playstore d-none d-md-block">
                                    <img src="{{ asset('assets/google.webp') }}" alt="Google Play Store" width="200">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    @livewireScripts
</body>

</html>
