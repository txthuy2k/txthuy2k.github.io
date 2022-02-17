@extends('Layout_user')
@section('title', 'Checkout')
@section('content')
    @include('FrontEnd.Sample.banner_sample')
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 ftco-animate">
                    <form method="POST" class="billing-form" id="submit_checkout">
                        <h3 class="mb-4 billing-heading">Hóa Đơn</h3>
                        <div id="error_sample">

                        </div>
                        <div class="row align-items-end">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="fullname">Tên</label>
                                    <input type="text" id="fullname" name="fullname" required class="form-control" placeholder="" value="{{ Auth::user()->name }}">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Điện thoại</label>
                                    <input type="tel" id="phone" name="phone" required data-parsley-pattern="[0-9]{10}" data-parsley-trigger="keyup" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emailaddress">Email</label>
                                    <input type="email" id="email" name="email" required class="form-control" placeholder="" value="{{ Auth::user()->email }}">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="streetaddress">Địa Chỉ</label>
                                    <textarea class="form-control" id="address" name="address" required rows="5" placeholder="Địa chỉ nhà"></textarea>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="note">Ghi Chú</label>
                                    <textarea class="form-control" id="note" name="note" rows="5" placeholder=""></textarea>
                                </div>
                            </div>
                            <div class="w-100"></div>
                        </div>
                        <input type="submit" id="submit_hidden" value="" style="display:none;">
                    </form><!-- END -->
                </div>
                <div class="col-xl-5">
                    <div class="row mt-5 pt-3">
                        <div class="col-md-12 d-flex mb-5">
                            <div class="cart-detail cart-total p-3 p-md-4" id="loadtotal">

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="cart-detail p-3 p-md-4">
                                <h3 class="billing-heading mb-4">Phương thức thanh toán</h3>
                                <p><a href="#" style="border-radius: 0px;line-height: 0.8;" class="btn btn-primary py-3 px-4 submit_a {{ $count > 0 ? '' : 'disabled' }}">Thanh toán khi nhận hàng</a></p>
                                <p><div class="btnpaypal" style="" id="paypal-button-container"></div></p>
                            </div>
                        </div>
                    </div>
                </div> <!-- .col-md-8 -->
            </div>
        </div>
    </section>
    @include('FrontEnd.Sample.footer_sample')
    <style>
        a.disabled {
            pointer-events: none;
            cursor: default;
        }
    </style>
@endsection
@section('js')
    <script src="http://parsleyjs.org/dist/parsley.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=AU1aqbLwuw2HGSIQujQRTEMJ-m5aRTR_bKYLggDV8MOcDbR6AEdRKw8WuW5oYsGOMAWoojM-BWZNtu7Q"></script>
    <script>
        function loadCart(){
            $.ajax({
                type: 'get',
                url: '{{ route('cart.index') }}',
                dataType: 'json',
                success:function(data){
                    $('#loadtotal').html(data.total);
                }
            });
        }
        paypal.Buttons({
            createOrder: function(data, actions) {
              // This function sets up the details of the transaction, including the amount and line item details.
              return actions.order.create({
                purchase_units: [{
                  amount: {
                    value: '{{ round(Session::get('total') *  0.0000441966,2) }}'
                  }
                }]
              });
            },
            onApprove: function(data, actions) {
                // This function captures the funds from the transaction.
                return actions.order.capture().then(function(details) {
                    // This function shows a transaction success message to your buyer.
                    // alert('Transaction completed by ' + details.payer.name.given_name);
                    var name = $('#fullname').val();
                    var email = $('#email').val();
                    var phone = $('#phone').val();
                    var address = $('#address').val();
                    var note = $('#note').val();
                    var pay_radio = 'PAYPAL';

                    $.ajax({
                        type: 'post',
                        url: '{{ route('save_cart') }}',
                        data: {
                            name:name,
                            email:email,
                            phone:phone,
                            address:address,
                            note:note,
                            pay_radio:pay_radio,
                        },
                        dataType: 'json',
                        beforeSend: function() {
                            $('.submit_a').addClass('disabled');
                            $('.submit_a').text('Submitting...');
                        },
                        success:function(response){
                            if(response.status == 200){
                                countCart();
                                $('#error_sample').html(
                                    '<div class="alert alert-success" role="alert">' + res
                                    .message + '</div>');
                                setTimeout(function() {
                                    $('.submit').attr('disabled', false);
                                    location.replace('/');
                                }, 2000);
                            }else{
                                $('.submit_a').removeClass('disabled');
                            }
                        }
                    });

                });
            }
        }).render('#paypal-button-container');
        $(document).ready(function() {
            loadCart();
            $('#submit_checkout').parsley();

            $(document).on('click','.submit_a',function(e){
                e.preventDefault();
                $('#submit_hidden').submit();
                if($('#submit_checkout').parsley().isValid())
                {
                    var name = $('#fullname').val();
                    var email = $('#email').val();
                    var phone = $('#phone').val();
                    var address = $('#address').val();
                    var note = $('#note').val();
                    var pay_radio = 'COD';

                    $.ajax({
                        type: 'post',
                        url: '{{ route('save_cart') }}',
                        data: {
                            name:name,
                            email:email,
                            phone:phone,
                            address:address,
                            note:note,
                            pay_radio:pay_radio,
                        },
                        dataType: 'json',
                        beforeSend: function() {
                            $('.submit_a').addClass('disabled');
                            $('.submit_a').text('Submitting...');
                        },
                        success:function(res){
                            if(res.status == 200){
                                countCart();
                                $('#error_sample').html(
                                    '<div class="alert alert-success" role="alert">' + res
                                    .message + '</div>');
                                setTimeout(function() {
                                    $('.submit').attr('disabled', false);
                                    location.replace('/');
                                }, 2000);
                            }else{
                                $('.submit_a').removeClass('disabled');
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
