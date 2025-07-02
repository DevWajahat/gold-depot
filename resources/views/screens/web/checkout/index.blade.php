@extends('layout.web.app')

@section('content')
    <section class="cart-section sec-pd fix-pading">
        <div class="container">
            <div class="row">
                <div class="col-12 m-0">
                    <div class="sub-sec">
                        <h1 class="cart-hd">Checkout</h1>

                    </div>
                </div>


            </div>

            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</strong>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif


            <form id="checkoutForm" action="{{ route('checkout.store') }}" method="post" class="mt-5"
                enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-between">
                    <div class="col-lg-3 col-md-6 col-12 m-0">
                        <div class="checkout-card-area">
                            <h4>SHIPPING DETAILS</h4>
                            <h5>required fields</h5>
                            <div class="mb-2">
                                <label for="">Full Name</label>
                                <input type="text" value="{{ old('full_name') }}" name="full_name"
                                    class="@error('full_name') is-invalid @enderror" id="fullName">
                                @error('full_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="">Country</label>
                                <input type="text" name="country" value="{{ old('country') }}"
                                    class="@error('country') is-invalid @enderror" id="country">
                                @error('country')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="">City</label>
                                <input type="text" name="city" value="{{ old('city') }}"
                                    class="@error('city') is-invalid @enderror" id="city">
                                @error('city')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="">State</label>
                                <input type="text" name="state" value="{{ old('state') }}"
                                    class="@error('state') is-invalid @enderror" id="state">
                                @error('state')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="">Street Address</label>
                                <input type="text" value="{{ old('address') }}" name="address"
                                    class="@error('address') is-invalid @enderror" id="streetAddress">
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="">Postal Code/ ZIP</label>
                                <div class="postal-area">
                                    <input type="number" value="{{ old('zip_code') }}" name="zip_code"
                                        class="@error('zip_code') is-invalid @enderror" id="zipCode">
                                    @error('zip_code')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <span>Enter ZIP for City & State</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 m-0">
                        <div class="checkout-card-area ">
                            <h4>CONTACT INFORMATION</h4>
                            <h5>required fields</h5>
                            {{-- <div class="mb-2">
                                <label for="">Email</label>
                                <input type="text" name="email" class=" @error('email') is-invalid @enderror">
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div> --}}
                            <div class="mb-2">
                                <label for="">Phone</label>
                                <input type="number" value="{{ old('phone') }}" name="phone" id="phone"
                                    class="@error('phone')  is-invalid  @enderror">
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 m-0">
                        <div class="checkout-card-area contactarea">
                            <h4>Your Order</h4>
                            <h5></h5>

                            <div class="sub-total">
                                <div class="row align-items-center ">
                                    <div class="col-lg-6 col-md-5 col-6 m-0">
                                        <h4 class="subttl-hd">Products</h4>
                                        @if (session()->has('cart') && count(session()->get('cart')))
                                            @foreach (session()->get('cart')['items'] as $id => $cart)
                                                <h4 class="subttl-hd mt-2">{{ $cart['name'] }} x{{ $cart['quantity'] }}
                                                </h4>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="col-lg-6 col-md-5 col-6 m-0">
                                        @if (session()->has('cart') && count(session()->get('cart')))
                                            @foreach (session()->get('cart')['items'] as $id => $cart)
                                                <p class="subttl-para mt-2" id="subTotal">
                                                    ${{ $cart['product_total'] }}</p>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="total total-area">
                                <div class="sub-total">
                                    <div class="row align-items-center ">
                                        <div class="col-lg-6 col-md-5 col-6 m-0">
                                            <h4 class="subttl-hd">subtotal</h4>
                                        </div>
                                        <div class="col-lg-6 col-md-5 col-6 m-0">
                                            <p class="subttl-para" id="subTotal">
                                                ${{ session()->get('cart')['sub_total'] }}</p>
                                            <input type="hidden" name="sub_total">
                                        </div>
                                    </div>
                                </div>


                                <div class="sub-total">
                                    <div class="row align-items-center ">
                                        <div class="col-lg-6 col-md-5 col-6 m-0">
                                            <h4 class="subttl-hd">SHIPPING</h4>
                                        </div>
                                        {{-- @dd(session()->get('cart')['shipping']) --}}
                                        @if (session()->get('cart')['shipping'] == 0)
                                            <div class="col-lg-6 col-md-5 col-6 m-0">
                                                <p class="subttl-para" id="shipping">FREE SHIPPING</p>
                                            </div>
                                        @else
                                            <div class="col-lg-6 col-md-5 col-6 m-0">
                                                <p class="subttl-para" id="shipping">
                                                    {{ session()->get('cart')['shipping'] }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="sub-total">
                                    <div class="row align-items-center ">
                                        <div class="col-lg-6 col-md-5 col-6 m-0">
                                            <h4 class="subttl-hd">COUPON</h4>
                                        </div>
                                        <div class=" col-md-6 col-6  d-flex justify-content-end">
                                            <button class="ml-5subttl-para btn couponBtn" id="couponBtn">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    width="24" height="24" fill="currentColor">
                                                    <path
                                                        d="M11 11V7H13V11H17V13H13V17H11V13H7V11H11ZM12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20Z">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="d-flex justify-content-end coupon-hidden" style="display: none">
                                            <input type="text" style="display: none" id="couponInput"
                                                name="coupon_value" class="">
                                            <br>
                                            <button style="display: none" class="btn btn-light "
                                                id="couponSubmitBtn">Apply
                                                Coupon</button>

                                            <p class="" id="flashMessage"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="sub-total">
                                    <div class="row align-items-center ">
                                        <div class="col-lg-6 col-md-5 col-6 m-0">
                                            <h4 class="subttl-hd">TOTAL</h4>
                                        </div>
                                        <div class="col-lg-6 col-md-5 col-6 m-0">

                                            <p class="subttl-para" id="total">${{ session()->get('cart')['total'] }}
                                            </p>


                                        </div>
                                    </div>
                                </div>
                                <label for="">Card Holder Name</label>
                                <input id="card-holder-name" type="text">

                                <!-- Stripe Elements Placeholder -->
                                <div id="card-element"></div>
                                {{-- <button
                                    class="mt-3 btn-success btn">
                                    Verified Payment
                                </button> --}}

                                <label class="form-check-label payment-radio tearm-label" for="flexRadioDefault2">
                                    <input class="form-check-input" type="checkbox" name="radio"
                                        id="flexRadioDefault2">
                                    I have read and agree to the website terms and conditions
                                </label>
                                @error('radio')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <button id="card-button" class="primary-btn" data-secret="{{ $intent->client_secret }}"
                                    type="submit">Place Order</button>
                            </div>
                        </div>
                    </div>

            </form>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        const stripe = Stripe('{{ env('STRIPE_KEY') }}');
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');
        const checkoutForm = document.getElementById('checkoutForm');

        checkoutForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const {
                paymentMethod,
                error
            } = await stripe.createPaymentMethod(
                'card', cardElement, {
                    billing_details: {
                        name: cardHolderName.value
                    }
                }
            );

            if (error) {
                console.log(error);
                toastr.error(error.message ||
                "An error occurred with your payment method.");
            } else {
                console.log(paymentMethod);
                cardButton.classList.remove("btn-success");
                cardButton.classList.add("disabled");

                var fullName = $('#fullName').val();
                var country = $('#country').val();
                var city = $('#city').val();
                var state = $('#state').val();
                var streetAddress = $('#streetAddress').val();
                var zipCode = $('#zipCode').val();
                var phone = $('#phone').val();
                var couponInput = $("#couponInput").val();

                // Create a FormData object
                var formData = new FormData();
                formData.append('_token', "{{ csrf_token() }}");
                formData.append('full_name', fullName);
                formData.append('country', country);
                formData.append('city', city);
                formData.append('state', state);
                formData.append('address', streetAddress);
                formData.append('zip_code', zipCode);
                formData.append('phone', phone);
                formData.append('coupon_value', couponInput);
                formData.append('radio', 1);
                formData.append('paymentMethodId', paymentMethod.id);

                console.log(fullName + " " + country + " " + city + " " + state + " " + streetAddress + " " +
                    zipCode + " " + phone + " ");
                console.log(fullName);

                $.ajax({
                    type: 'POST',
                    url: "{{ route('checkout.store') }}",
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(response) {
                        window.location.href = "{{ route('checkout.confirm') }}";
                    },
                    error: function(xhr, status, error) {

                        console.error("AJAX error:", status, error);
                        try {
                            console.log(xhr)
                            const responseJson = JSON.parse(xhr.responseText);
                            toastr.error(responseJson.message ||
                                "An error occurred during checkout.");

                        } catch (e) {
                            toastr.error("An unknown error occurred.");
                        }

                        cardButton.classList.add("btn-success");
                        cardButton.classList.remove("disabled");
                    }
                });

                document.getElementById('card-element').style.display = "none";
                cardHolderName.remove();
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#couponBtn').click(function(event) {
                event.preventDefault();
            });
        });

        $(document).ready(function() {
            $('#couponSubmitBtn').click(function(event) {
                event.preventDefault();
            });
        });

        $(document).ready(function() {
            $('#couponBtn').click(function() {
                $('.coupon-hidden').toggle();
                $('#couponInput').toggle();
                $('#couponSubmitBtn').toggle();
            });
        });
        $(document).ready(function() {
            $('#couponSubmitBtn').on('click', function() {
                var couponCode = $('#couponInput').val();

                $.ajax({
                    url: "check-coupon/" + couponCode + "/",
                    type: 'GET',
                    success: function(response) {
                        console.log(response);
                        $('#flashMessage').text(response.message);
                        $('#flashMessage').css("color", response.class);
                        $('#total').text(`$` + response.total);
                        $('#totalValue').val(response.total);
                        if (response.class == 'green') {
                            $('#couponInput').attr("readonly", "");

                        }
                    }
                })
            });
        });
    </script>

    <script>
        var notBtn = document.querySelector(".note-btn");
        // var icon = notBtn.querySelector("i");
        var noteArea = document.querySelector(".note-area");
        var cpBtn = document.querySelector(".coupan-btn");
        // var icon2 = cpBtn.querySelector("i");
        var cpArea = document.querySelector(".coupan-area");



        function toggleCardInput() {
            var checkbox = document.getElementById("flexRadioDefault1");
            var cardInputArea = document.querySelector(".card-main-area");

            if (checkbox.checked) {
                cardInputArea.style.display = "none";
            } else {
                cardInputArea.style.display = "block";
            }
        }
    </script>
@endpush
