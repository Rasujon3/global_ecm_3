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
    {{--                <a href="{{url('/carts')}}" class="cart-toggle label-down link">--}}
    <a href="#" class="cart-toggle label-down link">
        <i class="w-icon-cart">
            <span class="cart-count">{{ $countCart ?? 0}}</span>
        </i>
        <span class="cart-label">Cart</span>
    </a>
    <div class="dropdown-box" id="cart-dropdown-box">
        <div class="cart-header">
            <span>Shopping Cart</span>
            <a href="#" class="btn-close cart-close-btn" data-target="cart">
                Close <i class="w-icon-long-arrow-right"></i>
            </a>
        </div>
        @include('fronts.components.scrollableProducts')
    </div>
    <!-- End of Dropdown Box -->
</div>

<style>
    /* Ensure dropdown-box has a proper height */
    #cart-dropdown-box {
        display: flex;
        flex-direction: column;
        max-height: 100%; /* Adjust as needed */
        width: 320px; /* optional, for consistent layout */
    }

    /* Scrollable middle area */
    .cart-content {
        overflow-y: auto;
        flex: 1;
        padding-right: 6px; /* avoid scrollbar overlap */
        margin-bottom: 10px;
    }

    /* Fix footer to bottom */
    .cart-footer {
        border-top: 1px solid #eee;
        background: #fff;
        padding: 12px;
        flex-shrink: 0;
        position: sticky;
        bottom: 0;
    }

    /* Optional: make smooth scrolling look nice */
    .cart-content::-webkit-scrollbar {
        width: 6px;
    }
    .cart-content::-webkit-scrollbar-thumb {
        background-color: #ccc;
        border-radius: 3px;
    }
</style>

@push('scripts')

@endpush
