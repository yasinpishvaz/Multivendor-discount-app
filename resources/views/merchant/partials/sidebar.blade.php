<div class="col-md-3 mb-3">
    <div class="card">
        <div class="card-header text-right">
            <i class="fa fa-user fa-lg"></i>
            {{ auth()->user()->name }}
        </div>
        <div class="card-body pr-0">
            <ul class="nav flex-column  pr-4">


                <a class="btn btn-light text-right" href="{{ url('/') }}"> 
                    صفحه اصلی سایت</a>

                <a class="btn btn-light text-right" href="{{ url('merchant/panel/editprofile') }}"> ویرایش حساب
                    کاربری</a>

                <a class="btn btn-light text-right" href="{{ url('/merchant/panel/package/create') }}"> افزودن پکیج
                    تخفیف جدید </a>

                <a class="btn btn-light text-right" href="{{ url('/merchant/panel/mydeals') }}"> تخفیف های تایید شده
                    من</a>

                <a class="btn btn-light text-right" href="{{ url('/merchant/panel/notapproveddeals') }}"> تخفیف های
                    تایید نشده من</a>

            </ul>
        </div>
    </div>
</div>
