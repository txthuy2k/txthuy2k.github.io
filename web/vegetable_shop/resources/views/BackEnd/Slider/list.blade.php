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
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Image</th>
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
                                        <input type="text" required class="form-control" name="slider_name"
                                            id="slider_name" placeholder="Enter Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Name Sub</label>
                                        <input type="text" required class="form-control" name="slider_desc"
                                            id="slider_desc" placeholder="Enter Name Sub">
                                    </div>
                                    <div class="form-group">
                                        <label>Url</label>
                                        <input type="text" data-parsley-type="url" data-parsley-trigger="keyup"
                                            class="form-control" name="slider_url" id="slider_url"
                                            placeholder="Enter Url">
                                    </div>
                                    <div class="form-group">
                                        <label>Image</label>
                                        <div class="custom-file">
                                            <input type="file" accept="image/*" multiple="" required
                                                class="custom-file-input" id="slider_image" name="slider_image">
                                            <label class="custom-file-label" for="validatedCustomFile">Choose
                                                file...</label>
                                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select required class="form-control" id="slider_status" name="slider_status">
                                            <option value="1">Show</option>
                                            <option value="2">Hide</option>
                                        </select>
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
    <style>
        .none {
            display: none;
        }

    </style>
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
                    url: "{{ route('slider.index') }}",
                },
                columns: [{
                        data: null,
                        render: function(data, type, full, meta) {
                            return "<img src={{ URL::to('/') }}/uploads/slider/" + data
                                .slider_image + " width='70' class='img-thumbnail' />";
                        },
                        orderable: false
                    },
                    {
                        data: null,
                        render: function(data, type, full, meta) {
                            if (data.slider_status == 1) {
                                $output =
                                    '<button type="button" class="btn btn-success btn-sm click_status" data-id="' +
                                    data.slider_id + '">Show</button>';
                            } else {
                                $output =
                                    '<button type="button" class="btn btn-danger btn-sm click_status" data-id="' +
                                    data.slider_id + '">Hide</button>';
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
            // Reset Form
            $('.clicklist').click(function() {
                $('#hidden_action').val('Add');
                $('.sampleTitel').text('Add')

                $('#submit_form')[0].reset();
                $('#submit_form').parsley().reset();
            });
            // Add & Update
            $(document).on('submit', '#submit_form', function(e) {
                e.preventDefault();
                if ($('#submit_form').parsley().isValid()) {
                    var action_url = '';
                    var action_type = '';
                    var slider_name = $('#slider_name').val();
                    var slider_desc = $('#slider_desc').val();
                    var slider_url = $('#slider_url').val();
                    var slider_image = $('#slider_image')[0].files[0];
                    var slider_status = $('#slider_status').val();

                    var data = new FormData(this);
                    data.append('slider_image', slider_image);
                    data.append('slider_name', slider_name);
                    data.append('slider_desc', slider_desc);
                    data.append('slider_url', slider_url);
                    data.append('slider_status', slider_status);

                    if ($('#hidden_action').val() == 'Add') {
                        action_url = '{{ route('slider.store') }}';
                        data.append('_method', 'POST');
                    } else {
                        var id = $('#hidden_cate_id').val();
                        action_url = 'slider/' + id;
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
                        beforeSend: function() {
                            $('.submit').attr('disabled', 'disabled');
                            $('.submit').val('Submitting...');
                        },
                        success: function(res) {
                            if (res.status == 200) {
                                $('#submit_form')[0].reset();
                                $('#submit_form').parsley().reset();
                                $('.submit').attr('disabled', false);
                                $('#sample_load').DataTable().ajax.reload();
                                if ($('#hidden_action').val() == 'Edit') {
                                    $('.clicklist').addClass('active show');
                                    $('.editclick').removeClass('active show');
                                    $('#list').addClass('active show');
                                    $('#sample').removeClass('active show');
                                    $('#hidden_action').val('Add');
                                    $('.sampleTitel').text('Add')
                                }
                            } else {
                                alert(res.message);
                            }
                        }
                    });
                }
            });
            //Edit
            $(document).on('click', '.editsample', function(e) {
                var id = $(this).data('id');
                $('.clicklist').removeClass('active show');
                $('.editclick').addClass('active show');
                $('#list').removeClass('active show');
                $('#sample').addClass('active show');

                $.ajax({
                    type: 'get',
                    url: 'slider/' + id,
                    dataType: 'json',
                    success: function(res) {
                        if (res.status == 200) {
                            $('#hidden_action').val('Edit');
                            $('.sampleTitel').text('Edit "' + res.data.slider_id + '"');
                            $('#hidden_cate_id').val(id);
                            $('#slider_name').val(res.data.slider_name);
                            $('#slider_desc').val(res.data.slider_desc);
                            $('#slider_url').val(res.data.slider_url);
                            $('#slider_status').val(res.data.slider_status);
                        } else {
                            alert(res.message)
                        }
                    }
                });
            });
            // Delete
            $(document).on('click', '.delete', function() {
                var id = $(this).data('id');
                var result = confirm("Want to delete?");
                if (result) {
                    $.ajax({
                        type: 'delete',
                        url: 'slider/' + id,
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
            // Status
            $(document).on('click', '.click_status', function() {
                var id = $(this).data('id');

                $.ajax({
                    type: 'get',
                    url: 'slider/' + id + '/edit',
                    success: function(res) {
                        if (res.status == 200) {
                            $('#sample_load').DataTable().ajax.reload();
                        } else {
                            alert(res.message);
                        }
                    }
                });
            });
        });
    </script>
@endsection
