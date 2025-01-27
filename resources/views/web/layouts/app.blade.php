<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Portfolio - MyPortfolio Bootstrap Template</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/web/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/web/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/web/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/web/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/web/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/web/assets/css/main.css') }}" rel="stylesheet">

    <!-- =======================================================
    * Template Name: MyPortfolio
    * Template URL: https://bootstrapmade.com/myportfolio-bootstrap-portfolio-website-template/
    * Updated: Aug 08 2024 with Bootstrap v5.3.3
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body class="portfolio-page">

<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid  position-relative d-flex align-items-center justify-content-between">

        <a href="index.html" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1 class="sitename">Product Management</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ route('products.index') }}">Products</a></li>
                <li><a href="{{ route('cart.index') }}">Cart</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

    </div>
</header>
@yield('content')
<footer id="footer" class="footer light-background">

    <div class="container">
        <div class="copyright text-center ">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Products</strong> <span>All Rights Reserved</span></p>
        </div>
        <div class="social-links d-flex justify-content-center">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
        </div>
        <div class="credits">
        </div>
    </div>

</footer>
<div class="modal fade" id="modalSuccess">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="checkout-card text-center">
                    <i class="icon anm anm-check-cil text-success"></i>
                    <h3>{{ session()->get('success') }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalError">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="checkout-card text-center">
                    <i class="icon anm anm-times-cil text-danger"></i>
                    <h3>{{ session()->get('error') }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="{{ asset('assets/web/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/web/assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('assets/web/assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/web/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/web/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/web/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/web/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

<!-- Main JS File -->
<script src="{{ asset('assets/web/assets/js/main.js') }}"></script>

<script>
    $(function () {
        @if(session()->has('success'))
        $('#modalSuccess').modal('toggle');
        @endif
        @if(session()->has('error'))
        $('#modalError').modal('toggle');
        @endif

        function closeModalAfterDelay(modalId, delay) {
            setTimeout(function () {
                $(modalId).modal('hide');
            }, delay);
        }

        closeModalAfterDelay('#modalSuccess', 1500);
        closeModalAfterDelay('#modalError', 1500);
    });
</script>
@stack('js')
</body>

</html>
