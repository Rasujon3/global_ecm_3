@if(count($homeCategories) > 0)
    @foreach($homeCategories as $category)
        <div class="product-wrapper-1 appear-animate mb-5">
            <div class="title-link-wrapper pb-1 mb-4">
                <h2 class="title ls-normal mb-0">{{$category->category_name}}</h2>
                <a href="{{ url('/product-lists?category_id='.$category->id) }}" class="font-size-normal font-weight-bold ls-25 mb-0">More Products<i class="w-icon-long-arrow-right"></i></a>
            </div>
            <div class="row">
                 <div class="col-lg-3 col-sm-4 mb-4 d-none">
                    <div class="banner h-100 br-sm" style="background-image: url(front/assets/images/demos/demo1/banners/2.jpg);
                        background-color: #ebeced;">
                        <div class="banner-content content-top">
                            <h5 class="banner-subtitle font-weight-normal mb-2">Weekend Sale</h5>
                            <hr class="banner-divider bg-dark mb-2">
                            <h3 class="banner-title font-weight-bolder ls-25 text-uppercase">
                                New Arrivals<br> <span
                                    class="font-weight-normal text-capitalize">Collection</span>
                            </h3>
                            <a href="#"
                                class="btn btn-dark btn-outline btn-rounded btn-sm">shop Now</a>
                        </div>
                    </div>
                </div>
                <!-- End of Banner -->
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
                                        <a href="#"
                                           class="btn-product-icon btn-cart add-to-cart"
                                           title="Add to cart"
                                           data-id="{{ $product->id }}">
                                            <i class="w-icon-cart"></i>
                                        </a>
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
        </div>
    @endforeach
@endif

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
</style>
