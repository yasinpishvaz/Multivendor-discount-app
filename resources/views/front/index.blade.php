@extends('layouts.app')

@section('title')   صفحه اصلی @endsection

@section('secondNavbar')
    @include('front.secondnavbar')
@endsection

@section('content')

    @if ($products->isNotEmpty())
        <div class="container-fluid mt-3">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($products as $product)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <a href="{{ route('show-product-details', $product->slug) }}">
                                        <img class="d-block w-100 rounded"
                                            src="{{ asset('storage/uploads/products/images/' . $product->menu_image_path) }}"
                                            alt="First slide">
                                    </a>

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
        </div>
    @endif




    @if ($products->isNotEmpty())
        <div class="container-fluid my-5">
            <div class="row">
                <div class="col-md-6">
                    <p class="product-row-title">همه محصولات</p>
                </div>
				
			<div class="col-md-6">
                <a href="/products/all" class="product-row-morelink"><span>مشاهده همه</span>
                    <i class="fa fa-arrow-left"></i>
                </a>
            </div>

            </div>
			
			

            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-3 col-sm-3 mb-3">
                        <div class="col-md-12 border rounded">
                            <div class="product-box">
                                <a href="{{ route('show-product-details', $product->slug) }}"
                                    class="text-decoration-none">
                                    <div class="product-image">
                                        <img class="pic-1"
                                            src="{{ asset('storage/uploads/products/images/' . $product->menu_image_path) }}">
                                        <span class="product-discount-label">٪{{ $product->discount_percent }}</span>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title"> {{ $product->title }} </h3>
                                        <span class="product-location"><i class="fa fa-map-marker location-icon"
                                                aria-hidden="true"></i>{{ $product->user->city->name }}</span>
                                        <div class="price"> <span> {{ $product->price }} </span>
                                            {{ $product->discount }} تومان
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    @endif




    <div class="container-fluid my-4">
        <div class="row justify-content-center">
            <div class="col-md-3 mb-3">
                <a href="/tehran/healthandmedical/hair-removal-laser">
                    <img class="block w-100 rounded" src="{{ asset('storage/uploads/images/menu_under_slider.jpg') }}">
                </a>
            </div>

            <div class="col-md-3 mb-3">
                <a href="/tehran/healthandmedical/massage">
                    <img class="block w-100 rounded" src="{{ asset('storage/uploads/images/menu_under_slider_2.jpg') }}">
                </a>
            </div>

            <div class="col-md-3 mb-3">
                <a href="/tehran/healthandmedical/fitness-services">
                    <img class="block w-100 rounded" src="{{ asset('storage/uploads/images/menu_under_slider_3.jpg') }}">
                </a>
            </div>

        </div>
    </div>




    @if ($tours->isNotEmpty())
    <div class="container-fluid my-5">
        <div class="row">
            <div class="col-md-6">
                <p class="product-row-title">تور و طبیعت گردی</p>
            </div>

            <div class="col-md-6">
                <a href="/tehran/tour" class="product-row-morelink"><span>مشاهده همه</span>
                    <i class="fa fa-arrow-left"></i>
                </a>
            </div>

        </div>

        <div class="row">
            @foreach ($tours as $tour)
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="col-md-12 border rounded">
                        <div class="product-box">
                            <a href="{{ route('show-product-details', $tour->slug) }}" class="text-decoration-none">
                                <div class="product-image">
                                    <img class="pic-1"
                                        src="{{ asset('storage/uploads/products/images/' . $tour->menu_image_path) }}">
                                    <span class="product-discount-label">٪{{ $tour->discount_percent }}</span>
                                </div>
                                <div class="product-content">
                                    <h3 class="title"> {{ $tour->title }} </h3>
                                    <span class="product-location"><i class="fa fa-map-marker location-icon"
                                            aria-hidden="true"></i>{{ $tour->user->city->name }}</span>
                                    <div class="price"> <span> {{ $tour->price }} </span>
                                        {{ $tour->discount }} تومان
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endif




    <div class="container-fluid my-4">
        <div class="row justify-content-center">
            <div class="col-md-5 mb-3">
                <a href="/tehran/tour">
                    <img class="block w-100 rounded" src="{{ asset('storage/uploads/images/50_a.jpg') }}" alt="">
                </a>
            </div>
            <div class="col-md-5">
                <a href="/tehran/restaurant-coffe/breakfast">
                    <img class="block w-100 rounded" src="{{ asset('storage/uploads/images/breakfast.jpg') }}" alt="">
                </a>
            </div>
        </div>
    </div>






    
    @if ($educations->isNotEmpty())
        <div class="container-fluid my-5">
            <div class="row">
                <div class="col-md-6">
                    <p class="product-row-title"> آموزش  </p>
                </div>

                <div class="col-md-6">
                    <a href="/tehran/education" class="product-row-morelink"><span>مشاهده همه</span>
                        <i class="fa fa-arrow-left"></i>
                    </a>
                </div>

            </div>

            <div class="row">
                @foreach ($educations as $education)
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="col-md-12 border rounded">
                            <div class="product-box">
                                <a href="{{ route('show-product-details', $education->slug) }}" class="text-decoration-none">
                                    <div class="product-image">
                                        <img class="pic-1"
                                            src="{{ asset('storage/uploads/products/images/' . $education->menu_image_path) }}">
                                        <span class="product-discount-label">٪{{ $education->discount_percent }}</span>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title"> {{ $education->title }} </h3>
                                        <span class="product-location"><i class="fa fa-map-marker location-icon"
                                                aria-hidden="true"></i>{{ $education->user->city->name }}</span>
                                        <div class="price"> <span> {{ $education->price }} </span>
                                            {{ $education->discount }} تومان
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    @endif


    

    
    @if ($breakfasts->isNotEmpty())
        <div class="container-fluid my-5">
            <div class="row">
                <div class="col-md-6">
                    <p class="product-row-title">صبحانه  </p>
                </div>

                <div class="col-md-6">
                    <a href="/tehran/restaurant-coffe/breakfast" class="product-row-morelink"><span>مشاهده همه</span>
                        <i class="fa fa-arrow-left"></i>
                    </a>
                </div>

            </div>

            <div class="row">
                @foreach ($breakfasts as $breakfast)
                    <div class="col-md-3 col-sm-6 mb-5">
                        <div class="col-md-12 border rounded">
                            <div class="product-box">
                                <a href="{{ route('show-product-details', $breakfast->slug) }}" class="text-decoration-none">
                                    <div class="product-image">
                                        <img class="pic-1"
                                            src="{{ asset('storage/uploads/products/images/' . $breakfast->menu_image_path) }}">
                                        <span class="product-discount-label">٪{{ $breakfast->discount_percent }}</span>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title"> {{ $breakfast->title }} </h3>
                                        <span class="product-location"><i class="fa fa-map-marker location-icon"
                                                aria-hidden="true"></i>{{ $breakfast->user->city->name }}</span>
                                        <div class="price"> <span> {{ $breakfast->price }} </span>
                                            {{ $breakfast->discount }} تومان
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    @endif





@endsection('content')
