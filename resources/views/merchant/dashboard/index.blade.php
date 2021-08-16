@extends('merchant.app')

@section('title')   پنل کسب و کار @endsection

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">


            @include('merchant.partials.sidebar')


            <div class="col-md-9">
                <div class="card border-primary text-center">
                    <div class="card-header"> خانه </div>

                    <div class="card-body">

                        <a class="btn btn-outline-primary d-block" role="button"
                            href="{{ url('merchant/panel/editprofile') }}"> <i class="fa fa-home"></i> ویرایش حساب
                            کاربری</a>

                        <a class="btn btn-outline-primary d-block" role="button"
                            href="{{ url('/merchant/panel/package/create') }}"> <i class="fa fa-tags"></i> افزودن پکیج
                            تخفیف جدید </a>

                        <a class="btn btn-outline-primary d-block" role="button"
                            href="{{ url('/merchant/panel/mydeals') }}"> <i class="fa fa-tags"></i> تخفیف های تایید شده
                            من</a>

                        <a class="btn btn-outline-primary d-block" role="button"
                            href="{{ url('/merchant/panel/notapproveddeals') }}"> <i class="fa fa-tags"></i> تخفیف های
                            تایید نشده من</a>

                        <a class="btn btn-outline-primary d-block" role="button" href="#"> <i class="fa fa-money"></i>
                            درخواست پرداخت</a>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
