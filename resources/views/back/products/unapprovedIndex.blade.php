@extends('back.app')

@section('title')نمایش محصولات  @endsection

@section('content')



    <div class="content-wrapper">
        
        <section class="content">
            <div class="row">
                <div class="col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> محصولات تایید نشده</h3>
                        </div>
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th> عنوان</th>
                                        {{-- <th scope="col"> توضیحات</th> --}}
                                        <th> نوع خدمت </th>
                                        {{-- <th scope="col">نوع سرویس </th> --}}
                                        {{-- <th scope="col">شرایط استفاده</th> --}}
                                        <th>قیمت اصلی (ریال)</th>
                                        <th>قیمت با تخفیف(ریال) </th>
                                        <th>مهلت استفاده کوپن</th>
                                        <th> ظرفیت </th>
                                        <th> تاریخ شروع </th>
                                        <th> تاریخ پایان </th>
                                        <th>تصویر</th>
                                        <th>عملیات</th>
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
                                            <td>{{ $product->gregorianDateToPersian($product->starts_at) }}</td>
                                            <td>{{ $product->gregorianDateToPersian($product->ends_at) }}</td>

                                            <td><img src="{{ asset('storage/uploads/products/images/' . $product->menu_image_path) }}"
                                                    width="60px" height="60px" alt=""></td>

                                            <td><a href="productapproval/{{ $product->id }}">تایید </a>
                                                |
                                                <a href="productdisapproval/{{ $product->id }}">رد کردن محصول</a>
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th> عنوان</th>
                                        {{-- <th scope="col"> توضیحات</th> --}}
                                        <th> نوع خدمت </th>
                                        {{-- <th scope="col">نوع سرویس </th> --}}
                                        {{-- <th scope="col">شرایط استفاده</th> --}}
                                        <th>قیمت اصلی (ریال)</th>
                                        <th>قیمت با تخفیف(ریال) </th>
                                        <th>مهلت استفاده کوپن</th>
                                        <th> ظرفیت </th>
                                        <th> تاریخ شروع </th>
                                        <th> تاریخ پایان </th>
                                        <th>تصویر</th>
                                        <th>عملیات</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>


@endsection


@push('scripts')
    <script src="{{ url('/back/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('/back/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ url('/back/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>

    <script>
        $(function() {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            })
        })

    </script>
@endpush
