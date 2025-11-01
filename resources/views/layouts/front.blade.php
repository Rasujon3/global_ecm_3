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

            // ============ QUANTITY INCREASE ============
            $(document).on('click', '.quantity-plus', function(e) {
                e.preventDefault();
                e.stopPropagation();
                console.log('➕ Plus clicked');

                let $input = $(this).siblings('.quantity');
                let $cartItem = $(this).closest('.product-cart');
                let cart_id = $cartItem.data('cart-id');

                console.log('Cart item:', $cartItem);
                console.log('Cart ID:', cart_id);

                if (!cart_id) {
                    console.error('❌ Cart ID not found!');
                    return;
                }

                let currentQty = parseInt($input.val()) || 1;
                let newQty = currentQty + 1;

                console.log('Current:', currentQty, 'New:', newQty);

                // Update input value
                $input.val(newQty);

                // Call update function
                window.updateCartQuantity(cart_id, newQty);
            });

            // ============ QUANTITY DECREASE ============
            $(document).on('click', '.quantity-minus', function(e) {
                e.preventDefault();
                e.stopPropagation();
                console.log('➖ Minus clicked');

                let $input = $(this).siblings('.quantity');
                let $cartItem = $(this).closest('.product-cart');
                let cart_id = $cartItem.data('cart-id');

                if (!cart_id) {
                    console.error('❌ Cart ID not found!');
                    return;
                }

                let currentQty = parseInt($input.val()) || 1;
                let newQty = currentQty - 1;

                if (newQty < 1) {
                    newQty = 1;
                }

                console.log('Current:', currentQty, 'New:', newQty);

                // Update input value
                $input.val(newQty);

                // Call update function
                window.updateCartQuantity(cart_id, newQty);
            });

            // ============ MANUAL QUANTITY INPUT ============
            $(document).on('change', '.quantity', function(e) {
                console.log('✏️ Input changed');

                let $input = $(this);
                let $cartItem = $(this).closest('.product-cart');
                let cart_id = $cartItem.data('cart-id');

                if (!cart_id) {
                    console.error('❌ Cart ID not found!');
                    return;
                }

                let newQty = parseInt($input.val()) || 1;

                if (newQty < 1) {
                    newQty = 1;
                    $input.val(newQty);
                }

                console.log('Manual change to:', newQty);

                // Call update function
                window.updateCartQuantity(cart_id, newQty);
            });

            // ============ REMOVE CART ITEM ============
            $(document).on('click', '.remove-item', function(e) {
                e.preventDefault();
                e.stopPropagation();
                console.log('🗑️ Remove clicked');

                let $cartItem = $(this).closest('.product-cart');
                let cart_id = $cartItem.data('cart-id');

                console.log('Removing cart ID:', cart_id);

                if (!cart_id) {
                    console.error('❌ Cart ID not found!');
                    return;
                }

                if (confirm('Do you want to remove this item from cart?')) {
                    $.ajax({
                        url: "{{ url('/cart-delete') }}/" + cart_id,
                        type: "GET",
                        dataType: "json",
                        beforeSend: function() {
                            $cartItem.css('opacity', '0.5');
                            console.log('⏳ Removing...');
                        },
                        success: function(data) {
                            console.log('✅ Remove response:', data);

                            if (data.status) {
                                // Update cart count
                                $('#cart-count').text(data.cart_count);
                                $('.cart-count').text(data.cart_count);

                                // Update cart content
                                if (data.cart_html) {
                                    $('#akbar-cart-dropdown-box').html(data.cart_html);
                                }

                                toastr.success(data.message || 'Item removed from cart');
                            } else {
                                toastr.error(data.message || 'Failed to remove item');
                                $cartItem.css('opacity', '1');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('❌ Error:', error);
                            $cartItem.css('opacity', '1');
                            toastr.error('Failed to remove item from cart');
                        }
                    });
                }
            });

            console.log('✅ All cart event handlers registered');
        });

        // Error handler
        window.onerror = function(msg, url, lineNo, columnNo, error) {
            console.error('JavaScript Error:', msg, 'at', url, ':', lineNo);
            return false;
        };
    </script>
@endpush
