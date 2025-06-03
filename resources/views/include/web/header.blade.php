<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gold Depot</title>
    <link rel="stylesheet" href="{{ asset('assets/web/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/web/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/web/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/web/css/responsive.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css"
        integrity="sha512-kJlvECunwXftkPwyvHbclArO8wszgBGisiLeuDFwNM8ws+wKIw0sv1os3ClWZOcrEB2eRXULYUsm8OVRGJKwGA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>

<body>
    <header>
        <div class="topbar">
            <div class="container-fluid">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-2 col-md-3 col-6">
                        <div class="translater-area" style="display: none;">
                            <div id="google_translate_element"></div>
                        </div>
                        <div class="dropdown dropdown-language">
                            <button class="btn btn-secondary dropdown-toggle trans-btn" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Eng
                            </button>
                            <ul class="dropdown-menu flag">
                                <li>
                                    <button class="flag_link eng dropdown-item default" data-lang="en">
                                        Eng
                                    </button>
                                </li>
                                <li>
                                    <button class="flag_link chi dropdown-item" data-lang="zh-CN">
                                        Chinese
                                    </button>
                                </li>


                                <li>
                                    <button class="flag_link eng dropdown-item default" data-lang="ar">
                                        Arabic
                                    </button>
                                </li>
                                <li>
                                    <button class="flag_link chi dropdown-item" data-lang="bn">
                                        Bengali
                                    </button>
                                </li>
                                <li>
                                    <button class="flag_link eng dropdown-item default" data-lang="zh-CN">
                                        Chinese (Simplified)
                                    </button>
                                </li>
                                <li>
                                    <button class="flag_link chi dropdown-item" data-lang="zh-TW">
                                        Chinese (Traditional)
                                    </button>
                                </li>
                                <li>
                                    <button class="flag_link eng dropdown-item default" data-lang="fi">
                                        Finnish
                                    </button>
                                </li>
                                <li>
                                    <button class="flag_link chi dropdown-item" data-lang="ht">
                                        Haitian Creole
                                    </button>
                                </li>
                                <li>
                                    <button class="flag_link eng dropdown-item default" data-lang="ko">
                                        Korean
                                    </button>
                                </li>
                                <li>
                                    <button class="flag_link chi dropdown-item" data-lang="ru">
                                        Russian
                                    </button>
                                </li>
                                <li>
                                    <button class="flag_link chi dropdown-item" data-lang="es">
                                        Spanish
                                    </button>
                                </li>
                                <li>
                                    <button class="flag_link chi dropdown-item" data-lang="ur">
                                        Urdu
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-6">
                        @auth
                            <li class="nav-item dropdown" style="list-style: none">
                                <a class="nav-link dropdown-toggle right-profile" href="#" id="navbarDropdown"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="https://cdn.vectorstock.com/i/1000v/51/05/male-profile-avatar-with-brown-hair-vector-12055105.jpg"
                                        alt=""> {{ auth()->user()->first_name }}
                                </a>
                                <ul class="dropdown-menu profile-dropdown" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a></li>
                                    <li><a class="dropdown-item" href="{{ route('profile.index') }}">Manage My profile</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li>
                        @else
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('login') }}" class="top-link">Login</a>
                                <span>/</span>
                                <a href="{{ route('register') }}" class="top-link">Signup</a>
                            </div>
                        @endauth

                    </div>
                </div>
            </div>
        </div>
        <div class="header">
            <img class="logo-bg" src="{{ asset('assets/web/images/logobg.png') }}" alt="">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-3 col-md-6 col-5">
                        <div class="logo-area">
                            <img class="img-fluid" src="{{ asset('assets/web/images/logo.png') }}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-1 col-1">
                        <nav class="navbar-menu">
                            <ul class="list">
                                <li class="list-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="list-item"><a href="{{ route('about') }}">About Us</a></li>

                                @foreach ($categories as $category)
                                    <li class="list-item"><a
                                            href="{{ route('shop.category', $category->id) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach

                                {{-- <li class="list-item"><a href="{{ route('shop.category') }}">Gold</a></li>
                                <li class="list-item"><a href="{{ route('shop.category') }}">Platinum</a></li> --}}
                                <li class="list-item"><a href="{{ route('shop.index') }}">Shop All</a></li>
                                <li class="list-item"><a href="{{ route('blog') }}">Blog</a></li>
                                <li class="list-item"><a href="{{ route('contact') }}">Contact Us</a></li>

                            </ul>
                            <div>
                                <button class="menu-close">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        </nav>
                    </div>
                    <div class="col-lg-3 col-md-5 col-6">
                        <div class="header-cart-area">
                            <div class="search-open">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>
                            <div class="call-area">
                                <i class="fa-solid fa-phone-volume"></i>
                            </div>
                            <a href="{{ route('cart.index') }}" class="black">
                                @if (session()->has('cart') && count(session()->get('cart')))
                                    <div class="cart-area">
                                        <span class="cart-count">
                                            {{ count(session()->get('cart')) }}


                                        </span>
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        <span class="cart-text">Cart</span>

                                    </div>

                                    @else
                                     <div class="cart-area">
                                        <span class="cart-count">
                                            {{ 0 }}


                                        </span>
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        <span class="cart-text">Cart</span>

                                    </div>
                                @endif
                            </a>
                            <div>
                                <button class="menu-open">
                                    <i class="fa-solid fa-bars fa-fw"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="gold-prices-area">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-md-12 col-12">
                        <div class="liv-gold-area">
                            <strong class="liv-spot-hd">Live Spot Prices:</strong>
                            <p class="para"><strong>Gold Ask:</strong> <span>$2,418.10 , $28.65</span></p>
                            <span class="divid"></span>
                            <p class="para"><strong>Silver Ask:</strong> <span>$2,418.10 , $28.65</span></p>
                            <span class="divid"></span>
                            <p class="para"><strong>Platrinum Ask:</strong> <span>$2,418.10 , $28.65</span></p>
                            <span class="divid"></span>
                            <p class="para"><strong>Palladium Ask:</strong> <span>$2,418.10 , $28.65</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
