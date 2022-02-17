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
                            <a class="nav-link active clicklist" data-toggle="tab" href="#list"
                                role="tab">
                                <span class="hidden-sm-up"></span>
                                <span class="hidden-xs-down">List</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link editclick" data-toggle="tab" href="#sample"
                                role="tab">
                                <span class="hidden-sm-up"></span>
                                <span class="hidden-xs-down sampleTitel">Add</span>
                            </a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content tabcontent-border">
                        <div class="tab-pane active" id="list" role="tabpanel">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="sample_load" class="table table-striped table-bordered" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Price</th>
                                                <th>Category</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Price</th>
                                                <th>Category</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane  p-20" id="sample" role="tabpanel">
                            <form id="submit_form" action="post">
                                <input type="hidden" id="hidden_pro_id">
                                <div class="card-body">
                                    {{--  <div class="form-group m-t-20">
                                        <label>Date Mask <small class="text-muted">dd/mm/yyyy</small></label>
                                        <input type="text" class="form-control date-inputmask" id="date-mask" placeholder="Enter Date">
                                    </div>  --}}
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" required  class="form-control" name="pro_name" id="pro_name" placeholder="Enter Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Slug</label>
                                        <input type="text" required class="form-control" name="pro_slug" id="pro_slug" placeholder="Enter Slug">
                                    </div>
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="text" data-parsley-pattern="^[1-9]\d{0,7}(?:\.\d{1,4})?$" data-parsley-trigger="keyup" required class="form-control" name="pro_price" id="pro_price" placeholder="Enter Price">
                                    </div>
                                    <div class="form-group">
                                        <label>Price Sale</label>
                                        <input type="text" value="0" data-parsley-pattern="^[0-9]\d{0,7}(?:\.\d{1,4})?$" data-parsley-trigger="keyup" required class="form-control" name="pro_price_sale" id="pro_price_sale" placeholder="Enter Price Sale">
                                    </div>
                                    <div class="form-group">
                                        <label>Quantity</label>
                                        <input type="text" value="1" data-parsley-pattern="^[1-9]\d{0,7}(?:\.\d{1,4})?$" data-parsley-trigger="keyup" required class="form-control" name="pro_qty" id="pro_qty" placeholder="Enter Quantity">
                                    </div>
                                    <div class="form-group">
                                        <label>Desc</label>
                                        <textarea id="pro_desc" name="pro_desc" rows="5" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select required class="form-control" id="pro_cate" name="pro_cate">
                                            @foreach ($category as $cate)
                                            <option value="{{ $cate->category_id  }}">{{ $cate->category_name  }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select required class="form-control" id="pro_status" name="pro_status">
                                            <option value="1">Show</option>
                                            <option value="2">Hide</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Image</label>
                                        <div class="custom-file">
                                            <input type="file" accept="image/*" multiple="" required class="custom-file-input" id="pro_image" name="pro_image">
                                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                                        </div>
                                    </div>

                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <input type="hidden" id="hidden_action" value="Add">
                                        <button type="submit" class="btn btn-primary submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('css')
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/extra-libs/multicheck/multicheck.css') }}">
    <link href="{{ asset('backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/libs/quill/dist/quill.snow.css') }}">
@endsection
@section('js')
    <script src="{{ asset('backend/assets/extra-libs/multicheck/datatable-checkbox-init.js') }}"></script>
    <script src="{{ asset('backend/assets/extra-libs/multicheck/jquery.multicheck.js') }}"></script>
    <script src="{{ asset('backend/assets/extra-libs/DataTables/datatables.min.js') }}"></script>
    {{--  <script src="{{ asset('backend/assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js') }}"></script>  --}}
    {{--  <script src="{{ asset('backend/dist/js/pages/mask/mask.init.js') }}"></script>  --}}
    <script src="http://parsleyjs.org/dist/parsley.js"></script>
    <script src="//cdn.ckeditor.com/4.17.1/basic/ckeditor.js"></script>

    <script>
        function CKupdate(){
            for(instance in CKEDITOR.instance){
                CKEDITOR.instances['pro_desc'].updateElement();
            }
        }

        $(document).ready(function() {
            CKEDITOR.config.autoParagraph = false;
            CKEDITOR.replace('pro_desc');
            // Check
            $('#submit_form').parsley();
            // Load Table
            $('#sample_load').DataTable({
                destroy: true,
                order:[],
                ajax:{
                    url: "{{ route('product.index') }}",
                },
                columns: [
                    {data: 'product_name'},
                    {
                        data: 'image',
                        orderable: false
                    },
                    {
                        data: 'price_td',
                        orderable: false
                    },
                    {
                        data: null,
                        render: function(data, type, full, meta) {
                            return '<span class="badge badge-pill badge-dark">'+data.category_name+'</span>';
                        }
                    },
                    {
                        data: null,
                        render:function(data, type, full, meta) {
                            if(data.product_status == 1){
                                $output = '<button type="button" class="btn btn-success btn-sm click_status" data-id="'+data.product_id+'">Show</button>';
                            }else{
                                $output = '<button type="button" class="btn btn-danger btn-sm click_status" data-id="'+data.product_id+'">Hide</button>';
                            }
                            return $output;
                        },
                        orderable: false
                    },
                    {data: 'action'}
                ]
            });
            // Change Slug
            $(document).on('keyup','#pro_name', function(){
                var keyword = $(this).val();

                $.ajax({
                    type: 'get',
                    url: '{{ route('product.create') }}',
                    data: {keyword:keyword},
                    dataType: 'json',
                    success:function(data){
                        $('#pro_slug').val(data);
                    }
                });
            });
            // Add & Update
            $(document).on('submit','#submit_form', function(e){
                e.preventDefault();
                if($('#submit_form').parsley().isValid())
                {
                    var action_url = '';
                    var action_type = '';
                    var pro_name = $('#pro_name').val();
                    var pro_slug = $('#pro_slug').val();
                    var pro_price = $('#pro_price').val();
                    var pro_price_sale = $('#pro_price_sale').val();
                    var pro_qty = $('#pro_qty').val();
                    var pro_status = $('#pro_status').val();
                    var pro_cate = $('#pro_cate').val();
                    var pro_desc = $('#pro_desc').val();
                    var pro_image = $('#pro_image')[0].files[0];

                    var data = new FormData(this);
                    data.append('pro_image', pro_image);
                    data.append('pro_desc', pro_desc);
                    data.append('pro_status', pro_status);
                    data.append('pro_cate', pro_cate);
                    data.append('pro_qty', pro_qty);
                    data.append('pro_price_sale', pro_price_sale);
                    data.append('pro_price', pro_price);
                    data.append('pro_slug', pro_slug);
                    data.append('pro_name', pro_name);

                    if($('#hidden_action').val() == 'Add'){
                        action_url = '{{ route('product.store') }}';
                        data.append('_method', 'POST');
                    }else{
                        var id = $('#hidden_pro_id').val();
                        action_url = 'product/'+id;
                        data.append('_method', 'PUT');
                    }

                    $.ajax({
                        type: 'post',
                        url: action_url,
                        data: data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: 'json',
                        beforeSend:function(){
                            $('.submit').attr('disabled','disabled');
                            $('.submit').val('Submitting...');
                        },
                        success:function(res){
                            if(res.status == 200){
                                $('#submit_form')[0].reset();
                                $('#submit_form').parsley().reset();
                                $('.submit').attr('disabled',false);
                                CKupdate();
                                $('#pro_desc').text('');
                                CKEDITOR.instances['pro_desc'].setData(pro_desc);
                                $('#sample_load').DataTable().ajax.reload();
                                if($('#hidden_action').val() == 'Edit'){
                                    $('.clicklist').addClass('active show');
                                    $('.editclick').removeClass('active show');
                                    $('#list').addClass('active show');
                                    $('#sample').removeClass('active show');
                                    $('#hidden_action').val('Add');
                                    $('.sampleTitel').text('Add')
                                }

                            }else{
                                console.log(res);
                            }
                        }
                    });
                }
            });
            // Reset Form
            $('.clicklist').click(function(){
                $('#hidden_action').val('Add');
                $('.sampleTitel').text('Add')

                CKupdate();
                $('#pro_desc').text('');
                CKEDITOR.instances['pro_desc'].setData(pro_desc);
                $('#submit_form')[0].reset();
                $('#submit_form').parsley().reset();
            });
            //Edit
            $(document).on('click','.editpro', function(e){
                var id = $(this).data('id_product');
                $('.clicklist').removeClass('active show');
                $('.editclick').addClass('active show');
                $('#list').removeClass('active show');
                $('#sample').addClass('active show');

                $.ajax({
                    type: 'get',
                    url: 'product/'+id,
                    dataType: 'json',
                    success:function(res){
                        if(res.status == 200){
                            $('#hidden_action').val('Edit');
                            $('.sampleTitel').text('Edit "'+res.data.product_name+'"');
                            $('#hidden_pro_id').val(id);
                            $('#pro_name').val(res.data.product_name);
                            $('#pro_slug').val(res.data.product_slug);
                            $('#pro_price').val(res.data.product_price);
                            $('#pro_price_sale').val(res.data.product_price_sale);
                            $('#pro_qty').val(res.data.product_quantity);
                            $('#pro_status').val(res.data.product_status);
                            $('#pro_cate').val(res.data.category_id );
                            CKupdate();
                            $('#pro_desc').text(res.data.product_desc);
                            CKEDITOR.instances['pro_desc'].setData(pro_desc);
                        }else{
                            console.log(res.message)
                        }
                    }
                });
            });
            // Delete
            $(document).on('click','.delete', function(){
                var id = $(this).data('id_product');
                var result = confirm("Want to delete?");
                if (result) {
                    $.ajax({
                        type: 'delete',
                        url: 'product/'+id,
                        success:function(res){
                            if(res.status == 200){
                                $('#sample_load').DataTable().ajax.reload();
                                alert(res.message);
                            }else{
                                alert(res.message);
                            }

                        }
                    });
                }
            });
            // Status
            $(document).on('click','.click_status', function(){
                var id = $(this).data('id');

                $.ajax({
                    type: 'get',
                    url: 'product/'+id+'/edit',
                    success:function(res){
                        if(res.status == 200){
                            $('#sample_load').DataTable().ajax.reload();
                        }else{
                            alert(res.message);
                        }
                    }
                });
            });
        });
    </script>
@endsection
