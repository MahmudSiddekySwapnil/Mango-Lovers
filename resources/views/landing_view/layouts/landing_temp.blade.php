<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="template" content="BazarGhor">
    <meta name="title" content="BazarGhor - At Your Door Step">
    <meta name="keywords"
        content="bazarGhor,bazar,market,bazzarghor,bazar ghor,ghore bazar,organic, food, shop, ecommerce, store, html, bootstrap, template, agriculture, vegetables, products, farm, grocery, natural, online">
    <title>Bazar Ghor</title>
    <link rel="icon" href="front_assets/images/icon.png">
    <link rel="stylesheet" href="front_assets/fonts/flaticon/flaticon.css">
    <link rel="stylesheet" href="front_assets/fonts/icofont/icofont.min.css">
    <link rel="stylesheet" href="front_assets/fonts/fontawesome/fontawesome.min.css">
    <link rel="stylesheet" href="front_assets/vendor/venobox/venobox.min.css">
    <link rel="stylesheet" href="front_assets/vendor/slickslider/slick.min.css">
    <link rel="stylesheet" href="front_assets/vendor/niceselect/nice-select.min.css">
    <link rel="stylesheet" href="front_assets/vendor/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="front_assets/css/main.css">
    <link rel="stylesheet" href="front_assets/css/home-standard.css">
</head>

<body>
    <div>
        @include('landing_view.common.home_header')
        @include('landing_view.common.top_navbar')

        <div>
            @yield('content')
        </div>

        @include('landing_view.common.home_footer')
    </div>

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
