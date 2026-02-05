<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">


        <!-- Styles / Scripts -->

    </head>

    <body class="d-flex flex-column min-vh-100">

          @if (Route::has('login'))
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">

        {{-- Brand --}}
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
            NGOAB
        </a>

        {{-- Mobile toggle --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Menu --}}
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">

                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/dashboard') }}">
                            Dashboard
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            Login
                        </a>
                    </li>

                    @if (Route::has('register'))
                        <li class="nav-item ms-lg-2">
                            <a class="btn btn-outline-primary" href="{{ route('register') }}">
                                Register
                            </a>
                        </li>
                    @endif
                @endauth

            </ul>
        </div>

    </div>
</nav>
@endif

 <!-- Hero Section -->
    <section class="bg-light py-5">
        <div class="container text-center">
            <h1 class="fw-bold mb-3">
                Welcome to My Website
            </h1>
            <p class="text-muted mb-4">
                This is your Laravel + Bootstrap homepage.
            </p>
    </section>


  <!-- Footer -->

    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <small>
            © {{ date('Y') }} My Website. All rights reserved.
        </small>
    </footer>

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
