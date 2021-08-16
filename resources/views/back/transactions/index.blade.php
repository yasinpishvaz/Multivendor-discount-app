@extends('back.app')

@section('title')نمایش تراکنش ها @endsection

@section('content')



    <div class="content-wrapper">

        <section class="content">
            <div class="row">
                <div class="col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> تراکنش های انجام شده</h3>
                        </div>

                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <th>شماره تراکنش</th>
                                    <th>آیدی کاربر</th>
                                    <th>شماره پیگیری پرداخت</th>
                                    <th>وضعیت</th>
                                    <th>مبلغ پرداختی</th>
                                    <th> درگاه پرداخت</th>
                                </thead>
                                <tbody>

                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td>{{ $transaction->id }}</td>
                                            <td> {{ $transaction->user_id}}</td>
                                            <td>{{ $transaction->reference_id }}</td>
                                            <td>{{ $transaction->description }}</td>
                                            <td>{{ $transaction->amount }} تومان</td>
                                            <td>{{ $transaction->payment_type }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <th>شماره تراکنش</th>
                                    <th>آیدی کاربر</th>
                                    <th>شماره پیگیری پرداخت</th>
                                    <th>وضعیت</th>
                                    <th>مبلغ پرداختی</th>
                                    <th> درگاه پرداخت</th>
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
