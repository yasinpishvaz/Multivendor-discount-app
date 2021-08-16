        <aside class="main-sidebar">
            
            <section class="sidebar">
                <div class="user-panel">
                    <div class="pull-right image">
                        <img src="{{ url('/back/dist/img/origAvatar.png') }}" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-right info">
                    <p> {{ Auth::user()->name }}</p>
                        <a href="#"><i class="fa fa-circle text-success"></i> آنلاین</a>
                    </div>
                </div>
 
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">منو</li>


                    <li>
                        <a href="{{ url('/') }}">
                            <i class="fa fa-th"></i> <span>   مشاهده صفحه اصلی سایت   </span>
                        </a>
                    </li>


                    <li>
                        <a href="{{ url('back/users/index') }}">
                            <i class="fa fa-th"></i> <span>   کاربران   </span>
                        </a>
                    </li>

                    
                    <li>
                        <a href="{{ url('back/products/Unapprovedproducts') }}">
                            <i class="fa fa-th"></i> <span> محصولات تایید نشده </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('back/products/index') }}">
                            <i class="fa fa-th"></i> <span> همه محصولات   </span>
                        </a>
                    </li>


                    <li>
                        <a href="{{ url('back/categories/index') }}">
                            <i class="fa fa-th"></i> <span> دسته ها و سرویس ها </span>
                        </a>
                    </li>


                    
                    <li>
                        <a href="{{ url('back/categories/create') }}">
                            <i class="fa fa-th"></i> <span>ایجاد دسته بندی جدید </span>
                        </a>
                    </li>


                    <li>
                        <a href="{{ url('back/services/create') }}">
                            <i class="fa fa-th"></i> <span>ایجاد سرویس جدید </span>
                        </a>
                    </li>



                    <li>
                        <a href="{{ url('back/transactions/index') }}">
                            <i class="fa fa-th"></i> <span>  تراکنش ها </span>
                        </a>
                    </li>


                    <li>
                        <a href="{{ url('back/orders/index') }}">
                            <i class="fa fa-th"></i> <span>  سفارش ها </span>
                        </a>
                    </li>



                </ul>
            </section>
        </aside>
