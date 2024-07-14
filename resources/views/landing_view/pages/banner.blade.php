<style>
    /* Ensure images are responsive and maintain aspect ratio */
    .responsive-image {
        width: 100%;
        height: auto; /* Auto height to maintain aspect ratio */
        object-fit: cover; /* Ensure the image covers the container without distortion */
        max-height: 450px; /* Fixed max height for all devices */
    }

    /* Make sure the parent container is responsive */
    .home-grid-slider {
        width: 100%;
    }

    /* Additional styling for the slider */
    .banner-wrap {
        margin-bottom: 20px; /* Adjust as needed for spacing */
    }

    /* Responsive layout adjustments */
    @media (max-width: 768px) {
        .responsive-image {
            max-height: 300px; /* Adjust height for smaller screens if necessary */
        }
    }

    @media (max-width: 576px) {
        .responsive-image {
            max-height: 250px; /* Adjust height for even smaller screens if necessary */
        }
    }
    .banner-image {
        width: 100%;
        height: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

    .banner-image img {
        width: 100%;
        height: auto;
        object-fit: contain; /* This ensures the image will scale down to fit within its container without cropping */
        max-width: 100%;

    }
</style>

<div class="col-lg-10">
    <div class="row">
        <div class="col-lg-12">
            <div class="home-grid-slider slider-dots">
                @foreach($banners as $banner)
                <div class="banner-wrap">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <div class="banner-content">
                                <div class="banner-image">
                                    <img src="{{$banner->image_url}}" alt="Mango" class="responsive-image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<section class="intro-part">
    <div class="container">
        <div class="row intro-content">
            <div class="col-sm-6 col-lg-3">
                <div class="intro-wrap">
                    <div class="intro-icon"><i class="fas fa-truck"></i></div>
                    <div class="intro-content">
                        <h5><b>হোম ডেলিভারি</b></h5>
                        <p>আমাদের ডেলিভারি ২৪-৭২ ঘণ্টার মধ্যে সম্পন্ন হয়।</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="intro-wrap">
                    <div class="intro-icon"><i class="fas fa-sync-alt"></i></div>
                    <div class="intro-content">
                        <h5> <b>রিটার্ন পলিসি</b> </h5>
                        <p>যদি প্রোডাক্টে কোন সমস্যা থাকে, তাহলে টাকা ফেরত দেওয়া হয় অথবা প্রোডাক্ট পরিবর্তন করা হয়।</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="intro-wrap">
                    <div class="intro-icon"><i class="fas fa-headset"></i></div>
                    <div class="intro-content">
                        <h5><b>দ্রুত সহায়তা ব্যবস্থা</b></h5>
                        <p>২৪/৭ দ্রুত সহায়তা প্রদান করা হয়।</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="intro-wrap">
                    <div class="intro-icon"><i class="fas fa-lock"></i></div>
                    <div class="intro-content">
                        <h5><b>পেমেন্ট পদ্ধতি</b></h5>
                        <p>মোবাইল ব্যাংকিং এবং কার্ড পেমেন্ট উপলব্ধ।</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
