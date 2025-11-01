@php
    use App\Models\Cart;
    $carts = Cart::with('product','productvariant', 'product.images')
                ->where('cart_session_id',Session::get('cart_session_id'))
                ->latest()
                ->get();

    $sum = Cart::where('cart_session_id',Session::get('cart_session_id'))
        ->sum('unit_total');
@endphp

<div class="dropdown cart-dropdown cart-offcanvas mr-0 mr-lg-2">
    <div class="cart-overlay"></div>
    <a href="#" class="cart-toggle label-down link">
        <i class="w-icon-cart">
            <span class="cart-count">{{ $countCart ?? 0 }}</span>
        </i>
        <span class="cart-label">Cart</span>
    </a>
    <div class="dropdown-box" id="akbar-cart-dropdown-box">
        <div class="cart-header">
            <span>Your Cart</span>
            <a href="#" class="btn-close">
                Close<i class="w-icon-long-arrow-right"></i>
            </a>
        </div>

        <div class="products">
            @forelse($carts as $cart)
            <div class="product product-cart">
                <figure class="product-media">
                    <a href="{{ url('/product-details/'.$cart->product->id) }}">
                        <img
                            src="{{ URL::to($cart->product->images[0]->image) }}"
                            alt="product"
                            height="84"
                            width="94"
                        />
                    </a>
                </figure>
                <div class="product-detail" id="product-detail-box">
                    <a href="{{ url('/product-details/'.$cart->product->id) }}" class="product-name">
                        {{ $cart->product->product_name }}
                    </a>
                    <div class="price-box">
                        <span class="product-quantity">Price: </span>
                        <span class="product-price">{{ discount($cart->product) }} BDT</span>
                    </div>
                    <div class="input-group" id="quantity-form-group">
                        <input
                            class="quantity form-control"
                            type="number"
                            min="1"
                            max="100000"
                        />
                        <button class="quantity-plus w-icon-plus"></button>
                        <button class="quantity-minus w-icon-minus"></button>
                    </div>
                </div>

{{--                <div class="discount">--}}
{{--                    <span>Save 20%</span>--}}
{{--                    <p>1000৳</p>--}}
{{--                </div>--}}

                <button
                    class="btn btn-link btn-close"
                    aria-label="button"
                >
                    <i class="fas fa-times"></i>
                </button>
            </div>
            @empty
                <p class="text-center py-3">No products in cart</p>
            @endforelse
        </div>

        <div class="cart-total">
            <label>Subtotal:</label>
            <span class="price">{{ $sum }} BDT</span>
        </div>

{{--        <div class="cart-all-total">--}}
{{--            <label>total:</label>--}}
{{--            <span class="price">1150৳</span>--}}
{{--        </div>--}}
{{--        <div>--}}
{{--                    <span--}}
{{--                    >To find out your shipping cost , Please proceed to--}}
{{--                      checkout.</span--}}
{{--                    >--}}
{{--        </div>--}}
        <div class="cart-action">
            <a href="{{ url('/carts') }}" class="btn btn-dark btn-outline btn-rounded">
                View Cart
            </a>
            <a href="{{ url('/checkout') }}" class="btn btn-primary btn-rounded">
                Checkout
            </a>
        </div>
    </div>
    <!-- End of Dropdown Box -->
</div>

<style>
    #quantity-form-group {
        width: 50% !important;
    }
    #product-detail-box {
        padding-left: 5px !important;
    }
</style>

@push('scripts')

@endpush
