@extends('layouts.app')

@section('title')  تراکنش های من @endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">

            @include('front.partials.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header text-right">تراکنش های من</div>

                    <div class="card-body table-responsive">
                        <table class="table table-hover text-center table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">شماره تراکنش</th>
                                    <th scope="col">شماره پیگیری پرداخت</th>
                                    <th scope="col">وضعیت</th>
                                    <th scope="col">مبلغ پرداختی</th>
                                    <th scope="col"> درگاه پرداخت</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->id }}</td>
                                        <td>{{ $transaction->reference_id }}</td>
                                        <td>{{ $transaction->description }}</td>
                                        <td>{{ $transaction->amount }} تومان</td>
                                        <td>{{ $transaction->payment_type }}</td>
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
