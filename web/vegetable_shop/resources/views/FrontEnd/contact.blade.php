@extends('Layout_user')
@section('title', 'Contact us')
@section('content')
    @include('FrontEnd.Sample.banner_sample')
    <section class="ftco-section contact-section bg-light">
        <div class="container">
            <div class="row d-flex mb-5 contact-info">
                <div class="w-100"></div>
                <div class="col-md-3 d-flex">
                    <div class="info bg-white p-4">
                        <p><span>Địa Chỉ:</span> Trường đại học Công nghệ Đông Á</p>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="info bg-white p-4">
                        <p><span>Số điện thoại:</span> <a href="tel:1235 2355 98">0965258010</a></p>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="info bg-white p-4">
                        <p><span>Email:</span> <a href="mailto:txthuy2k@gmail.com">txthuy2k@gmail.com</a></p>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="info bg-white p-4">
                        <p><span>Website</span> <a href="#">vegetable_shop.com</a></p>
                    </div>
                </div>
            </div>
            <div id="checkdis" class="alert alert-success alert-dismissible fade hide" role="alert">
                <strong>Thành công!</strong> <span id="nonfi"></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row block-9">
                <div class="col-md-6 order-md-last d-flex">
                    <form id="submitform_contact" class="bg-white p-5 contact-form">
                        <div class="form-group">
                            <input type="text" required id="contact_name" class="form-control" placeholder="Tên của bạn">
                        </div>
                        <div class="form-group">
                            <input type="email" required id="contact_email" class="form-control" placeholder=" Email của bạn">
                        </div>
                        <div class="form-group">
                            <input type="text" readonly id="contact_subject" class="form-control" placeholder="Subject"
                                value="Liên hệ với chúng tôi">
                        </div>
                        <div class="form-group">
                            <textarea required name="contact_message" id="contact_message" cols="30" rows="7"
                                class="form-control" placeholder="Message"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Gửi" class="btn btn-primary py-3 px-5 submit">
                        </div>
                    </form>

                </div>

                <div class="col-md-6 d-flex">
                    <div class="bg-white">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3723.8168144214765!2d105.73976961423476!3d21.040014492771455!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1643029437757!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="http://parsleyjs.org/dist/parsley.js"></script>
    <script>
        $(document).ready(function() {
            $('#submitform_contact').parsley();
            $(document).on('submit', '#submitform_contact', function(e) {
                e.preventDefault();
                var name = $('#contact_name').val();
                var email = $('#contact_email').val();
                var subject = $('#contact_subject').val();
                var mess = $('#contact_message').val();

                if ($('#submitform_contact').parsley().isValid()) {
                    $.ajax({
                        type: 'post',
                        url: '{{ route('contact.store') }}',
                        data: {
                            name: name,
                            email: email,
                            subject: subject,
                            mess: mess
                        },
                        dataType: 'json',
                        beforeSend:function(){
                            $('.submit').attr('disabled','disabled');
                            $('.submit').val('Đang gửi...');
                        },
                        success: function(res) {
                            $('.submit').attr('disabled',false);
                            $('.submit').val('Send Message');
                            $('#checkdis').removeClass('hide');
                            $('#checkdis').addClass('show');
                            $('#nonfi').text(res.message);
                            $('#submitform_contact')[0].reset();
                        }
                    });
                }
            });
        });
    </script>
@endsection
