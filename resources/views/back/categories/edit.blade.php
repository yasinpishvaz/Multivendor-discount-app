@extends('back.app')

@section('title') ایجاد دسته بندی جدید @endsection

@section('content')

    <div class="content-wrapper">
        
        <section class="content-header">
            <h1>
                صفحه خالی
                <small>آماده برای پروژه شما</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> خانه</a></li>
                <li><a href="#">مثال ها</a></li>
                <li class="active">صفحه خالی</li>
            </ol>
        </section>





        <section class="content">
            <div class="row">

                <div class="col-md-10">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">اجزای کلی</h3>
                        </div>
                
                        <div class="box-body">
                            <form action="{{ url('/back/categories/updatecategory/' . $selectedCategory->id) }}"
                                method="POST" role="form" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')

                   
                                <div class="form-group">
                                    <label>عنوان دسته </label>
                                    <input type="text" class="form-control" placeholder="عنوانی وارد کنید" name="title"
                                        value="{{ $selectedCategory->title }}">
                                </div>

                                <div class="form-group">
                                    <label>نام مستعار</label>
                                    <input type="text" class="form-control" placeholder="نام مستعاری وارد کنید" name="slug"
                                        value="{{ $selectedCategory->slug }}">
                                </div>

                     
                                <div class="form-group">
                                    <label>توضیحات</label>
                                    <textarea class="form-control" rows="3" placeholder="متن"
                                        name="description"> {{ $selectedCategory->description }} </textarea>
                                </div>

           
                                <div class="form-group">
                                    <label>انتخاب دسته بندی اصلی</label>
                                    <select name="parent_id" id="" class="form-control">
                                        <option value="0"> دسته اصلی</option>
                                        </option>
                                        @foreach ($categories as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ $key == $selectedCategory->parent_id ? 'selected' : '' }}>
                                                {{ $value }}</option>
                                        @endforeach


                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">اپلود آیکن</label>
                                    <input type="file" id="exampleInputFile" name="icon_path">

                                    <p class="help-block">متن راهنما</p>
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
