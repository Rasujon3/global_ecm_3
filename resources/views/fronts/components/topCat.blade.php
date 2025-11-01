<section class="category-section top-category bg-grey pt-10 pb-10 appear-animate">
    <div class="container pb-2">
        <h2 class="title justify-content-center pt-1 ls-normal mb-5">Top Categories</h2>
        <div class="swiper">
            <div class="swiper-container swiper-theme pg-show" data-swiper-options="{
                            'spaceBetween': 20,
                            'slidesPerView': 2,
                            'breakpoints': {
                                '576': {
                                    'slidesPerView': 3
                                },
                                '768': {
                                    'slidesPerView': 5
                                },
                                '992': {
                                    'slidesPerView': 6
                                }
                            }
                        }">
                <div class="swiper-wrapper row cols-lg-6 cols-md-5 cols-sm-3 cols-2">
                    @foreach($topCategories as $category)
                        <div
                            class="swiper-slide category category-classic category-absolute overlay-zoom br-xs">
                            <a href="{{url('/product-lists?category_id='.$category->id)}}" class="category-media">
                                <img src="{{URL::to($category->image)}}" alt="Category"
                                     width="130" height="130">
                            </a>
                            <div class="category-content">
                                <h2 class="category-name" style="color: dodgerblue;">{{$category->category_name}}</h2>
                                <a href="{{url('/product-lists?category_id='.$category->id)}}"
                                   class="btn btn-primary btn-link btn-underline">Shop
                                    Now</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
