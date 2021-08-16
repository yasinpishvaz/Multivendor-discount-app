@extends('back.app')

@section('title') لیست کاربر ها @endsection

@section('content')



    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> لیست کاربر ها</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>نام کاربری </th>
                                        <th>ایمیل</th>
                                        <th> شماره تلفن</th>
                                        <th> وضعیت حساب</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($users as $user)
                                        <tr>

                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>

                                            @if ($user->status == 0)
                                                <td> فعال نشده
                                                </td>
                                            @elseif ($user->status == 1) <td> فعال</td>
                                            @elseif ($user->status == 2) <td> مسدود</td>
                                            @endif

                                            <td>
                                                @if ($user->status == 1)
                                                    <a href="block/{{ $user->id }}">مسدود کردن </a>

                                                @elseif ($user->status == 2)
                                                    <a href="active/{{ $user->id }}">فعال کردن </a>
                                                @endif


                                            </td>
                                    @endforeach
                                    </tr>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>نام کاربری </th>
                                        <th>ایمیل</th>
                                        <th> شماره تلفن</th>
                                        <th> وضعیت حساب</th>
                                        <th>عملیات</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


@endsection


@push('scripts')
    <!-- DataTables -->
    <script src="{{ url('/back/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('/back/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <!-- SlimScroll -->
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
