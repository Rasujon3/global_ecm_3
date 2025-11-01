<div class="header-right ml-4">
    <div class="header-call d-xs-show d-lg-flex align-items-center">
        <a href="tel:#{{ setting()->phone ?? '' }}" class="w-icon-call"></a>
        <div class="call-info d-lg-show">
            <h4 class="chat font-weight-normal font-size-md text-normal ls-normal text-light mb-0">
                <a href="#" class="text-capitalize">Phone</a>
            </h4>
            <a href="tel:#{{ setting()->phone ?? '' }}" class="phone-number font-weight-bolder ls-50">
                {{ setting()->phone ?? '' }}
            </a>
        </div>
    </div>
    <a class="wishlist label-down link d-xs-show" href="{{url('/wishlists')}}">
        <i class="w-icon-heart"></i>
        <span class="wishlist-label d-lg-show">Wishlist</span>
    </a>

    <!-- Cart Dropdown Structure - Never replace this wrapper -->
    <div class="dropdown cart-dropdown cart-offcanvas mr-0 mr-lg-2">
        <div class="cart-overlay"></div>
        <a href="#" class="cart-toggle label-down link">
            <i class="w-icon-cart">
                <span class="cart-count" id="cart-count">{{ $countCart ?? 0 }}</span>
            </i>
            <span class="cart-label">Cart</span>
        </a>

        <!-- ONLY THIS INNER PART GETS REPLACED -->
        <div class="dropdown-box" id="akbar-cart-dropdown-box">
            @include('fronts.components.cart-dropdown-inner')
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        console.log('🏠 Home page cart scripts (Vanilla JS) loaded');

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

        // ============ REFRESH CART FUNCTION ============
        async function refreshCart() {
            try {
                const res = await fetch("{{ route('get.cart.html') }}");
                const data = await res.json();

                console.log('Cart refreshed:', data);
                if (data.status) {
                    document.querySelector('#akbar-cart-dropdown-box').innerHTML = data.html;
                    document.querySelectorAll('.cart-count').forEach(el => el.textContent = data.count);
                } else {
                    console.error('Cart update failed');
                }
            } catch (err) {
                console.error('Cart refresh error:', err);
            }
        }

        // ============ UPDATE CART QUANTITY ============
        window.updateCartQuantity = async function (cart_id, qty) {
            console.log('🔄 updateCartQuantity called:', cart_id, qty);
            try {
                const res = await fetch("{{ url('/cart-update-ajax') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken
                    },
                    body: JSON.stringify({ cart_id, qty })
                });

                const data = await res.json();
                console.log('✅ Cart updated:', data);

                if (data.status) {
                    document.querySelectorAll('#cart-count, .cart-count')
                        .forEach(el => el.textContent = data.cart_count);

                    if (data.cart_html) {
                        document.querySelector('#akbar-cart-dropdown-box').innerHTML = data.cart_html;
                    }
                } else {
                    toastr.error(data.message || 'Failed to update cart');
                }
            } catch (err) {
                console.error('❌ Error updating cart:', err);
                toastr.error('Failed to update cart quantity');
            }
        };

        // ============ EVENT DELEGATION FOR ALL CLICKS ============
        document.addEventListener('click', async (e) => {
            const target = e.target.closest('button, a, div, span');

            // ADD TO CART
            if (target?.classList.contains('add-to-cart')) {
                e.preventDefault();
                const product_id = target.dataset.id;
                console.log('➕ Adding product:', product_id);

                try {
                    const res = await fetch(`{{url('/add-to-cart')}}?use_for=product&element_id=${product_id}`);
                    const data = await res.json();

                    toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        positionClass: "toast-bottom-left",
                        timeOut: 3000
                    };

                    if (!data.status) {
                        toastr.error(data.message);
                    } else {
                        document.querySelectorAll('#cart-count, .cart-count')
                            .forEach(el => el.textContent = data.cart_count);

                        if (data.cart_html) {
                            document.querySelector('#akbar-cart-dropdown-box').innerHTML = data.cart_html;
                            console.log('🔄 Cart HTML updated');
                        }

                        document.querySelector('.cart-dropdown')?.classList.add('opened');
                        document.querySelector('.cart-overlay')?.classList.add('active');
                        document.body.classList.add('cart-opened');

                        toastr.success(data.message);
                    }
                } catch (err) {
                    console.error(err);
                    toastr.error('Failed to add to cart');
                }
            }

            // ADD TO WISHLIST
            if (target?.classList.contains('add-wishlist')) {
                e.preventDefault();
                const product_id = target.dataset.id;

                try {
                    const res = await fetch(`{{url('/add-wishlist')}}/${product_id}`);
                    const data = await res.json();

                    toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        positionClass: "toast-bottom-left",
                        timeOut: 3000
                    };

                    if (!data.status) toastr.error(data.message);
                    else toastr.success(data.message);
                } catch (err) {
                    console.error(err);
                    toastr.error('Failed to add wishlist');
                }
            }

            // QUANTITY PLUS
            if (target?.classList.contains('quantity-plus')) {
                console.log('➕ Quantity plus clicked');
                e.preventDefault();
                const productCart = target.closest('.product-cart');
                const cart_id = productCart?.dataset.cartId;
                const input = productCart?.querySelector('.quantity');

                if (!cart_id || !input) return;

                const newQty = parseInt(input.value || '1') + 1;
                input.value = newQty;
                window.updateCartQuantity(cart_id, newQty);
            }

            // QUANTITY MINUS
            if (target?.classList.contains('quantity-minus')) {
                console.log('➕ Quantity minus clicked');
                e.preventDefault();
                const productCart = target.closest('.product-cart');
                const cart_id = productCart?.dataset.cartId;
                const input = productCart?.querySelector('.quantity');

                if (!cart_id || !input) return;

                let newQty = parseInt(input.value || '1') - 1;
                if (newQty < 1) newQty = 1;
                input.value = newQty;
                window.updateCartQuantity(cart_id, newQty);
            }

            // REMOVE ITEM
            if (target?.classList.contains('remove-item')) {
                e.preventDefault();
                const productCart = target.closest('.product-cart');
                const cart_id = productCart?.dataset.cartId;
                if (!cart_id) return;

                if (confirm('Do you want to remove this item from cart?')) {
                    try {
                        productCart.style.opacity = '0.5';
                        const res = await fetch(`{{ url('/cart-delete') }}/${cart_id}`);
                        const data = await res.json();

                        if (data.status) {
                            document.querySelectorAll('#cart-count, .cart-count')
                                .forEach(el => el.textContent = data.cart_count);

                            if (data.cart_html) {
                                document.querySelector('#akbar-cart-dropdown-box').innerHTML = data.cart_html;
                            }
                            toastr.success(data.message || 'Item removed');
                        } else {
                            productCart.style.opacity = '1';
                            toastr.error(data.message || 'Failed to remove');
                        }
                    } catch (err) {
                        console.error(err);
                        productCart.style.opacity = '1';
                        toastr.error('Error removing item');
                    }
                }
            }
        });

        // ============ MANUAL QUANTITY CHANGE ============
        document.addEventListener('change', (e) => {
            if (e.target.classList.contains('quantity')) {
                const input = e.target;
                const productCart = input.closest('.product-cart');
                const cart_id = productCart?.dataset.cartId;

                if (!cart_id) return;

                let newQty = parseInt(input.value || '1');
                if (newQty < 1) newQty = 1;
                input.value = newQty;

                window.updateCartQuantity(cart_id, newQty);
            }
        });

        console.log('✅ All cart event handlers (vanilla JS) registered');
    });

    // Global error handler
    window.onerror = function (msg, url, lineNo, columnNo, error) {
        console.error('JavaScript Error:', msg, 'at', url, ':', lineNo);
        return false;
    };
</script>
