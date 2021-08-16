@extends('layouts.app')

@section('title') جزيیات سفارش  @endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header text-right"> جزییات سفارش</div>

                    <div class="card-body">
                        <table class="table table-hover text-center justify-content-center">
                            <tbody>
                                <tr>
                                    <th scope="row"> شماره سفارش</th>
                                    <td> {{ $payment->order->id }}</td>
                                </tr>
                                <tr>
                                    <th scope="row"> محصول </th>
                                    <td>
                                        @foreach ($order as $item)
                                            <a href="{{ route('show-product-details', $item->product->slug) }}"
                                                class="text-decoration-none">{{ $item->product->title }}</a> *
                                            {{ $item->quantity }}
                                            <hr>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"> هزینه نهایی</th>
                                    <td>{{ $payment->amount }} تومان</td>
                                </tr>
                                <tr>
                                    <th scope="row">شیوه پرداخت</th>
                                    <td> {{ $payment->payment_type }} </td>
                                </tr>
                                <tr>
                                    <th scope="row">کد پیگیری پرداخت</th>
                                    <td>{{ $payment->reference_id }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
