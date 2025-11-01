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
            console.log('🏠 Home page cart scripts loaded');

            // ============ REFRESH CART FUNCTION ============
            function refreshCart() {
                $.ajax({
                    url: "{{ route('get.cart.html') }}",
                    type: "GET",
                    success: function(res) {
                        console.log('Cart refreshed:', res);
                        if (res.status) {
                            $('#akbar-cart-dropdown-box').html(res.html);
                            $('.cart-count').text(res.count);
                        } else {
                            console.error('Cart update failed');
                        }
                    },
                    error: function(err) {
                        console.error('Cart refresh error:', err);
                    }
                });
            }

            // ============ UPDATE CART QUANTITY - MAKE IT GLOBAL ============
            window.updateCartQuantity = function(cart_id, qty) {
                console.log('🔄 updateCartQuantity called:', cart_id, qty);

                $.ajax({
                    url: "{{ url('/cart-update-ajax') }}",
                    type: "POST",
                    data: {
                        cart_id: cart_id,
                        qty: qty,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: "json",
                    beforeSend: function() {
                        console.log('⏳ Updating cart...');
                    },
                    success: function(data) {
                        console.log('✅ Cart updated:', data);

                        if (data.status) {
                            // Update cart count
                            $('#cart-count').text(data.cart_count);
                            $('.cart-count').text(data.cart_count);

                            // Update cart content
                            if (data.cart_html) {
                                $('#akbar-cart-dropdown-box').html(data.cart_html);
                            }
                        } else {
                            toastr.error(data.message || 'Failed to update cart');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('❌ Error updating cart:', error);
                        console.error('Response:', xhr.responseText);
                        toastr.error('Failed to update cart quantity');
                    }
                });
            };

            // ============ ADD TO CART ============
            $(document).on('click', '.add-to-cart', function(e) {
                e.preventDefault();
                let product_id = $(this).data('id');
                console.log('➕ Adding product:', product_id);

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
                                console.log('🔄 Cart HTML updated');
                            }

                            // Open cart
                            $('.cart-dropdown').addClass('opened');
                            $('.cart-overlay').addClass('active');
                            $('body').addClass('cart-opened');

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
