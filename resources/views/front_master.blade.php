<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ setting()->shop_name ?? 'Glamours World' }}</title>

    <meta name="keywords" content="Marketplace ecommerce responsive HTML5 Template" />
    <meta name="description"
        content="Wolmart is powerful marketplace &amp; ecommerce responsive Html5 Template.">
    <meta name="author" content="D-THEMES">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{asset(setting()->favicon ?? 'front/assets/images/icons/favicon.png')}}" />

    <link rel="stylesheet" href="{{asset('custom/toastr.css')}}">

    <!-- WebFont.js -->
    <script>
        WebFontConfig = {
            google: { families: ['Poppins:400,500,600,700,800'] }
        };
        (function (d) {
            var wf = d.createElement('script'), s = d.scripts[0];
            wf.src = '{{ asset("front/assets/js/webfont.js") }}';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>

    <link rel="preload" href="{{asset('front/assets/vendor/fontawesome-free/webfonts/fa-regular-400.woff2')}}" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="{{asset('front/assets/vendor/fontawesome-free/webfonts/fa-solid-900.woff2')}}" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="{{asset('front/assets/vendor/fontawesome-free/webfonts/fa-brands-400.woff2')}}" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="{{asset('front/assets/fonts/wolmart87d5.woff?png09e')}}" as="font" type="font/woff" crossorigin="anonymous">

    <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('front/assets/vendor/fontawesome-free/css/all.min.css')}}">

    <!-- Plugins CSS -->
    <!-- <link rel="stylesheet" href="front/assets/vendor/swiper/swiper-bundle.min.css"> -->
    <link rel="stylesheet" type="text/css" href="{{asset('front/assets/vendor/animate/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front/assets/vendor/magnific-popup/magnific-popup.min.css')}}">
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="{{asset('front/assets/vendor/swiper/swiper-bundle.min.css')}}">

    <!-- Default CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('front/assets/css/demo1.min.css')}}">

    <!-- Default CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('front/assets/css/style.min.css')}}">

    <style>
        .login.sign-in:hover, .login.register:hover, .my-account:hover, .user-logout:hover {
            color: #fff !important;
        }
        .search-results-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #e0e0e0;
            border-top: none;
            border-radius: 0 0 8px 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-height: 400px;
            overflow-y: auto;
            z-index: 1000;
            display: none;
        }

        .search-results-dropdown.show {
            display: block;
        }

        .search-result-item {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border-bottom: 1px solid #f0f0f0;
            cursor: pointer;
            transition: background 0.2s ease;
            text-decoration: none;
            color: inherit;
        }

        .search-result-item:last-child {
            border-bottom: none;
        }

        .search-result-item:hover {
            background: #f8f9fa;
        }

        .search-result-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
            margin-right: 12px;
            flex-shrink: 0;
        }

        .search-result-info {
            flex: 1;
            min-width: 0;
        }

        .search-result-title {
            font-size: 14px;
            font-weight: 500;
            color: #333;
            margin: 0 0 4px 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .search-result-price {
            font-size: 14px;
            font-weight: 600;
            color: #28a745;
            margin: 0;
        }

        .search-result-category {
            font-size: 12px;
            color: #999;
            margin: 0;
        }

        .search-no-results {
            padding: 20px;
            text-align: center;
            color: #999;
            font-size: 14px;
        }

        .search-loading {
            padding: 20px;
            text-align: center;
            color: #666;
        }

        /* Make parent form position relative */
        .header-search {
            position: relative;
        }

        /* Scrollbar styling */
        .search-results-dropdown::-webkit-scrollbar {
            width: 6px;
        }

        .search-results-dropdown::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .search-results-dropdown::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 3px;
        }

        .search-results-dropdown::-webkit-scrollbar-thumb:hover {
            background: #999;
        }
        /* Mobile Search Form - Make it relative for dropdown positioning */
        .mobile-search-form {
            position: relative;
        }

        /* Mobile Search Results Dropdown */
        .mobile-menu-container .search-results-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #e0e0e0;
            border-top: none;
            border-radius: 0 0 8px 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            max-height: 350px;
            overflow-y: auto;
            z-index: 1001;
            display: none;
        }

        .mobile-menu-container .search-results-dropdown.show {
            display: block;
        }

        .mobile-menu-container .search-result-item {
            display: flex;
            align-items: center;
            padding: 10px 12px;
            border-bottom: 1px solid #f0f0f0;
            cursor: pointer;
            transition: background 0.2s ease;
            text-decoration: none;
            color: inherit;
        }

        .mobile-menu-container .search-result-item:last-child {
            border-bottom: none;
        }

        .mobile-menu-container .search-result-item:hover,
        .mobile-menu-container .search-result-item:active {
            background: #f8f9fa;
        }

        .mobile-menu-container .search-result-img {
            width: 45px;
            height: 45px;
            object-fit: cover;
            border-radius: 6px;
            margin-right: 10px;
            flex-shrink: 0;
        }

        .mobile-menu-container .search-result-info {
            flex: 1;
            min-width: 0;
        }

        .mobile-menu-container .search-result-title {
            font-size: 13px;
            font-weight: 500;
            color: #333;
            margin: 0 0 3px 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .mobile-menu-container .search-result-price {
            font-size: 13px;
            font-weight: 600;
            color: #28a745;
            margin: 0;
        }

        .mobile-menu-container .search-result-category {
            font-size: 11px;
            color: #999;
            margin: 0;
        }

        .mobile-menu-container .search-no-results {
            padding: 20px;
            text-align: center;
            color: #999;
            font-size: 14px;
        }

        .mobile-menu-container .search-loading {
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }

        /* Scrollbar for mobile */
        .mobile-menu-container .search-results-dropdown::-webkit-scrollbar {
            width: 5px;
        }

        .mobile-menu-container .search-results-dropdown::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .mobile-menu-container .search-results-dropdown::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 3px;
        }
        /* Cart Dropdown Styles */
        .cart-dropdown {
            position: relative;
        }

        .cart-dropdown .dropdown-box {
            position: fixed;
            right: -400px;
            top: 0;
            width: 350px;
            height: 100vh;
            background: #fff;
            box-shadow: -2px 0 10px rgba(0,0,0,0.1);
            transition: right 0.3s ease;
            z-index: 9999;
            overflow-y: auto;
        }

        .cart-dropdown.active .dropdown-box,
        .cart-dropdown.opened .dropdown-box {
            right: 0;
        }

        .cart-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9998;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .cart-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        body.cart-opened {
            overflow: hidden;
        }

        .cart-header {
            padding: 20px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-header span {
            font-size: 18px;
            font-weight: 600;
        }

        .cart-header .btn-close {
            color: #666;
            text-decoration: none;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .cart-header .btn-close:hover {
            color: #000;
        }

        /*.products {*/
        /*    padding: 20px;*/
        /*}*/

        .cart-total {
            padding: 20px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-action {
            padding: 0 20px 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        /* Cart Dropdown - Higher specificity to override other styles */
        .cart-dropdown .dropdown-box {
            position: fixed !important;
            right: -400px !important;
            top: 0 !important;
            width: 350px;
            height: 100vh;
            background: #fff;
            box-shadow: -2px 0 10px rgba(0,0,0,0.1);
            transition: right 0.3s ease !important;
            z-index: 9999;
            overflow-y: auto;
            display: block !important; /* Override any display:none from hover */
        }

        .cart-dropdown.active .dropdown-box,
        .cart-dropdown.opened .dropdown-box {
            right: 0 !important;
        }
    </style>

    <!-- Meta Pixel Code -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var pixelId = {{ setting()->meta_pixel_script ?? null }};

            if (pixelId) {
                !function(f,b,e,v,n,t,s)
                {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
                    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
                    n.queue=[];t=b.createElement(e);t.async=!0;
                    t.src=v;s=b.getElementsByTagName(e)[0];
                    s.parentNode.insertBefore(t,s)}(window, document,'script',
                    'https://connect.facebook.net/en_US/fbevents.js');
                fbq('init', pixelId);
                fbq('track', 'PageView');
            } else {
                console.warn("⚠️ Meta Pixel ID not found in .env");
            }
        });
    </script>

    <noscript>
        <img height="1" width="1" style="display:none"
             src="https://www.facebook.com/tr?id={{ setting()->meta_pixel_script ?? '' }}&ev=PageView&noscript=1"/>
    </noscript>
    <!-- End Meta Pixel Code -->

</head>

<body class="home">
    <div class="page-wrapper">
        <h1 class="d-none">Glamours World - Responsive Marketplace HTML Template</h1>
        <!-- Start of Header -->
        <header class="header">
            @include('fronts.components.headerTop')
            <!-- End of Header Top -->

            @include('fronts.components.headerMiddle')
            <!-- End of Header Middle -->

            @include('fronts.components.innerNav')
        </header>
        <!-- End of Header -->

        <!-- Start of Main-->
        <main class="main">
           @if(Route::currentRouteName() == 'home')
            <x-slider/>
           @endif
            <!-- End of .intro-section -->

            @yield('front_content')
        </main>
        <!-- End of Main -->

        @include('fronts.components.footer')

        @include('fronts.components.cart-modal')

    </div>
    <!-- End of Page-wrapper-->

    @include('fronts.components.stickyFooter')

    @include('fronts.components.scrollTop')

    @include('mobileMenu')

    @include('fronts.components.newsletterPopup')

    @include('fronts.components.quickView')

    <!-- Plugin JS File -->
{{--    <script data-cfasync="false" src="{{asset('../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js')}}"></script>--}}
    <script src="{{asset('front/assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('front/assets/vendor/jquery.plugin/jquery.plugin.min.js')}}"></script>
    <script src="{{asset('front/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('front/assets/vendor/zoom/jquery.zoom.js')}}"></script>
    <script src="{{asset('front/assets/vendor/jquery.countdown/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('front/assets/vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('front/assets/vendor/skrollr/skrollr.min.js')}}"></script>

    <!-- Swiper JS -->
    <script src="{{asset('front/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>

    <!-- Main JS -->
    <script src="{{asset('front/assets/js/main.min.js')}}"></script>

{{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>--}}

    <script src="{{asset('custom/toastr.js')}}"></script>

      @if(Session::has('messege'))
        @toastr("{{ Session::get('messege') }}")
      @endif



    @stack('scripts')

    @if(Route::currentRouteName() != 'home')
        <script>
            $(document).ready(function(){
                // Select only the category dropdown area
                const $categoryDropdown = $('.category-dropdown');

                // Show only its own dropdown-box on hover
                $categoryDropdown.hover(
                    function() {
                        $(this).find('.dropdown-box').stop(true, true).fadeIn(200);
                    },
                    function() {
                        $(this).find('.dropdown-box').stop(true, true).fadeOut(200);
                    }
                );
            });
        </script>
    @endif

    <script>
          $(function () {
            var base_url = "{{url('/')}}";
            localStorage.setItem('base_url', base_url);
          })
        </script>

    <script>
        // Replace the existing script section with this updated version
        $(document).ready(function() {
            // Cart dropdown toggle functionality (WORKS ON ALL PAGES)
            $('.cart-toggle').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const $cartDropdown = $('.cart-dropdown');
                const $cartDropdownBox = $cartDropdown.find('.dropdown-box');
                const $overlay = $('.cart-overlay');

                // Toggle active state
                $cartDropdown.toggleClass('active opened');
                $cartDropdownBox.toggleClass('active opened');
                $overlay.toggleClass('active');

                // Prevent body scroll when cart is open
                if ($cartDropdown.hasClass('active')) {
                    $('body').addClass('cart-opened');
                } else {
                    $('body').removeClass('cart-opened');
                }
            });

            // Close cart dropdown when clicking close button
            $('.cart-dropdown .btn-close').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const $cartDropdown = $('.cart-dropdown');
                const $cartDropdownBox = $cartDropdown.find('.dropdown-box');
                const $overlay = $('.cart-overlay');

                $cartDropdown.removeClass('active opened');
                $cartDropdownBox.removeClass('active opened');
                $overlay.removeClass('active');
                $('body').removeClass('cart-opened');
            });

            // Close cart dropdown when clicking overlay
            $('.cart-overlay').on('click', function(e) {
                e.preventDefault();

                const $cartDropdown = $('.cart-dropdown');
                const $cartDropdownBox = $cartDropdown.find('.dropdown-box');
                const $overlay = $('.cart-overlay');

                $cartDropdown.removeClass('active opened');
                $cartDropdownBox.removeClass('active opened');
                $overlay.removeClass('active');
                $('body').removeClass('cart-opened');
            });

            // Close cart dropdown when clicking outside
            $(document).on('click', function(e) {
                const $cartDropdown = $('.cart-dropdown');

                if (!$cartDropdown.is(e.target) && $cartDropdown.has(e.target).length === 0) {
                    const $cartDropdownBox = $cartDropdown.find('.dropdown-box');
                    const $overlay = $('.cart-overlay');

                    $cartDropdown.removeClass('active opened');
                    $cartDropdownBox.removeClass('active opened');
                    $overlay.removeClass('active');
                    $('body').removeClass('cart-opened');
                }
            });

            // Prevent cart dropdown from closing when clicking inside
            $('.cart-dropdown .dropdown-box').on('click', function(e) {
                e.stopPropagation();
            });

            // Category dropdown functionality (ONLY FOR NON-HOME PAGES)
            var isHomePage = $('body').hasClass('home') || window.location.pathname === '/' || window.location.pathname === '';

            if (!isHomePage) {
                $('.category-toggle, .has-submenu').hover(
                    function() {
                        // Only show category dropdown, NOT cart dropdown
                        $(this).find('.dropdown-box').not('.cart-dropdown .dropdown-box').stop(true, true).fadeIn(200);
                    },
                    function() {
                        // Only hide category dropdown, NOT cart dropdown
                        $(this).find('.dropdown-box').not('.cart-dropdown .dropdown-box').stop(true, true).fadeOut(200);
                    }
                );
            }
        });
    </script>

</body>

    <script>
        $(document).ready(function(){

            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });

            $(document).on('submit','#signupUser',function(e){
                e.preventDefault();
                let name_1 = $('#name_1').val();
                let email_1 = $('#email_1').val();
                let phone_1 = $('#phone_1').val();
                let password_1 = $('#password_1').val();
                let password_2 = $('#password_2').val();
                // let redirectUrl = "{{url('/')}}/"+"user-dashboard";
                let redirectUrl = "{{url('/')}}";
                $.ajax({

                    url: "{{url('user-signup')}}",

                        type:"POST",

                        data:{'name_1':name_1,'email_1':email_1,'phone_1':phone_1,'password_1':password_1,'password_2':password_2},
                        dataType:"json",
                        success:function(data) {
                            if(data.status == true){
                                $('#name_1').val('');
                                $('#email_1').val('');
                                $('#phone_1').val('');
                                $('#password_1').val('');
                                $('#password_2').val('');
                                toastr.success(data.message);
                                setTimeout(function() {
                                    window.location.href = redirectUrl;
                                }, 1000);
                            }else{
                                toastr.error(data.message);
                            }

                    },

                });
            });

            $(document).on('submit','#signinUser',function(e){
                e.preventDefault();
                let email_or_phone = $('#email_or_phone').val();
                let password = $('#password').val();
                // let redirectUrl = "{{url('/')}}/"+"user-dashboard";
                let sessionGet = "{{Session::get('page')}}";
                let redirectUrl;
                if(sessionGet == 'checkout'){
                    redirectUrl = "{{url('/')}}/checkout";
                }else{
                    redirectUrl = "{{url('/')}}";
                };
                $.ajax({

                    url: "{{url('user-signin')}}",

                        type:"POST",

                        data:{'email_or_phone':email_or_phone,'password':password},
                        dataType:"json",
                        success:function(data) {
                            if(data.status == true){
                                $('#email_or_phone').val('');
                                $('#password').val('');
                                toastr.success(data.message);
                                setTimeout(function() {
                                    window.location.href = redirectUrl;
                                }, 1000);
                            }else{
                                toastr.error(data.message);
                            }

                    },

                });
            });

        });
     </script>
    <script>
        $(document).ready(function(){
            $('#category').on('change', function(){
                var categoryId = $(this).val();
                if(categoryId){
                    window.location.href = "{{ url('/product-lists') }}?category_id=" + categoryId;
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Set the cookie to true immediately when page loads
            Wolmart.setCookie("hideNewsletterPopup", true, 7);
        });
    </script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const headerTop = document.querySelector('.header-top');
        const headerMiddle = document.querySelector('.header-middle');

        window.addEventListener('scroll', function() {
            if (window.scrollY > 80) {
                headerTop?.classList.add('hide');
                headerMiddle?.classList.add('sticky');
            } else {
                headerTop?.classList.remove('hide');
                headerMiddle?.classList.remove('sticky');
            }
        });
    });
</script>


</html>
