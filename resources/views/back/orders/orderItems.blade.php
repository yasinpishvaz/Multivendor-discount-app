@extends('back.app')

@section('title')نمایش سفارش ها @endsection

@section('content')



    <div class="content-wrapper">

        <section class="content">
            <div class="row">
                <div class="col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> سفارش های ثبت شده</h3>
                        </div>

                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <th>نام محصول</th>
                                    <th>قیمت اصلی</th>
                                    <th>قیمت با تخفیف </th>
                                    <th>تعداد سفارش </th>
                                    <th>کد تخفیف خریداری شده</th>
                                    <th>X</th>
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
                                <tfoot>
                                    <th>نام محصول</th>
                                    <th>قیمت اصلی</th>
                                    <th>قیمت با تخفیف </th>
                                    <th>تعداد سفارش </th>
                                    <th>کد تخفیف خریداری شده</th>
                                    <th>X</th>
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

    <!-- page script -->
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
