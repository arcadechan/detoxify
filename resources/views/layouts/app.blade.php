<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title -->
    <title>Better Spotify</title>

    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ url('/fonts/font-awesome5.css') }}">
    <link rel="stylesheet" href="{{ url('/css/app.css') }}">


    <!-- CSS Customization -->
    <!--<link rel="stylesheet" href="/assets/css/custom.css">-->

</head>

<body>
    <main id="app">
        <div class="nav-main">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-none d-lg-block text-decoration-none" href="/">
                        <img id="navbar-spotify-icon" src="{{ url('/icons/Spotify_Icon_White.png') }}">
                        <span class="navbar-brand font-weight-bold">Better Spotify</span>
                    </a>
                    <a class="d-block d-lg-none" href="/">
                        <img id="navbar-spotify-icon" src="{{ url('/icons/Spotify_Icon_White.png') }}">
                    </a>
                    <a class="navbar-brand font-weight-bold d-block d-lg-none" href="/">Better Spotify</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <svg id="hamburger-menu-icon">
                            <use xlink:href="{{ url('/icons/svg-sprites.svg#menu') }}"></use>
                        </svg>
                    </button>
                    <div class="collapse navbar-collapse mt-3 mt-md-0" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link px-2" href="/">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-2" href="/better_release_radar">Better Release Radar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-2" href="/about">About</a>
                            </li>
                            
                        </ul>

                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link px-2" href="/credits">Credits</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-2" href="/contact">Contact</a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!--end:Nav -->
            </div>
        </div>
        <!--end:Navigation -->
        <!-- Header -->
        <header>
            
        </header>
        <!-- End Header -->

        <!-- View Contents -->
        @yield('content')
        <!-- End View Contents -->

        <!-- Footer -->
        <footer class="position-relative">
            <div class="container">
                <hr class="mt-5">
                <div class="row">
                    <div class="col-lg-auto ml-lg-auto mt-4">
                        <ul class="list-unstyled footer-link">
                            <li>
                            <a href="https://www.buymeacoffee.com/arcadechan" target="_blank">Buy me a coffee</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--/.row-->
            </div>
            <!--/.container-->
        </footer>
        <!-- End Footer -->

    </main>  

</body>

@yield('scripts')

<script src="{{ url('/js/app.js') }}"></script>

</html>