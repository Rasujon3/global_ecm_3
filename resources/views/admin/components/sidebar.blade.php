<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{URL::to('/dashboard')}}" class="brand-link">
        <img src="{{asset('back/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ setting()->shop_name ?? 'Glamours World' }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('back/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->name}}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="{{URL::to('/dashboard')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard

                        </p>
                    </a>

                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Categories
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('categories.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('categories.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Category</p>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Subcategories
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('subcategories.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add SubCategory</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('subcategories.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All SubCategory</p>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Brands
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('brands.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Brand</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('brands.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Brand</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Unit
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('units.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Unit</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('units.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Unit</p>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Variant
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('variants.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Variant</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('variants.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Variant</p>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Product
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('products.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Product</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('products.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Product</p>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Sliders
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('sliders.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Slider</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('sliders.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Slider</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Banners
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('banners.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Banner One</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('cosmetics.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Banner Two</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{route('newsletters.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                            Subscribers
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Delivery
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('delivery-charges') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Delivery Charges</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dc-bank-info') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Bank Info's</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('dc-bkash-info')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>BKash Info's</p>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Orders
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/order-lists')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Order Lists</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item {{ Request::is('password-change') ? 'menu-open' : '' }}">
                    <a href="{{ route('password-change') }}" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Password Change
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('intros') ? 'menu-open' : '' }}">
                    <a href="{{ route('intros.index') }}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Intro
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('settings') ? 'menu-open' : '' }}">
                    <a href="{{ route('settings') }}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Settings
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('about-us') ? 'menu-open' : '' }}">
                    <a href="{{ route('about-us') }}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            About Us
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
