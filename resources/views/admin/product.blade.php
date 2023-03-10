<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @include('admin.header_links')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/custom.css') }}">
</head>
<body>
    <div class="container-scroller">
        <div class="row p-0 m-0 proBanner" id="proBanner">
            <div class="col-md-12 p-0 m-0">
                <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
                    <div class="ps-lg-1">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates,
                                and more with this template!</p>
                            <a href="https://www.bootstrapdash.com/product/corona-free/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo"
                                target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="https://www.bootstrapdash.com/product/corona-free/"><i
                                class="mdi mdi-home me-3 text-white"></i></a>
                        <button id="bannerClose" class="btn border-0 p-0">
                            <i class="mdi mdi-close text-white me-0"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('admin.header')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @if (session()->has('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session()->get('message') }}
                            {{-- <button type="button" class="btn-close" data-dismiss="alert" aria-label="close"></button> --}}
                        </div>
                    @endif
                    <div class="div_center">
                        <h2 class="h2_font">Add Product</h2>
                    </div>
                    <div class="form_center">
                        <form action="{{ url('add_product') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="div_design">
                                <label class="lblcls" for="title">Product Title :</label>
                                <input type="text" name="title" placeholder="Write Product Title" required>
                            </div>
                            <div class="div_design">
                                <label class="lblcls" for="category">Product Category :</label>
                                <select name="category" required>
                                    <option value="">Add a Category</option>
                                    @foreach ($category as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="div_design">
                                <label class="lblcls" for="description">Product Description :</label>
                                <input type="text" name="description" placeholder="Write Product Description"required>
                            </div>
                            <div class="div_design">
                                <label class="lblcls" for="image">Product Image :</label>
                                <input type="file" name="image" required>
                            </div>
                            <div class="div_design">
                                <label class="lblcls" for="price">Product Price :</label>
                                <input type="number" name="price" placeholder="Write Product Price"required>
                            </div>
                            <div class="div_design">
                                <label class="lblcls" for="discount_price">Discount Price ;</label>
                                <input type="number" name="discount_price" placeholder="Write Product Discount Price">
                            </div>
                            <div class="div_design">
                                <label class="lblcls" for="quantity">Product Quantity :</label>
                                <input type="number" name="quantity" min="0" placeholder="Write Product Quantity" required>
                            </div>
                            <div class="div_design right_btn">
                                <input type="submit" class="btn btn-outline-primary" value="Add Product"required>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('admin/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('admin/assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendors/jvectormap/jquery-jvectormap.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('admin/assets/vendors/owl-carousel-2/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('admin/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('admin/assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('admin/assets/js/misc.js') }}"></script>
    <script src="{{ asset('admin/assets/js/settings.js') }}"></script>
    <script src="{{ asset('admin/assets/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('admin/assets/js/dashboard.js') }}"></script>
    <!-- End custom js for this page -->
</body>
</html>
