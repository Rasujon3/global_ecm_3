@if(count($cosmetics) > 0)
<div class="row category-cosmetic-lifestyle appear-animate mb-5">
    @foreach($cosmetics as $cosmetic)
    <div class="col-md-6 mb-4">
        <div class="banner banner-fixed category-banner-1 br-xs">
            <figure>
                <img src="{{ $cosmetic->image ?? '' }}" alt="Category Banner"
                     width="610" height="200" style="background-color: #3B4B48;" />
            </figure>
            <div class="banner-content y-50 pt-1">
                {!! $cosmetic->title ?? '' !!}
                {!! $cosmetic->description ?? '' !!}
                <a href="{{url('/product-lists?brand_id='.$cosmetic->brand_id)}}"
                   class="btn btn-primary btn-link btn-underline btn-icon-right">
                    Shop Now
                    <i class="w-icon-long-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
<!-- End of Category Cosmetic Lifestyle -->
