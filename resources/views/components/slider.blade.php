<div>
@php
 $sliders = \App\Models\Slider::latest()->get();
@endphp
<style>
    .slide-image {
        position: absolute !important;
        /*top: 50%;*/
        left: 40%;
        transform: translate(-50%, -50%);
        margin: 0;
        text-align: center;
    }

    .slide-image img {
        max-width: 100%;
        height: auto;
        display: block;
    }

    .intro-section .banner-content {
        position: absolute;
        bottom: 80px; /* adjust as needed */
        left: 50%;
        transform: translateX(-50%);
        text-align: center;
    }


</style>
 <section class="intro-section">
                <div class="swiper-container swiper-theme nav-inner pg-inner swiper-nav-lg animation-slider pg-xxl-hide nav-xxl-show nav-hide"
                    data-swiper-options="{
                    'slidesPerView': 1,
                    'autoplay': {
                        'delay': 8000,
                        'disableOnInteraction': false
                    }
                }">
                    <div class="swiper-wrapper">
                      @foreach($sliders as $key=>$slider)
                        <div class="swiper-slide banner banner-fixed intro-slide intro-slide-1"
                            style="background-image: url({{ asset($slider->image) }}); background-color: #ebeef2;">
                            <div class="container">
{{--                                <figure class="slide-image skrollable slide-animate">--}}
{{--                                    <img--}}
{{--                                        src="{{ $slider->image }}"--}}
{{--                                        alt="Banner"--}}
{{--                                        data-bottom-top="transform: translateY(10vh);"--}}
{{--                                        data-top-bottom="transform: translateY(-10vh);"--}}
{{--                                        width="474"--}}
{{--                                        height="397"--}}
{{--                                    >--}}
{{--                                </figure>--}}
                                <div class="banner-content text-center">
                                    <h5 class="banner-subtitle font-weight-normal text-default ls-50 lh-1 mb-2 slide-animate d-none"
                                        data-animation-options="{
                                    'name': 'fadeInRightShorter',
                                    'duration': '1s',
                                    'delay': '.2s'
                                }">
                                        {{$slider->title}}
                                    </h5>
                                    <h3 class="banner-title font-weight-bolder ls-25 lh-1 slide-animate d-none"
                                        data-animation-options="{
                                    'name': 'fadeInRightShorter',
                                    'duration': '1s',
                                    'delay': '.4s'
                                }">
                                        {{$slider->title}}
                                    </h3>
                                    <p class="font-weight-normal text-default slide-animate d-none" data-animation-options="{
                                    'name': 'fadeInRightShorter',
                                    'duration': '1s',
                                    'delay': '.6s'
                                }">
                                        {{$slider->sub_title}}
                                    </p>

                                    <a href="{{url('/product-lists?brand_id='.$slider->brand_id)}}"
                                        class="btn btn-primary btn-primary-outline btn-rounded btn-icon-right slide-animate"
                                        data-animation-options="{
                                            'name': 'fadeInRightShorter',
                                            'duration': '1s',
                                            'delay': '.8s'
                                        }"
                                    >
                                        SHOP NOW
                                        <i class="w-icon-long-arrow-right"></i>
                                    </a>

                                </div>
                                <!-- End of .banner-content -->
                            </div>
                            <!-- End of .container -->
                        </div>
                        <!-- End of .intro-slide1 -->
                     @endforeach
                        <!-- End of .intro-slide2 -->
                    </div>
                    <div class="swiper-pagination"></div>
                    <button class="swiper-button-next"></button>
                    <button class="swiper-button-prev"></button>
                </div>
                <!-- End of .swiper-container -->
            </section>
</div>
