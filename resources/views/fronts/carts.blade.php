@extends('front_master')
@section('front_content')
<!-- Start of Main -->
        <main class="main cart">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb shop-breadcrumb bb-no">
                        <li class="active"><a href="{{url('/carts')}}">Shopping Cart</a></li>
                        <li><a href="{{url('/checkout')}}">Checkout</a></li>
                        <li><a href="#">Order Complete</a></li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of PageContent -->
            <div class="page-content">
                <div class="container">
                    <div class="row gutter-lg mb-10">
                        <div class="col-lg-8 pr-lg-4 mb-6">
                         <form id="cartUpdateForm" action="{{url('/cart-update')}}" method="POST">
                            @csrf
                            <table class="shop-table cart-table">
                                <thead>
                                    <tr>
                                        <th class="product-name"><span>Item</span></th>
                                        <th></th>
                                        <th class="product-price"><span>Price</span></th>
                                        <th class="product-quantity"><span>Quantity</span></th>
                                        <th class="product-subtotal"><span>Subtotal</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($carts as $cart)
                                    <tr id="cart_{{$cart->id}}">
                                        <td class="product-thumbnail">
                                            <div class="p-relative">
                                                <a href="{{url('/product-details/'.$cart->product->id)}}">
                                                    <figure>
                                                       @if($cart->productvariant == null)
                                                        <img src="{{URL::to($cart->product->images[0]->image)}}" alt="product"
                                                            width="300" height="338">
                                                       @else
                                                        <img src="{{URL::to($cart->productvariant->image)}}" alt="product"
                                                            width="300" height="338">
                                                       @endif
                                                    </figure>
                                                </a>
                                                <button type="button" class="btn btn-close remove-cart" data-id="{{$cart->id}}"><i
                                                        class="fas fa-times"></i></button>
                                            </div>
                                        </td>
                                        <td class="product-name">
                                            <a href="{{url('/product-details/'.$cart->product->id)}}">
                                                {{$cart->product->product_name}} @if($cart->productvariant != null)( {{$cart->productvariant->variant_value}} )@endif
                                            </a>
                                        </td>
                                        <td class="product-price"><span class="amount" id="product_price_{{$cart->id}}">
                                            @if($cart->productvariant == null)
                                             {{discount($cart->product)}} BDT
                                            @else
                                              {{$cart->productvariant->pricevariant_price}} BDT
                                            @endif
                                        </span></td>
                                        <td class="product-quantity">
                                            <div class="input-group">
                                                <input
                                                class="form-control cart_input"
                                                id="cart_input_{{$cart->id}}"
                                                name="cart_qty_{{$cart->id}}"
                                                type="number"
                                                min="1"
                                                max="100000"
                                                data-id="{{$cart->id}}"
                                                value="{{$cart->cart_qty}}"
                                                />

                                                <button class="quantity-inc w-icon-plus" data-id="{{$cart->id}}"></button>
                                                <button class="quantity-dc w-icon-minus" data-id="{{$cart->id}}"></button>
                                            </div>
                                        </td>
                                        <td class="product-subtotal">
                                            <span class="amount">
                                             <span class="unit-total" id="unit_total_{{$cart->id}}">{{$cart->unit_total}}</span> BDT
                                            </span>
                                        </td>
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>

                            <div class="cart-action mb-6">
                                <a href="{{ route('home') }}" class="btn btn-dark btn-rounded btn-icon-left btn-shopping mr-auto"><i class="w-icon-long-arrow-left"></i>Continue Shopping</a>
                                <button type="button" class="btn btn-rounded btn-default btn-clear" name="clear_cart" value="Clear Cart">Clear Cart</button>
                                <button type="submit" class="btn btn-rounded btn-update" name="update_cart" value="Update Cart">Update Cart</button>
                            </div>
                        </form>

                            <form class="coupon d-none">
                                <h5 class="title coupon-title font-weight-bold text-uppercase">Coupon Discount</h5>
                                <input type="text" class="form-control mb-4" placeholder="Enter coupon code here..." required />
                                <button class="btn btn-dark btn-outline btn-rounded">Apply Coupon</button>
                            </form>
                        </div>
                        <div class="col-lg-4 sticky-sidebar-wrapper">
                            <div class="sticky-sidebar">
                                <div class="cart-summary mb-4">
                                    <h3 class="cart-title text-uppercase">Cart Totals</h3>
                                    <div class="cart-subtotal d-flex align-items-center justify-content-between">
                                        <label class="ls-25">Subtotal</label>
                                        <span class="cart_subtotal">{{$sum}} BDT</span>
                                    </div>

                                    <hr class="divider">

                                    <ul class="shipping-methods mb-2 d-none">
                                        <li>
                                            <label
                                                class="shipping-title text-dark font-weight-bold">Shipping</label>
                                        </li>
                                        <li>
                                            <div class="custom-radio">
                                                <input type="radio" id="free-shipping" class="custom-control-input"
                                                    name="shipping">
                                                <label for="free-shipping"
                                                    class="custom-control-label color-dark">Free
                                                    Shipping</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-radio">
                                                <input type="radio" id="local-pickup" class="custom-control-input"
                                                    name="shipping">
                                                <label for="local-pickup"
                                                    class="custom-control-label color-dark">Local
                                                    Pickup</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-radio">
                                                <input type="radio" id="flat-rate" class="custom-control-input"
                                                    name="shipping">
                                                <label for="flat-rate" class="custom-control-label color-dark">Flat
                                                    rate:
                                                    $5.00</label>
                                            </div>
                                        </li>
                                    </ul>

                                    <div class="shipping-calculator d-none">
                                        <p class="shipping-destination lh-1">Shipping to <strong>CA</strong>.</p>

                                        <form class="shipping-calculator-form">
                                            <div class="form-group">
                                                <div class="select-box">
                                                    <select name="country" class="form-control form-control-md">
                                                        <option value="default" selected="selected">United States
                                                            (US)
                                                        </option>
                                                        <option value="us">United States</option>
                                                        <option value="uk">United Kingdom</option>
                                                        <option value="fr">France</option>
                                                        <option value="aus">Australia</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="select-box">
                                                    <select name="state" class="form-control form-control-md">
                                                        <option value="default" selected="selected">California
                                                        </option>
                                                        <option value="ohaio">Ohaio</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control form-control-md" type="text"
                                                    name="town-city" placeholder="Town / City">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control form-control-md" type="text"
                                                    name="zipcode" placeholder="ZIP">
                                            </div>
                                            <button type="submit" class="btn btn-dark btn-outline btn-rounded">Update
                                                Totals</button>
                                        </form>
                                    </div>

                                    <hr class="divider mb-6">
                                    <div class="order-total d-flex justify-content-between align-items-center">
                                        <label>Total</label>
                                        <span class="ls-50 cart_total">{{$sum}} BDT</span>
                                    </div>
                                    @if(Auth::check())
                                     <a href="{{url('/checkout')}}" class="btn btn-block btn-dark btn-icon-right btn-rounded  btn-checkout">Proceed to checkout</a>
                                    @else
                                    {{-- <a href="{{url('/login-register')}}" class="d-lg-show login sign-in"><i
                                class="w-icon-account"></i>Sign In</a> --}}
                                    <a href="{{url('/login-register')}}"
                                        class="btn btn-block btn-dark btn-icon-right btn-rounded  btn-checkout login sign-in checkout-process">
                                        Proceed to checkout<i class="w-icon-long-arrow-right"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of PageContent -->
        </main>
        <!-- End of Main -->
@endsection


@push('scripts')
<script>
   $(document).ready(function(){
      let cart_id;

       function rebindCartEvents() {
           $(document).on('click', '.btn-close', function(e) {
               e.preventDefault();
               const target = $(this).data('target');

               switch (target) {
                   case 'cart':
                       $('.cart-dropdown').removeClass('show');
                       $('.cart-overlay').removeClass('show');
                       break;
               }
           });
       }

      $(document).on('click', '.quantity-inc', function(e){
        e.preventDefault();
        cart_id = $(this).data('id');
        let qty = parseFloat($('#cart_input_'+cart_id).val());
        qty += 1;
        $('#cart_input_'+cart_id).val(qty);

        let unitTotal = parseFloat($('#product_price_'+cart_id).text());
        let totalSum = unitTotal * qty;

        $('#unit_total_'+cart_id).text(totalSum.toFixed(2));
        cartCal();

          // ✅ submit form after calculation
          $('#cartUpdateForm').submit();
      });

      $(document).on('input', '.cart_input', function(){
          let inputVal = $(this).val();
          cart_id = $(this).data('id');
          if(inputVal != ""){
            let qty = parseInt(inputVal);

            let unitTotal = parseFloat($('#product_price_'+cart_id).text());
            let totalSum = unitTotal * qty;

            $('#unit_total_'+cart_id).text(totalSum.toFixed(2));
            cartCal();
              // ✅ submit form after calculation
              $('#cartUpdateForm').submit();
          }
      });

      $(document).on('click', '.quantity-dc', function(e){
        e.preventDefault();
        cart_id = $(this).data('id');
        let qty = parseFloat($('#cart_input_'+cart_id).val());
        if(qty > 1){
            qty -= 1;
        }

        $('#cart_input_'+cart_id).val(qty);

        let unitTotal = parseFloat($('#product_price_'+cart_id).text());
        let totalSum = unitTotal * qty;

        $('#unit_total_'+cart_id).text(totalSum.toFixed(2));
        cartCal();
          // ✅ submit form after calculation
          $('#cartUpdateForm').submit();
      });

      $(document).on('click', '.remove-cart', function(e){
        e.preventDefault();
        cart_id = $(this).data('id');
        if(confirm('Do you want to delete this?'))
        {
            $.ajax({

                url: "{{url('/cart-delete')}}/"+cart_id,

                        type:"GET",
                        dataType:"json",
                        success:function(data) {

                        $('#cart_'+cart_id).remove();
                        $('.cart-count').text(data.cart_count);
                        cartCal();
                            // update cart count in header
                            $('.cart-count').text(data.cart_count);

                            // replace dropdown-box content
                            if (data.cart_html) {
                                $('#cart-dropdown-box').html($(data.cart_html).find('#cart-dropdown-box').html());
                                // if you want to ensure the new HTML has id #cart-dropdown-box:
                                // $('#cart-dropdown-box').html(data.cart_html);
                                rebindCartEvents(); // rebind events for new content
                            }
                        toastr.success(data.message);

                },

            });
        }
      });

      $(document).on('click', '.checkout-process', function(e){
        e.preventDefault();
        let put = "{{Session::put('page','checkout')}}";
        let get = "{{Session::get('page')}}";
        console.log(get);
        // let redirectUrl;
        // $.ajax({

        //     url: "{{url('/check-page')}}",

        //         type:"GET",
        //         dataType:"json",
        //         success:function(data) {

        //         if(data.status == true){
        //             redirectUrl = "{{url('/')}}/checkout";
        //             window.location.href="redirectUrl";
        //         }else{
        //             $('.login-popup').popup('show');
        //         }

        //     },

        // });
      });


      function cartCal(){
         let sum = 0;
         $('.unit-total').each(function(){
            let val = parseFloat($(this).text());
            if (!isNaN(val)) {
                sum += val;
            }
         });

         $('.cart_subtotal').text(`${sum.toFixed(2)} BDT`);
         $('.cart_total').text(`${sum.toFixed(2)} BDT`);
      }
   });
</script>

@endpush
