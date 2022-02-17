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
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Image</th>
                                                <th>Name</th>
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
                                <input type="hidden" id="hidden_cate_id">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" required class="form-control" name="cate_name" id="cate_name"
                                            placeholder="Enter Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Slug</label>
                                        <input type="text" required class="form-control" name="cate_slug" id="cate_slug"
                                            placeholder="Enter Slug">
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select required class="form-control" id="cate_status" name="cate_status">
                                            <option value="1">Show</option>
                                            <option value="2">Hide</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Image</label>
                                        <div class="custom-file">
                                            <input type="file" accept="image/*" multiple="" required class="custom-file-input" id="category_image" name="category_image">
                                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                                        </div>
                                        <span id="edit_image"></span>
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
    <link href="{{ asset('backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endsection
@section('js')
    <script src="{{ asset('backend/assets/extra-libs/multicheck/datatable-checkbox-init.js') }}"></script>
    <script src="{{ asset('backend/assets/extra-libs/multicheck/jquery.multicheck.js') }}"></script>
    <script src="{{ asset('backend/assets/extra-libs/DataTables/datatables.min.js') }}"></script>
    <script src="http://parsleyjs.org/dist/parsley.js"></script>
    <script>
        // Check
        $('#submit_form').parsley();
        $(document).ready(function() {
            // Load Table
            $('#sample_load').DataTable({
                destroy: true,
                order:[],
                ajax: {
                    url: "{{ route('category.index') }}",
                },
                columns: [
                    {
                        data: null,
                        render: function(data, type, full, meta) {
                            return '<img src="{{ URL::to('/') }}/uploads/category/' + data.category_image + '" width="80px" height="80px" class="img-thumbnail"/>';
                        },
                        orderable: false
                    },
                    {
                        data: 'category_name'
                    },
                    {
                        data: null,
                        render: function(data, type, full, meta) {
                            if (data.category_status == 1) {
                                $output =
                                    '<button type="button" class="btn btn-success btn-sm click_status" data-id="' +
                                    data.category_id + '">Show</button>';
                            } else {
                                $output =
                                    '<button type="button" class="btn btn-danger btn-sm click_status" data-id="' +
                                    data.category_id + '">Hide</button>';
                            }
                            return $output;
                        },
                        orderable: false
                    },
                    {
                        data: 'action'
                    }
                ]
            });
            // Change Slug
            $(document).on('keyup','#cate_name', function(){
                var keyword = $(this).val();

                $.ajax({
                    type: 'get',
                    url: '{{ route('product.create') }}',
                    data: {keyword:keyword},
                    dataType: 'json',
                    success:function(data){
                        $('#cate_slug').val(data);
                    }
                });
            });
            // Reset Form
            $('.clicklist').click(function(){
                $('#hidden_action').val('Add');
                $('.sampleTitel').text('Add')
                $('#edit_image').html('');
                $('#submit_form')[0].reset();
                $('#submit_form').parsley().reset();
            });
            // Add & Update
            $(document).on('submit','#submit_form', function(e){
                e.preventDefault();
                if($('#submit_form').parsley().isValid())
                {
                    var action_url = '';
                    var action_type = '';
                    var cate_name = $('#cate_name').val();
                    var cate_slug = $('#cate_slug').val();
                    var cate_status = $('#cate_status').val();
                    var category_image = $('#category_image')[0].files[0];

                    var data = new FormData(this);
                    data.append('category_image', category_image);
                    data.append('cate_name', cate_name);
                    data.append('cate_slug', cate_slug);
                    data.append('cate_status', cate_status);

                    if($('#hidden_action').val() == 'Add'){
                        action_url = '{{ route('category.store') }}';
                        data.append('_method', 'POST');
                    }else{
                        var id = $('#hidden_cate_id').val();
                        action_url = 'category/'+id;
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
                                alert(res.message);
                            }
                        }
                    });
                }
            });
            //Edit
            $(document).on('click','.editsample', function(e){
                var id = $(this).data('id');
                $('.clicklist').removeClass('active show');
                $('.editclick').addClass('active show');
                $('#list').removeClass('active show');
                $('#sample').addClass('active show');

                $.ajax({
                    type: 'get',
                    url: 'category/'+id,
                    dataType: 'json',
                    success:function(res){
                        if(res.status == 200){
                            $('#hidden_action').val('Edit');
                            $('.sampleTitel').text('Edit "'+res.data.category_name+'"');
                            $('#hidden_cate_id').val(id);
                            $('#cate_name').val(res.data.category_name);
                            $('#cate_slug').val(res.data.category_slug);
                            $('#cate_status').val(res.data.category_status);
                            $('#edit_image').html('<img src="{{ URL::to('/') }}/uploads/category/' + res.data.category_image + '" width="100px" height="100px" class="img-thumbnail" style="\
                            margin: 13px 0px 0px;"/>');
                        }else{
                            alert(res.message)
                        }
                    }
                });
            });
            // Delete
            $(document).on('click','.delete', function(){
                var id = $(this).data('id');
                var result = confirm("Want to delete?");
                if (result) {
                    $.ajax({
                        type: 'delete',
                        url: 'category/'+id,
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
                    url: 'category/'+id+'/edit',
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
