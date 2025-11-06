<h2 class="title justify-content-center ls-normal mb-4 mt-10 pt-1 appear-animate">Featured Products</h2>

<div class="tab tab-nav-boxed tab-nav-outline appear-animate">
    <ul class="nav nav-tabs justify-content-center" role="tablist">
        @foreach($featuredCategories as $key=>$category)

            <li class="nav-item mr-2 mb-2">
                <a class="nav-link {{$key+1 == 1?'active':null}} br-sm font-size-md ls-normal" href="#tab1-{{categorySlug($category)}}">{{$category->category_name}}</a>
            </li>
        @endforeach
    </ul>
</div>

<!-- End of Tab -->
<div class="tab-content product-wrapper appear-animate">
    @foreach($featuredCategories as $key=>$category)
        <div class="tab-pane {{$key+1 == 1?'active':null}} pt-4" id="tab1-{{categorySlug($category)}}">
            <div class="row cols-xl-5 cols-md-4 cols-sm-3 cols-2">
                @foreach($category->products as $product)
                    <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <div class="product-label-group">
                                    <label class="product-label label-in" style="background-color: #e5757e !important;">
                                        {{ $product->tag ?? 'In Stock' }}
                                    </label>
                                    @if($product->stock_qty == 0)
                                        <label class="product-label label-out">Sold Out</label>
                                    @endif
                                </div>
                                <!-- Swiper Container -->
                                <div class="swiper-container product-swiper">
                                    <div class="swiper-wrapper">
                                        @if($product->images && count($product->images) > 0)
                                            @foreach($product->images as $image)
                                                <div class="swiper-slide">
                                                    <a href="{{ url('/product-details/'.$product->id) }}">
                                                        <img src="{{ URL::to($image->image) }}"
                                                             alt="{{ $product->product_name }}"
                                                             width="300" height="338">
                                                    </a>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="swiper-slide">
                                                <a href="{{ url('/product-details/'.$product->id) }}">
                                                    <img src="{{ URL::to(setting()->no_img) }}"
                                                         alt="Default Product Image"
                                                         width="300" height="338">
                                                </a>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Swiper Navigation Buttons -->
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                                <!-- End Swiper Container -->

                                <!-- Product Action Buttons (OUTSIDE Swiper) -->
                                <div class="product-action-vertical">
                                    @if (! $product->has_variants)
                                        <a href="#"
                                           class="btn-product-icon btn-cart add-to-cart"
                                           data-id="{{ $product->id }}"
                                           title="Add to cart">
                                            <i class="w-icon-cart"></i>
                                        </a>
                                    @else
                                        {{--  Detail page button (when variants exist)  --}}
                                        <a href="{{url('/product-details/'.$product->id)}}"
                                           class="btn-product-icon btn-view"
                                           title="View Details">
                                            <i class="w-icon-info"></i>   {{-- or any icon you prefer --}}
                                        </a>
                                    @endif
                                    <a href="#"
                                       class="btn-product-icon btn-wishlist add-wishlist"
                                       title="Add to wishlist"
                                       data-id="{{ $product->id }}">
                                        <i class="w-icon-heart"></i>
                                    </a>
                                </div>
                            </figure>

                            <div class="product-details">
                                <h4 class="product-name">
                                    <a href="{{URL::to('/product-details/'.$product->id)}}">
                                        {{$product->product_name}}
                                    </a>
                                </h4>
                                <div class="product-price">
                                    @if($product->discount > 0)
                                        <ins class="new-price">{{discount($product)}} BDT</ins>
                                        <del class="old-price">{{$product->product_price}} BDT</del>
                                    @else
                                        <ins class="new-price">{{$product->product_price}} BDT</ins>
                                    @endif
                                </div>
                                <div class="product-rating-details">
                                    @php
                                        $avg_rating = $product->reviews->avg('rating');
                                        $total_reviews = $product->reviews->count();
                                    @endphp
                                    <div class="ratings-container">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width: {{ $avg_rating * 20 }}%;"></span>
                                            <span class="tooltiptext tooltip-top">{{ number_format($avg_rating, 1) }}</span>
                                        </div>
                                        <a href="{{ URL::to('/product-details/'.$product->id) }}" class="rating-reviews scroll-to">({{ $total_reviews }} Reviews)</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
    <!-- End of Tab Pane -->
</div>
<!-- End of Tab Content -->

<style>
    /* Add this CSS */
    .product-media {
        position: relative;
    }

    .product-action-vertical {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 10; /* ✅ Swiper এর উপরে থাকবে */
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .swiper-container {
        position: relative;
        z-index: 1;
    }

    .btn-product-icon {
        width: 40px;
        height: 40px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .btn-product-icon:hover {
        background: #ff6b6b;
        color: white;
        transform: scale(1.1);
    }

    .product-label-group {
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 10;
    }

    .product-label {
        padding: 5px 10px;
        border-radius: 5px;
        color: #fff;
        font-size: 12px;
        font-weight: bold;
    }

    .label-in {
        background-color: #28a745;
    }

    .label-out {
        background-color: #dc3545;
    }
</style>
