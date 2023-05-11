<!DOCTYPE html>
<html>
<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    @include('home.header_links')
</head>
<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
        <div class="center center_text">
            <table class="table table-bordered center_text">
                <tr>
                    <th class="th_deg">Product Title</th>

                    <th class="th_deg">Quantity</th>

                    <th class="th_deg">Price</th>

                    <th class="th_deg">Payment Status</th>

                    <th class="th_deg">Delivery Status</th>

                    <th class="th_deg">Image</th>

                    <th class="th_deg action">Cancel Order</th>

                </tr>

                @foreach ($orders as $order)
                    <tr>

                        <td>{{ $order->product_title }}</td>

                        <td>{{ $order->quantity }}</td>

                        <td>{{ $order->price }}</td>

                        <td>{{ $order->payment_status }}</td>

                        <td>{{ $order->delivery_status }}</td>

                        <td>
                            <img src="product/{{ $order->image }}"  alt="" height="100" width="100">
                        </td>

                        <td>
                            @if($order->delivery_status == 'processing')
                                <a onclick="return confirm('Are you sure to cancel this order?');"
                                href="{{ url('cancel_order',$order->id) }}" class="btn btn-danger">Cancel Order</a>
                            @else
                                <p class="blue_color">Not Allowed</p>
                            @endif

                        </td>
                    </tr>
                @endforeach

            </table>
        </div>
    </div>
    <div class="cpy_">
        <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
        </p>
    </div>
    <!-- jQuery -->
    <script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
    <!-- popper js -->
    <script src="{{ asset('home/js/popper.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('home/js/bootstrap.js') }}"></script>
    <!-- custom js -->
    {{-- <script src="{{ asset('home/js/custom.js') }}"></script> --}}
</body>
</html>
