@extends('layouts.app')

@section('title') لیست سفارش ها @endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">


 

            @include('front.partials.sidebar')



            <div class="col-md-9">
                <div class="card">
                    <div class="card-header text-right">تخفیف های من</div>

                    <div class="card-body table-responsive">
                        <table class="table table-hover text-center table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">شماره سفارش</th>
                                    <th scope="col">وضعیت</th>
                                    <th scope="col">x</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->description }}</td>
                                        <td> <a href="{{ route('userOrderItems', $order->id) }}">
                                                مشاهده آیتم های سفارش موجود در سفارش
                                            </a></td>
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
