<div class="main-panel">

    <div class="content-wrapper">
        <div class="row">

            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">{{ $totalProducts }}</h3>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-info ">
                                    <i class="fa-solid fa-t r_margin"></i>
                                    <i class="fa-solid fa-p"></i>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">Total Products</h6>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">{{ $totalCustomers }}</h3>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-info">
                                    <i class="fa-solid fa-t r_margin"></i>
                                    <i class="fa-solid fa-c"></i>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">Total Customers</h6>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">{{ $totalOrders }}</h3>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-info">
                                    <i class="fa-solid fa-t r_margin"></i>
                                    <i class="fa-solid fa-o"></i>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">Total Orders</h6>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">₹{{ $totalRevenue }}</h3>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-info ">
                                    <i class="fa-solid fa-t r_margin"></i>
                                    <i class="fa-solid fa-r"></i>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">Total Revenue</h6>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">{{ $totalDelivered }}</h3>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-info ">
                                    <i class="fa-solid fa-o r_margin"></i>
                                    <i class="fa-solid fa-d"></i>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">Order Delivered</h6>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">{{ $totalProcessing }}</h3>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-info">
                                    <i class="fa-solid fa-o r_margin"></i>
                                    <i class="fa-solid fa-p"></i>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">Order Processing</h6>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- content-wrapper ends -->
    @include('admin.footer')
</div>
