@extends('layouts.app')

@section('title')  نمایش محصولات @endsection

@section('content')

    <div class="container-fluid">

        <hr class="my-3" />

        <div class="row">
            <div class="col-md-6">
                <p class="product-row-title"> نمایش همه محصولات</p>
            </div>
        </div>


        <div class="row" id="products-row">
            {{-- results --}}
        </div>

        <!-- Data Loader -->
        <div class="auto-load text-center">
            <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                <path fill="#000"
                    d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                    <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50"
                        to="360 50 50" repeatCount="indefinite" />
                </path>
            </svg>
        </div>




    </div>


@endsection('content')


@push('scripts')
    <script>
        var currentLoc = decodeURIComponent($(location).attr('href'));
        var currentLocArr = currentLoc.split('/');
        var categoryName = currentLocArr[currentLocArr.length - 1];
        var cityName = currentLocArr[currentLocArr.length - 2];

        var pageNumber = 1;
        loadMore(pageNumber, categoryName, cityName);

        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= $(document).height()) {

                pageNumber++;
                loadMore(pageNumber, categoryName, cityName);
            }
        });


        function loadMore(pageNumber, categoryName, cityName) {
            $.ajax({
                url: '/' + cityName + '/' + categoryName + '?page=' + pageNumber,
                datatype: 'html',
                type: 'get',
                beforeSend: function() {
                    $('.auto-load').show();
                }

            }).done(function(response) {
                if (response.length == 0) {
                    $('.auto-load').html('محصولی جهت نمایش وجود ندارد :(');
                    return;
                }
                $('.auto-load').hide();
                $('#products-row').append(response);
            });
        }

    </script>
@endpush
