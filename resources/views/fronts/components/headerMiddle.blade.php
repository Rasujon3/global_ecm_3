<div class="header-middle">
    <div class="container">
        <div class="header-left mr-md-4">
            <a href="#" class="mobile-menu-toggle  w-icon-hamburger" aria-label="menu-toggle">
            </a>
            <a href="{{ url('/') }}" class="logo ml-lg-0">
                <img src="{{ asset(setting()->logo ?? 'front/assets/images/logo.png') }}" alt="logo" width="144" height="45" />
            </a>
            {{--                        <div style="position: relative;">--}}
            <form method="get" action="{{url('product-lists')}}"
                  class="header-search hs-expanded hs-round d-none d-md-flex input-wrapper">
                <div class="select-box">
                    <select id="category" name="category" class="form-control">
                        <option value="" selected disabled>All Categories</option>
                        @foreach($topCategories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="text" class="form-control" name="search_product" id="search-product"
                       placeholder="Search in..." autocomplete="off" />
                <button class="btn btn-search" type="submit">
                    <i class="w-icon-search"></i>
                </button>

                <!-- Search Results Dropdown -->
                <div class="search-results-dropdown" id="searchResults">
                    <!-- Loading State -->
                    <div class="search-loading" id="searchLoading" style="display: none;">
                        <i class="fa fa-spinner fa-spin"></i> Searching...
                    </div>

                    <!-- Results List -->
                    <div id="searchResultsList" style="display: none;">
                        <!-- Results will be populated here -->
                    </div>

                    <!-- No Results State -->
                    <div class="search-no-results" id="noResults" style="display: none;">
                        <i class="w-icon-exclamation-triangle"></i>
                        <p>No products found</p>
                    </div>
                </div>
            </form>
            <div id="search-suggestions-container" class="suggestions-container"></div>
            {{--                        </div>--}}
        </div>
        <div id="searchSuggestions" class="suggestion-box"></div>
        @include('fronts.components.headerCart')
    </div>
</div>

<style>
    .suggestions-container {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #fff;
        border: 1px solid #ddd;
        border-top: 0;
        display: none;
        z-index: 1000;
    }
    .suggestion-item {
        padding: 10px;
        cursor: pointer;
    }
    .suggestion-item:hover {
        background: #f0f0f0;
    }
    .search-results-dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #fff;
        border: 1px solid #ddd;
        border-top: none;
        border-radius: 0 0 6px 6px;
        z-index: 9999;
        padding: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .search-result-item {
        display: block;
        padding: 8px 10px;
        border-radius: 6px;
        color: #333;
        text-decoration: none;
        transition: background 0.2s ease;
    }

    .search-result-item:hover {
        background: #f7f7f7;
    }

    .search-product-img, .search-brand-logo {
        width: 40px;
        height: 40px;
        border-radius: 4px;
        object-fit: cover;
    }

    .search-section-header {
        font-weight: 600;
        font-size: 14px;
        color: #444;
        margin: 8px 0;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const input = document.querySelector('#search-product');
        const resultsDropdown = document.querySelector('#searchResults');
        const resultsList = document.querySelector('#searchResultsList');
        const loadingState = document.querySelector('#searchLoading');
        const noResultsState = document.querySelector('#noResults');
        const baseURL = window.location.origin;

        let searchTimeout;

        input.addEventListener('input', function() {
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
                        resultsList.innerHTML = ''; // Clear old results

                        // --- 🟩 SHOW BRANDS ---
                        if (data.brands && data.brands.length > 0) {
                            const brandHeader = `<div class="search-section-header">Brands</div>`;
                            resultsList.innerHTML += brandHeader;

                            data.brands.forEach(brand => {
                                resultsList.innerHTML += `
                                <a href="/product-lists?brand_id=${brand.id}" class="search-result-item d-flex align-items-center">
                                    <img src="${baseURL}/${brand.image}" alt="${brand.brand_name}" class="search-brand-logo" style="margin-right: 20px !important;">
                                    <span>${brand.brand_name}</span>
                                </a>
                            `;
                            });

                            resultsList.innerHTML += '<hr>';
                        }

                        // --- 🟨 SHOW PRODUCTS ---
                        if (data.products && data.products.length > 0) {
                            const productHeader = `<div class="search-section-header">Products</div>`;
                            resultsList.innerHTML += productHeader;

                            data.products.forEach(product => {
                                resultsList.innerHTML += `
                                <a href="/product-details/${product.id}" class="search-result-item d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <img src="${baseURL}/${product.image}" alt="${product.product_name}" class="search-product-img me-2">
                                        <div>
                                            <div class="fw-semibold">${product.product_name}</div>
                                            ${product.brand_name ? `<small class="text-muted">${product.brand_name}</small>` : ''}
                                        </div>
                                    </div>
                                    <div class="text-end text-dark fw-bold">${product.product_price} BDT</div>
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

        document.addEventListener('click', function(e) {
            if (!input.contains(e.target) && !resultsDropdown.contains(e.target)) {
                resultsDropdown.classList.remove('show');
            }
        });
    });
</script>

