<header class="header-v2">
    <!-- Header desktop -->
    <div class="container-menu-desktop trans-03">
        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop p-l-45">
                <!-- Logo desktop -->
                <a href="{{ route('page.home') }}" class="logo">
                    <img src="{{ asset('page/images/icons/logo.webp') }}" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">

                        <li class="{{ request()->is('san-pham/*')  ? 'active-menu' : '' }}">
                            <a href="{{ route('page.home') }}">
                                Trang chủ
                            </a>
                        </li>
                        <li class="{{ request()->is('khuyen-mai.html')  ? 'active-menu' : '' }} label1" data-label1=hot>
                            <a href="{{ route('page.product.sale') }}">
                                Khuyến mãi
                            </a>
                        </li>
                        <li class="{{ request()->is('san-pham-moi.html')  ? 'active-menu' : '' }}">
                            <a href="{{ route('page.product') }}">
                                Sản Phẩm Mới
                            </a>
                        </li>
                        @if (isset($categories))
                            @foreach($categories as $key => $category)
                                <li class="{{ request()->is('danh-muc/'. $category->id .'/'.$category->c_slug. '.html') ? 'active-menu' : '' }} {{ isset($category->c_hot) && $category->c_hot == 1 ? 'label1' : ''  }}"
                                    {{ isset($category->c_hot) && $category->c_hot == 1 ? 'data-label1=hot' : ''  }}>
                                    <a href="{{ route('page.category.index', ['id' => $category->id, 'slug' => $category->c_slug]) }}">{{ $category->c_name }}</a>
                                    @if (count($category->children) > 0)
                                        <ul class="sub-menu">
                                            @foreach($category->children as $sub)
                                                <li><a href="{{ route('page.category.index', ['id' => $sub->id, 'slug' => $sub->c_slug]) }}">{{ $sub->c_name }}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        @endif
                        {{--<li class="{{ request()->is('san-pham/*') || request()->is('san-pham.html')  ? 'active-menu' : '' }}">--}}
                            {{--<a href="{{ route('page.product') }}">--}}
                                {{--Sản phẩm--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="{{ request()->is('chi-tiet/*') || request()->is('tin-tuc.html') ? 'active-menu' : '' }}">--}}
                            {{--<a href="{{ route('page.news') }}">Tin tức</a>--}}
                        {{--</li>--}}
                        {{--<li class="{{ request()->is('lien-he.html') ? 'active-menu' : '' }}">--}}
                            {{--<a href="{{ route('page.contact') }}">Liên hệ</a>--}}
                        {{--</li>--}}
                        {{--<li class="{{ request()->is('gioi-thieu.html') ? 'active-menu' : '' }}">--}}
                            {{--<a href="{{ route('page.about') }}">Giới thiệu</a>--}}
                        {{--</li>--}}

                    </ul>
                </div>
                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m h-full">
                    <div class="flex-c-m h-full p-r-24">
                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 js-show-modal-search search-product">
                            <i class="zmdi zmdi-search"></i>
                        </div>
                    </div>

                    <div class="flex-c-m h-full p-l-18 p-r-25 bor5">
                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11">
                            <ul class="main-menu">
                                <li class="">
                                    <a href="{{ route('page.user.account') }}"><i class="icon-header-item zmdi zmdi-account-circle zmd-fw"></i></a>
                                    @if(Auth::guard('users')->check())
                                        <ul class="sub-menu">
                                            <li><a href="{{ route('info.account') }}">Thông tin tài khoản</a></li>
                                            <li><a href="{{ route('page.user.logout') }}">Đăng xuất</a></li>
                                        </ul>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="flex-c-m h-full p-l-18 p-r-25 bor5">
                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 icon-header-noti {{ Auth::guard('users')->check() ? 'js-show-cart' : '' }}"
                             data-notify="{{ isset($qty) && Auth::guard('users')->check() ? $qty : 0 }}" url ="{{ route('quick.view.cart') }}">
                            <i class="zmdi zmdi-shopping-cart"></i>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile">
            <a href="{{ route('page.home') }}" class="logo">
                <img src="{{ asset('page/images/icons/logo.png') }}" alt="IMG-LOGO">
            </a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m h-full m-r-15">
            <div class="flex-c-m h-full p-r-10">
                <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 js-show-modal-search">
                    <i class="zmdi zmdi-search"></i>
                </div>
            </div>
            <div class="flex-c-m h-full p-lr-10 bor5">
                <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart"
                     data-notify="{{ isset($qty) ? $qty : 0 }}" url ="{{ route('quick.view.cart') }}">
                    <i class="zmdi zmdi-shopping-cart"></i>
                </div>
            </div>
        </div>
        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
            <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>
    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="main-menu-m">
            @if (isset($categories))
                @foreach($categories as $key => $category)
                    <li>
                        <a href="{{ route('page.category.index', ['id' => $category->id, 'slug' => $category->c_slug]) }}">{{ $category->c_name }}</a>
                        @if (count($category->children) > 0)
                            <ul class="sub-menu">
                                @foreach($category->children as $sub)
                                    <li><a href="{{ route('page.category.index', ['id' => $sub->id, 'slug' => $sub->c_slug]) }}">{{ $sub->c_name }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            @endif
            {{--<li>--}}
                {{--<a href="{{ route('page.product') }}">--}}
                    {{--Sản phẩm--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="{{ route('page.news') }}">Tin tức</a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="{{ route('page.contact') }}">Liên hệ</a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="{{ route('page.about') }}">Giới thiệu</a>--}}
            {{--</li>--}}
            <li>
                <a href="{{ route('page.user.account') }}">Tài khoản</a>
            </li>
        </ul>
    </div>
    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="{{ asset('page/images/icons/icon-close2.png') }}" alt="CLOSE">
            </button>
            <form class="wrap-search-header flex-w p-l-15 form-search" action="{{ route('page.product') }}">
                <button class="flex-c-m trans-04" type="submit">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="search" placeholder="Tìm kiếm">
            </form>
        </div>
    </div>
</header>
