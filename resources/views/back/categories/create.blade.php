@extends('back.app')

@section('title') ایجاد دسته بندی جدید @endsection

@section('content')

    <div class="content-wrapper">
  
        <section class="content">
            <div class="row">

                <div class="col-md-10">
                
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title"> ایجاد دسته جدید</h3>
                        </div>
                        <div class="box-body">
                            <form action="" method="POST" role="form" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label>عنوان دسته </label>
                                    <input type="text" class="form-control" placeholder="عنوانی وارد کنید" name="title">
                                </div>

                                <div class="form-group">
                                    <label>نام مستعار</label>
                                    <input type="text" class="form-control" placeholder="نام مستعاری وارد کنید" name="slug">
                                </div>

                                <div class="form-group">
                                    <label>توضیحات</label>
                                    <textarea class="form-control" rows="3" placeholder="متن" name="description"></textarea>
                                </div>

                                <div class="form-group">
                                    <label>انتخاب دسته بندی اصلی</label>
                                    <select name="parent_id" id="" class="form-control">
                                        <option value="0"> دسته اصلی</option>
                                        @foreach($categories as $key => $value)
                                            <option value="{{ $key }}"> {{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="InputFile">آپلود آیکن</label>
                                    <input type="file" id="InputFile" name="icon_path">
                                </div>


                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">ارسال</button>
                                </div>

                            </form>
                        </div>            
                    </div>           
                </div>      
            </div>
        </section>

    </div>


@endsection
