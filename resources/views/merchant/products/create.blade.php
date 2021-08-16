@extends('merchant.app')

@section('title') ایجاد تخفیف  @endsection

@prepend('styles')
    <link rel="stylesheet" href="{{ url('/back/dist/css/persian-datepicker-0.4.5.min.css') }}" />
    <link rel="stylesheet" href="{{ url('/back/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}" />
    <link rel="stylesheet"
        href="{{ url('/back/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}" />
@endprepend

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">

            @include('merchant.partials.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header text-right">ایجاد تخفیف جدید</div>

                    <div class="card-body">
                        <form action="" method="POST" role="form" enctype="multipart/form-data">
                            @csrf


                            <div class="form-group row">
                                <label for="companyTitle" class="col-md-4 col-form-label text-md-left">نام کسب و کار</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" required
                                        placeholder="عنوانی وارد کنید" value=" {{ Auth::user()->name }}"
                                        name="companyTitle" disabled>
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="category" class="col-md-4 col-form-label text-md-left">دسته بندی </label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" required
                                        placeholder="عنوانی وارد کنید" value=" {{ $user->category->title }}"
                                        name="category_id" disabled>
                                </div>
                            </div>







                            <div class="form-group row">
                                <label for="service" class="col-md-4 col-form-label text-md-left">نوع خدمت </label>

                                <div class="col-md-6">
                                    <select name="service_id" id="" class="form-control">
                                        <option value="">انتخاب خدمت</option>
                                        @foreach ($category->childs as $child)
                                            <option value="{{ $child->id }}"> {{ $child->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>





                            <div class="form-group row">
                                <label for="subService" class="col-md-4 col-form-label text-md-left">نوع سرویس </label>

                                <div class="col-md-6">
                                    <select name="subService_id" id="" class="form-control">
                                        <option value="0">انتخاب خدمت</option>

                                    </select>
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-left">عنوان</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                        name="title" value="{{ old('title') }}" required autocomplete="title">

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-left">توضیحات</label>

                                <div class="col-md-6">
                                    <textarea class="form-control" rows="3" placeholder="توضیحات" @error('description')
                                        is-invalid @enderror" name="description" value="{{ old('description') }}" required
                                        autocomplete="description"></textarea>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>




                            <div class="form-group row">
                                <label for="menu_image_path" class="col-md-4 col-form-label text-md-left">اپلود
                                    تصویر</label>
                                <div class="col-md-6">
                                    <input id="menu_image_path" type="file"
                                        class="form-control @error('menu_image_path') is-invalid @enderror"
                                        name="menu_image_path" value="{{ old('menu_image_path') }}" autocomplete="phone">

                                    <p class="help-block">متن راهنما</p>

                                    @error('menu_image_path')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>





                            <div class="form-group row">
                                <label for="terms_of_use" class="col-md-4 col-form-label text-md-left">شرایط استفاده</label>

                                <div class="col-md-6">
                                    <textarea class="form-control" rows="3" placeholder="شرایط استفاده"
                                        @error('terms_of_use') is-invalid @enderror" name="terms_of_use"
                                        value="{{ old('terms_of_use') }}" required
                                        autocomplete="terms_of_use"></textarea>

                                    @error('terms_of_use')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>




                            <div class="form-group row">
                                <label for="price" class="col-md-4 col-form-label text-md-left"> قیمت بدون تخفیف</label>
                                <div class="col-md-6">
                                    <input id="price" type="number"
                                        class="form-control @error('price') is-invalid @enderror" name="price"
                                        placeholder="قیمت اصلی(ریال)  " value="{{ old('price') }}" required
                                        autocomplete="price">

                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>




                            <div class="form-group row">
                                <label for="discount" class="col-md-4 col-form-label text-md-left"> قیمت با تخفیف</label>
                                <div class="col-md-6">
                                    <input id="discount" type="number"
                                        class="form-control @error('discount') is-invalid @enderror" name="discount"
                                        placeholder="قیمت با تخفیف(ریال)  " value="{{ old('discount') }}" required
                                        autocomplete="discount">

                                    @error('discount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>





                            <div class="form-group row">
                                <label for="service" class="col-md-4 col-form-label text-md-left">مهلت استفاده کوپن </label>

                                <div class="col-md-6">
                                    <select name="deadline_for_use" id="" class="form-control">
                                        <option value="30"> ۳۰ روز پس از خرید کوپن</option>
                                        <option value="45"> ۴۵ روز پس از خرید کوپن</option>
                                        <option value="60"> ۶۰ روز پس از خرید کوپن</option>
                                    </select>
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="service" class="col-md-4 col-form-label text-md-left"> ظرفیت </label>

                                <div class="col-md-6">
                                    <input type="number" class="form-control" placeholder=" ظرفیت " name="quantity">
                                </div>
                            </div>














                            <div class="form-group row">
                                <label for="starts_at" class="col-md-4 col-form-label text-md-left">تاریخ شروع</label>
                                <div class="col-md-6">
                                    <input id="fromDate" type="text" class="form-control" @error('starts_at') is-invalid
                                        @enderror" name="starts_at" value="{{ old('starts_at') }}" required
                                        autocomplete="starts_at">

                                    <div class="range-from"></div>
                                    {{-- @error('starts_at')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror --}}
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="ends_at" class="col-md-4 col-form-label text-md-left">تاریخ پایان</label>
                                <div class="col-md-6">
                                    <input id="toDate" type="text" class="form-control" @error('ends_at') is-invalid
                                        @enderror" name="ends_at" value="{{ old('ends_at') }}" required
                                        autocomplete="ends_at">

                                    <div class="range-to"></div>
                                    {{-- @error('ends_at')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror --}}
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        ثبت
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection






@push('scripts')

    <!-- date-range-picker -->
    <script src="{{ url('/back/bower_components/moment/min/moment.min.js') }} "></script>
    <script src="{{ url('/back/bower_components/bootstrap-daterangepicker/daterangepicker.js') }} "></script>
    <!-- bootstrap datepicker -->
    <script src="{{ url('/back/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }} "></script>


    <script src="{{ url('/back/dist/js/persian-date-0.1.8.min.js') }} "></script>
    <script src="{{ url('/back/dist/js/persian-datepicker-0.4.5.min.js') }} "></script>



    <script>
        var to, from;
        to = $("#toDate").persianDatepicker({
            inline: true,
            altField: '#toDate',
            format: 'YYYY/MM/DD',
            altFormat: 'LLLL',
            initialValue: false,
            onSelect: function(unix) {
                to.touched = true;
                if (from && from.options && from.options.maxDate != unix) {
                    var cachedValue = from.getState().selected.unixDate;
                    from.options = {
                        maxDate: unix
                    };
                    if (from.touched) {
                        from.setDate(cachedValue);
                    }
                }
            }
        });


        from = $("#fromDate").persianDatepicker({
            inline: true,
            altField: '#fromDate',
            format: 'YYYY/MM/DD',
            altFormat: 'LLLL',
            initialValue: false,
            onSelect: function(unix) {
                from.touched = true;
                if (to && to.options && to.options.minDate != unix) {
                    var cachedValue = to.getState().selected.unixDate;
                    to.options = {
                        minDate: unix
                    };
                    if (to.touched) {
                        to.setDate(cachedValue);
                    }
                }
            }
        });

    </script>






    <script>
        $(document).ready(function() {

            $('select[name="service_id"]').on('change', function() {

                var serviceId = $(this).val();
                if (serviceId) {
                    $.ajax({
                        url: '/merchant/products/services/get/' + serviceId,
                        type: "GET",
                        dataType: "json",

                        success: function(data) {

                            $('select[name="subService_id"]').empty();

                            $.each(data, function(key, value) {

                                $('select[name="subService_id"]').append(
                                    '<option value="' +
                                    key + '">' + value + '</option>');

                            });
                        },
                    });
                } else {
                    $('select[name="subService_id"]').empty();
                }

            });

        });

    </script>
@endpush
