<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="template" content="MangoLovers">
    <meta name="title" content="MangoLovers - Ecommerce Food Store HTML Template">
    <meta name="keywords" content="MangoLovers, organic, food, shop, ecommerce, store, html, bootstrap, template, agriculture, vegetables, products, farm, grocery, natural, online">
    <title>Greeny - Login</title>
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
                        <h2>welcome!</h2>
                        <p>Use your credentials to access</p>
                    </div>
                    <div class="user-form-group">
                        <ul class="user-form-social">
                            <li>
                                <a href="#" class="facebook">
                                    <i class="fab fa-facebook-f"></i>login with facebook </a>
                            </li>
                            <li>
                                <a href="#" class="twitter">
                                    <i class="fab fa-twitter"></i>login with twitter </a>
                            </li>
                            <li>
                                <a href="#" class="google">
                                    <i class="fab fa-google"></i>login with google </a>
                            </li>
                            <li>
                                <a href="#" class="instagram">
                                    <i class="fab fa-instagram"></i>login with instagram </a>
                            </li>
                        </ul>
                        <div class="user-form-divider">
                            <p>or</p>
                        </div>
                        <form class="user-form">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Enter your email">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Enter your password">
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="remember" value="yes" id="check">
                                <label class="form-check-label" for="check">Remember Me</label>
                            </div>
                            <div class="form-button">
                                <button type="submit">login</button>
                                <p>Forgot your password? <a href="reset-password.html">reset here</a></p>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="user-form-remind">
                    <p>Don't have any account? <a href="{{route('user_register')}}">register here</a>
                    </p>
                </div>
                <div class="user-form-footer">
                    <p>&COPY; Copyright by <a href="#">Mango Lovers</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const form = document.querySelector('.user-form');

            form.addEventListener('submit', async (event) => {
                event.preventDefault(); // Prevent default form submission

                // Gather the form data
                const formData = new FormData(form);
                const formObject = Object.fromEntries(formData.entries());

                // Log the gathered data to see what we are sending
                console.log(formObject);
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                try {
                    // Send the data using Fetch API
                    const response = await fetch('/user_login_process', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-Token': csrfToken // Include the CSRF token in the headers

                        },
                        body: JSON.stringify(formObject)
                    });

                    // Handle the response
                    if (response.ok) {
                        const result = await response.json();
                        window.location.href = result.redirect;
                        console.log('Success:', result);
                    } else {
                        console.error('Error:', response.statusText);
                    }
                } catch (error) {
                    console.error('Fetch error:', error);
                }
            });
        });
    </script>
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
</body>
</html>
