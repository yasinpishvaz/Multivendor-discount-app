@extends('layouts.app')

@section('title') آیتم های سفارش  @endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">

            
            @include('front.partials.sidebar')


            <div class="col-md-9">
                <div class="card">
                    <div class="card-header text-right">تخفیف های من</div>

                    <div class="card-body table-responsive">
                        <table class="table table-hover text-center justify-content-center table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">نام محصول</th>
                                    <th scope="col">قیمت اصلی</th>
                                    <th scope="col">قیمت با تخفیف </th>
                                    <th scope="col">تعداد سفارش </th>
                                    <th scope="col">کد تخفیف خریداری شده</th>
                                    <th scope="col">X</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderItems as $orderItem)
                                    <tr>
                                        <td> {{ $orderItem->product->title }}</td>
                                        <td> {{ $orderItem->price }}</td>
                                        <td> {{ $orderItem->discount }}</td>
                                        <td> {{ $orderItem->quantity }}</td>
                                        <td class="text-break"> {{ $orderItem->coupon_code }}</td>
                                        <td> <a href="{{ route('show-product-details', $orderItem->product->slug) }}"
                                                class="text-decoration-none">مشاهده صفحه محصول در سایت</a> </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
