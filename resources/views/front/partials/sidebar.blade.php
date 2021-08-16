            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-header text-right">
                        <i class="fa fa-user fa-lg"></i>
                        {{ auth()->user()->name }}
                        {{-- <img src="{{ asset('storage/uploads/images/origAvatar.png') }}" alt=""> --}}
                    </div>
                    <div class="card-body pr-0">
                        <ul class="nav flex-column pr-4">



                            <a class="btn btn-light text-right" href="{{ url('/') }}">
                                صفحه اصلی سایت</a>

                            <a class="btn btn-light text-right" href="{{ route('updateprofile') }}" onclick="event.preventDefault();
                                            document.getElementById('update-form').submit();">
                                ویرایش پروفایل
                            </a>


                            <a class="btn btn-light text-right" href="{{ route('userOrders') }}">تخفیف های من</a>

                            <a class="btn btn-light text-right" href="{{ route('userTransactions') }}">تراکنش های
                                من</a>

                            <a class="btn btn-light text-right" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                خروج
                            </a>

                        </ul>
                    </div>
                </div>

            </div>
