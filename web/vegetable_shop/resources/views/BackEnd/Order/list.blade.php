@extends('Layout_admin')
@section('content')
    @include('BackEnd.sample')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active clicklist" data-toggle="tab" href="#list" role="tab">
                                <span class="hidden-sm-up"></span>
                                <span class="hidden-xs-down">List</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link editclick" data-toggle="tab" href="#sample" role="tab">
                                <span class="hidden-sm-up"></span>
                                <span class="hidden-xs-down sampleTitel"></span>
                            </a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content tabcontent-border">
                        <div class="tab-pane active" id="list" role="tabpanel">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="sample_load" class="table table-striped table-bordered"
                                        style="width: 100% !important;">
                                        <thead>
                                            <tr>
                                                <th>Code</th>
                                                <th>Name</th>
                                                <th>Payment</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Code</th>
                                                <th>Name</th>
                                                <th>Payment</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane  p-20" id="sample" role="tabpanel">
                            <div class="row">
                                <div class="col-12" style="margin-bottom: -34px;">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title m-b-0">Customer Information</h5>
                                        </div>
                                        <form id="submit_form" action="post">
                                            <div class="card-body">
                                                <div class="row mb-3">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="formleft">Name</label>
                                                            <input type="text" class="form-control formleft" name="cus_name"
                                                                id="cus_name" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input type="text" class="form-control" name="cus_email"
                                                                id="cus_email" readonly style="width: 98%;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="formleft">Phone</label>
                                                            <input type="text" class="form-control formleft" name="cus_phone"
                                                                id="cus_phone" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Payment</label>
                                                            <input type="text" class="form-control" name="cus_pay"
                                                                id="cus_pay" readonly style="width: 98%;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <textarea rows="5" id="cus_address" name="cus_address" readonly class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 dis_note">
                                                    <div class="form-group">
                                                        <label>Note</label>
                                                        <textarea rows="5" id="cus_note" name="cus_note"  readonly class="form-control"></textarea>
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title m-b-0">List Order Details</h5>
                                        </div>
                                        <table class="table" style="margin-bottom: -37px;margin-left: 31px;width: 95%;">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col">Product</th>
                                                    <th scope="col">Qty</th>
                                                    <th scope="col">Qty Sold</th>
                                                    <th scope="col">Coupon</th>
                                                    <th scope="col">Price</th>
                                                </tr>
                                            </thead>
                                            <tbody id="detailorder">

                                            </tbody>
                                            <tfoot id="loadtotal">

                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title m-b-0">Status</h5>
                                        </div>
                                        <div class="col-lg-12 dis_status">
                                            <select class="form-control" id="status_or" name="status_or">
                                                <option value="1">PROCESSING</option>
                                                <option value="2">BEING TRANSPORTED</option>
                                                <option id="com_pay" class="display" value="3">COMPLETELY PAYMENT</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="code_hidden">
    <style>
        .none {
            display: none;
        }
        .formleft{
            margin-left: 8px !important;
        }
        .display{
            display: none;
        }

    </style>
@endsection

@section('css')
    <link href="{{ asset('backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/dist/css/active.css') }}" rel="stylesheet">
@endsection
@section('js')
    <script src="{{ asset('backend/assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/dist/js/pages/mask/mask.init.js') }}"></script>
    <script src="{{ asset('backend/assets/extra-libs/multicheck/datatable-checkbox-init.js') }}"></script>
    <script src="{{ asset('backend/assets/extra-libs/multicheck/jquery.multicheck.js') }}"></script>
    <script src="{{ asset('backend/assets/extra-libs/DataTables/datatables.min.js') }}"></script>

    <script>
        // Check
        $(document).ready(function() {
            // Load Table
            $('#sample_load').DataTable({
                destroy: true,
                order: [],
                ajax: {
                    url: "{{ route('order.index') }}",
                },
                columns: [{
                        data: null,
                        render: function(data, type, full, meta) {
                            return '#' + data.order_code + '';
                        },

                    },
                    {
                        data: 'customer_name'
                    },
                    {
                        data: 'customer_pay'
                    },
                    {
                        data: null,
                        render: function(data, type, full, meta) {
                            if (data.order_status == 1) {
                                return "<span class='expired tag-style'>Processing</span>";
                            } else if (data.order_status == 2) {
                                return "<span class='still-term tag-style'>being transported</span>";
                            } else {
                                return "<span class='expiry tag-style'>COMPLETELY PAYMENT</span>";
                            }
                        },
                        orderable: false
                    },
                    {
                        data: 'action'
                    }
                ]
            });
            // Reset Form
            $('.clicklist').click(function() {
                $('.sampleTitel').text('');
            });
            // Detail
            $(document).on('click', '.editsample', function(e) {
                var id = $(this).data('id');
                var action = $(this).data('action');
                $('.clicklist').removeClass('active show');
                $('.editclick').addClass('active show');
                $('#list').removeClass('active show');
                $('#sample').addClass('active show');

                $.ajax({
                    type: 'get',
                    url: action,
                    dataType: 'json',
                    success: function(res) {
                        if (res.status == 200) {
                            $('.sampleTitel').text('Detail "#' + id + '"');
                            $('#cus_name').val(res.cus.customer_name);
                            $('#cus_email').val(res.cus.customer_email);
                            $('#cus_phone').val(res.cus.customer_phone);
                            $('#cus_pay').val(res.cus.customer_pay);
                            $('#cus_address').val(res.cus.customer_address);
                            $('#status_or').val(res.or.order_status);
                            if(res.cus.customer_note != null){
                                $('#cus_note').val(res.cus.customer_note);
                            }else{
                                $('.dis_note').addClass('display');
                            }
                            if(res.or.order_status == 3){
                                $('#status_or').attr('disabled',true);
                            }
                            if(res.or.order_status == 2){
                                $('#com_pay').removeClass('display');
                            }
                            $('#code_hidden').val(id);
                            $('#detailorder').html(res.data);
                            $('#loadtotal').html(res.data_2);


                        } else {
                            alert(res.message)
                        }
                    }
                });
            });
            // Change Qty
            $(document).on('blur', '.update_qty', function() {
                var id = $(this).data('id');
                var order_text = $('.idpro_' + id + '').text();
                var code_hidden = $('#code_hidden').val();

                $.ajax({
                    type: 'put',
                    url: 'order/' + id,
                    data: {
                        order_text: order_text,
                        code_hidden:code_hidden
                    },
                    success: function(res) {
                        if (res.status == 200) {
                            $('.subtotal').text(res.subtotal);
                            $('.total').text(res.total);

                        } else if (res.status == 400) {
                            $.each(res.errors, function(key, err_values) {
                                alert(err_values);
                            });
                            $('.idpro_' + id + '').text(res.data.order_de_qty);
                        } else {
                            alert(res.message);
                            $('.idpro_' + id + '').text(res.data.order_de_qty);
                        }
                    }

                });
            });
            // Change Status
            $(document).on('change','#status_or',function(e){
                e.preventDefault();
                var value = $(this).val();
                var id = $('#code_hidden').val();

                //lay so luong
                quantity = [];
                $("input[name='product_quantity_order']").each(function(){
                    quantity.push($(this).val());
                });

                //lay product id
                order_product_id = [];
                $("input[name='order_product_id']").each(function(){
                    order_product_id.push($(this).val());
                });

                j=0;
                for(i=0; i<order_product_id.length; i++){
                    var order_qty = $('.order_qty_' + order_product_id[i]).val();
                    var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();

                    if (parseInt(order_qty)>parseInt(order_qty_storage)) {
                        j += 1;
                        if (j==1) {
                            alert('Số lượng trong kho không đủ');
                        }
                        $('.color_qty_' + order_product_id[i]).css('color','#e74a3b').css('font-weight','bold');
                    }

                }
                if(j==0){

                    $.ajax({
                        type: 'get',
                        url : 'order/'+id+'/edit',
                        data: {value:value,order_product_id:order_product_id,quantity:quantity},
                        success:function(response){
                            if (response.status == 404) {
                                alert(response.message);
                            }else{
                                $('#sample_load').DataTable().ajax.reload();
                                $('.sampleTitel').text('');
                                $('.clicklist').addClass('active show');
                                $('.editclick').removeClass('active show');
                                $('#list').addClass('active show');
                                $('#sample').removeClass('active show');
                                alert(response.message);
                            }
                        }

                    });
                }
            });
            // Delete
            $(document).on('click', '.delete', function() {
                var id = $(this).data('id');
                var result = confirm("Want to delete?");
                if (result) {
                    $.ajax({
                        type: 'delete',
                        url: 'order/' + id,
                        success: function(res) {
                            if (res.status == 200) {
                                $('#sample_load').DataTable().ajax.reload();
                                alert(res.message);
                            } else {
                                alert(res.message);
                            }

                        }
                    });
                }
            });
        });
    </script>
@endsection
