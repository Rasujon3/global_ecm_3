@if(count($intros) > 0)
    <div class="swiper-container appear-animate icon-box-wrapper br-sm mt-6 mb-6" data-swiper-options="{
                        'slidesPerView': 1,
                        'loop': false,
                        'breakpoints': {
                            '576': {
                                'slidesPerView': 2
                            },
                            '768': {
                                'slidesPerView': 3
                            },
                            '1200': {
                                'slidesPerView': 4
                            }
                        }
                    }">
        <div class="swiper-wrapper row cols-md-4 cols-sm-3 cols-1">
            @foreach($intros as $intro)
                <div class="swiper-slide icon-box icon-box-side icon-box-primary">
                    <span class="icon-box-icon icon-shipping">
                        <i class="{{ $intro->icon ?? '' }}"></i>
                    </span>
                    <div class="icon-box-content">
                        <h4 class="icon-box-title font-weight-bold mb-1">{{ $intro->title ?? '' }}</h4>
                        <p class="text-default">{{ $intro->description ?? '' }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
