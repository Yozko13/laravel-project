<!DOCTYPE html>
<html lang="bg">
    <head>
        <meta charset="UTF-8" />
        <meta name="description" content="" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <!-- Title  -->
        <title>{{ __('The 3D Workshop') }}</title>

        <!-- Favicon  -->
        <link rel="icon" href="{{ asset('favicon.ico') }}" />

        <!-- Core Style CSS -->
        <link rel="stylesheet" href="{{ asset('web/css/core-style.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/common-styles.css') }}" />
        <link rel="stylesheet" href="{{ asset('web/css/style.css') }}" />
    </head>
<body>
    <!-- Search Wrapper Area Start -->
    <div class="search-wrapper section-padding-100">
        <div class="search-close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="search-content">
                        <form action="#" method="get">
                            <input type="search" name="search" id="search" placeholder="Type your keyword...">
                            <button type="submit"><img src="{{ asset('web/img/core-img/search.png') }}" alt="" /></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Wrapper Area End -->
    @if (env('APP_DEBUG') && $errors->any())
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (Session::has('success_message'))
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-success">{{ Session::get('success_message') }}</div>
                </div>
            </div>
        </div>
    @endif
    @if (Session::has('error_message'))
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger">{{ Session::get('error_message') }}</div>
                </div>
            </div>
        </div>
    @endif
    @error('system_error')
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger">{{ $message }}</div>
                </div>
            </div>
        </div>
    @enderror
    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix">

        <!-- Mobile Nav (max width 767px)-->
        <div class="mobile-nav">
            <!-- Navbar Brand -->
            <div class="amado-navbar-brand">
                <a href="index.html"><img src="{{ asset('web/img/core-img/logo.png') }}" alt="" /></a>
            </div>
            <!-- Navbar Toggler -->
            <div class="amado-navbar-toggler">
                <span></span><span></span><span></span>
            </div>
        </div>

        <!-- Header Area Start -->
        <header class="header-area clearfix">
            <!-- Close Icon -->
            <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            <!-- Logo -->
            <div class="logo">
                <a href="index.html"><img src="{{ asset('web/img/core-img/logo.png') }}" alt="" /></a>
            </div>
            <!-- Amado Nav -->
            <nav class="amado-nav">
                <ul>
                    <li {!! $route_mame == 'home' ? 'class="active"' : '' !!}>
                        <a href="{{ route('home') }}" title="{{ __('Home') }}">{{ __('Home') }}</a>
                    </li>
                    <li {!! $route_mame == 'shop-around' ? 'class="active"' : '' !!}>
                        <a href="{{ route('shop-around') }}" title="{{ __('Shop around') }}">{{ __('Shop around') }}</a>
                    </li>
                </ul>
            </nav>
            <!-- Button Group -->
            <div class="amado-btn-group mt-30 mb-100">
                <a href="#" class="btn amado-btn mb-15">%Discount%</a>
                <a href="#" class="btn amado-btn active">New this week</a>
            </div>
            <!-- Cart Menu -->
            <div class="cart-fav-search mb-100">
                <a href="{{ $current_cart ? route('cart.show', $current_cart->id) : route('shop-around') }}" class="cart-nav">
                    <img src="{{ asset('web/img/core-img/cart.png') }}" alt="{{ __('Cart') }}" title="{{ __('Cart') }}" /> {{ __('Cart') }}
                    <span>({{ $current_cart->quantity ?? 0 }})</span>
                </a>
                <a href="#" class="fav-nav"><img src="{{ asset('web/img/core-img/favorites.png') }}" alt="" /> Favourite</a>
                <a href="#" class="search-nav"><img src="{{ asset('web/img/core-img/search.png') }}" alt="" /> Search</a>
            </div>
            <!-- Social Button -->
            <div class="social-info d-flex justify-content-between">
                <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div>
        </header>
        <!-- Header Area End -->
