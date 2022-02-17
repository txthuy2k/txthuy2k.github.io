@extends('Layout_admin')
@section('content')
    @include('BackEnd.sample')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <form id="up_profile" method="POST">
                        <div class="card-body">
                            <h4 class="card-title">Update</h4>
                            <div id="message" role="alert"></div>
                            <div class="form-group">
                                <label for="fullname">Name</label>
                                <input type="text" required id="prf_name" name="prf_name" class="form-control"
                                    value="{{ Auth::user()->name }}" placeholder="Full Name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" required id="prf_email" name="prf_email" class="form-control"
                                    value="{{ Auth::user()->email }}" placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <label for="password" id="label_pass">Password</label>
                                <input type="password" required id="prf_password" name="prf_password" class="form-control"
                                    placeholder="Password">
                                <input type="hidden" id="hidden_pass">
                            </div>
                            <div class="form-group checkdis display">
                                <label for="confirmpassword">Confirm Password</label>
                                <input type="password" data-parsley-equalto="#prf_password" data-parsley-trigger="keyup"
                                    id="prf_confirmpass" name="prf_confirmpass" class="form-control"
                                    placeholder="Confirm Password">
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-success submit" disabled>Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style>
        .display {
            display: none;
        }

    </style>
@endsection

@section('js')
    <script src="http://parsleyjs.org/dist/parsley.js"></script>
    <script>
        $(document).ready(function() {
            $('#up_profile').parsley();
            $('#prf_name, #prf_email, #prf_password').change(function() {
                $('.submit').attr('disabled', false);
            });
            // Check Password
            $('#prf_password').change(function() {
                var pass = $(this).val();
                if (pass == '') {
                    $('.checkdis').addClass('display');
                }
                $.get("{{ route('profile.index') }}", {
                    pass: pass
                }).done(function(res) {
                    $('#hidden_pass').val(res.password);
                    if (res.status != 200) {
                        $('#label_pass').text('New Password');
                        $('#prf_confirmpass').attr('required', true);
                        $('.checkdis').removeClass('display');
                    }else{
                        $('#label_pass').text('Password');
                        $('#prf_confirmpass').attr('required', false);
                        $('.checkdis').addClass('display');
                    }
                });
            });
            // Update
            $(document).on('submit', '#up_profile', function(e) {
                e.preventDefault();
                var name = $('#prf_name').val();
                var email = $('#prf_email').val();
                var password = $('#prf_password').val();
                var checkpass = $('#hidden_pass').val();
                $.ajax({
                    type: 'post',
                    url: '{{ route('profile.store') }}',
                    data: {
                        name:name,
                        email:email,
                        password:password,
                        checkpass:checkpass
                    },
                    beforeSend:function(){
                        $('.submit').attr('disabled','disabled');
                        $('.submit').val('Submitting...');
                    },
                    success: function(res) {
                        if (res.status == 200) {
                            $('#message').addClass('alert alert-success');
                            $('#message').text(res.message);
                            $('#up_profile')[0].reset();
                        }
                    }
                });
            });
        });
    </script>
@endsection
