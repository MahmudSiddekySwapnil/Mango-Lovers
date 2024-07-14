<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="template" content="MangoLovers">
    <meta name="title" content="MangoLovers">
    <meta name="keywords"
          content="MangoLovers,bazar,market,Mango,bazar ghor,ghore bazar,organic, food, shop, ecommerce, store, html, bootstrap, template, agriculture, vegetables, products, farm, grocery, natural, online">
    <title>MangoLovers</title>
    <link rel="icon" href="front_assets/images/mango/logo.png">
    <link rel="stylesheet" href="front_assets/fonts/flaticon/flaticon.css">
    <link rel="stylesheet" href="front_assets/fonts/icofont/icofont.min.css">
    <link rel="stylesheet" href="front_assets/fonts/fontawesome/fontawesome.min.css">
    <link rel="stylesheet" href="front_assets/vendor/venobox/venobox.min.css">
    <link rel="stylesheet" href="front_assets/vendor/slickslider/slick.min.css">
    <link rel="stylesheet" href="front_assets/vendor/niceselect/nice-select.min.css">
    <link rel="stylesheet" href="front_assets/vendor/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="front_assets/css/main.css">
    <link rel="stylesheet" href="front_assets/css/home-standard.css">
    <style>
        @media (min-width: 1400px) {
            .container, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl {
                max-width: 1550px;
            }
        }
        .p-add {
            width: 100%;
            font-size: 15px;
            padding: 6px 0px;
            border-radius: 6px;
            text-align: center;
            text-transform: capitalize;
            color: var(--heading);
            background: var(--green);
            text-shadow: var(-primary-tshadow);
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            transition: all linear .3s;
            -webkit-transition: all linear .3s;
            -moz-transition: all linear .3s;
            -ms-transition: all linear .3s;
            -o-transition: all linear .3s;
        }

        .custom-btn {
            width: 100%;
            font-size: 15px;
            padding: 6px 0px;
            border-radius: 6px;
            text-align: center;
            text-transform: capitalize;
            color: var(--heading);
            background: var(--green);
            text-shadow: var(-primary-tshadow);
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            transition: all linear .3s;
            -webkit-transition: all linear .3s;
            -moz-transition: all linear .3s;
            -ms-transition: all linear .3s;
            -o-transition: all linear .3s;
        }
    </style>
</head>

<body>
<div>
    <div class="backdrop"></div>
    <a class="backtop fas fa-arrow-up" href="#"></a>
    @if(!session()->has('username'))
        <div class="header-top alert fade show">
            <p><a href="{{route('user_register')}}">Get Register</a></p>
            {{--         <button data-bs-dismiss="alert"><i class="fas fa-times"></i></button>--}}
        </div>
    @endif
    <header class="header-part">
        <div class="container">
            <div class="header-content">
                <div class="header-media-group">
                    <button class="header-user">
                        <img src="front_assets/images/user.png" alt="user">
                    </button>
                    <a href="/"><img src="front_assets/images/mango/logo.png" alt="logo">
                    </a>
                    <button class="header-src"><i class="fas fa-search"></i></button>
                </div>
                <a href="/" class="header-logo"><img src="front_assets/images/mango/logo.png" alt="logo"
                                                     style=""></a>
                @if(session()->has('username'))
                    <li class="navbar-item dropdown header-widget">
                        <img src="front_assets/images/user.png" alt="user">
                        <ul class="dropdown-position-list">
                            <li><a href="login.html">My Account</a></li>
                            <li><a href="{{route('logout')}}">Loug out</a></li>
                            <li><a href="change-password.html">change password</a></li>
                        </ul>
                    </li>
                @else
                    <div class="header-widget">
                        <img src="front_assets/images/user.png" alt="user">

                    </div>
                @endif
                <a href="#" class="header-widget" title="My Account">
                        <span>
                            @if(session()->has('username'))
                                {{ session('username') }}
                            @else
                                <a href="{{route('user_login')}}" class="header-widget" title="My Account"
                                   style="color:#6b7280">Login</a>
                            @endif
                        </span>
                </a>
                <form class="header-form"><input type="text" placeholder="Search anything...">
                    <button><i class="fas fa-search"></i></button>
                </form>
                <button class="header-widget header-cart" title="Cartlist">
                    <i class="fas fa-shopping-basket"></i>
                    <sup class="cart-count" id="pc-cart-count">0</sup>
                </button>
                <div class="mobile-menu">
                    <a href="{{route('home')}}" title="Home Page"><i class="fas fa-home"></i><span>Home</span></a>
                    <button class="cate-btn" title="Category List"><i class="fas fa-list"></i><span>category</span></button>
                    <button class="cart-btn" title="Cartlist">
                        <i class="fas fa-shopping-basket"></i><span>cartlist</span>
                        <sup class="cart-count" id="mobile-cart-count">0</sup>
                    </button>
                </div>
            </div>
        </div>
    </header>
    <aside class="cart-sidebar">
        <div class="cart-header">
            <div class="cart-total">
                <i class="fas fa-shopping-basket"></i>
                <span>total item ()</span>
            </div>
            <button class="cart-close">
                <i class="icofont-close"></i>
            </button>
        </div>
        <ul class="cart-list">
            {{-- <!-- Cart items will be dynamically inserted here -->--}}
        </ul>
        <div class="cart-footer">
            <button class="coupon-btn">Do you have a coupon code?</button>
            <form class="coupon-form">
                <input type="text" placeholder="Enter your coupon code">
                <button type="submit">
                    <span>apply</span>
                </button>
            </form>
            @if(session()->has('username'))
                <a class="cart-checkout-btn" href="{{ route('checkout') }}">
                    <span class="checkout-label">Proceed to Checkout</span>
                    <span class="checkout-price">$0.00</span>
                </a>
            @else
                <a class="cart-checkout-btn" href="{{ route('user_login') }}">
                    <span class="checkout-label">Login to Checkout</span>
                </a>
            @endif

        </div>
    </aside>
    <!-- Assuming there is a cart box element that triggers the cart display -->
    <div class="cart-box"></div>
{{--    @include('landing_view.common.home_header')--}}
    @include('landing_view.common.top_navbar')
    @include('landing_view.common.mobile_view_side_navbar')
    <div>
        @yield('content')
    </div>
    @include('landing_view.common.home_footer')
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Attach click event listener to the cart close button
        $('.cart-close').click(function() {
            location.reload(); // Reload the page
        });
    });
</script>
<script src="front_assets/vendor/bootstrap/jquery-1.12.4.min.js"></script>
<script src="front_assets/vendor/bootstrap/popper.min.js"></script>
<script src="front_assets/vendor/bootstrap/bootstrap.min.js"></script>
<script src="front_assets/vendor/countdown/countdown.min.js"></script>
<script src="front_assets/vendor/niceselect/nice-select.min.js"></script>
<script src="front_assets/vendor/slickslider/slick.min.js"></script>
<script src="front_assets/vendor/venobox/venobox.min.js"></script>
<script src="front_assets/js/nice-select.js"></script>
<script src="front_assets/js/countdown.js"></script>
<script src="front_assets/js/accordion.js"></script>
<script src="front_assets/js/venobox.js"></script>
<script src="front_assets/js/slick.js"></script>
<script src="front_assets/js/main.js"></script>
<script src="front_assets/js/cart.js"></script>
<script src="front_assets/js/cartoperation.js"></script>

</body>
</html>
