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

                                <div class="container py-5" style="max-width: 700px;">
                                    <!-- Set fixed width like accordion -->


                                    <div class="mb-4">
                                        <label for="sortSelect" class="form-label fw-bold">Sort By Price:</label>
                                        <select id="sortSelect" class="form-select">
                                            <option value="high">High to Low</option>
                                            <option value="low">Low to High</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="sortSelect" class="form-label fw-bold">Sort By Date:</label>
                                        <select id="sortSelect" class="form-select">
                                            <option value="low">old to new</option>
                                            <option value="low">new to old</option>
                                        </select>
                                    </div>
                                    <div class="accordion" id="mainAccordion">

                                        <!-- Main Accordion 1 -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="mainHeadingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#mainCollapseOne" aria-expanded="true"
                                                    aria-controls="mainCollapseOne">
                                                    color
                                                </button>
                                            </h2>
                                            <div id="mainCollapseOne" class="accordion-collapse collapse show"
                                                aria-labelledby="mainHeadingOne" data-bs-parent="#mainAccordion">
                                                <div class="accordion-body">

                                                    <!-- Nested Accordion inside Main 1 -->
                                                    <div class="d-flex justify-content-between align-items-center gap-2">
                                                        <label for="greenCheck" class="fw-normal mb-0">green</label>
                                                        <input type="checkbox" id="greenCheck">

                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <!-- Main Accordion 2 -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="mainHeadingTwo">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#mainCollapseTwo"
                                                    aria-expanded="false" aria-controls="mainCollapseTwo">
                                                    size
                                                </button>
                                            </h2>
                                            <div id="mainCollapseTwo" class="accordion-collapse collapse"
                                                aria-labelledby="mainHeadingTwo" data-bs-parent="#mainAccordion">
                                                <div class="accordion-body">

                                                    <!-- Nested Accordion inside Main 2 -->
                                                    <div class="d-flex justify-content-between align-items-center gap-2">
                                                        <label for="greenCheck" class="fw-normal mb-0">23</label>
                                                        <input type="checkbox" id="greenCheck">

                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Main Accordion 3 -->
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="mainHeadingThree">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#mainCollapseThree"
                                                        aria-expanded="false" aria-controls="mainCollapseThree">
                                                        weight
                                                    </button>
                                                </h2>
                                                <div id="mainCollapseThree" class="accordion-collapse collapse"
                                                    aria-labelledby="mainHeadingThree" data-bs-parent="#mainAccordion">
                                                    <div class="accordion-body">

                                                        <!-- Nested Accordion inside Main 3 -->
                                                        <div
                                                            class="d-flex justify-content-between align-items-center gap-2">
                                                            <label for="greenCheck" class="fw-normal mb-0">32kg</label>
                                                            <input type="checkbox" id="greenCheck">

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="range-area">
                                            <div class="slider-container">
                                                <input type="range" min="0" max="100" value="0"
                                                    id="minRange" class="slider min-slider"
                                                    style="background: linear-gradient(to right, rgb(193, 193, 193) 0%, rgb(79, 126, 255) 0%, rgb(79, 126, 255) 99%, rgb(221, 221, 221) 99%);">
                                                <input type="range" min="0" max="100" value="100"
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
                                                        $<span id="maxValue">99.00</span>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>

                    </div>
                </div>

            </div>
            <div class="col-lg-9">
                <div class="row">
                    @foreach ($Products as $product)
                        <x-product-card :id="$product->id" :name="$product->name" :price="$product->price"
                            :image="$product->image"></x-product-card>
                    @endforeach

                    {{ $Products->links() }}
                </div>
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
     const minRange = document.getElementById("minRange");
            const maxRange = document.getElementById("maxRange");
            const minValueDisplay = document.getElementById("minValue");
            const maxValueDisplay = document.getElementById("maxValue");

            if (minRange) {
                minRange.addEventListener("input", () => {
                    console.log();

                    if (parseInt(minRange.value) > parseInt(maxRange.value)) {
                        minRange.value = parseInt(maxRange.value).toFixed(2);
                    }
                    minValueDisplay.textContent = parseInt(minRange.value).toFixed(2);
                    updateSliderTrack();
                });
            }

            if (maxRange) {
                maxRange.addEventListener("input", () => {
                    if (parseInt(maxRange.value) < parseInt(minRange.value)) {
                        maxRange.value = parseInt(minRange.value).toFixed(2);
                    }
                    maxValueDisplay.textContent = parseInt(maxRange.value).toFixed(2);
                    updateSliderTrack();
                });
            }

            if (minRange && maxRange) {
                function updateSliderTrack() {
                    const percentMin = (minRange.value / maxRange.max) * 100;
                    const percentMax = (maxRange.value / maxRange.max) * 100;

                    minRange.style.background = `linear-gradient(to right, #c1c1c1
     ${percentMin}%, #4F7EFF ${percentMin}%, #4F7EFF ${percentMax}%, #ddd ${percentMax}%)`;
                    maxRange.style.background = minRange.style.background;
                }
                updateSliderTrack();
            }




</script>
@endpush
