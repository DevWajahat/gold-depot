@extends('layout.web.app')

@section('content')
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="details fix-pading">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10 col-12">
                    <div class="detail-img">
                        <img class="img-fluid" src="{{ asset('images/products/featured/' . $product?->image) }}"
                            alt="">
                    </div>
                    <div class="d-flex mt-3 gap-3">

                        @forelse($product?->productImages as $productImage)
                            <div class="gallery">

                                <img class="img-fluid" src="{{ asset('images/products/' . $productImage->image) }}"
                                    alt="">
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="detail-pr-area">
                        <h4 class="inner-financial-hd detail-pr-hd">{{ $product?->name }}</h4>
                        <p class="shipping-para pr"><strong>${{ $product?->price }}</strong></p>
                        <p class="para my-3">
                            {{ $product?->short_description }}
                        </p>
                        <form action="{{ route('cart.store', $product?->id) }}" method="post">
                            @csrf
                            <div class="d-flex align-items-center add-input-area">

                                <input type="hidden" name="name" value="{{ $product?->name }}">
                                <input type="hidden" name="image" value="{{ $product?->image }}">
                                <input type="hidden" name="category" value="{{ $product?->category->name }}">
                                <input type="hidden" name="price" value="{{ $product?->price }}">

                                <label for="Quantity" class="form-label">Quantity: &nbsp;</label>
                                <input type="number" min="1" placeholder="" name="quantity" class="form-input-add"
                                    value="1">
                                <input type="submit" class="primary-btn" value="Add To Cart">
                            </div>

                        </form>
                        <p class="para">Category {{ $product?->category->name }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="review-area-detail">
                        <ul class="review-detail-list">
                            <li class="active" data-tab="description">Descrioption</li>
                            <li data-tab="revuiews">Reviews</li>
                        </ul>
                    </div>
                </div>
                <div class="col-12">
                    <div class="des-content mb-3" data-content="revuiews">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <div class="container bootstrap snippets bootdey">
                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="blog-comment">
                                                    <h3 class="text-warning">Reviews</h3>
                                                    <hr />
                                                    <ul class="comments">

                                                        @forelse($product?->reviews as $review)
                                                            <li class="clearfix">
                                                                <img src="https://bootdey.com/img/Content/user_2.jpg"
                                                                    class="avatar" alt="">
                                                                <div class="post-comments">
                                                                    <p class="meta">
                                                                        {{ $review->created_at }}
                                                                        <a href="#">{{ $review->full_name }} as
                                                                            ({{ $review->user->first_name . ' ' . $review->user->last_name }})
                                                                        </a>
                                                                    </p>
                                                                    <p>
                                                                        {{ $review->message }}
                                                                    </p>
                                                                </div>
                                                            </li>
                                                        @empty
                                                        @endforelse

                                                    </ul>
                                                </div>

                                               
                                                @if(count($product->orders->where('user_id',auth()->id())))
                                                <form action="{{ route('store.reviews', $id) }}" method="post"
                                                    class="contact-form">
                                                    @csrf
                                                    <div class="contact-form-inner">
                                                        <p class="para white">Be the first to review “20 Peace Dollars,
                                                            Mixed Dates,
                                                            Brilliant Uncirculated (20 Coin Roll)”
                                                            Your email address will not be published. Required fields
                                                            are marked *</p>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <textarea name="message" id="" class="form-input @error('message') is-invalid  @enderror"
                                                                    placeholder="Your Review"></textarea>
                                                                @error('message')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-12">
                                                                <input type="text"
                                                                    class="form-input @error('full_name') is-invalid  @enderror"
                                                                    name="full_name" placeholder="Full Name">
                                                                @error('full_name')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-12">
                                                                <input type="email"
                                                                    class="form-input @error('email') is-invalid  @enderror"
                                                                    name="email" placeholder="Email">
                                                                @error('email')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-check mt-4">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="" id="flexCheckDefault">
                                                                    <label class="form-check-label white"
                                                                        for="flexCheckDefault">
                                                                        Save my name, email, and website in this browser
                                                                        for the next
                                                                        time I comment.
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <button class="primary-btn">SUbmit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                @endif

                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="des-content active" data-content="description">


                        <h4 class="latest-hd detail">{{ $product?->long_description }}</h4>

                    </div>
                </div>

                @forelse($product?->category?->products as $product)
                    <x-product-card :id="$product?->id" :name="$product?->name" :price="$product?->price"
                        :image="$product?->image"></x-product-card>
                @empty
                @endforelse
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
