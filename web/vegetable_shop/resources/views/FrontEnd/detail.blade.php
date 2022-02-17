@extends('Layout_user')
@section('title', 'Detail')
@section('content')
    @include('FrontEnd.Sample.banner_sample')
    <section class="ftco-section">
        <style>
            .container .row .ftco-animate a img{
                width: 450px;
                height: 300px;
            }
        </style>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5 ftco-animate">
                    <a href="{{ asset('uploads/product/' . $detail_product->product_image) }}" class="image-popup">
                        <img  src="{{ asset('uploads/product/' . $detail_product->product_image) }}" class="img-fluid"
                            alt="{{ $detail_product->product_name }}">
                    </a>
                </div>
                <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                    <h3 style="text-transform: capitalize;">{{ $detail_product->product_name }}</h3>
                    <div class="rating d-flex">
                        <p class="text-left mr-4">
                            <a href="#" class="mr-2">5.0</a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                        </p>
                     
                    </div>
                    <p class="price">
                        @if ($detail_product->product_price_sale != 0)
                            <span>{{ number_format($detail_product->product_price_sale) }} vnđ</span>
                        @else
                            <span>{{ number_format($detail_product->product_price) }} vnđ</span>
                        @endif

                    </p>
                    <p>{{ substr($detail_product->product_desc, 0, 398) }}</p>
                    <div class="row mt-4">
                        <div class="w-100"></div>
                        <div class="input-group col-md-6 d-flex mb-3">
                            <span class="input-group-btn mr-2">
                                <button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
                                    <i class="ion-ios-remove"></i>
                                </button>
                            </span>
                            <input readonly type="text" id="quantity" name="quantity" class="form-control input-number quantity{{ $detail_product->product_id }}"
                                value="1" min="1" max="100">
                            <span class="input-group-btn ml-2">
                                <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                                    <i class="ion-ios-add"></i>
                                </button> kg
                            </span>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <p style="color: #000;">{{ $detail_product->product_quantity }} kg available</p>
                        </div>
                    </div>
                    <p><a href="#" data-id="{{ $detail_product->product_id }}" class="btn btn-black py-3 px-5 addcart">Thêm vào giỏ hàng</a></p>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <span class="subheading"></span>
                    <h2 class="mb-4">Sản phẩm liên quan</h2>
                    <p>Trái cây luôn tươi ngon</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @foreach ($related_product as $rel)
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        <div class="product">
                            <a href="{{ route('detail.show', $rel->product_slug) }}" class="img-prod">
                                <img class="img-fluid" src="{{ asset('uploads/product/' . $rel->product_image) }}" 
                                    class="img-fluid" alt="{{ $rel->product_name }}">
                                @if ($rel->product_price_sale != 0)
                                    <span
                                        class="status">{{ number_format(100 - ($rel->product_price_sale / $rel->product_price) * 100) }}%</span>
                                @endif
                                <div class="overlay"></div>
                            </a>
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><a
                                        href="{{ route('detail.show', $rel->product_slug) }}">{{ $rel->product_name }}</a>
                                </h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price">
                                            @if ($rel->product_price_sale != 0)
                                                <span class="mr-2 price-dc">{{ number_format($rel->product_price) }}
                                                    vnđ</span>
                                                <span
                                                    class="price-sale">{{ number_format($rel->product_price_sale) }}
                                                    vnđ</span>
                                            @else
                                                <span class="price-sale">{{ number_format($rel->product_price) }}
                                                    vnđ</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="bottom-area d-flex px-3">
                                    <input type="hidden" class="quantity{{ $rel->product_id }}" value="1">
                                    <div class="m-auto d-flex">
                                        <a href="#"
                                            class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                            <span><i class="ion-ios-menu"></i></span>
                                        </a>
                                        <a href="#" data-id="{{ $rel->product_id }}" class="buy-now d-flex justify-content-center align-items-center mx-1 addcart">
                                            <span><i class="ion-ios-cart"></i></span>
                                        </a>
                                        @php
                                            $wish = App\Wishlist::where('user_id', Auth::id())
                                                ->where('pro_id', $rel->product_id)
                                                ->first();
                                        @endphp
                                        <a href="#" data-id_pro="{{ $rel->product_id }}"
                                            class="heart d-flex justify-content-center align-items-center click_Add_Wish {{ $wish ? 'wishcolor' : '' }}">
                                            <span><i class="ion-ios-heart"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @include('FrontEnd.Sample.footer_sample')
@endsection
@section('js')
    <script>
        $(document).ready(function() {

            var quantitiy = 0;
            $('.quantity-right-plus').click(function(e) {

                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                // If is not undefined

                $('#quantity').val(quantity + 1);


                // Increment

            });

            $('.quantity-left-minus').click(function(e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                // If is not undefined

                // Increment
                if (quantity > 0) {
                    $('#quantity').val(quantity - 1);
                }
            });

        });
    </script>
@endsection
