<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="template" content="MangoLovers">
    <meta name="title" content="MangoLovers - Ecommerce Food Store HTML Template">
    <meta name="keywords" content="MangoLovers, organic, food, shop, ecommerce, store, html, bootstrap, template, agriculture, vegetables, products, farm, grocery, natural, online">
    <title>MangoLovers</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="icon" href="front_assets/images/favicon.png">
    <link rel="stylesheet" href="front_assets/fonts/flaticon/flaticon.css">
    <link rel="stylesheet" href="front_assets/fonts/icofont/icofont.min.css">
    <link rel="stylesheet" href="front_assets/fonts/fontawesome/fontawesome.min.css">
    <link rel="stylesheet" href="front_assets/vendor/venobox/venobox.min.css">
    <link rel="stylesheet" href="front_assets/vendor/slickslider/slick.min.css">
    <link rel="stylesheet" href="front_assets/vendor/niceselect/nice-select.min.css">
    <link rel="stylesheet" href="front_assets/vendor/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="front_assets/css/main.css">
    <link rel="stylesheet" href="front_assets/css/user-auth.css">
</head>
<body>
<section class="user-form-part">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-12 col-lg-12 col-xl-10">
                <div class="user-form-logo">
                    <a href="index.html">
                        <img src="front_assets/images/mango/logo.png" alt="logo">
                    </a>
                </div>
                <div class="user-form-card">
                    <div class="user-form-title">
                        <h2>Join Now!</h2>
                        <p>Setup A New Account In A Minute</p>
                    </div>
                    <div class="user-form-group">
                        <!-- <ul class="user-form-social">
                          <li>
                            <a href="#" class="facebook">
                              <i class="fab fa-facebook-f"></i>Join with facebook </a>
                          </li>
                          <li>
                            <a href="#" class="twitter">
                              <i class="fab fa-twitter"></i>Join with twitter </a>
                          </li>
                          <li>
                            <a href="#" class="google">
                              <i class="fab fa-google"></i>Join with google </a>
                          </li>
                          <li>
                            <a href="#" class="instagram">
                              <i class="fab fa-instagram"></i>Join with instagram </a>
                          </li>
                        </ul>
                        <div class="user-form-divider">
                          <p>or</p>
                        </div> -->


                        <form class="user-form" id="user-form">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter your name" name="name" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Enter your email" name="email" required>
                            </div>
                            <div class="form-group">
                                <input type="tel" class="form-control" placeholder="Enter phone number" name="phone" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Enter your password" name="password" required>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="" id="check" required>
                                <label class="form-check-label" for="check">Accept all the <a href="#">Terms & Conditions</a></label>
                            </div>
                            <div class="form-button">
                                <button type="submit">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="user-form-remind">
                    <p>Already Have An Account? <a href="{{route('user_login')}}">login here</a>
                    </p>
                </div>
                <div class="user-form-footer">
                    <p>&COPY; Copyright by <a href="#">Mango Lovers</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
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
<script src="front_assets/js/user-register.js"></script>

</body>
</html>
