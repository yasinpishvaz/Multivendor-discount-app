<nav class="nav nabar-light bg-white shadow-sm">
    <div class="container-fluid">
        <ul id="topmenu" class="topmenu navbar">
            <li class="topmenu_parent topmenu_li"><a href="/"><i class="fa fa-bars" aria-hidden="true"></i> همه دسته
                    بندی ها</a>

                <ul class="topmenu_child">
                    @foreach ($categoryList as $category)
                        <li class="topmenu_parent topmenu_li"><a
                                href="{{ route('showProductsByCategory', [$location = 'tehran',$category->slug]) }}">{{ $category->title }}
                                <span class="expand">></span></a>
                            <ul class="topmenu_child">
                                @foreach ($category->childs as $child)

                                    <li class="topmenu_li"><a
                                            href="{{ route('showProductsByChildCategory', [$location = 'tehran',$category->slug, $child->slug]) }}">{{ $child->title }}
                                        </a></li>

                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>

            </li>


        </ul>
    </div>
</nav>
