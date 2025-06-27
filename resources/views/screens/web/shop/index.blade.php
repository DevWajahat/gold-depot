@extends('layout.web.app')

@section('content')
    <section class="about-sec">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="inner-banner-hd">Shop</h2>
                </div>
            </div>
        </div>
    </section>
    <section class="recom-sec fix-pading">
        <div class="container">
            <div class="row justify-content-center ">

                <div class="col-lg-10 col-md-12 col-12 mb-5">
                    <div class="text-center">
                        <h2 class="section-hd-primary">Our Featured</h2>
                        <h3 class="section-hd-secondary">RECOMMENDED FOR YOU</h3>
                        <p class="para ">Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque iste autem veniam
                            debitis accusantium <br> velit neque dignissimos unde ex quibusdam saepe minima obcaecati
                            provident</p>
                    </div>
                </div>



            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="d-flex justify-content-between align-items-center mb-5 sorting-wrapper">
                        <h4 class="text-start text-uppercase mb-0">Filter</h4>
                        <i class="fa-solid fa-filter" style="font-size: 18px"></i>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="" id="filterProducts">

                                <div class="container py-5" style="max-width: 700px;">
                                    <!-- Set fixed width like accordion -->

                                    <div class="par">
                                        <div class="mb-4">
                                            <label for="sortSelect" class="form-label fw-bold">Sort By Price:</label>
                                            <select id="sortByPrice" name="" class="form-select">
                                                <option value="desc">High to Low</option>
                                                <option value="asc">Low to High</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label for="sortSelect" class="form-label fw-bold">Sort By Date:</label>
                                            <select id="sortByDate" class="form-select">
                                                <option value="asc">Old to New</option>
                                                <option value="desc">New to Old</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="accordion" id="mainAccordion">

                                        <!-- Main Accordion 1 -->
                                        @foreach ($attributes as $attribute)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="Heading{{ $attribute->id }}">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#Collapse{{ $attribute->id }}" aria-expanded="true"
                                                        aria-controls="mainCollapseOne">
                                                        {{ $attribute->name }}
                                                    </button>
                                                </h2>
                                                <div id="Collapse{{ $attribute->id }}" class="accordion-collapse collapse"
                                                    aria-labelledby="Heading{{ $attribute->id }}"
                                                    data-bs-parent="#mainAccordion">
                                                    <div class="accordion-body">
                                                        <!-- Nested Accordion inside Main 1 -->
                                                        @foreach ($attribute->variants as $variant)
                                                            <div
                                                                class="d-flex justify-content-between align-items-center gap-2">
                                                                <label for="greenCheck"
                                                                    class="fw-normal mb-0">{{ $variant->name }}</label>
                                                                <input type="checkbox" class="variantsCheck"
                                                                    value="{{ $variant->name }}" name="variants[]"
                                                                    id="variantsCheck">
                                                            </div>
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach


                                        <div class="range-area">
                                            <div class="slider-container">
                                                <input type="range" min="{{ $minimumPrice }}" max="{{ $maximumPrice }}" value="0"
                                                    id="minRange" class="slider min-slider"
                                                    style="background: linear-gradient(to right, rgb(193, 193, 193) 0%, rgb(79, 126, 255) 0%, rgb(79, 126, 255) 99%, rgb(221, 221, 221) 99%);">
                                                <input type="range" min="" max="{{ $maximumPrice }}" value="{{ $maximumPrice }}"
                                                    id="maxRange" class="slider max-slider"
                                                    style="background: linear-gradient(to right, rgb(193, 193, 193) 0%, rgb(79, 126, 255) 0%, rgb(79, 126, 255) 99%, rgb(221, 221, 221) 99%);">
                                            </div>
                                            <div class=" d-flex justify-content-between">
                                                <div class="range-values">
                                                    <div class="style-amount">
                                                        $<span id="minValue">0.00</span>
                                                    </div>
                                                    <p>-</p>
                                                    <div class="style-amount">
                                                        $<span id="maxValue">9999.00</span>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
                
                <div class="col-lg-9">
                    <div class="row product-card">
                        @foreach ($Products as $product)
                            <x-product-card :id="$product->id" :name="$product->name" :price="$product->price"
                                :image="$product->image"></x-product-card>
                        @endforeach
                    </div>
                    <div id="pagination-container" class="mt-4">
                        {{ $Products->links() }}
                    </div>

            </div>

        </div>
    </section>
    <div class="shop-dollar-sec">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-11 col-md-11 col-12">
                    <div class="dollar-sec">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-12">
                                    <div class="dollar-img-area">
                                        <img class="img-fluid" src="{{ asset('assets/web/images/dollar2.png') }}"
                                            alt="">
                                        <img class="img-fluid" src="{{ asset('assets/web/images/dollar1.png') }}"
                                            alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-12">
                                    <div class="dollar-content">
                                        <h3 class="dollar-hd">Home of the Morgan
                                            Dollar Deal!</h3>
                                        <h4 class="dollar-hd-inner">Any Quantity Only $49.99/oz Over Spot</h4>
                                        <p class="para white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                                            do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        <div class="mt-4">
                                            <a href="{{ route('shop.index') }}" class="primary-btn">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <section class="logo-sec">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div>
                        <img class="img-fluid" src="{{ asset('assets/web/images/logo1.png') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="news-area">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-md-7 col-12">
                                <h4 class="news-hd">Subscribe To Our Email</h4>
                                <h5 class="latest-hd">For Latest News & Updates</h5>
                                <p class="para news-para">There are many variations of passages of Lorem Ipsum available
                                    but
                                </p>
                            </div>
                            <div class="col-lg-6 col-md-5 col-12">
                                <form action="" class="news-later-form">
                                    <input type="text" placeholder="Enter Your Email Address" class="input-form">
                                    <button class="primary-btn mt-5">Submit Now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const minRange = document.getElementById("minRange");
            const maxRange = document.getElementById("maxRange");
            const minValueDisplay = document.getElementById("minValue");
            const maxValueDisplay = document.getElementById("maxValue");

            if (minRange && maxRange && minValueDisplay && maxValueDisplay) {
                minValueDisplay.textContent = parseInt(minRange.value).toFixed(2);
                maxValueDisplay.textContent = parseInt(maxRange.value).toFixed(2);

                updateSliderTrack();

                minRange.addEventListener("input", () => {
                    if (parseInt(minRange.value) > parseInt(maxRange.value)) {
                        minRange.value = parseInt(maxRange.value);
                    }
                    minValueDisplay.textContent = parseInt(minRange.value).toFixed(2);
                    updateSliderTrack();
                    triggerFilterUpdate();
                });

                maxRange.addEventListener("input", () => {
                    if (parseInt(maxRange.value) < parseInt(minRange.value)) {
                        maxRange.value = parseInt(minRange.value);
                    }
                    maxValueDisplay.textContent = parseInt(maxRange.value).toFixed(2);
                    updateSliderTrack();
                    triggerFilterUpdate();
                });

                function updateSliderTrack() {
                    const percentMin = (minRange.value / maxRange.max) * 100;
                    const percentMax = (maxRange.value / maxRange.max) * 100;

                    const bg =
                        `linear-gradient(to right, #c1c1c1 ${percentMin}%, #4F7EFF ${percentMin}%, #4F7EFF ${percentMax}%, #ddd ${percentMax}%)`;
                    minRange.style.background = bg;
                    maxRange.style.background = bg;
                }
            }


            function getFilterValues() {
                const selectPrice = $('#sortByPrice').val();
                const selectDate = $('#sortByDate').val();
                const variants = [];
                $('input[name^="variants"]:checked').each(function() {
                    variants.push($(this).val());
                });
                const minPrice = $('#minRange').val();
                const maxPrice = $('#maxRange').val();
                return {
                    selectPrice,
                    selectDate,
                    variants,
                    minPrice,
                    maxPrice
                };
            }


            function triggerFilterUpdate() {
                const {
                    selectPrice,
                    selectDate,
                    variants,
                    minPrice,
                    maxPrice
                } = getFilterValues();
                fetchProducts('POST', null, selectDate, selectPrice, variants, minPrice, maxPrice);
            }


            function fetchProducts(type, pageNo, date, price, variants, minPrice, maxPrice) {
                const url = pageNo ? `{{ route('shop.index') }}?page=${pageNo}` : '{{ route('shop.index') }}';
                $.ajax({
                    type: type,
                    url: url,
                    data: {
                        _token: "{{ csrf_token() }}",
                        date: date,
                        price: price,
                        variants: variants,
                        min_price: minPrice,
                        max_price: maxPrice
                    },
                    success: function(response) {
                        let html = '';
                        response.products.data.forEach(element => {
                            let imageurl = "{{ asset('images/products/featured') }}/" + element
                                .image;
                            let productId = element.id;
                            let producturl = "{{ route('shop.details', ':productId') }}"
                                .replace(':productId', productId);

                            html += `
                            <div class="col-lg-3 col-md-6 col-12">
                                <a href="${producturl}">
                                    <div class="pro-area">
                                        <div class="text-center mb-3">
                                            <img class="img-fluid bit-img" src="${imageurl}" alt="">
                                        </div>
                                        <h4 class="inner-financial-hd">${element.name}</h4>
                                        <div class="raiting-area">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <p class="shipping-para pr"><strong>$ ${element.price} </strong></p>
                                        <div class="cart-btn-area">
                                            <button class="cart-btn"><i class="fa-solid fa-cart-shopping"></i> Add To Cart</button>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        `;
                        });


                        $('.product-card').html(html);


                        if (response.pagination) {
                            $('#pagination-container').html(response.pagination);

                        }
                        else{
                            $('#pagination-container').html("");
                        }

                        updatePaginationLinks();


                        if (pageNo) {
                            $(".page-item").removeClass("active");
                            $(".page-item").each(function() {
                                const href = $(this).find('.page-link').attr('href');
                                if (href && href.includes(`page=${pageNo}`)) {
                                    $(this).addClass("active");
                                }
                            });
                        }
                    }
                });
            }


            function updatePaginationLinks() {
                const {
                    selectPrice,
                    selectDate,
                    variants,
                    minPrice,
                    maxPrice
                } = getFilterValues();
                $('.page-link').each(function() {
                    let href = $(this).attr('href');
                    if (href && href.includes('page=')) {
                        let newHref =
                            `${href}&price=${selectPrice}&date=${selectDate}&min_price=${minPrice}&max_price=${maxPrice}`;
                        if (variants.length > 0) {
                            newHref += `&variants=${encodeURIComponent(JSON.stringify(variants))}`;
                        }
                        $(this).attr('href', newHref);
                    }
                });
            }

            fetchProducts('GET', 1, null, null, null, null, null);


            $(document).on("click", ".page-link", function(e) {
                e.preventDefault();
                const href = $(this).attr('href');
                if (!href) return;

                const urlParams = new URLSearchParams(href.split('?')[1]);
                const pageNo = urlParams.get('page');
                const selectPrice = urlParams.get('price') || $('#sortByPrice').val();
                const selectDate = urlParams.get('date') || $('#sortByDate').val();
                const variants = urlParams.get('variants') ? JSON.parse(decodeURIComponent(urlParams.get(
                    'variants'))) : [];
                const minPrice = urlParams.get('min_price') || $('#minRange').val();
                const maxPrice = urlParams.get('max_price') || $('#maxRange').val();

                fetchProducts('GET', pageNo, selectDate, selectPrice, variants, minPrice, maxPrice);
            });


            $('select, .variantsCheck').on("change", function() {
                triggerFilterUpdate();
            });
        });
    </script>
@endpush
