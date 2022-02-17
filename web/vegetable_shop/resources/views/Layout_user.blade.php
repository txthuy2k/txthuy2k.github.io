<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>THỦY BÙI - @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('frontend/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.timepicker.css') }}">


    <link rel="stylesheet" href="{{ asset('frontend/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/style_2.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/util.css') }}">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>

<body class="goto-here">
    <style>
        html{

            font-family: 'Be Vietnam Pro', sans-serif !important;
        }
    </style>
    <div class="py-1 bg-primary">
        <div class="container">
            <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
                <div class="col-lg-12 d-block">
                    <div class="row d-flex">
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span
                                    class="icon-phone2"></span></div>
                            <span class="text">+ 1235 2355 98</span>
                        </div>
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span
                                    class="icon-paper-plane"></span></div>
                            <span class="text">thuy2k@gmail.com</span>
                        </div>
                        <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
                            <span class="text">Vận chuyển nhanh chóng &amp; Trái cây luôn tươi</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home.index') }}">Thủy Bùi</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a style="{{ request()->is('/*') ? 'color: #82ae46;' : '' }}"
                            href="{{ route('home.index') }}" class="nav-link">Trang chủ</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Shop</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="{{ route('all-product.index') }}">Tất cả sản phẩm</a>
                            <a class="dropdown-item" href="{{ route('wishlist.index') }}">Yêu thích</a>
                            <a class="dropdown-item" href="{{ route('cart.index') }}">Giỏ hàng</a>
                            @if (!Auth::user())
                                <a class="dropdown-item" href="{{ route('sign.index') }}">Đăng nhập</a>
                            @endif

                        </div>
                    </li>
                    <li class="nav-item"><a style="{{ request()->is('about*') ? 'color: #82ae46;' : '' }}"
                            href="{{ route('about.index') }}" class="nav-link">Giới thiệu</a></li>
                    <li class="nav-item"><a style="{{ request()->is('contact*') ? 'color: #82ae46;' : '' }}"
                            href="{{ route('contact.index') }}" class="nav-link">Liên hệ</a></li>
                    <li class="nav-item cta cta-colored bor6">
                        <a class="nav-link show_search" style="cursor: pointer;">
                            <i class="fa fa-search"></i>
                        </a>
                    </li>
                    <li class="nav-item cta cta-colored">
                        <a href="{{ route('cart.index') }}" class="nav-link">
                            <span class="icon-shopping_cart"></span> 
                        </a>
                    </li>
                    @if (Auth::check())
                        <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link">Đăng xuất</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->
    @yield('content')

    <footer class="ftco-footer ftco-section">
        <div class="container">
            <div class="row">
                <div class="mouse">
                    <a href="#" class="mouse-icon">
                        <div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
                    </a>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Thủy Bùi</h2>
                        <p>Trái cây luôn tươi , hàng vận chuyển nhanh chóng trong vài giờ</p>
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                            <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4 ml-md-5">
                        <h2 class="ftco-heading-2">Menu</h2>
                        <ul class="list-unstyled">
                            <li><a href="#" class="py-2 d-block">Shop</a></li>
                            <li><a href="#" class="py-2 d-block">Giới Thiệu</a></li>
                            <li><a href="#" class="py-2 d-block">Tạp Chí</a></li>
                            <li><a href="#" class="py-2 d-block">Liên Hệ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Giúp đỡ</h2>
                        <div class="d-flex">
                            <ul class="list-unstyled mr-l-5 pr-l-3 mr-4">
                                <li><a href="#" class="py-2 d-block">Thông Tin Vận Chuyển</a></li>
                                <li><a href="#" class="py-2 d-block">Trả hàng &amp; Thay Đổi</a></li>
                                <li><a href="#" class="py-2 d-block">Điều kiện &amp; Các Điều Kiện</a></li>
                                <li><a href="#" class="py-2 d-block">Chính Sách Bảo Mật</a></li>
                            </ul>
                            <ul class="list-unstyled">
                                <li><a href="#" class="py-2 d-block">FAQs</a></li>
                                <li><a href="#" class="py-2 d-block">Liên Hệ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Bạn có câu hỏi?</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon icon-map-marker"></span><span class="text">Trường đại học Công nghệ Đông Á</span></li>
                                <li><a href="#"><span class="icon icon-phone"></span><span class="text">0965258010</span></a></li>
                                <li><a href="mailto:txthuy2k@gmail.com"><span
                                            class="icon icon-envelope"></span><span
                                            class="text">thuy2k@gmail.com</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">

                    <p>
                        <!-- Link back to Colorlib cant be removed. Template is licensed under CC BY 3.0. -->
                        <script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | This website is completed <i
                            class="icon-heart color-danger" aria-hidden="true"></i> by <a href="https://eaut.edu.vn/"
                    target="_blank">Thủy</a>
                       
                    </p>
                </div>
            </div>
        </div>
    </footer>
    {{-- Modal Search --}}
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="{{ asset('frontend/images/icon-close2.png') }}" alt="CLOSE">
            </button>

            <form action="{{ route('search.index') }}" class="wrap-search-header flex-w p-l-15">
                <button type="submit" class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" id="txtsearch" name="txtsearch" placeholder="Search...">
            </form>
        </div>
    </div>

    <style>
        .wishcolor {
            color: red !important;
        }

        .dropdown-menu>.active>a,
        .dropdown-menu>.active>a:focus,
        .dropdown-menu>.active>a:hover {
            background-color: #82ae46 !important;
        }
        .typeahead {
            width: 91%;
        }

    </style>
    <input type="hidden" id="csrf-token" name="csrf-token" value="{{ csrf_token() }}">
    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" />
        </svg></div>
    @php
        Session::put('previous_url', URL::previous());
    @endphp

    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/aos.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('frontend/js/scrollax.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="csrf-token"]').val()
                },
            });
        });

        $('.show_search').on('click', function() {
            $('.modal-search-header').addClass('show-modal-search');
            $(this).css('opacity', '0');
        });

        $('.js-hide-modal-search').on('click', function() {
            $('.modal-search-header').removeClass('show-modal-search');
            $('.js-show-modal-search').css('opacity', '1');
        });

        $('.container-search-header').on('click', function(e) {
            e.stopPropagation();
        });

        // Auto Search
        $('#txtsearch').typeahead({

            source: function(query, process) {

                $.ajax({
                    type: 'get',
                    url: "{{ route('search.index') }}",
                    data: {
                        query: query
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        process(data);
                    }
                });

            }

        });
    </script>
    <script>
        function countCart() {
            $.ajax({
                type: 'get',
                url: '{{ route('countcart') }}',
                dataType: 'json',
                success: function(data) {
                    $('#count_cart').text(data);
                }
            });
        }
        $(document).ready(function() {
            countCart();
            // Add Wishlist
            $(document).on('click', '.click_Add_Wish', function(e) {
                e.preventDefault();
                var id = $(this).data('id_pro');

                $.ajax({
                    type: 'post',
                    url: '{{ route('wishlist.store') }}',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.action == 'login') {
                            setTimeout(function() {
                                location.replace(res.url);
                            }, 100);
                        } else if (res.action == 'add') {
                            $('a[data-id_pro=' + id + ']').addClass('wishcolor');
                            alert(res.message);
                        } else {
                            $('a[data-id_pro=' + id + ']').removeClass('wishcolor');
                        }
                    }
                });
            });
            // Add To Cart
            $(document).on('click', '.addcart', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var qty = $('.quantity' + id + '').val();

                $.ajax({
                    type: 'post',
                    url: '{{ route('cart.store') }}',
                    data: {
                        id: id,
                        qty: qty
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.action == 'login') {
                            setTimeout(function() {
                                location.replace(res.url);
                            }, 100);
                        } else if (res.action == 'add') {
                            countCart();
                            alert(res.message);
                        } else {
                            alert(res.message);
                        }
                    }
                });
            });
        });
    </script>

    @yield('js')

</body>

</html>
