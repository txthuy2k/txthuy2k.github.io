@if (count($all_product) > 0)
<div class="row">
    <input type="hidden" id="hidden_cate" value="{{ $check_cate }}">
    @if ($check_cate == 'Search')
        <input type="hidden" id="hidden_search" value="{{ $check_search }}">
    @else
        <input type="hidden" id="hidden_search" value="">
    @endif

    @foreach ($all_product as $all_pro)
    <div class="col-md-6 col-lg-3 ftco-animate fadeInUp ftco-animated">
        <div class="product">
            <a href="{{ route('detail.show',$all_pro->product_slug) }}" class="img-prod">
                <img class="img-fluid"
                    src="{{ asset('uploads/product/' . $all_pro->product_image) }}" class="img-fluid"
                    alt="{{ $all_pro->product_name }}">
                <div class="overlay"></div>
            </a>
            <div class="text py-3 pb-4 px-3 text-center">
                <h3><a
                        href="{{ route('detail.show', $all_pro->product_slug) }}">{{ $all_pro->product_name }}</a>
                </h3>
                <div class="d-flex">
                    <div class="pricing">
                        <p class="price">
                           
                            <span class="price-sale">{{ number_format($all_pro->product_price) }}
                                vnđ</span>
                           
                        </p>
                    </div>
                </div>
                <div class="bottom-area d-flex px-3">
                    <input type="hidden" class="quantity{{ $all_pro->product_id }}" value="1">
                    <div class="m-auto d-flex">
                        <a href="#"
                            class="add-to-cart d-flex justify-content-center align-items-center text-center">
                            <span><i class="ion-ios-menu"></i></span>
                        </a>
                        <a href="#" data-id="{{ $all_pro->product_id }}" class="buy-now d-flex justify-content-center align-items-center mx-1 addcart">
                            <span><i class="ion-ios-cart"></i></span>
                        </a>
                        @php
                            $wish = App\Wishlist::where('user_id',Auth::id())->where('pro_id',$all_pro->product_id)->first();
                        @endphp
                        <a href="#" data-id_pro="{{ $all_pro->product_id }}" class="heart d-flex justify-content-center align-items-center click_Add_Wish {{ $wish ? 'wishcolor' : '' }}">
                            <span><i class="ion-ios-heart"></i></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<h5 style="text-align: center;color: #cecece;">Product Not Found</h5>
@endif
<div class="row mt-5">
    <div class="col text-center">
        <div class="block-27">
            {!! $all_product->render('FrontEnd.paginatoin') !!}
        </div>
    </div>
</div>
