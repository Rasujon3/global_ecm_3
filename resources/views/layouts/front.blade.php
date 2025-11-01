@extends('front_master')
@section('front_content')
<div class="container">
                @include('fronts.components.intro')
                <!-- End of Iocn Box Wrapper -->

                @include('fronts.components.bannerOne')
                <!-- End of Category Banner Wrapper -->

{{--                @include('fronts.components.deals')--}}
            </div>

{{--            @include('fronts.components.topCat')--}}

            @include('fronts.components.arrivalProducts')
            @include('fronts.components.bestSellerProducts')

            <!-- End of .category-section top-category -->

            @include('fronts.components.featuredProducts')
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
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
            // ============ ADD TO CART ============
            $(document).on('click', '.add-to-cart', function(e) {
                e.preventDefault();
                let product_id = $(this).data('id');

                $.ajax({
                    url: "{{url('/add-to-cart')}}",
                    type: "GET",
                    data: {'use_for': 'product', 'element_id': product_id},
                    dataType: "json",
                    success: function(data) {
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true,
                            "positionClass": "toast-bottom-left",
                            "timeOut": "3000"
                        };

                        if (data.status == false) {
                            toastr.error(data.message);
                        } else {
                            // Update cart count
                            $('#cart-count').text(data.cart_count);
                            $('.cart-count').text(data.cart_count);

                            // Replace inner dropdown content
                            if (data.cart_html) {
                                $('#akbar-cart-dropdown-box').html(data.cart_html);
                            }

                            // Open cart
                            $('.cart-dropdown').addClass('opened');
                            $('.cart-overlay').addClass('active');
                            $('body').addClass('cart-opened');

                            triggerCartToggle();

                            toastr.success(data.message);
                        }
                    }
                });
            });

            // ============ ADD TO WISHLIST ============
            $(document).on('click', '.add-wishlist', function(e) {
                e.preventDefault();
                let product_id = $(this).data('id');

                $.ajax({
                    url: "{{url('/add-wishlist')}}/" + product_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true,
                            "positionClass": "toast-bottom-left",
                            "timeOut": "3000"
                        };

                        if (data.status == false) {
                            toastr.error(data.message);
                        } else {
                            toastr.success(data.message);
                        }
                    }
                });
            });
        });
    </script>
@endpush
