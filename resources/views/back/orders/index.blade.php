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
                                    <th>آیدی کاربر</th>
                                    <th>شماره سفارش</th>
                                    <th>وضعیت</th>
                                    <th>عملیات</th>
                                </thead>
                                <tbody>

                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->user_id }}</td>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->description }}</td>
                                            <td> <a href="{{ route('allOrderItems', $order->id) }}">
                                                    مشاهده آیتم های موجود در سفارش
                                                </a></td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <th>آیدی کاربر</th>
                                    <th>شماره سفارش</th>
                                    <th>وضعیت</th>
                                    <th>عملیات</th>
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
