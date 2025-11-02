<div id="cartModal" class="cart-modal" style="display: none;">
    <div class="cart-modal-overlay"></div>

    <div class="cart-modal-content">
        <div class="cart-modal-header">
            <h3>Your Cart</h3>
            <button class="close-cart-modal">
                Close <i class="w-icon-long-arrow-right"></i>
            </button>
        </div>

        <div class="cart-modal-body" id="cart-modal-body">
            {{-- Cart products will be loaded here --}}
            <div class="cart-loading" style="text-align:center; padding:20px;">
                <i class="fa fa-spinner fa-spin"></i> Loading cart...
            </div>
        </div>
    </div>
</div>

<style>
    .cart-modal {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: none;
    }

    .cart-modal-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.5);
    }

    .cart-modal-content {
        position: absolute;
        right: 0;
        top: 0;
        height: 100%;
        width: 420px;
        background: #fff;
        box-shadow: -2px 0 10px rgba(0,0,0,0.2);
        display: flex;
        flex-direction: column;
        border-radius: 8px 0 0 8px;
        transition: all 0.3s ease-in-out;
    }

    .cart-modal-header {
        padding: 1rem;
        border-bottom: 1px solid #ddd;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .cart-modal-body {
        flex: 1;
        overflow-y: auto;
        padding: 1rem;
    }

    .close-cart-modal {
        background: none;
        border: none;
        font-size: 1rem;
        cursor: pointer;
        color: #333;
        font-weight: 600;
    }

    /* 🔹 Mobile Responsive */
    @media (max-width: 768px) {
        .cart-modal-content {
            width: 100%;
            height: 100%;
            right: 0;
            border-radius: 0;
        }
        .cart-modal-header h3 {
            font-size: 1.1rem;
        }
        .cart-modal-body {
            padding: 0.75rem;
        }
    }
</style>

<script>

    document.addEventListener("DOMContentLoaded", () => {

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

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

        // ✅ Recalculate subtotal (client-side fallback)
        function cartCal() {
            let total = 0;
            document.querySelectorAll('.unit-total').forEach(el => {
                total += parseFloat(el.textContent) || 0;
            });
            const subtotalEl = document.querySelector('#cartSubtotal');
            if (subtotalEl) subtotalEl.textContent = total.toFixed(2);
        }

        // ✅ Update cart on backend (and update UI if success)
        async function updateCart(cart_id, qty) {
            try {
                const res = await fetch(`{{ route('cart.update.ajax') }}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken
                    },
                    body: JSON.stringify({ cart_id, qty })
                });
                const data = await res.json();

                if (data.status) {
                    triggerCartToggle();

                    // 🧾 Update header cart count
                    document.querySelectorAll('.cart-count')
                        .forEach(el => el.textContent = data.cart_count);

                    // 💰 Update subtotal
                    if (data.cart_sum) {
                        const subtotalEl = document.querySelector('#cartSubtotal');
                        if (subtotalEl) subtotalEl.textContent = parseFloat(data.cart_sum).toFixed(2);
                    }

                    // 🧩 Optional: Replace inner HTML (if full refresh needed)
                    if (data.cart_html && !document.querySelector(`#cart_input_${cart_id}`)) {
                        document.querySelector('#cart-modal-body').innerHTML = data.cart_html;
                    }

                    toastr.success(data.message || "Cart updated successfully");
                } else {
                    triggerCartToggle();
                    toastr.error(data.message || "Failed to update cart");
                }
            } catch (err) {
                triggerCartToggle();
                console.error("❌ Error updating cart:", err);
                toastr.error("Server error while updating cart");
            }
        }

        // ✅ Remove item from cart
        async function removeCartItem(cart_id, rowEl) {
            if (!confirm("Do you want to delete this?")) return;
            try {
                const res = await fetch(`{{ url('/cart-delete') }}/${cart_id}`);
                const data = await res.json();

                if (data.status) {
                    // Fade out before removing
                    if (rowEl) {
                        rowEl.style.opacity = '0.3';
                        setTimeout(() => rowEl.remove(), 200);
                    }

                    document.querySelectorAll('.cart-count')
                        .forEach(el => el.textContent = data.cart_count);

                    if (data.cart_sum) {
                        const subtotalEl = document.querySelector('#cartSubtotal');
                        if (subtotalEl) subtotalEl.textContent = parseFloat(data.cart_sum).toFixed(2);
                    }

                    triggerCartToggle();

                    toastr.success(data.message || "Item removed");
                } else {
                    triggerCartToggle();
                    toastr.error(data.message || "Failed to remove item");
                }
            } catch (err) {
                triggerCartToggle();
                console.error("❌ Error removing cart:", err);
                toastr.error("Server error while removing item");
            }
        }

        // ✅ Event Delegation (for all cart actions)
        document.addEventListener("click", async (e) => {
            const incBtn = e.target.closest(".quantity-inc");
            const decBtn = e.target.closest(".quantity-dc");
            const rmvBtn = e.target.closest(".remove-cart");

            // 🔼 Increase Quantity
            if (incBtn) {
                e.preventDefault();
                const cart_id = incBtn.dataset.id;
                const input = document.querySelector(`#cart_input_${cart_id}`);
                const priceEl = document.querySelector(`#product_price_${cart_id}`);
                const totalEl = document.querySelector(`#unit_total_${cart_id}`);

                let qty = parseInt(input.value) || 1;
                qty += 1;
                input.value = qty;

                const unitPrice = parseFloat(priceEl.textContent);
                const total = unitPrice * qty;
                totalEl.textContent = total.toFixed(2);

                cartCal();
                await updateCart(cart_id, qty);
            }

            // 🔽 Decrease Quantity
            if (decBtn) {
                e.preventDefault();
                const cart_id = decBtn.dataset.id;
                const input = document.querySelector(`#cart_input_${cart_id}`);
                const priceEl = document.querySelector(`#product_price_${cart_id}`);
                const totalEl = document.querySelector(`#unit_total_${cart_id}`);

                let qty = parseInt(input.value) || 1;
                if (qty > 1) qty -= 1;
                // if (qty === 1) return false;
                input.value = qty;

                const unitPrice = parseFloat(priceEl.textContent);
                const total = unitPrice * qty;
                totalEl.textContent = total.toFixed(2);

                cartCal();
                await updateCart(cart_id, qty);
            }

            // 🗑️ Remove Item
            if (rmvBtn) {
                e.preventDefault();
                const cart_id = rmvBtn.dataset.id;
                const row = rmvBtn.closest(".cart-item-row") || document.querySelector(`#cart_${cart_id}`);
                removeCartItem(cart_id, row);
            }
        });

        // ✅ Handle manual quantity input
        document.addEventListener("input", (e) => {
            if (e.target.classList.contains("cart_input")) {
                const cart_id = e.target.dataset.id;
                const qty = parseInt(e.target.value) || 1;
                const priceEl = document.querySelector(`#product_price_${cart_id}`);
                const totalEl = document.querySelector(`#unit_total_${cart_id}`);

                const unitPrice = parseFloat(priceEl.textContent);
                totalEl.textContent = (unitPrice * qty).toFixed(2);

                cartCal();
                updateCart(cart_id, qty);
            }
        });
    });
</script>


