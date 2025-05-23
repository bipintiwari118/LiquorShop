<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="{{ asset('frontend/images/favicon.png') }}" type="">
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.css') }}" />
    <!-- font awesome style -->
    <link href="{{ asset('frontend/css/font-awesome.min.css') }}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" /> --}}
    @yield('styles')
</head>

<body>

    <!-- header section strats -->
    <header class="header_section">
        <div class="container">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
                <a class="navbar-brand" href="{{ route('home') }}"><img width="200"
                        src="{{ asset('frontend/images/logo_online_liqour_shop-removebg-preview.png') }}" alt="#" /></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class=""> </span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Home</a>
                        </li>
                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Pages <span
                                        class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="about.html">About</a></li>
                                <li><a href="testimonial.html">Testimonial 1</a></li>
                            </ul>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link" href=" {{ route('beer.show') }}">Beer</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('vodka.show') }}">Vodka</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('rum.show') }}">Rum</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('softDrink.show') }}">Soft Drink</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cigratte.show') }}">Cigarette</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('snack.show') }}">Snacks</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart') }}">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;"
                                    xml:space="preserve">
                                    <g>
                                        <g>
                                            <path
                                                d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                                          c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
                                          C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
                                          c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
                                          C457.728,97.71,450.56,86.958,439.296,84.91z" />
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path
                                                d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
                                          c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                                        </g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                </svg>
                                <sup>{{\Cart::getContent()->count() }}</sup>
                            </a>
                        </li>
                        {{-- <form class="form-inline">
                            <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </form> --}}
                        <!-- Conditional Buttons -->
                        {{-- @if (Auth::check())
                            <!-- Show Logout Button if User is Logged In -->
                            <li class="nav-item">
                                <a class="btn btn-danger ml-5" href="">Logout</a>
                            </li>
                        @else --}}
                        <!-- Show Login and Register Buttons if User is Logged Out -->
                        {{-- <li class="nav-item">
                                <a class="btn btn-primary ml-5" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-success ml-3" href="{{ route('register') }}">Register</a>
                            </li> --}}
                        {{-- @endif --}}
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <!-- end header section -->

    @yield('content')

    <!-- footer start -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="full">
                        <div class="logo_footer">
                            <a href="#"><img width="210" src="{{ asset('frontend/images/logo_online_liqour_shop-removebg-preview.png') }}"
                                    alt="#" /></a>
                        </div>
                        <div class="information_f">
                            <p><strong>ADDRESS:</strong> New Bus Park, Kathmandu</p>
                            <p><strong>TELEPHONE:</strong> +977 9813834870</p>
                            <p><strong>EMAIL:</strong> Bipintiwari118@gmail.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="widget_menu">
                                        <h3>Menu</h3>
                                        <ul>
                                            <li><a href="{{ route('home') }}">Home</a></li>
                                            <li><a href="">Blog</a></li>
                                            <li><a href="{{ route('contact') }}">Contact</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="widget_menu">
                                        <h3>Products</h3>
                                        <ul>
                                            <li><a href="{{ route('beer.show') }}">Beers</a></li>
                                            <li><a href="{{ route('rum.show') }}">Rums</a></li>
                                            <li><a href="{{ route('vodka.show') }}">Vodkas</a></li>
                                            <li><a href="{{ route('snack.show') }}">Snacks</a></li>
                                            <li><a href="{{ route('cigratte.show') }}">Cigrattes</a></li>
                                            <li><a href="{{ route('softDrink.show') }}">Soft Drinks</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="widget_menu">
                                <h3>Contact Us</h3>
                                <ul>
                                    <li><a href="#">Contact</a></li>
                                    <li>
                                        <a href="https://facebook.com/" target="_blank">
                                            Facebook
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://instagram.com/" target="_blank">
                                            Instagram
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://youtube.com/" target="_blank">
                                            YouTube
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://tiktok.com/" target="_blank">
                                            TikTok
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer end -->
    <div class="cpy_">
        <p class="mx-auto">© 2025 All Rights Reserved By <a href="https://bipintiwari.com.np/">Liquor Shop</a><br>

            Distributed By <a href="https://bipintiwari.com.np/" target="_blank">Bipin Tiwari</a>

        </p>
    </div>
    <!-- jQery -->
    <script src="{{ asset('frontend/js/jquery-3.4.1.min.js') }}"></script>
    <!-- popper js -->
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('frontend/js/bootstrap.js') }}"></script>
    <!-- custom js -->
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    @stack('scripts')
</body>

</html>
