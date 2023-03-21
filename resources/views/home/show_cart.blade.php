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
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissable" role="alert">
                {{ session()->get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="close">&times</button>
            </div>
        @endif
        <div class="center center_text">
            <table class="table table-bordered center_text">
                <thead>
                    <tr>
                        <th class="th_deg">Product Title</th>
                        <th class="th_deg">Product Quantity</th>
                        <th class="th_deg">Price</th>
                        <th class="th_deg">Image</th>
                        <th class="th_deg">Action</th>
                    </tr>
                </thead>
                @php
                    $totalPrice = 0;
                @endphp
                <tbody>
                    @foreach ($cart as $cartData)
                        <tr>
                            <td>{{ $cartData->product_title }}</td>
                            <td>{{ $cartData->quantity }}</td>
                            <td>₹{{ $cartData->price }}</td>
                            <td>
                                <img src="/product/{{ $cartData->image }}" class="img_deg" alt="">
                            </td>
                            <td>
                                <a href="{{ url('remove_cart', $cartData->id) }}"
                                    onclick="return confirm('Are you sure to remove this product?');"
                                    class="remove_btn">Remove Product</a>
                            </td>
                        </tr>
                        @php
                            $totalPrice = $totalPrice + $cartData->price;
                        @endphp
                    @endforeach
                </tbody>
            </table>
            <div>
                <h1 class="total_deg">Total Price : ₹ {{ $totalPrice }}</h1>
            </div>
            <div class="div_padding">
                <h1 class="order_process_btn">Proceed to Order</h1>
                <a href="{{ url('cash_order') }}" class="remove_btn">Cash On Delivery</a>
                <a href="{{ url('stripe',$totalPrice) }}" class="remove_btn">Pay Using Card</a>
            </div>
        </div>
    </div>
    <div class="cpy_">
        <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
        </p>
    </div>
    <!-- jQery -->
    <script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
    <!-- popper js -->
    <script src="{{ asset('home/js/popper.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('home/js/bootstrap.js') }}"></script>
    <!-- custom js -->
    <script src="{{ asset('home/js/custom.js') }}"></script>
</body>
</html>
