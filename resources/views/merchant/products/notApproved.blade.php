@extends('merchant.app')

@section('title')  نمایش تخفیف های تایید نشده @endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">


            @include('merchant.partials.sidebar')


            <div class="col-md-9">
                <div class="card">
                    <div class="card-header text-right"> <span> تخفیف های من</span>
                        <div class="pull-left">
                            <a href="/merchant/panel/package/create/" class="text-decoration-none"><button type="button"
                                    class="btn btn-block btn-danger btn-flat">+افزودن پکیج جدید</button></a>
                        </div>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table table-hover text-center justify-content-center table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col"> عنوان</th>
                                    {{-- <th scope="col"> توضیحات</th> --}}
                                    <th scope="col"> نوع خدمت </th>
                                    {{-- <th scope="col">نوع سرویس </th> --}}
                                    {{-- <th scope="col">شرایط استفاده</th> --}}
                                    <th scope="col">قیمت اصلی (ریال)</th>
                                    <th scope="col">قیمت با تخفیف(ریال) </th>
                                    <th scope="col">مهلت استفاده کوپن</th>
                                    <th scope="col"> ظرفیت </th>
                                    {{-- <th scope="col"> تاریخ شروع </th>
                                    <th scope="col"> تاریخ پایان </th> --}}
                                    <th scope="col">وضعیت تخفیف</th>
                                    <th scope="col">تصویر</th>
                                    <th scope="col">عملیات</th>

                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->title }}</td>
                                        {{-- <td>{{ $product->description }}</td> --}}
                                        <td>{{ $product->service->title }}</td>
                                        {{-- <td>{{ $product->subService->title }}</td> --}}
                                        {{-- <td>{{ $product->terms_of_use }}</td> --}}
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->discount }}</td>
                                        <td>{{ $product->deadline_for_use }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        {{-- <td> {{ $product->gregorianDateToPersian($product->starts_at) }} </td>
                                        <td> {{ $product->gregorianDateToPersian($product->ends_at) }} </td> --}}

                                        @if ($product->status == 0)
                                            <td> در حال بررسی تخفیف</td>
                                        @elseif($product->status == 2)
                                            <td> تخفیف تایید نشد</td>
                                        @endif

                                        <td><img src="{{ asset('storage/uploads/products/images/' . $product->menu_image_path) }}"
                                                width="60px" height="60px" alt=""></td>

                                        <td><a href="delete/{{ $product->id }}">حذف</a>
                                        </td>

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
