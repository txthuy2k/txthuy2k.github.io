@extends('Layout_user')
@section('title', 'My Cart')
@section('content')
    @include('FrontEnd.Sample.banner_sample')
    <section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        <table class="table">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng</th>
                                </tr>
                            </thead>
                            <tbody id="loadcart">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end">
                
                <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                    {{--  <div class="cart-total mb-3">
                        <h3>Estimate shipping and tax</h3>
                        <p>Enter your destination to get a shipping estimate</p>
                        <form action="#" class="info">
                            <div class="form-group">
                                <label for="">Country</label>
                                <input type="text" class="form-control text-left px-3" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="country">State/Province</label>
                                <input type="text" class="form-control text-left px-3" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="country">Zip/Postal Code</label>
                                <input type="text" class="form-control text-left px-3" placeholder="">
                            </div>
                        </form>
                    </div>
                    <p><a href="checkout.html" class="btn btn-primary py-3 px-4">Estimate</a></p>  --}}
                </div>
                <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3" id="loadtotal">

                    </div>
                    @if (Auth::check())
                        @if ($countcart > 0)
                        <p><a href="{{ route('cart.create') }}" class="btn btn-primary py-3 px-4">Thanh toán</a></p>
                        @else
                        <p><input type="button" disabled="" class="btn btn-primary py-3 px-4" value="Proceed to Checkout"></p>
                        @endif
                    @else
                        <p><a href="{{ route('sign.index') }}" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @include('FrontEnd.Sample.footer_sample')
@endsection
@section('js')
<script>
    // Load Cart
    function loadCart(){
        $.ajax({
            type: 'get',
            url: '{{ route('cart.index') }}',
            dataType: 'json',
            success:function(data){
                $('#loadcart').html(data.cart);
                $('#loadtotal').html(data.total);
            }
        });
    }

    $(document).ready(function(){
        loadCart();
        // Add Coupon
        // $(document).on('submit','.addcoupon',function(e){
        //     e.preventDefault();
        //     var action = $(this).attr('action');
        //     var coupon_code = $('#coupon_code').val();

        //     $.ajax({
        //         type: 'post',
        //         url: action,
        //         data: {coupon_code:coupon_code},
        //         dataType: 'json',
        //         beforeSend: function() {
        //             $('.submit_coupon').attr('disabled', 'disabled');
        //             $('.submit_coupon').val('Submitting...');
        //         },
        //         success:function(res){
        //             if(res.message){
        //                 loadCart();
        //                 alert(res.message);
        //                 $('#error_sample').html('');
        //                 $('.submit_coupon').attr('disabled', false);
        //                 $('.submit_coupon').val('Apply Coupon');
        //             }else if(res.error_login){
        //                 $('#error_sample').html(
        //                         '<div class="alert alert-danger alert-dismissible fade show" role="alert"> ' +
        //                         res.error_login +
        //                         '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        //                         );
        //                 setTimeout(function() {
        //                     location.replace(res.url);
        //                 }, 1000);
        //             }else{
        //                 $('#error_sample').html(
        //                         '<div class="alert alert-danger alert-dismissible fade show" role="alert"> ' +
        //                         res.error +
        //                         '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        //                         );
        //                 $('.submit_coupon').attr('disabled', false);
        //                 $('.submit_coupon').val('Apply Coupon');
        //             }
        //         }
        //     });
        // });
        // Update Qty
        $(document).on('change','.up_qty', function(){
            var id = $(this).data('id');
            var qty = $(this).val();

            $.ajax({
                type: 'put',
                url: 'cart/'+id,
                data: {qty:qty},
                dataType: 'json',
                success:function(res){
                    if(res.status == 200){
                        loadCart();
                        alert(res.message);
                    }else{
                        alert(res.message);
                    }
                }
            });
        });
        // Remove
        $(document).on('click','.removecart', function(e){
            e.preventDefault();
            var id = $(this).data('id');

            $.ajax({
                type: 'delete',
                url: 'cart/'+id,
                dataType: 'json',
                success:function(res){
                    if(res.status == 200){
                        loadCart();
                        countCart();
                    }else{
                        alert(res.message);
                    }
                }
            });
        });
    });
</script>
@endsection
