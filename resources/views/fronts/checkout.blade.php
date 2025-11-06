@extends('front_master')
@section('front_content')
    <style>
        .order-table {
            width: 100%;
            border-collapse: collapse;
        }
        .order-table td.product-name {
            word-wrap: break-word;
            white-space: normal;
            max-width: 150px; /* adjust based on your design */
        }

        @media (max-width: 768px) {
            .order-table-wrapper {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            .order-table {
                min-width: 400px;
            }
            .order-table td,
            .order-table th {
                display: block;
                width: 100%;
                text-align: left;
                box-sizing: border-box;
            }

            .order-table tr {
                display: block;
                margin-bottom: 10px;
                border-bottom: 1px solid #eee;
            }

            .order-table td.product-name {
                max-width: 100%;
            }
        }

    </style>
<!-- Start of Main -->
        <main class="main checkout">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb shop-breadcrumb bb-no">
                        <li class="passed"><a href="{{ url('/carts') }}">Shopping Cart</a></li>
                        <li class="active"><a href="#">Checkout</a></li>
                        <li><a href="#">Order Complete</a></li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->


            <!-- Start of PageContent -->
            <div class="page-content">
                <div class="container">
                    <form class="login-content">
                        <p>If you have shopped with us before, please enter your details below.
                            If you are a new customer, please proceed to the Billing section.</p>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>Username or email *</label>
                                    <input type="text" class="form-control form-control-md" name="name"
                                        >
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>Password *</label>
                                    <input type="text" class="form-control form-control-md" name="password"
                                        >
                                </div>
                            </div>
                        </div>
                        <div class="form-group checkbox">
                            <input type="checkbox" class="custom-checkbox" id="remember" name="remember">
                            <label for="remember" class="mb-0 lh-2">Remember me</label>
                            <a href="#" class="ml-3">Last your password?</a>
                        </div>
                        <button class="btn btn-rounded btn-login">Login</button>
                    </form>
                    <div class="coupon-toggle d-none">
                        Have a coupon? <a href="#"
                            class="show-coupon font-weight-bold text-uppercase text-dark">Enter your
                            code</a>
                    </div>
                    <div class="coupon-content mb-4">
                        <p>If you have a coupon code, please apply it below.</p>
                        <div class="input-wrapper-inline">
                            <input type="text" name="coupon_code" class="form-control form-control-md mr-1 mb-2" placeholder="Coupon code" id="coupon_code">
                            <button type="submit" class="btn button btn-rounded btn-coupon mb-2" name="apply_coupon" value="Apply coupon">Apply Coupon</button>
                        </div>
                    </div>
                    <form class="form checkout-form" action="{{url('save-order')}}" method="post" enctype="multipart/form-data">
                       @csrf
                       <input type="hidden" name="paymentmethod_id" id="paymentmethod_id" value=""/>
                       <input type="hidden" name="grand_total" id="grand_total" value="{{ $sum + $settings->inside_dhaka_dc }}"/>
                        <input type="hidden" name="selected_delivery_charge" id="selected_delivery_charge" value="{{ $settings->inside_dhaka_dc }}">
                        <div class="row mb-9">
                            <div class="col-lg-7 pr-lg-4 mb-4">
                                <h3 class="title billing-title text-uppercase ls-10 pt-1 pb-3 mb-0">
                                    Billing Details
                                </h3>
                                <div class="row gutter-sm">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label>Full name *</label>
                                            <input type="text" class="form-control form-control-md" name="name"
                                                 value="{{user()->name}}">
                                        </div>
                                        @error('name')
		                                 <p class="alert alert-danger">{{ $message }}</p>
		                                @enderror
                                    </div>
                                    <div class="col-xs-6 d-none">
                                        <div class="form-group">
                                            <label>Last name *</label>
                                            <input type="text" class="form-control form-control-md" name="lastname"
                                                >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group d-none">
                                    <label>Company name (optional)</label>
                                    <input type="text" class="form-control form-control-md" name="company-name">
                                </div>
                                <div class="form-group d-none">
                                    <label>Country / Region *</label>
                                    <div class="select-box">
                                        <select name="country" class="form-control form-control-md">
                                            <option value="default" selected="selected">United States
                                                (US)
                                            </option>
                                            <option value="uk">United Kingdom (UK)</option>
                                            <option value="us">United States</option>
                                            <option value="fr">France</option>
                                            <option value="aus">Australia</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Full address *</label>
                                    <textarea class="form-control" name="full_address" placeholder="Full Address"></textarea>
                                    @error('full_address')
		                               <p class="alert alert-danger">{{ $message }}</p>
		                            @enderror
                                </div>
                                <div class="row gutter-sm">
                                    <div class="col-md-6">
                                        <div class="form-group d-none">
                                            <label>Town / City *</label>
                                            <input type="text" class="form-control form-control-md" name="town" >
                                        </div>
                                        <div class="form-group">
                                            <label>ZIP </label>
                                            <input type="text" class="form-control form-control-md" name="zip_code">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group d-none">
                                            <label>State *</label>
                                            <div class="select-box">
                                                <select name="country" class="form-control form-control-md">
                                                    <option value="default" selected="selected">California</option>
                                                    <option value="uk">United Kingdom (UK)</option>
                                                    <option value="us">United States</option>
                                                    <option value="fr">France</option>
                                                    <option value="aus">Australia</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Phone *</label>
                                            <input type="text" class="form-control form-control-md" name="phone" value="{{user()->phone}}">
                                        </div>
                                        @error('phone')
		                                 <p class="alert alert-danger">{{ $message }}</p>
		                                @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-7">
                                    <label>Email address *</label>
                                    <input type="email" class="form-control form-control-md" name="email" value="{{user()->email}}">
                                </div>
                                @error('email')
		                           <p class="alert alert-danger">{{ $message }}</p>
		                        @enderror

                                <div class="form-group checkbox-toggle pb-2 d-none">
                                    <input type="checkbox" class="custom-checkbox" id="shipping-toggle"
                                        name="shipping-toggle">
                                    <label for="shipping-toggle">Ship to a different address?</label>
                                </div>
                                <div class="checkbox-content">
                                    <div class="row gutter-sm">
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label>First name *</label>
                                                <input type="text" class="form-control form-control-md" name="firstname"
                                                    >
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label>Last name *</label>
                                                <input type="text" class="form-control form-control-md" name="lastname"
                                                    >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Company name (optional)</label>
                                        <input type="text" class="form-control form-control-md" name="company-name">
                                    </div>
                                    <div class="form-group">
                                        <label>Country / Region *</label>
                                        <div class="select-box">
                                            <select name="country" class="form-control form-control-md">
                                                <option value="default" selected="selected">United States
                                                    (US)
                                                </option>
                                                <option value="uk">United Kingdom (UK)</option>
                                                <option value="us">United States</option>
                                                <option value="fr">France</option>
                                                <option value="aus">Australia</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Street address *</label>
                                        <input type="text" placeholder="House number and street name"
                                            class="form-control form-control-md mb-2" name="street-address-1" >
                                        <input type="text" placeholder="Apartment, suite, unit, etc. (optional)"
                                            class="form-control form-control-md" name="street-address-2" >
                                    </div>
                                    <div class="row gutter-sm">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Town / City *</label>
                                                <input type="text" class="form-control form-control-md" name="town" >
                                            </div>
                                            <div class="form-group">
                                                <label>Postcode *</label>
                                                <input type="text" class="form-control form-control-md" name="postcode" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Country (optional)</label>
                                                <input type="text" class="form-control form-control-md" name="zip" >
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mt-3 d-none">
                                    <label for="order-notes">Order notes (optional)</label>
                                    <textarea class="form-control mb-0" id="order-notes" name="order-notes" cols="30"
                                        rows="4"
                                        placeholder="Notes about your order, e.g special notes for delivery"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-5 mb-4 sticky-sidebar-wrapper">
                                <div class="order-summary-wrapper sticky-sidebar">
                                    <h3 class="title text-uppercase ls-10">Your Order</h3>
                                    <div class="order-summary">
                                        <div class="order-table-wrapper">
                                            <table class="order-table">
                                                <thead>
                                                <tr>
                                                    <th colspan="2">
                                                        <b>Product</b>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($carts as $cart)
                                                    <tr class="bb-no">
                                                        <td class="product-name">{{$cart->product->product_name}}
                                                            <i class="fas fa-times"></i>
                                                            <span class="product-quantity">{{$cart->cart_qty}}</span>
                                                            @if(!empty($cart->variant_details))
                                                                <br>
                                                                @foreach($cart->variant_details as $variant)
                                                                    <small class="text-muted">
                                                                        {{ $variant->variant_name }}: {{ $variant->variant_value }}
                                                                        @if(!$loop->last) | @endif
                                                                    </small>
                                                                @endforeach
                                                            @endif
                                                        </td>
                                                        <td class="product-total">{{$cart->unit_total}} BDT</td>
                                                    </tr>
                                                @endforeach
                                                <tr class="cart-subtotal bb-no">
                                                    <td>
                                                        <b>Subtotal</b>
                                                    </td>
                                                    <td>
                                                        <b>{{$sum}} BDT</b>
                                                    </td>
                                                </tr>
                                                <tr class="delivery-charge">
                                                    <td><b>Delivery Charge</b></td>
                                                    <td>
                                                        <ul class="list-unstyled mb-0">
                                                            <li>
                                                                <label>
                                                                    <input type="radio" name="delivery_charge" value="{{ $settings->inside_dhaka_dc }}" checked>
                                                                    Inside Dhaka ({{ $settings->inside_dhaka_dc }} BDT)
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="radio" name="delivery_charge" value="{{ $settings->sub_urban_areas_dc }}">
                                                                    Suburban Areas ({{ $settings->sub_urban_areas_dc }} BDT)
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="radio" name="delivery_charge" value="{{ $settings->outside_dhaka_dc }}">
                                                                    Outside Dhaka ({{ $settings->outside_dhaka_dc }} BDT)
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                </tbody>
                                                <tfoot>
                                                <tr class="shipping-methods d-none">
                                                    <td colspan="2" class="text-left">
                                                        <h4 class="title title-simple bb-no mb-1 pb-0 pt-3">Shipping
                                                        </h4>
                                                        <ul id="shipping-method" class="mb-4">
                                                            <li>
                                                                <div class="custom-radio">
                                                                    <input type="radio" id="free-shipping"
                                                                           class="custom-control-input" name="shipping">
                                                                    <label for="free-shipping"
                                                                           class="custom-control-label color-dark">Free
                                                                        Shipping</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-radio">
                                                                    <input type="radio" id="local-pickup"
                                                                           class="custom-control-input" name="shipping">
                                                                    <label for="local-pickup"
                                                                           class="custom-control-label color-dark">Local
                                                                        Pickup</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-radio">
                                                                    <input type="radio" id="flat-rate"
                                                                           class="custom-control-input" name="shipping">
                                                                    <label for="flat-rate"
                                                                           class="custom-control-label color-dark">Flat
                                                                        rate: $5.00</label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr class="order-total">
                                                    <th><b>Total</b></th>
                                                    <td><b id="grand-total">{{ $sum + $settings->inside_dhaka_dc }} BDT</b></td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                        <div class="payment-methods" id="payment_method">
                                            <h4 class="title font-weight-bold ls-25 pb-0 mb-1">Payment Methods</h4>
                                            <div class="accordion payment-accordion">
                                              @foreach(paymentmethods() as $row)
                                                <div class="card">
                                                  <input type="radio" class="select-payment-method" name="selected_paymentmethod_id" id="{{$row->id}}" value="{{$row->id}}">
                                                  <label for="{{$row->id}}">{{$row->name}}</label>
                                                </div>
                                               @endforeach
                                               @error('paymentmethod_id')
					                           <p class="alert alert-danger">{{ $message }}</p>
					                        @enderror
                                               <div class="screenshot"></div>
                                            </div>
                                            @error('image')
					                           <p class="alert alert-danger">{{ $message }}</p>
					                        @enderror
                                        </div>

                                        <div class="form-group place-order pt-6">
                                            <button type="submit" class="btn btn-dark btn-block btn-rounded">Place Order</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End of PageContent -->
        </main>
        <!-- End of Main -->

@endsection

@push('scripts')

    <script>
 	$(document).ready(function(){
 		$(document).on('click','.select-payment-method',function(){
 			//e.preventDefault();
 			let payment_id = $(this).val();
 			if(payment_id == '2'){
 				$('.screenshot').html(`
<div class="form-group">
<label for="image"><b>Upload Payment Proof ScreenShot</b></label>
<a href="{{ route('bank.info') }}" target="_blank" class="btn btn-sm btn-info ml-2">
                Show Bank Info
            </a>
<input type="file" name="image" class="form-control" accept="image/*"  id="image"/></div>
`);
 			} else if(payment_id == '3'){
                $('.screenshot').html(`
<div class="form-group">
<label for="image"><b>Upload Payment Proof ScreenShot</b></label>
<a href="{{ route('bkash.info') }}" target="_blank" class="btn btn-sm btn-info ml-2">
                Show bkash Info
            </a>
<input type="file" name="image" class="form-control" accept="image/*"  id="image"/></div>
`);
            } else{
 				$('.screenshot').html('');
 			}
 			$('#paymentmethod_id').val(payment_id);
 		});
 	});
 </script>

 <script>
     document.addEventListener("DOMContentLoaded", function () {
         const deliveryOptions = document.querySelectorAll('input[name="delivery_charge"]');
         const hiddenCharge = document.getElementById('selected_delivery_charge');
         const grandTotal = document.getElementById('grand_total');
         const grandTotalElem = document.getElementById('grand-total');
         const baseTotal = {{ $sum }};

         deliveryOptions.forEach(option => {
             option.addEventListener('change', function () {
                 const deliveryCharge = parseFloat(this.value);
                 hiddenCharge.value = deliveryCharge;
                 grandTotal.value = grandTotal;
                 const newTotal = baseTotal + deliveryCharge;
                 grandTotalElem.textContent = `${newTotal} BDT`;
             });
         });
     });
 </script>
@endpush
