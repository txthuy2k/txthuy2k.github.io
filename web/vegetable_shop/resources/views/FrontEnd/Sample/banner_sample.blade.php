
<div class="hero-wrap hero-bread" style="background-image: url('{{ asset('uploads/slider/'.$banner->slider_image) }}');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home.index') }}">Trang chủ</a></span> <span></span></p>
                <h1 class="mb-0 bread">{{ $title_name }}</h1>
            </div>
        </div>
    </div>
</div>
