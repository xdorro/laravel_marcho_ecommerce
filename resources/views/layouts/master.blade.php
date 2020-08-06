<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ - Marcho Shop</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Custom Style -->
    {!! \Assets::renderHeader() !!}

    @yield('style')
</head>

<body>
    <header>
        <div class="container">
            <nav class="menu_bar navbar navbar-expand-lg align-items-center justify-content-between">
                <a class="header_logo navbar-brand" href="{{ route('home') }}">
                    <img class="logo d-inline-block align-middle" src="{{ asset('assets/img/logo.svg') }}" alt="">
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="header_menu navbar-nav">
                        <li class="nav-item {{ (request()->routeIs('home')) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('home') }}">Trang chủ</a>
                        </li>
                        <li class="nav-item {{ (request()->routeIs('product*')) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('product.index') }}">Sản phẩm</a>
                        </li>
                        <li class="nav-item {{ (request()->routeIs('blog.*')) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('blog.index') }}">Tin tức</a>
                        </li>
                        <li class="nav-item {{ (request()->routeIs('contact')) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('contact') }}">Liên hệ</a>
                        </li>
                    </ul>
                </div>

                <ul class="header_icon navbar-nav flex-row align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="tooltip" title="Tìm kiếm">
                            <i class="fal fa-search"></i>
                        </a>
                    </li>
                    @php
                    $user = auth()->user();
                    $cart = Cart::name('shopping');
                    $cartCount = $cart->sumItemsQuantity();
                    $favoriteCount = $user ? $user->favorites()->count() : 0;
                    @endphp
                    <li class="nav-item">
                        <a class="nav-link icon_love" href="{{ route('favorite.index') }}">
                            <i class="fal fa-heart"></i>
                            <span id="favorite_count" class="wishlist_count">{{ $favoriteCount }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link icon_cart" href="{{ route('cart.index') }}">
                            <i class="fal fa-shopping-cart"></i>
                            <span id="cart_count" class="cart_count">{{ $cartCount }}</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        @if(auth()->check())
                        <a class="nav-link user_header" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ asset($user->avatar ? auth()->user()->avatar : 'assets/img/user2-160x160.jpg') }}" alt="" class="rounded-circle img-fluid" width="35px" height="35px">
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @can('admin.dashboard')
                            <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Trang quản trị</a>
                            @endcan

                            @can('admin.dashboard')
                            <a class="dropdown-item" href="{{ route('admin.profile') }}">Trang cá nhân</a>
                            @endcan

                            @cannot('admin.dashboard')
                            <a class="dropdown-item" href="{{ route('profile.index') }}">Trang cá nhân</a>
                            @endcan

                            <div class="dropdown-divider"></div>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fal fa-sign-out"></i> Đăng xuất
                                </button>
                            </form>
                        </div>
                        @else
                        <a class="nav-link" href="{{ route('login') }}" data-toggle="tooltip" title="Đăng nhập">
                            <i class="fal fa-user-circle"></i>
                        </a>
                        @endif
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <div id="app">
        @yield('main')
    </div>

    <footer class="bg_gray pt-5 pb-3">
        <div class="container">
            <div class="row">
                <div class="address col-md-3">
                    <h5 class="my-3">
                        <img class="logo d-inline-block align-middle" src="{{ asset('assets/img/logo.svg') }}" alt="">
                    </h5>
                    <p>
                        No. 342 - London Oxford Street,<br />
                        012 United States<br />
                        Youremail@gmail.com<br />
                        +0283 838 8393
                    </p>
                </div>

                <hr class="clearfix w-100 d-md-none">

                <div class="col-md-2">
                    <h5 class="section_title my-3">Liên kết</h5>

                    <ul class="list-unstyled">
                        <li>
                            <a href="{{ route('home') }}">Trang chủ</a>
                        </li>
                        <li>
                            <a href="{{ route('product.index') }}">Sản phẩm</a>
                        </li>
                        <li>
                            <a href="{{ route('blog.index') }}">Tin tức</a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}">Liên hệ</a>
                        </li>
                        <li>
                            <a href="{{ route('home') }}">Tìm kiếm</a>
                        </li>
                    </ul>
                </div>

                <hr class="clearfix w-100 d-md-none">

                <div class="col-md-2">
                    <h5 class="section_title my-3">Tài khoản</h5>
                    <ul class="list-unstyled">
                        <li>
                            <a href="{{ route('profile.index') }}">Tài khoản của tôi</a>
                        </li>
                        <li>
                            <a href="{{ route('cart.index') }}">Giỏ hàng</a>
                        </li>
                        <li>
                            <a href="{{ route('favorite.index') }}">Yêu thích</a>
                        </li>
                        <li>
                            <a href="{{ route('login') }}">Đăng nhập</a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}">Đăng ký</a>
                        </li>
                    </ul>
                </div>

                <hr class="clearfix w-100 d-md-none">

                <div class="subscribe col-md-5">
                    <h5 class="section_title my-3">Theo dõi tin tức mới nhất</h5>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida.</p>

                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="email" placeholder="Your email address" name="email" required="">
                        <button class="btn my-2 my-sm-0" type="submit">subscribe</button>
                    </form>
                </div>
            </div>

            <hr>

            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="copyright mb-md-0 text-center text-md-left">© 2020 CodeAstrology. All Rights Reserved.</p>
                    </div>
                    <div class="col-md-6">
                        <ul class="footer_payment text-center text-md-right">
                            <li>
                                <a href="#">
                                    <img src="{{ asset('assets/img/payment/visa.png') }}" alt="visa">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="{{ asset('assets/img/payment/discover.png') }}" alt="discover">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="{{ asset('assets/img/payment/master_card.png') }}" alt="master_card">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="{{ asset('assets/img/payment/paypal.png') }}" alt="paypal">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="{{ asset('assets/img/payment/amarican_express.png') }}" alt="amarican_express">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Custom Script -->
    {!! \Assets::renderFooter() !!}

    @yield('script')

    @if(session('success'))
    <script>
        $(function() {
            Swal.fire({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 3000,
                icon: "success",
                title: "{{ session('success') }}",
            });
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        $(function() {
            Swal.fire({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 3000,
                icon: "error",
                title: "{{ session('error') }}",
            });
        });
    </script>
    @endif
</body>

</html>