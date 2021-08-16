@extends('layouts.app')

@section('title')  جزییات محصول @endsection

@section('content')


    <div class="container-fluid mt-5">

        <div class="row">
            <div class="col-md-9 col-sm-8 mb-5">

                <div class="card">
                    <div class="card-body">
                        <div class="product-box">
                            <div class="product-content mb-4">
                                <h3 class="title"> {{ $product->title }} </h3>
                                <hr />
                                <span class="product-location"><i class="fa fa-map-marker location-icon"
                                        aria-hidden="true"></i>{{ $product->user->city->name }}</span>
                            </div>
                            <div class="product-image">
                                <img class="pic-1 rounded"
                                    src="{{ asset('storage/uploads/products/images/' . $product->menu_image_path) }}">
                            </div>

                            <div class="product-content text-right mt-5">
                                <h3 class="title">چرا {{ $product->title }} ؟</h3>

                                <hr>
                                <p>{{ $product->description }}</p>
                                <hr>
                                <p> {{ $product->terms_of_use }}</p>
                                <hr>
                                <p> تاریخ استفاده: از {{ $product->gregorianDateToPersian($product->starts_at) }} تا
                                    {{ $product->gregorianDateToPersian($product->ends_at) }}</p>

                            </div>

                        </div>
                    </div>
                </div>

            </div>


            <div class="col-md-3 col-sm-4 pb-0">
                <div class="sticky-top">
                    <div class="purchase-box ">
                        <div class="card align-middle py-2">
    
                            <div class="product-bottom-box text-center">
    
                                <div class="product-left-box">
                                    <div class="price"> <span> {{ $product->price }} </span>
                                        {{ $product->discount }} تومان
                                    </div>
                                    <span class="product-discount-label">٪{{ $product->discount_percent }}</span>
                                </div>
                            </div>
    
                            <ul class="list-unstyled">
                                <li class="text-right">
                                    <span>مهلت استفاده {{ $product->deadline_for_use }} روز پس از خرید تخفیف</span>
                                </li>
                            </ul>
                        </div>
                    </div>


                    <p class="btn-holder"><a href="{{ url('product/add-to-cart/' . $product->id) }}"
                        class="btn btn-success btn-block text-center add-to-cart" data-id="{{ $product->id }}"
                        role="button">افزودن به سبد خرید </a> </p>

                </div>


 
            </div>

        </div>
    </div>




    <div class="container-fluid mt-3 mb-5">
        <div class="row justify-content-right">
            <div class="col-md-9 col-sm-8">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-link active" id="nav-comment-tab" data-toggle="tab" href="#nav-comment" role="tab"
                            aria-controls="nav-comment" aria-selected="false"> نظرات کاربران درباره {{ $product->title }}</a>
                        <a class="nav-link" id="nav-merchant-tab" data-toggle="tab" href="#nav-merchant" role="tab"
                            aria-controls="nav-merchant" aria-selected="true">اطلاعات کسب و کار</a>

                    </div>
                </nav>

                <div class="tab-content" id="nav-tabContent">

                    <div class="tab-pane fade show active" id="nav-comment" role="tabpanel"
                        aria-labelledby="nav-profile-tab">
                        <div class="card">
                            <div class="card-body text-right">
                                @if (count($product->comments))
                                    @include('front.products.comments', ['comments'=> $product->comments, 'productId' =>
                                    $product->id])
                                @endif

                                <hr />
                                <h5>ثبت نظر جدید برای {{ $product->title }}</h5>
                                <form method="post" action="{{ route('commentStore') }}">
                                    @csrf
                                    <div class="form-group">
                                        <textarea name="comment_text" class="form-control"></textarea>
                                        <input type="hidden" name="product_id" value="{{ $product->id }}" />
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="ثبت" />
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade " id="nav-merchant" role="tabpanel" aria-labelledby="nav-merchant-tab">

                        <div class="card">
                            <div class="card-body">
                                <div class="name-container">
                                    <p class="text-right">نام : {{ $product->user->name }} </p>
                                </div>
                                <div class="phone-container">
                                    <p class="text-right">شماره تماس: {{ $product->user->phone }} </p>
                                </div>

                                <div class="location">
                                    <p class="text-right"> آدرس: {{ $product->user->city->name }} </p>
                                </div>

                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>













@endsection('content')


@push('scripts')
    <script type="text/javascript">
        $('.add-to-cart').click(function(e) {
            e.preventDefault();
            var ele = $(this);

            $.ajax({
                url: '{{ url('/product/add-to-cart') }}' + '/' + ele.attr('data-id'),
                method: 'get',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(response) {
                    $("span#status").html('<div class="alert alert-success">' + response.msg +
                        '</div>');
                    $("#header-bar").html(response.data);
                }
            });
        });

    </script>



    {{-- put comment id on modal form input for reply to a comment --}}

    <script>
        $(document).on('click', '.btn-reply', function() {
            var commentId = $(this).data('id');
            $('.modal-body #parentId').val(commentId);
        });

    </script>



@endpush
