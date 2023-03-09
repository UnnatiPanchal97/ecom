<!DOCTYPE html>
<html>
<head>
    <base href="/public">
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
        <div class="col-sm-6 col-md-4 col-lg-4 details_div">
            <div class="img-box pb-4">
                <img src="/product/{{ $product->image }}" class="img_size" alt="">
            </div>
            <div class="detail-box">
                <h5>
                    {{ $product->title }}
                </h5>
                @if (isset($product->discount_price) && !empty($product->discount_price))
                    <h6 class="red_color">
                        Discount Price: {{ $product->discount_price }}
                    </h6>
                    <h6 class="blue_color">
                        Price: <span class="strikethrough">${{ $product->price }}</span>
                    </h6>
                @else
                    <h6 class="blue_color">
                        Price: ${{ $product->price }}
                    </h6>
                @endif
                <h6>Product Category: {{ $product->category_->category_name }}</h6>
                <h6>Poduct Detaiils: {{ $product->description }}</h6>
                <h6>Available Quantity: {{ $product->quantity }}</h6>
                <form action="{{ url('add_cart',$product) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <input type="number" name="quantity" value="1" min="1" class="input_num_width">
                        </div>
                        <div class="col-md-4">
                            <input type="submit" value="Add to Cart">
                        </div>
                    </div>
                </form>
                {{-- <a href="" class="btn btn-primary">Add to Cart</a> --}}
            </div>
        </div>
    </div>
    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->
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
