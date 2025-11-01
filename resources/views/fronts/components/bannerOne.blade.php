<div class="row category-banner-wrapper appear-animate pt-6 pb-8">
    @foreach($banners as $banner)
        <div class="col-md-6 mb-4">
            <a href="{{url('/product-lists?brand_id='.$banner->brand_id)}}">
                <div class="banner banner-fixed br-xs">
                    <figure>
                        <img src="{{ $banner->image ?? '' }}" alt="Category Banner"
                             width="610" height="160" style="background-color: #ecedec;" />
                    </figure>
                    <div class="banner-content y-50 mt-0">
                        {!! $banner->title ?? '' !!}
                        {!! $banner->description ?? '' !!}
                        {!! $banner->price ?? '' !!}
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>
