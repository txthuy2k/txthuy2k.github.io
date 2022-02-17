@extends('Layout_user')
@section('title', 'Sign In')
@section('content')
    @include('FrontEnd.Sample.banner_sample')
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                @if (Request::url() == route('sign.index'))
                    <!-- Sign In -->
                    <div class="col-xl-7 ftco-animate">
                        <form id="submit_signin" class="billing-form" method="POST">
                            <h3 class="mb-4 billing-heading">{{ $title_name }}</h3>
                            <div class="row align-items-end">
                                <div class="col-md-12" id="error_sample">

                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email_in" name="email_in" required class="form-control"
                                            placeholder="Enter Email">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" required id="password_in" name="password_in"
                                            class="form-control" placeholder="Enter Password">
                                    </div>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-12">
                                    <div class="form-group mt-4">
                                        <div class="radio">
                                            <label><input type="submit" class="btn btn-primary py-3 px-4 submit"
                                                    value="Submit"></label>
                                            <label class="mr-3"><a href="{{ route('sign.create') }}"> Tạo tài khoản? </a></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @else
                    <!-- Sign Up -->
                    <div class="col-xl-7 ftco-animate">
                        <form id="submit_signup" class="billing-form" method="POST">
                            <h3 class="mb-4 billing-heading">{{ $title_name }}</h3>
                            <div class="row align-items-end">
                                <div class="col-md-12" id="error_sample">

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fullname">Tên</label>
                                        <input type="text" required class="form-control" name="full_name_up"
                                            id="full_name_up" placeholder="Full Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" required class="form-control" name="email_up" id="email_up"
                                            placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" required class="form-control" name="password_up"
                                            id="password_up" placeholder="Password">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="confirmpassword">Xác nhận mật khẩu</label>
                                        <input type="password" required data-parsley-equalto="#password_up"
                                            data-parsley-trigger="keyup" class="form-control"
                                            placeholder="Confirm Password">
                                    </div>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-12">
                                    <div class="form-group mt-4">
                                        <div class="radio">
                                            <label><input type="submit" class="btn btn-primary py-3 px-4 submit"
                                                    value="Submit"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </section>
    @include('FrontEnd.Sample.footer_sample')

@endsection
@section('js')
    <script src="http://parsleyjs.org/dist/parsley.js"></script>
    <script>
        $(document).ready(function() {
            $('#submit_signin').parsley();
            $('#submit_signup').parsley();

            // Sign In
            $(document).on('submit', '#submit_signin', function(e) {
                e.preventDefault();
                if($('#submit_signin').parsley().isValid())
                {
                    var action = 'SignIn';
                    var email = $('#email_in').val();
                    var password = $('#password_in').val();

                    $.ajax({
                        type: 'post',
                        url: '{{ route('sign.store') }}',
                        data: {
                            action: action,
                            email: email,
                            password: password
                        },
                        dataType: 'json',
                        beforeSend: function() {
                            $('.submit').attr('disabled', 'disabled');
                            $('.submit').val('Submitting...');
                        },
                        success: function(res) {
                            if (res.status == 200) {
                                $('#error_sample').html(
                                    '<div class="alert alert-success" role="alert">' + res
                                    .message + '</div>');
                                setTimeout(function() {
                                    $('.submit').attr('disabled', false);
                                    location.replace(res.url);
                                }, 1000);
                            } else {
                                $('.submit').attr('disabled', false);
                                $('.submit').val('Submit');
                                $('#error_sample').html(
                                    '<div class="alert alert-danger alert-dismissible fade show" role="alert"> ' +
                                    res.message +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                                    );
                            }
                        }
                    });
                }
            });
            // Sign Up
            $(document).on('submit', '#submit_signup', function(e) {
                e.preventDefault();
                if($('#submit_signup').parsley().isValid())
                {
                    var action = 'SignUp';
                    var name = $('#full_name_up').val();
                    var email = $('#email_up').val();
                    var password = $('#password_up').val();

                    $.ajax({
                        type: 'post',
                        url: '{{ route('sign.store') }}',
                        data: {
                            action: action,
                            name: name,
                            email: email,
                            password: password
                        },
                        dataType: 'json',
                        beforeSend: function() {
                            $('.submit').attr('disabled', 'disabled');
                            $('.submit').val('Submitting...');
                        },
                        success: function(res) {
                            if (res.status == 200) {
                                $('#error_sample').html(
                                    '<div class="alert alert-success" role="alert">' + res
                                    .message + '</div>');
                                setTimeout(function() {
                                    $('.submit').attr('disabled', false);
                                    location.replace('/');
                                }, 2000);
                            } else {
                                $('.submit').attr('disabled', false);
                                $('.submit').val('Submit');
                                $('#error_sample').html(
                                    '<div class="alert alert-danger alert-dismissible fade show" role="alert"> ' +
                                    res.message +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                                    );
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
