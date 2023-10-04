<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
</head>

<body>
    <nav class="d-flex justify-content-between p-4 position-fixed top-0 bg-dark w-100">
        <div class="brand">
            <img src="{{ asset('logo-light.png') }}" alt="{{ env('APP_NAME') }}">
        </div>
        <ul class="nav gap-5">
            <li class=""><a class="fs-5" href="{{ route('index') }}">Home</a></li>
            <li class=""><a class="fs-5" href="{{ route('user.dashboard.index') }}">Dashboard</a></li>
            <li class=""><a class="fs-5" href="{{ route('login') }}">Sign In</a></li>
            <li class=""><a class="fs-5" href="{{ route('register') }}">Create Free Account</a></li>
        </ul>
        <div class="button">
            <a href="{{ route('register') }}" class="btn btn-outline-primary px-5">Get Started</a>
        </div>
    </nav>
    <section class="min-vh-100 bg-secondary d-flex align-items-center crypto-back">
        <div class="container d-flex align-items-center">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="text-white" style="font-size: 75px">Online trading with
                        better-than-market
                        conditions</h2>
                    <br>
                    <p class="fs-3 text-white">Trade across multiple markets with the most stable and reliable pricing
                        in the industry.</p>
                    <div class="buttons mt-4">
                        <a href="{{ route('register') }}" class="btn btn-primary px-4 py-2 fs-4">Get Started</a>
                        <a href="{{ route('login') }}" class="btn btn-primary px-4 py-2 fs-4">Sign In</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="min-vh-100 d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mb-5 text-center text-white display-2 fw-bold">Instant Withdrawal, 24/7</h1>
                    <p class="text-primary mb-5 fs-4 text-center">Our Withdrawals are carried out in seconds with no
                        manual
                        processing, including on weekends.</p>
                    <h4 class="text-center fs-4 mb-5 text-white">Platform we are used</h4>
                    <div class="gallery text-center">
                        <img width="200" src="{{ asset('assets/brand/1.png') }}" alt="logo">
                        <img width="200" src="{{ asset('assets/brand/2.png') }}" alt="logo">
                        <img width="200" src="{{ asset('assets/brand/3.png') }}" alt="logo">
                        <img width="200" src="{{ asset('assets/brand/4.png') }}" alt="logo">
                        <img width="200" src="{{ asset('assets/brand/5.png') }}" alt="logo">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="min-vh-100 d-flex align-items-center bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="mb-5  text-white display-2 fw-bold">About {{ env('APP_NAME') }}</h1>
                    <p class="text-primary mb-5 fs-4 ">Why Choose Us?</p>
                    <p class="text-white">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse modi, porro, sit vitae corrupti
                        dolor minima eligendi dolores ea cum, excepturi non ut totam quis a expedita neque voluptatum
                        nobis.0
                    </p>
                    <p class="text-white">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse modi, porro, sit vitae corrupti
                        dolor minima eligendi dolores ea cum, excepturi non ut totam quis a expedita neque voluptatum
                        nobis.Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse modi, porro, sit vitae
                        corrupti
                        dolor minima eligendi dolores ea cum, excepturi non ut totam quis a expedita neque voluptatum
                        nobis.
                    </p>
                    <p class="text-white">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse modi, porro, sit vitae corrupti
                        dolor minima eligendi dolores ea cum, excepturi non ut totam quis a expedita neque voluptatum
                        nobis.Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse modi, porro, sit vitae
                        corrupti
                        dolor minima eligendi dolores ea cum, excepturi non ut totam quis a expedita neque voluptatum
                        nobis.
                    </p>
                    <hr>
                    <div class="">
                        <a href="{{ route('register') }}" class="btn btn-primary px-4 py-2 fs-4">Create Account</a>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <img src="{{ asset('assets/girl.jpg') }}" alt="Girl" height="600">
                </div>
            </div>
        </div>
    </section>
    <section class="min-vh-100 d-flex align-items-center bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center d-flex align-items-center">
                    <img src="{{ asset('assets/building.jpg') }}" alt="Girl" height="600">
                </div>
                <div class="col-md-6">
                    <h1 class="mb-5  text-white display-2 fw-bold">Our Mission & Vision</h1>
                    <p class="text-primary mb-5 fs-4 ">Our Mission!</p>
                    <p class="text-white">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse modi, porro, sit vitae corrupti
                        dolor minima eligendi dolores ea cum, excepturi non ut totam quis a expedita neque voluptatum
                        nobis.Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse modi, porro, sit vitae
                        corrupti
                        dolor minima eligendi dolores ea cum, excepturi non ut totam quis a expedita neque voluptatum
                        nobis.
                    </p>
                    <p class="text-primary mb-5 fs-4 ">Our Vision!</p>
                    <p class="text-white">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse modi, porro, sit vitae corrupti
                        dolor minima eligendi dolores ea cum, excepturi non ut totam quis a expedita neque voluptatum
                        nobis.0
                    </p>
                    <p class="text-white">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse modi, porro, sit vitae corrupti
                        dolor mi eligendi dolores ea cum, excepturi non ut totam quis a expedita neque voluptatum
                        nobis.
                    </p>
                    <hr>
                    <div class="">
                        <a href="{{ route('register') }}" class="btn btn-primary px-4 py-2 fs-4">Create Account</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="d-flex align-items-center" style="height: 600px">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mb-5 text-center text-white display-2 fw-bold">Ready to Get Started</h1>
                    <p class="text-primary mb-5 fs-4 text-center">It only takes 3 minutes to get your account set up
                        and
                        ready for trading</p>
                    <h4 class="text-center fs-4 mb-5 text-white">Platform we are used</h4>
                    <div class="text-center">
                        <a href="{{ route('register') }}" class="btn btn-primary px-4 py-2 fs-4">Get Started</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="bg-secondary p-3">
        <h4 class="text-center text-white">Copyrights {{ date('Y') }} {{ env('APP_NAME') }}. All Rights Reserved
        </h4>
    </footer>
</body>

</html>
