<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container-fluid">
        {{-- <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a> --}}
        <a class="navbar-brand" href="{{ url('/') }}">
            FinalProject
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse  text-center" id="navbarSupportedContent">

            <select class="ml-auto mr-5" id="mySelect" onchange="myFunction()">
                <option class="btn btn-light" value=""> انتخاب شهر</option>
                <option value="{{ route('showProductsByCity', 'تهران') }}">تهران</option>
                <option value="{{ route('showProductsByCity', 'تبریز') }}">تبریز</option>
                <option value="{{ route('showProductsByCity', 'بندرعباس') }}">بندرعباس</option>
                <option value="{{ route('showProductsByCity', 'شیراز') }}">شیراز</option>
            </select>

            <ul class="navbar-nav mr-auto ">

                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">ورود</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">ثبت نام</a>
                        </li>


                        <li class="nav-item dropdown">
                            <a href="#" id="navbarDropdown2" class="nav-link dropdown-toggle" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                کسب و کار من
                            </a>

                            <div class="dropdown-menu left" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item text-right" href="{{ url('/panel/register') }}">
                                    ثبت نام
                                </a>

                                <a class="dropdown-item text-right" href="{{ route('login') }}">
                                    ورود
                                </a>


                            </div>

                        </li>

                    @endif

                @else
                    <li class="nav-item dropdown">
                        <a href="#" id="navbarDropdown" class="nav-link dropdown-toggle" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu left" aria-labelledby="navbarDropdown">


                            @can('isMerchant')
                                <a class="dropdown-item text-right pr-0" href="{{ asset('/merchant/panel/editprofile') }}">
                                    پنل کسب و کار
                                </a>
                            @endcan

                            @can('isAdmin')
                                <a class="dropdown-item text-right pr-0" href="{{ asset('/back/dashboard') }}">
                                    پنل مدیر سایت
                                </a>
                            @endcan

                            @can('isCustomer')
                                <a class="dropdown-item text-right pr-0" href="{{ route('profile') }}"
                                    onclick="event.preventDefault();  document.getElementById('update-form').submit();">
                                    پنل کاربری
                                </a>
                            @endcan


                            <a class="dropdown-item text-right pr-0" href="{{ route('logout') }}"
                                onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                                خروج
                            </a>


                            <form id='update-form' action='{{ route('profile') }}' method="GET" class="d-none">
                                @csrf
                            </form>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                        </div>
                    </li>
                @endguest

            </ul>




            <div class="ml-md-5 pl-md-5 text-center" id="header-bar">
                @include('front.header_cart')
            </div>

        </div>
    </div>
</nav>




<script>
    $('select').on('change', function(e) {
        var route = $('option:selected', this).val();
        if (route) {
            location.href = route;
        }
    });

</script>
