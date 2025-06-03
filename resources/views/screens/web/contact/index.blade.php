@extends('layout.web.app')


@section('content')
    <section class="about-sec">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="inner-banner-hd">Contact Us</h2>
                </div>
            </div>
        </div>
    </section>
    <section class="about-sec-content fix-pading contact">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <form action="{{ route('contact.store') }}" class="contact-form" method="post">
                        @csrf
                        <div class="contact-form-inner">
                            <h3 class="contact-hd">Contact</h3>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <input type="text" name="first_name" class="form-input @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" placeholder="First Name">
                                    @error('first_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <input type="text" name="last_name" class="form-input @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" placeholder="Last Name">
                                    @error('last_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <input type="text" name="email" class="form-input @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <input type="number" name="phone" class="form-input @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="Phone">
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <textarea name="message" id="" class="form-input @error('message') is-invalid @enderror" placeholder="Message">{{ old('message') }}</textarea>
                                    @error('messsage')
                                    <div class="text-danger">{{ $mesage }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button class="primary-btn">SUbmit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </section>
    <div class="about-dollar-area contact">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-11 col-md-11 col-12">
                    <div class="dollar-sec">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="dollar-img-area">
                                        <img class="img-fluid" src="{{ asset('assets/web/images/dollar2.png') }}" alt="">
                                        <img class="img-fluid" src="{{ asset('assets/web/images/dollar1.png') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="dollar-content">
                                        <h3 class="dollar-hd">Home of the Morgan
                                            Dollar Deal!</h3>
                                        <h4 class="dollar-hd-inner">Any Quantity Only $49.99/oz Over Spot</h4>
                                        <p class="para white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                                            do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        <div class="mt-4">
                                            <a href="#" class="primary-btn">Shop Now</a>
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
                        <img class="img-fluid" src="./assets/images/logo1.png" alt="">
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
                                <p class="para news-para">There are many variations of passages of Lorem Ipsum available but
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
