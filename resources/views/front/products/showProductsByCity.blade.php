@extends('layouts.app')

@section('title')  نمایش محصولات @endsection

@section('content')

    <div class="container-fluid mb-5">

        @if(!$products->isEmpty())
        <div class="row d-none d-lg-block">
            <div class="col-md-12">

                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($products as $product)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <div class="card mb-2 flex-row text-right">
                                    <img class="card-img-top w-25"
                                        src="{{ asset('storage/uploads/products/images/' . $product->menu_image_path) }}"
                                        alt="Card image cap">
                                    <div class="card-body">
                                        <span
                                            class="bg-danger text-white p-2 pull-left rounded">٪{{ $product->discount_percent }}</span>
                                        <h4 class="card-title">{{ $product->title }}</h4>
                                        <p class="card-text">{{ $product->description }}</p>
                                        <p class="card-text"><i class="fa fa-map-marker"></i>
                                            {{ $product->user->city->name }}</p>


                                        <div class="price"> <span> {{ $product->price }} </span>
                                            {{ $product->discount }} تومان
                                        </div>


                                        <a href="{{ route('show-product-details', [$product->slug]) }}"
                                            class="btn btn-success pull-center">مشاهده جزئیات محصول</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

            </div>
        </div>
    @endif

        <hr class="my-3" />

        <div class="row">
            <div class="col-md-6">
                <p class="product-row-title"> نمایش محصولات بر اساس شهر انتخاب شده </p>
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
        var cityName = currentLocArr[currentLocArr.length - 1];

        var pageNumber = 1;
        loadMore(pageNumber, cityName);

        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= $(document).height()) {

                pageNumber++;
                loadMore(pageNumber, cityName);
            }
        });


        function loadMore(pageNumber, cityName) {
            $.ajax({
                url: '/cities/' + cityName + '?page=' + pageNumber,
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
