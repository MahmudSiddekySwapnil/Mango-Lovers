@extends('admin_view.layouts.layouts')
@section('container')
    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box justify-content-between d-flex align-items-lg-center flex-lg-row flex-column">
                            <h4 class="page-title">Dashboard</h4>

                        </div>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-xxl-6 row-cols-lg-3 row-cols-md-2">
                    <div class="col">
                        <div class="card widget-icon-box">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-muted text-uppercase fs-13 mt-0" title="Number of Customers">Customers</h5>
                                        <h3 class="my-3">54,214</h3>
                                        <p class="mb-0 text-muted text-truncate">
                                            <span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i> 2,541</span>
                                            <span>Since last month</span>
                                        </p>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title text-bg-success rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                                    <i class="ri-group-line"></i>
                                                </span>
                                    </div>
                                </div>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col">
                        <div class="card widget-icon-box">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-muted text-uppercase fs-13 mt-0" title="Number of Orders">Orders</h5>
                                        <h3 class="my-3">7,543</h3>
                                        <p class="mb-0 text-muted text-truncate">
                                            <span class="badge bg-danger me-1"><i class="ri-arrow-down-line"></i> 1.08%</span>
                                            <span>Since last month</span>
                                        </p>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title text-bg-info rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                                    <i class="ri-shopping-basket-2-line"></i>
                                                </span>
                                    </div>
                                </div>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col">
                        <div class="card widget-icon-box">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-muted text-uppercase fs-13 mt-0" title="Average Revenue">Revenue</h5>
                                        <h3 class="my-3">$9,254</h3>
                                        <p class="mb-0 text-muted text-truncate">
                                            <span class="badge bg-danger me-1"><i class="ri-arrow-down-line"></i> 7.00%</span>
                                            <span>Since last month</span>
                                        </p>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title text-bg-danger rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                                    <i class="ri-money-dollar-circle-line"></i>
                                                </span>
                                    </div>
                                </div>

                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col">
                        <div class="card widget-icon-box">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-muted text-uppercase fs-13 mt-0" title="Growth">Growth</h5>
                                        <h3 class="my-3">+ 20.6%</h3>
                                        <p class="mb-0 text-muted text-truncate">
                                            <span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i> 4.87%</span>
                                            <span>Since last month</span>
                                        </p>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title text-bg-primary rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                                    <i class="ri-donut-chart-line"></i>
                                                </span>
                                    </div>
                                </div>

                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                    <div class="col">
                        <div class="card widget-icon-box">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-muted text-uppercase fs-13 mt-0" title="Conversation Ration">Conversation</h5>
                                        <h3 class="my-3">9.62%</h3>
                                        <p class="mb-0 text-muted text-truncate">
                                            <span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i> 3.07%</span>
                                            <span>Since last month</span>
                                        </p>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title text-bg-warning rounded rounded-3 fs-3 widget-icon-box-avatar">
                                                    <i class="ri-pulse-line"></i>
                                                </span>
                                    </div>
                                </div>

                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                    <div class="col">
                        <div class="card widget-icon-box">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-muted text-uppercase fs-13 mt-0" title="Conversation Ration">Balance</h5>
                                        <h3 class="my-3">$168.5k</h3>
                                        <p class="mb-0 text-muted text-truncate">
                                            <span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i> 18.34%</span>
                                            <span>Since last month</span>
                                        </p>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title text-bg-dark rounded rounded-3 fs-3 widget-icon-box-avatar">
                                                    <i class="ri-wallet-3-line"></i>
                                                </span>
                                    </div>
                                </div>

                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div> <!-- end row -->



            </div>
            <!-- container -->

        </div>
        <!-- content -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <script>document.write(new Date().getFullYear())</script>khanbp.com
                    </div>
                    <div class="col-md-6">
                        <div class="text-md-end footer-links d-none d-md-block">

                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

@endsection
