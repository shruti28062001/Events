<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="msapplication-TileColor" content="#0E0E0E">
    <meta name="template-color" content="#0E0E0E">
    <meta name="description" content="Index page">
    <meta name="keywords" content="index, page">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/imgs/template/uxlogo.svg')}}">
    <title>@if(!empty($meta_title)){{ $meta_title }} @else {{config('app.name')}} @endif</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if(!empty($meta_description)) <meta name="description" content="{{ $meta_title }}"> 
    @else <meta name="description" content="{{config('app.name')}}"> @endif

    <meta property="og:title" content="{{config('app.name')}}" />
    <meta property="og:type" content="site" />
    <meta property="og:description" content="{{config('app.name')}}" />
    <meta property="og:url" content="{{url('/')}}" />
    <meta property="og:image"  content="{{asset('assets/imgs/template/favicon.png')}}"  />
    
    <meta name="twitter:title" content="{{config('app.name')}}">
    <meta name="twitter:description" content="{{config('app.name')}}">
    <meta name="twitter:image"  content="{{asset('assets/imgs/template/favicon.png')}}" >
    <meta name="twitter:card" content="summary_large_image">

    <!-- Stylesheets-->
    <link href="{{asset('assets/css/style.css?v=5.0.0')}}" rel="stylesheet">
    
    @yield('styles')
</head>
<body>
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="page-loading">
                    <div class="page-loading-inner">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Page Header-->
    <!-- @include('layouts/frontLayout/front_header') -->

    @yield('content')

    <!-- Page Footer-->
    <!-- @include('layouts/frontLayout/front_footer') -->

    <!-- scripts -->
    <script src="{{asset('assets/js/vendors/modernizr-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/js/vendors/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/js/vendors/jquery-migrate-3.3.0.min.js')}}"></script>
    <script src="{{asset('assets/js/vendors/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/vendors/waypoints.js')}}"></script>
    <script src="{{asset('assets/js/vendors/wow.js')}}"></script>
    <script src="{{asset('assets/js/vendors/magnific-popup.js')}}"></script>
    <script src="{{asset('assets/js/vendors/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('assets/js/vendors/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/vendors/isotope.js')}}"></script>
    <script src="{{asset('assets/js/vendors/scrollup.js')}}"></script>
    <script src="{{asset('assets/js/vendors/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/vendors/noUISlider.js')}}"></script>
    <script src="{{asset('assets/js/vendors/slider.js')}}"></script>
    <!-- Count down-->
    <script src="{{asset('assets/js/vendors/counterup.js')}}"></script>
    <script src="{{asset('assets/js/vendors/jquery.countdown.min.js')}}"></script>
    <!-- Count down-->
    <script src="{{asset('assets/js/vendors/jquery.elevatezoom.js')}}"></script>
    <script src="{{asset('assets/js/vendors/slick.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <script src="{{asset('assets/js/main.js?v=5.0.0')}}"></script>
    <script src="{{asset('assets/js/ali-animation.js?v=1.0.0')}}"></script>

    @yield('scripts')

</body>
</html>