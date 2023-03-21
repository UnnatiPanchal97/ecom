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
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('admin.header')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="div_center">
                        <h2 class="h2_font">All Orders</h2>
                    </div>
                    @if (session()->has('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session()->get('message') }}
                            <button type="button" class="btn-close" data-dismiss="alert" aria-label="close"></button>
                        </div>
                    @endif
                    <div class="col-lg-12 stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <table class="table jsgrid-table table_layout">
                                    <thead>
                                        <tr class="th_color">
                                            <th class="th_deg">Name</th>
                                            <th class="th_deg">Email</th>
                                            <th class="th_deg">Address</th>
                                            <th class="th_deg">Phone</th>
                                            <th class="th_deg">Product Title</th>
                                            <th class="th_deg">Payment Status</th>
                                            <th class="th_deg">Delievery Status</th>
                                            <th class="th_deg">Image</th>
                                            <th class="th_deg action">Delivered</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order as $orders)
                                        <tr>
                                            <td class="td_deg">{{ $orders->name }}</td>
                                            <td class="td_deg">{{ $orders->email }}</td>
                                            <td class="td_deg">{{ $orders->address }}</td>
                                            <td class="td_deg">{{ $orders->phone }}</td>
                                            <td class="td_deg">{{ $orders->product_title }}</td>
                                            <td class="td_deg">
                                                @if (trim($orders->payment_status) == "paid")
                                                    <span class="badge badge-success">{{ $orders->payment_status }}</span>
                                                @else
                                                <span class="badge info">{{ $orders->payment_status }}</span>
                                                @endif
                                            </td>
                                            <td class="td_deg">
                                                @if (trim($orders->delivery_status) == "processing")
                                                <span class="badge info">{{ $orders->delivery_status }}</span>
                                                @else
                                                <span class="badge badge-success">{{ $orders->delivery_status }}</span>
                                                @endif
                                            </td> 
                                            <td class="td_deg">
                                                <img src="/product/{{ $orders->image }}" class="img_size">
                                            </td>
                                            <td class="action_data">
                                                @if (trim($orders->delivery_status) == "processing")
                                                <a onclick="return confirm('Are you sure this product is delivered?')" href="{{ url('delivered',$orders->id) }}" class="btn btn-primary">Delivered</a>
                                                </a>
                                                @else
                                                <p class="green_color">Product Delievered</p>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.script')
</body>
</html>
