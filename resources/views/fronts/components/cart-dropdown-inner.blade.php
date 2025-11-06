@php
    use App\Models\Cart;
    $cartSession = Session::get('cart_session_id');
    $carts = Cart::with('product','productvariant','product.images')
                ->where('cart_session_id', $cartSession)
                ->latest()
                ->get();

    $sum = Cart::where('cart_session_id', $cartSession)->sum('unit_total');
@endphp

<div class="cart-products">
    @forelse($carts as $cart)
        <div class="product product-cart cart-item-row" id="cart_{{ $cart->id }}" data-cart-id="{{ $cart->id }}">
            <figure class="cart-product-media">
                <a href="{{ url('/product-details/'.$cart->product->id) }}">
                    <img
                        src="{{ URL::to($cart->product->images[0]->image ?? 'frontend/images/placeholder.png') }}"
                        alt="product"
                        height="84"
                        width="94"
                    />
                </a>
            </figure>

            <div class="product-detail" id="product-detail-box">
                <a href="{{ url('/product-details/'.$cart->product->id) }}" class="product-name">
                    {{ $cart->product->product_name }}
                    @if(!empty($cart->variant_details))
                        <br>
                        @foreach($cart->variant_details as $variant)
                            <small class="text-muted">
                                {{ $variant->variant_name }}: {{ $variant->variant_value }}
                                @if(!$loop->last) | @endif
                            </small>
                        @endforeach
                    @endif
                </a>

                <div class="price-box">
                    <span class="product-quantity">Price: </span>
                    <span class="product-price" id="product_price_{{ $cart->id }}" style="padding-right: 5px;">
                        {{ $cart->unit_total }}</span> BDT
                </div>

                <div class="input-group" id="quantity-form-group">
                    <button class="quantity-dc w-icon-minus" type="button" data-id="{{ $cart->id }}"></button>

                    <input
                        id="cart_input_{{ $cart->id }}"
                        class="cart_input form-control"
                        type="number"
                        min="1"
                        max="100000"
                        value="{{ $cart->cart_qty }}"
                        data-id="{{ $cart->id }}"
                        readonly
                    />

                    <button class="quantity-inc w-icon-plus" type="button" data-id="{{ $cart->id }}"></button>
                    <button class="quantity-dc w-icon-minus" type="button" data-id="{{ $cart->id }}"></button>
                </div>

                <div class="subtotal-box mt-2" style="display: none !important;">
                    <span class="text-sm">Total: </span>
                    <span id="unit_total_{{ $cart->id }}" class="unit-total">{{ $cart->unit_total }}</span> BDT
                </div>
            </div>

            <button class="btn btn-link btn-close remove-cart" data-id="{{ $cart->id }}" aria-label="Remove item">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @empty
        <p class="text-center py-3 mb-0">Your cart is empty.</p>
    @endforelse
</div>

<div class="cart-total d-flex justify-content-between align-items-center border-top pt-2 mt-2">
    <label class="mb-0 fw-bold">Subtotal:</label>
    <span id="cartSubtotal" class="price fw-semibold">{{ number_format($sum, 2) }} BDT</span>
</div>

<div class="cart-action mt-3 d-flex gap-2">
    <a href="{{ url('/carts') }}" class="btn btn-dark btn-outline btn-rounded flex-fill">
        View Cart
    </a>
    <a href="{{ url('/checkout') }}" class="btn btn-primary btn-rounded flex-fill">
        Checkout
    </a>
</div>

<style>
    .cart-products {
        max-height: 350px;
        overflow-y: auto;
        padding-right: 5px;
    }

    .cart-item-row {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
    }

    .cart-product-media img {
        width: 70px;
        height: 70px;
        border-radius: 6px;
        object-fit: cover;
    }

    .product-detail {
        flex: 1;
        padding-left: 8px;
    }

    .product-name {
        display: block;
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
        font-size: 0.95rem;
    }

    .price-box {
        font-size: 0.9rem;
        margin-bottom: 8px;
    }

    .quantity-group {
        display: flex;
        align-items: center;
        justify-content: start;
        gap: 5px;
    }

    .quantity-group button {
        border: 1px solid #ccc;
        background: #f9f9f9;
        padding: 4px 8px;
        cursor: pointer;
        border-radius: 4px;
    }

    .quantity-group input {
        width: 50px;
        text-align: center;
        border: 1px solid #ccc;
        border-radius: 4px;
        height: 30px;
    }

    .remove-cart {
        color: #888;
        transition: 0.2s;
    }

    .remove-cart:hover {
        color: #ff4d4d;
    }

    .cart-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: 600;
        margin-top: 10px;
    }

    .cart-action {
        margin-top: 15px;
        display: flex;
        gap: 10px;
    }

    .cart-action a {
        flex: 1;
        text-align: center;
        padding: 8px 0;
        border-radius: 5px;
        font-weight: 600;
        font-size: 0.9rem;
    }
    #quantity-form-group {
        width: 50% !important;
    }

    /* ðŸ”¹ Mobile Responsive */
    @media (max-width: 768px) {
        .cart-item-row {
            flex-direction: column;
            align-items: flex-start;
        }

        .cart-product-media img {
            width: 100%;
            height: auto;
            max-height: 150px;
        }

        .product-detail {
            padding-left: 0;
            width: 100%;
        }

        .quantity-group {
            justify-content: flex-start;
        }

        .cart-total, .cart-action {
            flex-direction: column;
            align-items: stretch;
        }

        .cart-action a {
            width: 100%;
        }
        #quantity-form-group {
            width: 100% !important;
        }
    }
</style>
