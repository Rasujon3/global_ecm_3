@extends('front_master')
@section('front_content')
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
<!-- Start of Main -->
        <main class="main wishlist-page">
            <!-- Start of Page Header -->
            <div class="page-header py-4">
                <div class="container d-flex align-items-center justify-content-center gap-3">
                    @if($headerLogo)
                        <img src="{{ URL::to($headerLogo) }}"
                             alt="{{ $headerTitle }}"
                             width="500" height="80"
                             class="me-3 rounded"
                             style="max-height: 150px !important;"
                        >
                    @endif

{{--                    <h1 class="page-title mb-0 fw-bold">{{ $headerTitle }}</h1>--}}
                </div>
            </div>
            <!-- End of Page Header -->

            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav mb-10">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li>Products</li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of PageContent -->
            <div class="page-content">
                <div class="container">
                  <div class="row cols-xl-5 cols-md-4 cols-sm-3 cols-2">
                  @foreach($products as $product)
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
                                                 class="btn-product-icon btn-cart add-cart"
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
                  <div style="margin-top: 5px; margin-bottom: 5px;">{{$products->links()}}</div>
                </div>
            </div>
            <!-- End of PageContent -->
        </main>
        <!-- End of Main -->
@endsection

@push('scripts')
    <script>
        let variant_id;
        let productvariant_ids = [];
        let base_url = "{{url('/')}}";

        $(document).ready(function(){
            $(document).on('click', '.select-variant', function(e){
                e.preventDefault();
                variant_id = $(this).data('id');
                $.ajax({

                    url: "{{url('/product-variant-details')}}/"+variant_id,

                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                        if(data.status == true){
                            $('#product_image').html(`
                    	<img src=${base_url}/${data.variant.image}
                            data-zoom-image=${base_url}/${data.variant.image}
                            alt=${data.variant.variant_value} height="900">
                        `);
                        }

                        productvariant_ids.push(variant_id);

                    },

                });

            });

            $(document).on('click', '.product-variation-clean', function(e){
                e.preventDefault();
                productvariant_ids = [];
            });

            function rebindCartEvents() {
                $(document).on('click', '.btn-close', function(e) {
                    e.preventDefault();
                    const target = $(this).data('target');

                    switch (target) {
                        case 'cart':
                            $('.cart-dropdown').removeClass('show');
                            $('.cart-overlay').removeClass('show');
                            break;
                    }
                });
            }

            function triggerCartToggle(loadContent = true) {
                try {
                    const cartToggle = document.querySelector('.cart-toggle');

                    if (!cartToggle) {
                        console.warn('Cart toggle element not found');
                        return false;
                    }

                    // Create and dispatch a real click event
                    const clickEvent = new MouseEvent('click', {
                        view: window,
                        bubbles: true,
                        cancelable: true
                    });

                    cartToggle.dispatchEvent(clickEvent);

                    // Optionally load cart content
                    if (loadContent && typeof window.loadCartContent === 'function') {
                        window.loadCartContent();
                    }

                    return true;
                } catch (error) {
                    console.error('Error triggering cart toggle:', error);
                    return false;
                }
            }

            $(document).on('click', '.add-cart', function(e){
                e.preventDefault();
                let product_id = $(this).data('id');
                //alert(product_id);
                let use_for = "product";
                let qty = $('.quantity').val();
                let redirectUrl = base_url+"/carts";
                $.ajax({

                    url: "{{url('/add-to-cart')}}",

                    type:"GET",
                    data:{'element_id':product_id,'productvariant_ids':productvariant_ids,'use_for':use_for,'qty':qty},
                    dataType:"json",
                    success:function(data) {
                        if (data.status == true) {

                            // update cart count in header
                            $('.cart-count').text(data.cart_count);

                            // replace dropdown-box content
                            if (data.cart_html) {
                                $('#cart-dropdown-box').html($(data.cart_html).find('#cart-dropdown-box').html());
                                // if you want to ensure the new HTML has id #cart-dropdown-box:
                                // $('#cart-dropdown-box').html(data.cart_html);
                                rebindCartEvents(); // rebind events for new content
                                triggerCartToggle();
                            }

                            toastr.success(data.message);
                            // setTimeout(function() {
                            //     window.location.href = redirectUrl;
                            // }, 1000);
                        } else {
                            toastr.error(data.message);
                        }
                    },

                });

            });
        });
    </script>
@endpush
