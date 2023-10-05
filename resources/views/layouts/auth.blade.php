<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    @vite(['resources/js/app.js'])
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
</head>

<body>
    <section class="bg-dark p-3">
        <div class="container text-white text-center">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo" width="200">
        </div>
    </section>
    <section>
        <div class="container d-flex align-items-center">
            <div class="content py-4 w-100">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="card bg-dark card-body">
                            @yield('form')
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
