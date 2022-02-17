@extends('Layout_user')
@section('title', 'All product')
@section('content')
    @include('FrontEnd.Sample.banner_sample')

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 mb-5 text-center">
                    <ul class="product-category">
                        <li><a href="all" id="all_all" class="active">All</a></li>
                        @foreach ($category as $cate)
                        <li><a id="all_{{ $cate->category_id }}" href="{{ $cate->category_id }}">{{ $cate->category_name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div id="loadData">
                @include('FrontEnd.all_include')
            </div>
        </div>
    </section>
    @include('FrontEnd.Sample.footer_sample')

@endsection
@section('js')
    <script>
        $(document).ready(function() {
            // Click paginate
            $(document).on('click', '.pagi a', function(e) {
                e.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                var id_cate = $('#hidden_cate').val();
                fetch_data(page,id_cate);
            });
            // Click Cate
            $(document).on('click', '.product-category a', function(e) {
                e.preventDefault();
                var cate_id = $(this).attr('href');
                $('.product-category a').removeClass('active');
                $('#all_'+cate_id+' ').addClass('active');
                cateData(cate_id);
            });
            // Load Cate
            function cateData(cate_id){
                $.ajax({
                    url: "{{ url('all-product') }}/" +cate_id,
                    dataType: 'html',
                    success: function(data) {
                        $('#loadData').html(data);
                    }
                });
            }
            // Load Data
            function fetch_data(page) {
                $.ajax({
                    url: "{{ url('all-product/create?page=') }}" +page,
                    data: {id_cate:$('#hidden_cate').val()},
                    dataType: 'html',
                    success: function(data) {
                        $('#loadData').html(data);
                    }
                });
            }
        });
    </script>
@endsection
