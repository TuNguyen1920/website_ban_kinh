<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link navbar-info">
        <img src="{!! asset('admin/dist/img/AdminLTELogo.png') !!}"
             alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Quản lý bán hàng</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        @php
            $user = Auth::user();
        @endphp
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('/admin/dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{!! $user->name !!}</a>
        </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                    <a href="{{ route('admin.home') }}" class="nav-link {{ isset($home_active) ? $home_active : '' }}">
                        <i class="nav-icon fas fa fa-home"></i>
                        <p>Bảng điều khiển</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('transaction.index') }}" class="nav-link {{ isset($transaction_active) ? $transaction_active : '' }}">
                        <i class="nav-icon fas fa-cart-plus"></i>
                        <p>Danh sách giao dịch</p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{ isset($data_product_active) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ isset($data_product_active) ? $data_product_active : '' }}">
                        <i class="nav-icon fas fa-database"></i>
                        <p>Sản phẩm<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('category.index') }}" class="nav-link {{ isset($category_active) ? $category_active : '' }}">
                                <i class="nav-icon fas fa-list" aria-hidden="true"></i>
                                <p>Danh mục</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('trademark.index') }}" class="nav-link {{ isset($trademark_active) ? $trademark_active : '' }}">
                                <i class="nav-icon fas fa-text-height" aria-hidden="true"></i>
                                <p>Nhà cung cấp</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('attribute.index') }}" class="nav-link {{ isset($attribute_active) ? $attribute_active : '' }}">
                                <i class="nav-icon fas fa-pencil-alt" aria-hidden="true"></i>
                                <p>Thuộc tính</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('value.index') }}" class="nav-link {{ isset($value_active) ? $value_active : '' }}">
                                <i class="nav-icon fas fa-pencil-alt" aria-hidden="true"></i>
                                <p>Giá trị</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('product.index') }}" class="nav-link {{ isset($product_active) ? $product_active : '' }}">
                                <i class="nav-icon fas fa-truck" aria-hidden="true"></i>
                                <p>Sản phẩm</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('article.index') }}" class="nav-link {{ isset($article_active) ? $article_active : '' }}">
                        <i class="nav-icon fas fa-file-word" aria-hidden="true"></i>
                        <p>Bài viết</p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{ isset($data_info_active) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ isset($data_info_active) ? $data_info_active : '' }}">
                        <i class="nav-icon fa fa-th-large"></i>
                        <p>Cấu hình website<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('slide.index') }}" class="nav-link {{ isset($slide_active) ? $slide_active : '' }}">
                                <i class="nav-icon fab fa-jsfiddle" aria-hidden="true"></i>
                                <p>Banner</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('event.index') }}" class="nav-link {{ isset($event_active) ? $event_active : '' }}">
                                <i class="nav-icon fab fa-dropbox" aria-hidden="true"></i>
                                <p>Sự kiện</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{--<li class="nav-item">--}}
                    {{--<a href="{{ route('group.permission.index') }}" class="nav-link {{ isset($group_permission) ? $group_permission : '' }}">--}}
                        {{--<i class="nav-icon fa fa-hourglass" aria-hidden="true"></i>--}}
                        {{--<p>Nhóm quyền</p>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li class="nav-item">--}}
                    {{--<a href="{{ route('permission.index') }}" class="nav-link {{ isset($permission_active) ? $permission_active : '' }}">--}}
                        {{--<i class="nav-icon fa fa-balance-scale"></i>--}}
                        {{--<p> Quyền </p>--}}
                    {{--</a>--}}
                {{--</li>--}}
                <li class="nav-item">
                    <a href="{{ route('role.index') }}" class="nav-link {{ isset($role_active) ? $role_active : '' }}">
                        <i class="nav-icon fa fa-gavel" aria-hidden="true"></i>
                        <p> Vai trò </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link {{ isset($user_active) ? $user_active : '' }}">
                        <i class="nav-icon fa fa-fw fa-user" aria-hidden="true"></i>
                        <p> Người dùng </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
