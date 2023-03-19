<title>@yield('title', 'Home')</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!--===============================================================================================-->
<link rel="icon" type="image/png" href="{{ asset('page/images/icons/favicon.png') }}" />
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('page/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('page/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('page/fonts/iconic/css/material-design-iconic-font.min.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('page/fonts/linearicons-v1.0.0/icon-font.min.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('page/vendor/animate/animate.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('page/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('page/vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('page/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('page/vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('page/vendor/slick/slick.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('page/vendor/MagnificPopup/magnific-popup.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('page/vendor/perfect-scrollbar/perfect-scrollbar.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('page/css/util.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('page/css/main.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('page/css/style.css') }}">
<!--===============================================================================================-->
@yield('style')