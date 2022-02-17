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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Level</th>
                                            <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Level</th>
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
                                        <input type="text" required class="form-control" name="user_name"
                                            id="user_name" placeholder="Enter Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" required class="form-control" name="user_email"
                                            id="user_email" placeholder="Enter Email">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" required class="form-control" name="user_password"
                                            id="user_password">
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select required class="form-control" id="user_level" name="user_level">
                                            <option value="1">Admin</option>
                                            <option value="2">User</option>
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
                    url: "{{ route('account.index') }}",
                },
                columns: [
                    {data: 'name'},
                    {data: 'email'},
                    {
                        data: null,
                        render: function(data, type, full, meta) {
                            if (data.level == 2) {
                                $output =
                                    '<button type="button" class="btn btn-danger btn-sm click_status" data-id="' +
                                    data.id + '"><i class="fas fa-user"></i></button>';
                            } else {
                                $output =
                                    '<button type="button" class="btn btn-success btn-sm click_status" data-id="' +
                                    data.id + '"><i class="fas fa-user-secret"></i></button>';
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
                    var user_name = $('#user_name').val();
                    var user_email = $('#user_email').val();
                    var user_password = $('#user_password').val();
                    var user_level = $('#user_level').val();

                    if ($('#hidden_action').val() == 'Add') {
                        action_url = '{{ route('account.store') }}';
                        action_type = 'POST'
                    } else {
                        var id = $('#hidden_cate_id').val();
                        action_url = 'account/' + id;
                        action_type = 'PUT'
                    }

                    $.ajax({
                        type: action_type,
                        url: action_url,
                        data: {
                            user_name:user_name,
                            user_email:user_email,
                            user_password:user_password,
                            user_level:user_level,
                        },
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
                    url: 'account/' + id,
                    dataType: 'json',
                    success: function(res) {
                        if (res.status == 200) {
                            $('#hidden_action').val('Edit');
                            $('.sampleTitel').text('Edit "' + res.data.name + '"');
                            $('#hidden_cate_id').val(id);
                            $('#user_name').val(res.data.name);
                            $('#user_email').val(res.data.email);
                            $('#user_level').val(res.data.level);
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
                        url: 'account/' + id,
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
                    url: 'account/' + id + '/edit',
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
