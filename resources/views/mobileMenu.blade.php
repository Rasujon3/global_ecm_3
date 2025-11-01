<!-- Start of Mobile Menu -->
<div class="mobile-menu-wrapper">
    <div class="mobile-menu-overlay"></div>
    <!-- End of .mobile-menu-overlay -->

    <a href="#" class="mobile-menu-close"><i class="close-icon"></i></a>
    <!-- End of .mobile-menu-close -->

    <div class="mobile-menu-container scrollable">
        <form method="get" action="{{url('product-lists')}}" class="input-wrapper mobile-search-form">
            <input type="text" class="form-control" name="search_product" id="mobile-search-input"
                   autocomplete="off" placeholder="Search" />
            <button class="btn btn-search" type="submit">
                <i class="w-icon-search"></i>
            </button>

            <!-- Mobile Search Results Dropdown -->
            <div class="search-results-dropdown" id="mobileSearchResults">
                <!-- Loading State -->
                <div class="search-loading" id="mobileSearchLoading" style="display: none;">
                    <i class="fa fa-spinner fa-spin"></i> Searching...
                </div>

                <!-- Results List -->
                <div id="mobileSearchResultsList" style="display: none;">
                    <!-- Results will be populated here -->
                </div>

                <!-- No Results State -->
                <div class="search-no-results" id="mobileNoResults" style="display: none;">
                    <i class="w-icon-exclamation-triangle"></i>
                    <p>No products found</p>
                </div>
            </div>
        </form>
        <!-- End of Search Form -->

        <div class="tab">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a href="#main-menu" class="nav-link active">Main Menu</a>
                </li>
                <li class="nav-item">
                    <a href="#categories" class="nav-link">Categories</a>
                </li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="main-menu">
                <ul class="mobile-menu">
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li>
                        <a href="#">Brands</a>
                        <ul>
                            @if(isset($menuBrands))
                                @foreach($menuBrands as $brand)
                                    <li>
                                        <a href="{{ url('/product-lists?brand_id='.$brand->id) }}">{{ $brand->brand_name }}</a>
                                        <ul>
                                            @foreach($brand->products as $product)
                                                <li>
                                                    <a href="{{ url('/product-details/'.$product->id) }}">
                                                        {{ $product->product_name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </li>
                    <li><a href="{{url('/about')}}">About Us</a></li>
                    <li><a href="{{url('/contact')}}">Contact Us</a></li>
                    @if(Auth::check())
                        <li>
                            <a href="{{ url('/wishlists') }}" class="">My Wishlist</a>
                        </li>
                        <li>
                            <a href="{{ route('my-account') }}" class="">My Account</a>
                        </li>
                        <li>
                            <a href="{{'/user-logout'}}" class="">{{Auth::user()->name}} ( Logout )</a>
                        </li>
                    @else
                        <li>
                            <a href="{{url('/login-register')}}" class="login sign-in"><i class="w-icon-account"></i>Sign In</a>
                        </li>
                        <li>
                            <a href="{{url('/login-register')}}" class="ml-0 login register">Register</a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="tab-pane" id="categories">
                <ul class="mobile-menu">
                    @foreach($topCategories as $category)
                        <li>
                            <a href="{{url('/product-lists?category_id='.$category->id)}}">
                                {{ $category->category_name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End of Mobile Menu -->

<style>
    /* Mobile Search Specific Styles */
    .mobile-search-form {
        position: relative;
    }

    .mobile-menu-container .search-results-dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border: 1px solid #e0e0e0;
        border-top: none;
        border-radius: 0 0 8px 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        max-height: 300px;
        overflow-y: auto;
        z-index: 1000;
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

    .mobile-menu-container .search-result-item:hover {
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
        padding: 15px;
        text-align: center;
        color: #999;
        font-size: 13px;
    }

    .mobile-menu-container .search-loading {
        padding: 15px;
        text-align: center;
        color: #666;
        font-size: 13px;
    }

    /* Scrollbar for mobile */
    .mobile-menu-container .search-results-dropdown::-webkit-scrollbar {
        width: 4px;
    }

    .mobile-menu-container .search-results-dropdown::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .mobile-menu-container .search-results-dropdown::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 2px;
    }
    .search-section-header {
        font-weight: 600;
        font-size: 13px;
        color: #444;
        padding: 6px 12px;
        background: #f8f9fa;
        border-radius: 4px;
        margin-top: 5px;
    }

    .mobile-menu-container .search-result-item hr {
        margin: 6px 0;
    }
</style>

<script>
    (function() {
        // Keep menu open when search is focused
        window.addEventListener('load', function() {
            var searchInput = document.querySelector('.mobile-menu-container input[name="search_product"]');
            var body = document.body;
            var isSearchFocused = false;

            if (!searchInput) {
                return;
            }

            searchInput.addEventListener('focus', function() {
                isSearchFocused = true;
            });

            searchInput.addEventListener('blur', function() {
                isSearchFocused = false;
            });

            var observer = new MutationObserver(function(mutations) {
                if (isSearchFocused) {
                    mutations.forEach(function(mutation) {
                        if (mutation.attributeName === 'class') {
                            var targetNode = mutation.target;
                            if (!targetNode.classList.contains('mmenu-active')) {
                                targetNode.classList.add('mmenu-active');
                            }
                        }
                    });
                }
            });

            observer.observe(body, {
                attributes: true
            });
        });

            const mobileInput = document.querySelector('#mobile-search-input');
            const resultsDropdown = document.querySelector('#mobileSearchResults');
            const resultsList = document.querySelector('#mobileSearchResultsList');
            const loadingState = document.querySelector('#mobileSearchLoading');
            const noResultsState = document.querySelector('#mobileNoResults');
            const baseURL = window.location.origin;

            if (!mobileInput) return;

            let searchTimeout;

            mobileInput.addEventListener('input', function () {
                const query = this.value.trim();

                if (query.length < 2) {
                    resultsDropdown.classList.remove('show');
                    return;
                }

                clearTimeout(searchTimeout);

                loadingState.style.display = 'block';
                resultsList.style.display = 'none';
                noResultsState.style.display = 'none';
                resultsDropdown.classList.add('show');

                searchTimeout = setTimeout(() => {
                    fetch(`{{ route('search.suggestions') }}?q=${encodeURIComponent(query)}`)
                        .then(res => res.json())
                        .then(data => {
                            loadingState.style.display = 'none';
                            resultsList.innerHTML = ''; // clear previous

                            // --- 🟩 Show Brands ---
                            if (data.brands && data.brands.length > 0) {
                                resultsList.innerHTML += `<div class="search-section-header">Brands</div>`;
                                data.brands.forEach(brand => {
                                    resultsList.innerHTML += `
                                <a href="/product-lists?brand_id=${brand.id}" class="search-result-item d-flex align-items-center">
                                    <img src="${baseURL}/${brand.image}" alt="${brand.brand_name}" class="search-result-img me-2">
                                    <div class="search-result-info">
                                        <p class="search-result-title">${brand.brand_name}</p>
                                    </div>
                                </a>
                            `;
                                });
                                resultsList.innerHTML += `<hr>`;
                            }

                            // --- 🟨 Show Products ---
                            if (data.products && data.products.length > 0) {
                                resultsList.innerHTML += `<div class="search-section-header">Products</div>`;
                                data.products.forEach(product => {
                                    resultsList.innerHTML += `
                                <a href="/product-details/${product.id}" class="search-result-item d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <img src="${baseURL}/${product.image}" alt="${product.product_name}" class="search-result-img me-2">
                                        <div class="search-result-info">
                                            <p class="search-result-title">${product.product_name}</p>
                                            ${product.brand_name ? `<p class="search-result-category">${product.brand_name}</p>` : ''}
                                        </div>
                                    </div>
                                    <p class="search-result-price">${product.product_price} BDT</p>
                                </a>
                            `;
                                });
                            }

                            if (
                                (!data.brands || data.brands.length === 0) &&
                                (!data.products || data.products.length === 0)
                            ) {
                                noResultsState.style.display = 'block';
                                resultsList.style.display = 'none';
                            } else {
                                noResultsState.style.display = 'none';
                                resultsList.style.display = 'block';
                            }
                        })
                        .catch(err => {
                            console.error('Error:', err);
                            loadingState.style.display = 'none';
                            noResultsState.innerHTML = '<i class="w-icon-exclamation-triangle"></i><p>Error loading results</p>';
                            noResultsState.style.display = 'block';
                        });
                }, 300);
            });

            // Hide suggestions on outside click
            document.addEventListener('click', function (e) {
                if (!mobileInput.contains(e.target) && !resultsDropdown.contains(e.target)) {
                    resultsDropdown.classList.remove('show');
                }
            });

            // Press enter -> go to first result
            mobileInput.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' && resultsDropdown.classList.contains('show')) {
                    const firstResult = resultsList.querySelector('.search-result-item');
                    if (firstResult) {
                        e.preventDefault();
                        window.location.href = firstResult.getAttribute('href');
                    }
                }
            });

    })();

</script>
