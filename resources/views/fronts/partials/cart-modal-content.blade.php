@if(count($cartItems) > 0)
    <div class="cart-products">
        @foreach($cartItems as $item)
            <div class="product product-cart mb-3">
                <figure class="product-media">
                    <a href="{{ url('product-details/' . $item['id']) }}">
                        <img src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}" width="80" height="80">
                    </a>
                </figure>
                <div class="product-detail">
                    <a href="{{ url('product-details/' . $item['id']) }}" class="product-name">
                        {{ $item['title'] }}
                    </a>
                    <div class="price-box">
                        <span class="product-quantity">{{ $item['quantity'] }} ×</span>
                        <span class="product-price">৳{{ $item['price'] }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="cart-total mt-3 text-end">
        <h5>Subtotal: <span class="text-primary">৳{{ number_format($subtotal, 2) }}</span></h5>
    </div>
@else
    <div class="text-center py-5">
        <i class="w-icon-cart" style="font-size: 40px; color: #aaa;"></i>
        <p class="mt-3 mb-0">Your cart is empty.</p>
    </div>
@endif
