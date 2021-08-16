@extends('back.app')

@section('title')نمایش دسته ها @endsection

@section('content')



    <div class="content-wrapper">

        <section class="content">
            <div class="row">
                <div class="col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> نمایش دسته ها و سرویس ها</h3>
                        </div>
                    
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>عنوان دسته </th>
                                        <th>نام مستعار</th>
                                        <th> توضیحات</th>
                                        <th>دسته بندی اصلی</th>
                                        <th> آیکن</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($categories as $category)
                                        <tr>

                                            <td>{{ $category->title }}</td>
                                            <td>{{ $category->slug }}</td>
                                            <td>{{ $category->description }}</td>

                                            @if ($category->parent)
                                                <td> {{ $category->parent->title }}
                                                </td>

                                            @else <td> ندارد</td>
                                            @endif
                                          
                                            <td><img src="{{ asset('storage/uploads/images/' . $category->icon_path) }}"
                                                    width="60px" height="60px" alt=""></td>
                                            <td><a href="delete/{{ $category->id }}">حذف</a>
                                                |
                                                <a href="edit/{{ $category->id }}">ویرایش</a>
                                            </td>
                                    @endforeach
                                    </tr>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>عنوان دسته </th>
                                        <th>نام مستعار</th>
                                        <th> توضیحات</th>
                                        <th>دسته بندی اصلی</th>
                                        <th> آیکن</th>
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
