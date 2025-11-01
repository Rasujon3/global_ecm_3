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
{{--        <div class="dropdown-box" id="akbar-cart-dropdown-box">--}}
{{--            @include('fronts.components.cart-dropdown-inner')--}}
{{--        </div>--}}
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const cartToggle = document.querySelector('.cart-toggle');
        const cartModal = document.getElementById('cartModal');
        const cartModalBody = document.getElementById('cart-modal-body');

        if (!cartToggle || !cartModal) return;

        cartToggle.addEventListener('click', async (e) => {
            e.preventDefault();

            cartModal.style.display = 'block';
            cartModalBody.innerHTML = `
            <div class="cart-loading" style="text-align:center; padding:20px;">
                <i class="fa fa-spinner fa-spin"></i> Loading cart...
            </div>
        `;

            try {
                const res = await fetch(`{{ route('get.cart.modal') }}`);
                const data = await res.json();

                if (data.status) {
                    cartModalBody.innerHTML = data.html;
                } else {
                    cartModalBody.innerHTML = `<p style="text-align:center; color:red;">Failed to load cart.</p>`;
                }
            } catch (err) {
                console.error(err);
                cartModalBody.innerHTML = `<p style="text-align:center; color:red;">Error loading cart.</p>`;
            }
        });

        // Close modal
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('cart-modal-overlay') || e.target.classList.contains('close-cart-modal')) {
                cartModal.style.display = 'none';
            }
        });
    });
</script>

