@extends('Layout_user')
@section('title','Wishlist')
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
                                    <th>Danh sách sản phẩm</th>
                                    <th>&nbsp;</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Thêm vào giỏ</th>
                                </tr>
                            </thead>
                            <tbody id="loadwish">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('FrontEnd.Sample.footer_sample')

@endsection
@section('js')
<script>
    function loadWish(){
        $.ajax({
            type: 'get',
            url: '{{ route('wishlist.index') }}',
            dataType: 'json',
            success:function(data){
                $('#loadwish').html(data);
            }
        });
    }
    $(document).ready(function(){
        loadWish();
        // Remove
        $(document).on('click','.removewish', function(e){
            e.preventDefault();
            var id = $(this).data('id');

            $.ajax({
                type: 'delete',
                url: 'wishlist/'+id,
                dataType: 'json',
                success:function(res){
                    if(res.status == 200){
                        loadWish();
                    }else{
                        alert(res.message);
                    }
                }
            });
        });
    });
</script>
@endsection
