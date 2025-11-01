<!-- Scrollable products -->
<div class="cart-content">
    <div class="products">
        @forelse($carts as $cart)
            <div class="product product-cart">
                <div class="product-detail">
                    <a href="{{ url('/product-details/'.$cart->product->id) }}" class="product-name">
                        {{ $cart->product->product_name }}
                    </a>
                    <div class="price-box">
                        <span class="product-quantity">{{ $cart->cart_qty }} </span>
                        <span class="product-price">{{ discount($cart->product) }} BDT</span>
                    </div>
                </div>
                <figure class="product-media">
                    <a href="{{ url('/product-details/'.$cart->product->id) }}">
                        <img src="{{ URL::to($cart->product->images[0]->image) }}" alt="product" height="84" width="94" />
                    </a>
                </figure>
            </div>
        @empty
            <p class="text-center py-3">No products in cart</p>
        @endforelse
    </div>
</div>

<!-- Fixed footer -->
<div class="cart-footer">
    <div class="cart-total">
        <label>Subtotal:</label>
        <span class="price">{{ $sum }} BDT</span>
    </div>
    <div class="cart-action">
        <a href="{{ url('/carts') }}" class="btn btn-dark btn-outline btn-rounded">View Cart</a>
        <a href="{{ url('/checkout') }}" class="btn btn-primary btn-rounded">Checkout</a>
    </div>
</div>
