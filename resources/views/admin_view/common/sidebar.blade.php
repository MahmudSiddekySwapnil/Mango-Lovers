<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">
    <!-- Brand Logo Light -->
    <a href="index.html" class="logo logo-light">
    <span class="logo-lg">
      <img src="landing_assets/images/khan.png" alt="small logo">
    </span>
        <span class="logo-sm">
      <img src="landing_assets/images/khan.png" alt="small logo">
    </span>
    </a>
    <!-- Brand Logo Dark -->
    <a href="index.html" class="logo logo-dark">
    <span class="logo-lg">
      <img src="landing_assets/images/khan.png" alt="small logo">
    </span>
        <span class="logo-sm">
      <img src="landing_assets/images/khan.png" alt="small logo">
    </span>
    </a>
    <!-- Sidebar Hover Menu Toggle Button -->
    <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
        <i class="ri-checkbox-blank-circle-line align-middle"></i>
    </div>
    <!-- Full Sidebar Menu Close Button -->
    <div class="button-close-fullsidebar">
        <i class="ri-close-fill align-middle"></i>
    </div>
    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!-- Leftbar User -->
        <div class="leftbar-user p-3 text-white">
            <a href="pages-profile.html" class="d-flex align-items-center text-reset">
                <div class="flex-shrink-0">
                    <img src="admin_assets/images/users/avatar-1.jpg" alt="user-image" height="42" class="rounded-circle shadow">
                </div>
                <div class="flex-grow-1 ms-2">
                    <span class="fw-semibold fs-15 d-block">Doris Larson</span>
                    <span class="fs-13">Founder</span>
                </div>
                <div class="ms-auto">
                    <i class="ri-arrow-right-s-fill fs-20"></i>
                </div>
            </a>
        </div>
        <!--- Sidemenu -->
        <ul class="side-nav">
            <li class="side-nav-title mt-1"> Main</li>
            <li class="side-nav-item">
                <a href="{{route('dashboard')}}" class="side-nav-link">
                    <i class="fa fa-desktop"></i> {{-- <span class="badge bg-success float-end">9+</span>--}}
                    <span> Dashboard </span>
                </a>
            </li>
            <li class="side-nav-item">
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEmail" aria-expanded="false" aria-controls="sidebarEmail" class="side-nav-link">
                    <i class="fa fa-cog"></i>
                    <span>Order Management<i class="fa fa-sort-desc"></i>
          </span>
                </a>
                <div class="collapse" id="sidebarEmail">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('order')}}">
                                <i class="fa fa-plus"></i>&nbsp;Orders </a>
                        </li>
{{--                        <li>--}}
{{--                            <a href="{{route('home_banner')}}">--}}
{{--                                <i class="fa fa-plus"></i>&nbsp;Banner Manage </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="{{route('company_service')}}">--}}
{{--                                <i class="fa fa-plus"></i>&nbsp;Service Manage </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="{{route('partners_management')}}">--}}
{{--                                <i class="fa fa-plus"></i> Partner Manage </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="{{route('company_profile')}}">--}}
{{--                                <i class="fa fa-plus"></i>Company Profile </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="{{route('company_service_fact')}}">--}}
{{--                                <i class="fa fa-plus"></i>Service Fact </a>--}}
{{--                        </li>--}}
                    </ul>
                </div>
            </li>
            <li class="side-nav-title mt-2">Custom</li>
        </ul>
        <!--- End Sidemenu -->
        <div class="clearfix"></div>
    </div>
</div>
<!-- ========== Left Sidebar End ========== -->
