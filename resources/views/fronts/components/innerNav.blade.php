<div class="header-bottom sticky-content fix-top sticky-header has-dropdown">
    <div class="container">
        <div class="inner-wrap">
            <div class="header-left">
                @if(Route::currentRouteName() == 'home')
                    <div class="dropdown category-dropdown has-border" data-visible="true">
                        <a href="#" class="category-toggle text-dark" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="true" data-display="static"
                           title="Browse Categories">
                            <i class="w-icon-category"></i>
                            <span>Browse Categories</span>
                        </a>

                        <div class="dropdown-box">
                            <ul class="menu vertical-menu category-menu">
                                @if(isset($menuCategories))
                                    @foreach($menuCategories as $menuCategory)
                                        @if(count($menuCategory->subcategories) > 0)
                                            <li>
                                                <a href="{{ url('/product-lists?category_id='.$menuCategory->id) }}">
                                                    <i class="w-icon-list"></i>{{$menuCategory->category_name}}
                                                </a>
                                                <ul class="megamenu">
                                                    @foreach($menuCategory->subcategories as $subcatgory)
                                                        <li>
                                                            <a href="{{ url('/product-lists?category_id='.$menuCategory->id) }}">
                                                                <h4 class="menu-title">{{$subcatgory->subcategory_name}}</h4>
                                                            </a>
                                                            <hr class="divider">
                                                            <ul>
                                                                @foreach($subcatgory->products as $product)
                                                                    <li>
                                                                        <a href="{{url('/product-details/'.$product->id)}}">
                                                                            {{$product->product_name}}
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{url('/product-lists?category_id='.$menuCategory->id)}}">
                                                    <i class="w-icon-list"></i>{{$menuCategory->category_name}}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                @endif

                                <li class="d-none">
                                    <a href="#"
                                       class="font-weight-bold text-primary text-uppercase ls-25">
                                        View All Categories<i class="w-icon-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                @else
                    <div class="dropdown category-dropdown has-border" data-visible="true">
                        <a href="#" class="category-toggle text-dark" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="true" data-display="static"
                           title="Browse Categories">
                            <i class="w-icon-category"></i>
                            <span>Browse Categories</span>
                        </a>

                        <div class="dropdown-box" style="display:none;">
                            <ul class="menu vertical-menu category-menu">
                                @if(isset($menuCategories))
                                    @foreach($menuCategories as $menuCategory)
                                        @if(count($menuCategory->subcategories) > 0)
                                            <li>

                                                <a href="{{url('/product-lists?category_id='.$menuCategory->id)}}">
                                                    <i class="w-icon-list"></i>{{$menuCategory->category_name}}
                                                </a>
                                                <ul class="megamenu">
                                                    @foreach($menuCategory->subcategories as $subcatgory)
                                                        <li>
                                                            <a href="{{ url('/product-lists?category_id='.$menuCategory->id) }}">
                                                                <h4 class="menu-title">{{$subcatgory->subcategory_name}}</h4>
                                                            </a>
                                                            <hr class="divider">
                                                            <ul>
                                                                @foreach($subcatgory->products as $product)
                                                                    <li><a href="{{url('/product-details/'.$product->id)}}">{{$product->product_name}}</a>
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{url('/product-lists?category_id='.$menuCategory->id)}}">
                                                    <i class="w-icon-list"></i>{{$menuCategory->category_name}}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                @endif

                                <li class="d-none">
                                    <a href="#"
                                       class="font-weight-bold text-primary text-uppercase ls-25">
                                        View All Categories<i class="w-icon-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                @endif
                <nav class="main-nav">
                    <ul class="menu active-underline">
                        <li class="{{ Request::is('/') ? 'active' : '' }}">
                            <a href="{{url('/')}}">Home</a>
                        </li>
                        <li>
                            <a href="#">Brand</a>

                            <!-- Start of Megamenu -->
                            <ul class="megamenu">
                                @if(isset($menuBrands))
                                    @foreach($menuBrands as $brand)
                                        <li>
                                            <a href="{{url('/product-lists?brand_id='.$brand->id)}}">
                                                <h4 class="menu-title">{{$brand->brand_name}}</h4>
                                            </a>
                                            <ul>
                                                @foreach($brand->products as $product)
                                                    <li><a href="{{url('/product-details/'.$product->id)}}">{{$product->product_name}}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                            <!-- End of Megamenu -->
                        </li>
                        <li class="{{ Request::is('about') ? 'active' : '' }}">
                            <a href="{{ route('about') }}">About Us</a>
                        </li>
                        <li class="{{ Request::is('contact') ? 'active' : '' }}">
                            <a href="{{ route('contact') }}">Contact Us</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="header-right d-none">
                <a href="#" class="d-xl-show"><i class="w-icon-map-marker mr-1"></i>Track Order</a>
                <a href="#"><i class="w-icon-sale"></i>Daily Deals</a>
            </div>
        </div>
    </div>
</div>
