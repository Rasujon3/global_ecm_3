@if(count($arrivalProducts) > 0)
    <section class="category-section top-category pt-10 pb-10 appear-animate">
        <div class="container pb-2">
            <div class="title-link-wrapper pb-1 mb-4 text-center">
                <h2 class="title w-100 justify-content-center pt-1 ls-normal mb-5">
                    New Arrival Products
                </h2>
            </div>

            <!-- Swiper Main Container -->
            <div class="swiper arrival-swiper">
                <div class="swiper-wrapper">
                    @foreach($arrivalProducts as $product)
                        <div class="swiper-slide">
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

                                        <!-- Product Images -->
                                        @if($product->images && count($product->images) > 0)
                                            <a href="{{ url('/product-details/'.$product->id) }}">
                                                <img src="{{ URL::to($product->images[0]->image) }}"
                                                     alt="{{ $product->product_name }}"
                                                     width="300" height="338">
                                            </a>
                                        @else
                                            <a href="{{ url('/product-details/'.$product->id) }}">
                                                <img src="{{ URL::to(setting()->no_img) }}"
                                                     alt="Default Product Image"
                                                     width="300" height="338">
                                            </a>
                                        @endif

                                        <!-- Action Buttons -->
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
                                            <a href="#" class="btn-product-icon btn-wishlist add-wishlist" data-id="{{ $product->id }}" title="Add to wishlist">
                                                <i class="w-icon-heart"></i>
                                            </a>
                                        </div>
                                    </figure>

                                    <div class="product-details">
                                        <h4 class="product-name">
                                            <a href="{{ url('/product-details/'.$product->id) }}">
                                                {{ $product->product_name }}
                                            </a>
                                        </h4>
                                        <div class="product-price">
                                            @if($product->discount > 0)
                                                <ins class="new-price">{{ discount($product) }} BDT</ins>
                                                <del class="old-price">{{ $product->product_price }} BDT</del>
                                            @else
                                                <ins class="new-price">{{ $product->product_price }} BDT</ins>
                                            @endif
                                        </div>
                                        <div class="ratings-container">
                                            @php
                                                $avgRating = round($product->reviews_avg_rating ?? 0, 1);
                                                $ratingCount = $product->reviews_count ?? 0;
                                            @endphp

                                            <div class="ratings-full" title="Rated {{ $avgRating }} out of 5">
                                                <span class="ratings" style="width: {{ ($avgRating / 5) * 100 }}%;"></span>
                                                <span class="tooltiptext tooltip-top">{{ $avgRating }} / 5</span>
                                            </div>
                                            <span class="rating-reviews">
                                                ({{ $ratingCount }} {{ Str::plural('review', $ratingCount) }})
                                            </span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Navigation & Pagination -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
@endif

<!-- ✅ SwiperJS CSS -->
{{--<link rel="stylesheet" href="{{ asset('front/assets/vendor/swiper/swiper-bundle.min.css') }}"/>--}}

<!-- ✅ SwiperJS Script -->
{{--<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>--}}

<script>
    document.addEventListener("DOMContentLoaded", function() {
        new Swiper(".arrival-swiper", {
            slidesPerView: 4,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                0: { slidesPerView: 2, spaceBetween: 10 },
                768: { slidesPerView: 3, spaceBetween: 15 },
                1024: { slidesPerView: 4, spaceBetween: 20 },
            },
        });
    });
</script>

<style>
    .product-wrap {
        padding: 10px;
    }
    .product-media {
        position: relative;
        overflow: hidden;
    }
    .product-action-vertical {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 10;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    .btn-product-icon {
        width: 38px;
        height: 38px;
        background: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    .btn-product-icon:hover {
        background: #ff6b6b;
        color: #fff;
        transform: scale(1.1);
    }
    .swiper {
        position: relative;
        padding-bottom: 40px;
    }
    .swiper-button-next,
    .swiper-button-prev {
        color: #333;
        transition: 0.3s;
    }
    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        color: #ff6b6b;
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
