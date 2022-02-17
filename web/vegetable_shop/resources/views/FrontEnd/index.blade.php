@extends('Layout_user')
@section('title','Home')
@section('content')
<section id="home-section" class="hero">
    <div class="home-slider owl-carousel">
        @foreach ($slider as $slide)
        <div class="slider-item" style="background-image: url('{{ asset('uploads/slider/'.$slide->slider_image) }}');">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                    <div class="col-md-12 ftco-animate text-center">
                        <h1 class="mb-2">{{ $slide->slider_name }}</h1>
                        <h2 class="subheading mb-4">{{ $slide->slider_desc }}</h2>
                        
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
<section class="ftco-section">
    <div class="container">
        <div class="row no-gutters ftco-services">
            <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-shipped"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Miễn Ship</h3>
                        <span></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-diet"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Luôn Tươi</h3>
                        <span>Sản phẩm được bảo quản tốt</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-award"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Chất lượng cao</h3>
                        <span>An toàn thực phẩm</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-customer-service"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Trợ Giúp</h3>
                        <span>24/7</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-category ftco-no-pt">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6 order-md-last align-items-stretch d-flex">
                        <div class="category-wrap-2 ftco-animate img align-self-stretch d-flex"
                            style="background-image: url('{{ asset('frontend/images/category.jpg') }}');">
                            <div class="text text-center">
                                 <h3><script language='javascript'>
var myVar=setInterval(function(){Clock()},1000);
function Clock() {
a=new Date();
w=Array("Chủ Nhật","Thứ hai","Thứ ba","Thứ tư","Thứ năm","Thứ sáu","Thứ bảy");
var a=w[a.getDay()],
w=new Date,
d=w.getDate();
m=w.getMonth()+1;
y=w.getFullYear();
h=w.getHours();
mi=w.getMinutes();
se=w.getSeconds();
if(10>d){d="0"+d}
if(10>m){m="0"+m}
if(10>h){h="0"+h}
if(10>mi){mi="0"+mi}
if(10>se){se="0"+se}
document.getElementById("clockDiv").innerHTML=""+a+","+d+"/"+m+"/"+y+"  ,  "+h+":"+mi+":"+se+"";
}
</script>
<div id="clockDiv"></div></h3>
                                <h2>Thủy Bùi</h2>
                                <p>Trái cây ngon bổ rẻ</p>
                                <p><a href="{{ route('all-product.index') }}" class="btn btn-primary">Mua ngay</a></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        @foreach ($category_left as $key => $cate_left)
                        <div class="category-wrap ftco-animate img {{ $key == 1 ? '' : 'mb-4' }} d-flex align-items-end"
                            style="background-image: url('{{ asset('uploads/category/'.$cate_left->category_image) }}');">
                            <div class="text px-3 py-1">
                                <h2 class="mb-0"><a href="#">{{ $cate_left->category_name }}</a></h2>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                @foreach ($category_right as $key_2 => $cate_right)
                <div class="category-wrap ftco-animate img {{ $key_2 == 1 ? '' : 'mb-4' }} d-flex align-items-end"
                    style="background-image: url('{{ asset('uploads/category/'.$cate_right->category_image) }}');">
                    <div class="text px-3 py-1">
                        <h2 class="mb-0"><a href="#">{{ $cate_right->category_name }}</a></h2>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                
                <h2 class="mb-4">Sản phẩm nổi bật</h2>
                
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @foreach ($our_product as $our)
            <div class="col-md-6 col-lg-3 ftco-animate">
                <div class="product">
                    <a href="{{ route('detail.show',$our->product_slug) }}" class="img-prod">
                        <img class="img-fluid" src="{{ asset('uploads/product/'.$our->product_image) }}"
                            alt="{{ $our->product_name }}">
                       
                        <div class="overlay"></div>
                    </a>
                    <div class="text py-3 pb-4 px-3 text-center">
                        <h3><a href="{{ route('detail.show',$our->product_slug) }}">{{ $our->product_name }}</a></h3>
                        <div class="d-flex">
                            <div class="pricing">
                                <p class="price">
                                  
                                <span class="price-sale">{{ number_format($our->product_price) }} vnđ</span>
                                  
                                </p>
                            </div>
                        </div>
                        <div class="bottom-area d-flex px-3">
                            <input type="hidden" class="quantity{{ $our->product_id }}" value="1">
                            <div class="m-auto d-flex">
                                <a href="#"
                                    class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                    <span><i class="ion-ios-menu"></i></span>
                                </a>
                                <a href="#" data-id="{{ $our->product_id }}" class="buy-now d-flex justify-content-center align-items-center mx-1 addcart">
                                    <span><i class="ion-ios-cart"></i></span>
                                </a>
                                @php
                                    $wish = App\Wishlist::where('user_id',Auth::id())->where('pro_id',$our->product_id)->first();
                                @endphp
                                <a href="#" data-id_pro="{{ $our->product_id }}" class="heart d-flex justify-content-center align-items-center click_Add_Wish {{ $wish ? 'wishcolor' : '' }}">
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



<section class="ftco-section testimony-section">
    <div class="container">
        
    </div>
</section>  

<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
    <div class="container py-4">
        <div class="row d-flex justify-content-center py-5">
            
        </div>
    </div>
</section>
@endsection
