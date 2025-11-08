<!-- Start of Footer -->
<footer class="footer appear-animate" data-animation-options="{
            'name': 'fadeIn'
        }">
    @include('fronts.components.newsletter')
    <div class="container">
        <div class="footer-top">
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="widget widget-about">
                        <a href="{{url('/')}}" class="logo-footer">
                            <img src="{{ asset(setting()->logo ?? 'front/assets/images/logo_footer.png') }}" alt="logo-footer" width="144"
                                 height="45" />
                        </a>
                        <div class="widget-body">
                            <p class="widget-about-title">{{ setting()->footer_title ?? 'Got Question? Call us 24/7'}}</p>
                            <a href="tel:{{ setting()->phone ?? '' }}" class="widget-about-call">{{ setting()->phone ?? '' }}</a>
                            <p class="widget-about-desc">{{ setting()->footer_description ?? 'Register now to get updates on pronot get up icons & coupons ster now toon.'}}
                            </p>

                            <div class="social-icons social-icons-colored">
                                <a href="{{ setting()->facebook ?? '' }}" class="social-icon social-facebook w-icon-facebook"></a>
                                <a href="{{ setting()->twitter ?? '' }}" class="social-icon social-twitter w-icon-twitter"></a>
                                <a href="{{ setting()->instagram ?? '' }}" class="social-icon social-instagram w-icon-instagram"></a>
                                <a href="{{ setting()->youtube ?? '' }}" class="social-icon social-youtube w-icon-youtube"></a>
                                <a href="{{ setting()->pinterest ?? '' }}" class="social-icon social-pinterest w-icon-pinterest"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h3 class="widget-title">Company</h3>
                        <ul class="widget-body">
                            <li><a href="{{ route('about') }}">About Us</a></li>
                            {{--                                    <li><a href="#">Team Member</a></li>--}}
                            {{--                                    <li><a href="#">Career</a></li>--}}
                            <li><a href="{{ route('contact') }}">Contact Us</a></li>
                            {{--                                    <li><a href="#">Affilate</a></li>--}}
                            {{--                                    <li><a href="#">Order History</a></li>--}}
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h4 class="widget-title">My Account</h4>
                        <ul class="widget-body">
                            @if(Auth::check())
                                <li><a href="{{ route('my-account') }}">Track My Order</a></li>
                            @endif
                            <li><a href="{{url('/carts')}}">View Cart</a></li>
                            {{--                                    <li><a href="#">Sign In</a></li>--}}
                            {{--                                    <li><a href="#">Help</a></li>--}}
                            <li><a href="{{url('/wishlists')}}">My Wishlist</a></li>
                            {{--                                    <li><a href="#">Privacy Policy</a></li>--}}
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h4 class="widget-title">Customer Service</h4>
                        <ul class="widget-body">
                            <li><a href="{{ route('bank.info') }}">Payment Methods (Bank)</a></li>
                            <li><a href="{{ route('bkash.info') }}">Payment Methods (BKash)</a></li>
                            {{--                                    <li><a href="#">Support Center</a></li>--}}
                            {{--                                    <li><a href="#">Term and Conditions</a></li>--}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-middle d-none">
            <div class="widget widget-category">
                <div class="category-box">
                    <h6 class="category-name">Consumer Electric:</h6>
                    <a href="#">TV Television</a>
                    <a href="#">Air Condition</a>
                    <a href="#">Refrigerator</a>
                    <a href="#">Washing Machine</a>
                    <a href="#">Audio Speaker</a>
                    <a href="#">Security Camera</a>
                    <a href="#">View All</a>
                </div>
                <div class="category-box">
                    <h6 class="category-name">Clothing & Apparel:</h6>
                    <a href="#">Men's T-shirt</a>
                    <a href="#">Dresses</a>
                    <a href="#">Men's Sneacker</a>
                    <a href="#">Leather Backpack</a>
                    <a href="#">Watches</a>
                    <a href="#">Jeans</a>
                    <a href="#">Sunglasses</a>
                    <a href="#">Boots</a>
                    <a href="#">Rayban</a>
                    <a href="#">Acccessories</a>
                </div>
                <div class="category-box">
                    <h6 class="category-name">Home, Garden & Kitchen:</h6>
                    <a href="#">Sofa</a>
                    <a href="#">Chair</a>
                    <a href="#">Bed Room</a>
                    <a href="#">Living Room</a>
                    <a href="#">Cookware</a>
                    <a href="#">Utensil</a>
                    <a href="#">Blender</a>
                    <a href="#">Garden Equipments</a>
                    <a href="#">Decor</a>
                    <a href="#">Library</a>
                </div>
                <div class="category-box">
                    <h6 class="category-name">Health & Beauty:</h6>
                    <a href="#">Skin Care</a>
                    <a href="#">Body Shower</a>
                    <a href="#">Makeup</a>
                    <a href="#">Hair Care</a>
                    <a href="#">Lipstick</a>
                    <a href="#">Perfume</a>
                    <a href="#">View all</a>
                </div>
                <div class="category-box">
                    <h6 class="category-name">Jewelry & Watches:</h6>
                    <a href="#">Necklace</a>
                    <a href="#">Pendant</a>
                    <a href="#">Diamond Ring</a>
                    <a href="#">Silver Earing</a>
                    <a href="#">Leather Watcher</a>
                    <a href="#">Rolex</a>
                    <a href="#">Gucci</a>
                    <a href="#">Australian Opal</a>
                    <a href="#">Ammolite</a>
                    <a href="#">Sun Pyrite</a>
                </div>
                <div class="category-box">
                    <h6 class="category-name">Computer & Technologies:</h6>
                    <a href="#">Laptop</a>
                    <a href="#">iMac</a>
                    <a href="#">Smartphone</a>
                    <a href="#">Tablet</a>
                    <a href="#">Apple</a>
                    <a href="#">Asus</a>
                    <a href="#">Drone</a>
                    <a href="#">Wireless Speaker</a>
                    <a href="#">Game Controller</a>
                    <a href="#">View all</a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="footer-left">
                <p class="copyright">{{setting()->copyright_msg ?? 'Copyright © 2025 Glamours World. All Rights Reserved.'}}</p>
            </div>
            <div class="footer-right d-none">
                <span class="payment-label mr-lg-8">We're using safe payment for</span>
                <figure class="payment">
                    <img src="{{ asset('front/assets/images/payment.png') }}" alt="payment" width="159" height="25" />
                </figure>
            </div>
        </div>
    </div>
</footer>
<!-- End of Footer -->
