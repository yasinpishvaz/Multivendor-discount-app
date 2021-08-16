        <header class="main-header">
     
            <a href="{{ url('back/dashboard') }}" class="logo">
          
                <span class="logo-mini">پنل</span>
    
                <span class="logo-lg"><b>کنترل پنل مدیریت</b></span>
            </a>
    
            <nav class="navbar navbar-static-top">
 
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ url('back/dist/img/origAvatar.png') }}" class="user-image"
                                    alt="User Image">
                                <span class="hidden-xs">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu">
                          
                                <li class="user-header">
                                    <img src="{{ url('/back/dist/img/origAvatar.png') }}" class="img-circle"
                                        alt="User Image">

                                    <p>
                                        {{ Auth::user()->name }}
                                        <small>مدیریت سایت</small>
                                    </p>
                                </li>
                               
                                <li class="user-footer">
                                    {{-- <div class="pull-right">
                                        <a href="#" class="btn btn-default btn-flat">پروفایل</a>
                                    </div> --}}
                                    <div class="text-center">
                                        <a href="{{ route('logout') }}" class="btn btn-default btn-flat"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">خروج</a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>

                                    </div>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>
