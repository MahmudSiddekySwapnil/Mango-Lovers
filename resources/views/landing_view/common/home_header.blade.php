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
                <a href="/"><img src="front_assets/images/logo.png" alt="logo">
                </a>
                <button class="header-src"><i class="fas fa-search"></i></button>
            </div>
            <a href="/" class="header-logo"><img src="front_assets/images/mango/logo.png" alt="logo" style="width:100px; height:50px;"></a>
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
            <div class="header-widget-group"><a href="compare.html" class="header-widget" title="Compare List"><i
                        class="fas fa-random"></i><sup>0</sup></a><a href="wishlist.html" class="header-widget"
                                                                     title="Wishlist"><i
                        class="fas fa-heart"></i><sup>0</sup></a>
                <button class="header-widget header-cart" title="Cartlist">
                    <i class="fas fa-shopping-basket"></i>
                    <sup id="cart-count">0</sup>
                </button>
            </div>
        </div>
    </div>
</header>{{--                    <span>total price<small id="cart-total-price">৳ 0.00</small></span>--}}

