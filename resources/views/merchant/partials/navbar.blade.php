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

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav mr-auto">

                <li class="nav-item dropdown">
                    <a href="#" id="navbarDropdown" class="nav-link dropdown-toggle ml-5" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu left" aria-labelledby="navbarDropdown">


                        <a class="dropdown-item text-right pr-0" href="{{ url('merchant/panel/editprofile') }}""
                                        onclick=" event.preventDefault();
                            document.getElementById('update-form').submit();">
                            ویرایش پروفایل
                        </a>


                        <a class="dropdown-item text-right pr-0" href="{{ route('logout') }}"
                            onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                            خروج
                        </a>


                        <form id='update-form' action='{{ url('merchant/panel/editprofile') }}' method="GET"
                            class="d-none">
                            @csrf
                        </form>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                    </div>
                </li>

            </ul>

        </div>
    </div>
</nav>
