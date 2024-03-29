<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
            </h2>
        </div>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="box">
                        <div class="option_container">
                            <div class="options">
                                <a href="{{ url('product_details',$product->id) }}" class="option1">
                                    Product Details
                                </a>
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
                            </div>
                        </div>
                        <div class="img-box">
                            <img src="/product/{{ $product->image }}" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                {{ $product->title }}
                            </h5>
                            @if (isset($product->discount_price) && !empty($product->discount_price))
                                <h6 class="red_color">
                                    Discount Price <br>₹{{ $product->discount_price }}
                                </h6>
                                <h6 class="blue_color">
                                    Price <br><span class="strikethrough">₹{{ $product->price }}</span>
                                </h6>
                            @else
                                <h6 class="blue_color">
                                    Price <br>₹ {{ $product->price }}
                                </h6>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="paginate_div">
            {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
        <div class="btn-box">
            <a href="">
                View All products
            </a>
        </div>
    </div>
</section>
