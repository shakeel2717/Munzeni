<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="icon" href="{{ asset('assets/favi.ico') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
</head>

<body>
    <nav class="d-flex justify-content-between p-4 position-fixed top-0 bg-dark w-100">
        <div class="brand">
            <a href="{{ route('index') }}"><img src="{{ asset('logo-light.png') }}" alt="{{ env('APP_NAME') }}"></a>
        </div>
        <ul class="nav gap-5 d-none d-sm-flex">
            <li class=""><a class="fs-5" href="{{ route('index') }}">Home</a></li>
            <li class=""><a class="fs-5" href="{{ route('user.dashboard.index') }}">Dashboard</a></li>
            <li class=""><a class="fs-5" href="{{ route('login') }}">Sign In</a></li>
            <li class=""><a class="fs-5" href="{{ route('register') }}">Create Free Account</a></li>
        </ul>
        <div class="button">
            <a href="{{ route('register') }}" class="btn btn-outline-primary px-5">Get Started</a>
        </div>
    </nav>
    <section class="min-vh-100 bg-secondary d-flex align-items-center crypto-back pb-5" style="padding-top: 200px;">
        <div class="container d-flex align-items-center">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="text-white" style="font-size: 50px">Online trading with
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
    <section class="min-vh-100 d-flex align-items-center py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mb-5 text-center text-white display-2 fw-bold">Instant Withdrawal, 24/7</h1>
                    <p class="text-primary mb-5 fs-4 text-center">Our Withdrawals are carried out in seconds with no
                        manual
                        processing, including on weekends.</p>
                    <h4 class="text-center fs-4 mb-5 text-white">Platform we are used</h4>
                    <div class="gallery text-center d-flex flex-wrap">
                        <div class="col">
                            <img width="200" src="{{ asset('assets/brand/1.png') }}" alt="logo">
                        </div>
                        <div class="col">
                            <img width="200" src="{{ asset('assets/brand/2.png') }}" alt="logo">
                        </div>
                        <div class="col">
                            <img width="200" src="{{ asset('assets/brand/3.png') }}" alt="logo">
                        </div>
                        <div class="col">
                            <img width="200" src="{{ asset('assets/brand/4.png') }}" alt="logo">
                        </div>
                        <div class="col">
                            <img width="200" src="{{ asset('assets/brand/5.png') }}" alt="logo">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="d-flex align-items-center bg-secondary" style="height: 600px">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mb-5 text-center text-white display-2 fw-bold">Download Android Applicaton</h1>
                    <p class="text-primary mb-5 fs-4 text-center">Download Trading Application for best and smooth
                        experiences</p>
                    <div class="text-center">
                        <a href="{{ asset('munzeni_1_1.0.apk') }}" class="btn btn-primary px-4 py-2 fs-4">Download
                            Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="min-vh-100 py-5 d-flex align-items-center bg-dark pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 py-4">
                    <h1 class="mb-5  text-white display-2 fw-bold">About {{ env('APP_NAME') }}</h1>
                    <p class="text-primary mb-5 fs-4 ">Welcome to Munzeni - The Future</p>
                    <p class="text-white">
                        At Munzeni, we are pioneering the future of financial growth and sustainability from the heart
                        of Asia, Singapore. As a premier binary trading website, mining, and investment company, we
                        combine cutting-edge technology with ethical practices to redefine the landscape of finance.
                    </p>
                    <ul class="text-white list-unstyled pe-4">
                        <li>
                            <h4>Responsible Mining:</h4>
                        </li>
                        <li>
                            <p>We are committed to responsible mining practices that prioritize sustainability and
                                environmental consciousness. Our mining operations utilize state-of-the-art technology
                                to ensure efficiency while minimizing our ecological footprint, contributing to a
                                greener, healthier planet.
                            </p>
                        </li>

                        <li>
                            <h4>Innovative Investments</h4>
                        </li>
                        <li>
                            <p>Explore a world of innovative investments curated to suit your financial aspirations. Our
                                investment strategies are designed to optimize returns while aligning with our core
                                values of sustainability and ethical conduct, making your investments a force for
                                positive change.
                            </p>
                        </li>
                        <li>
                            <h4>Singaporean Integrity:</h4>
                        </li>
                        <li>
                            <p>Based in Singapore, a global hub of financial excellence, we uphold the values of
                                integrity, transparency, and reliability that are synonymous with this thriving economic
                                center. Your trust is our greatest asset, and we strive to honor it in every aspect of
                                our operations.
                            </p>
                        </li>
                        <li>
                            <h4>Community-Centric Approach</h4>
                        </li>
                        <li>
                            <p> Our dedication extends beyond profits to the communities we serve. We actively engage
                                with local stakeholders, supporting initiatives that enhance the well-being of society
                                and reinforce our commitment to being a responsible corporate citizen.
                            </p>
                        </li>
                        <li>
                            <h4>Global Reach, Local Expertise:</h4>
                        </li>
                        <li>
                            <p>With a global reach, we offer our services to clients both locally and internationally.
                                Our expert team, deeply rooted in Singapore's financial landscape, possesses the
                                expertise and knowledge needed to navigate the complexities of the global financial
                                markets.

                            </p>
                        </li>
                    </ul>
                    <p class="text-white">
                        Join us at Munzeni as we embark on a journey of innovation, sustainability, and growth.
                        Together, let's shape a future where financial success is harmonized with environmental
                        consciousness and societal well-being.
                    </p>
                    <hr>
                    <div class="">
                        <a href="{{ route('register') }}" class="btn btn-primary px-4 py-2 fs-4">Create Account</a>
                    </div>
                </div>
                <div class="col-md-6 d-flex align-items-center justify-content-center py-4">
                    <img class="w-100" src="{{ asset('assets/img1.jpg') }}" alt="Girl" height="750">
                </div>
            </div>
        </div>
    </section>
    <section class="min-vh-100 d-flex align-items-center bg-dark py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 d-flex align-items-center justify-content-center">
                    <img class="w-100" src="{{ asset('assets/img2.jpg') }}" alt="Girl" height="">
                </div>
                <div class="col-md-8">
                    <div class="card card-body p-5 mt-5 w-100">
                        <h1 class="mb-5  text-white display-2 fw-bold">Why Choose Us</h1>
                        <p class="text-primary mb-5 fs-4 ">Why Choice Munzeni??</p>
                        <p class="text-white">
                            At Munzeni, we invite you to choose us as your trusted partner on a journey towards a
                            brighter
                            future. As we evolve into a world-class corporation, our unwavering commitment to
                            sustainability, health, and excellence sets us apart.
                        </p>
                        <ul class="text-white list-unstyled pe-4">
                            <li>
                                <h4>Sustainable Practices:</h4>
                            </li>
                            <li>
                                <p>We prioritize sustainability at every step, embedding responsible trading and mining
                                    practices into our DNA. Our mission is to not only succeed as a business but to
                                    succeed
                                    in a way that leaves a positive, lasting impact on the environment and society.
                                </p>
                            </li>

                            <li>
                                <h4>Innovative Solutions:</h4>
                            </li>
                            <li>
                                <p>Innovation is our cornerstone. Our dedicated team constantly seeks inventive
                                    strategies
                                    to maximize efficiency, reduce waste, and drive positive change. By choosing us, you
                                    opt
                                    for cutting-edge solutions that align with your vision for a sustainable future.
                                </p>
                            </li>
                            <li>
                                <h4>Integrity and Ethics:</h4>
                            </li>
                            <li>
                                <p>Our integrity is non-negotiable. We uphold the highest ethical standards in all our
                                    interactions and transactions. Transparency, honesty, and trust are the pillars of
                                    our
                                    relationships, ensuring your confidence in every aspect of our partnership.
                                </p>
                            </li>
                            <li>
                                <h4>Global Excellence:</h4>
                            </li>
                            <li>
                                <p> Striving for excellence on a global stage is part of our DNA. We relentlessly pursue
                                    the
                                    highest standards of quality, service, and performance. Our aspiration to be a
                                    world-class corporation drives us to continuously improve and deliver beyond
                                    expectations.
                                </p>
                            </li>
                            <li>
                                <h4>Community and Stakeholder Engagement:</h4>
                            </li>
                            <li>
                                <p>Your success is intertwined with the well-being of the communities we operate in. We
                                    engage with stakeholders and invest in initiatives that uplift and empower,
                                    reinforcing
                                    our dedication to creating a world where every entity thrives.
                                </p>
                            </li>
                        </ul>
                        <p class="text-primary fs-4 ">{{ env('APP_NAME') }} Mission??</p>
                        <p class="text-white">
                            Empowering a sustainable and healthier world through our commitment to excellence,
                            innovation, and responsible trading and mining practices, striving to attain world-class
                            status in all our endeavors
                        </p>
                        <div class="">
                            <a href="{{ route('register') }}" class="btn btn-primary px-4 py-2 fs-4">Create
                                Account</a>
                        </div>
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
    <div class="livechat position-fixed" style="bottom: 20px; right: 20px;">
        <a class="rounded-circle" href="{{ settings('telegram_support') ?? 'https://telegram.org/' }}"><i
                class="bi fs-1 bi-chat-fill"></i></a>
    </div>
    <footer class="bg-secondary p-3">
        <h4 class="text-center text-white">Copyrights {{ date('Y') }} {{ env('APP_NAME') }}. All Rights Reserved
        </h4>
        <hr>
        <div class="socials text-center">
            <ul class="d-flex justify-content-center list-unstyled gap-4">
                <li><a href="{{ settings('facebook_link') }}"><i class="bi fs-2 bi-facebook"></i></a></li>
                <li><a href="{{ settings('youtube_link') }}"><i class="bi fs-2 bi-youtube"></i></a></li>
                <li><a href="{{ settings('instagram_link') }}"><i class="bi fs-2 bi-instagram"></i></a></li>
                <li><a href="{{ settings('tiktok_link') }}"><i class="bi fs-2 bi-tiktok"></i></a></li>
                <li><a href="{{ settings('telegram_link') }}"><i class="bi fs-2 bi-telegram"></i></a></li>
            </ul>
        </div>
    </footer>
</body>

</html>
