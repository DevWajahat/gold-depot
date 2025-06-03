@extends('layout.web.app')

@section('content')
    <section class="cart-section sec-pd fix-pading">
        <div class="container">
            <div class="row">
                <div class="col-12 m-0">
                    <div class="sub-sec">
                        <h1 class="cart-hd">Checkout</h1>
                        <div class="return-area">
                            <p>
                                Returning customer?
                            </p>
                            <a href="{{ route('login') }}">Click here to login</a>
                        </div>
                    </div>
                </div>


            </div>
            <form action="{{ route('checkout.store') }}" method="post" class="mt-5" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-between">
                    <div class="col-lg-3 col-md-6 col-12 m-0">
                        <div class="checkout-card-area">
                            <h4>SHIPPING DETAILS</h4>
                            <h5>required fields</h5>
                            <div class="mb-2">
                                <label for="">Full Name</label>
                                <input type="text" value="{{ old('full_name') }}" name="full_name"
                                    class="@error('full_name') is-invalid @enderror">
                                @error('full_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="">Country</label>
                                <input type="text" name="country" value="{{ old('country') }}"
                                    class="@error('country') is-invalid @enderror">
                                @error('country')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="">City</label>
                                <input type="text" name="city" value="{{ old('city') }}"
                                    class="@error('city') is-invalid @enderror">
                                @error('city')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="">Street Address</label>
                                <input type="text" value="{{ old('address') }}" name="address"
                                    class="@error('address') is-invalid @enderror">
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="">Postal Code/ ZIP</label>
                                <div class="postal-area">
                                    <input type="number" value="{{ old('zip_code') }}" name="zip_code"
                                        class="@error('zip_code') is-invalid @enderror">
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


                            {{-- <div class="mt-5 mb-3">
                                <h4>ADDITIONAL OPTIONS</h4>
                                <div class="note-area">
                                    <textarea></textarea>
                                </div>

                                <button class="add-address-btn note-btn p-0" type="button"><i class="fa-solid fa-plus"></i>
                                    Add a note to this order</button>
                                <div class="coupan-area">
                                    <input type="text">
                                    <button class="primary-btn mt-0">apply</button>
                                </div>
                                <button class="add-address-btn coupan-btn p-0" type="button"><i
                                        class="fa-solid fa-plus"></i> Apply a coupon code</button>

                            </div> --}}
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
                                            @foreach (session()->get('cart') as $id => $cart)
                                                <h4 class="subttl-hd mt-2">{{ $cart['name'] }} x{{ $cart['quantity'] }}
                                                </h4>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="col-lg-6 col-md-5 col-6 m-0">
                                        @if (session()->has('cart') && count(session()->get('cart')))
                                            @foreach (session()->get('cart') as $id => $cart)
                                                <p class="subttl-para mt-2" id="subTotal">
                                                    ${{ $cart['price'] * $cart['quantity'] }}</p>
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
                                            <p class="subttl-para" id="subTotal">${{ $subTotal }}</p>
                                            <input type="hidden" name="sub_total" value={{ $subTotal }}>
                                        </div>
                                    </div>
                                </div>


                                <div class="sub-total">
                                    <div class="row align-items-center ">
                                        <div class="col-lg-6 col-md-5 col-6 m-0">
                                            <h4 class="subttl-hd">SHIPPING</h4>
                                        </div>
                                        <div class="col-lg-6 col-md-5 col-6 m-0">
                                            <p class="subttl-para" id="shipping">{{ $shipping }}</p>
                                            <input type="text" style="display:none" name="shipping"  value="{{ $shipping == 'FREE SHIPPING' ? 0 : $shipping  }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="sub-total">
                                <div class="row align-items-center ">
                                    <div class="col-lg-6 col-md-5 col-6 m-0">
                                        <h4 class="subttl-hd">SALES</h4>
                                    </div>
                                    <div class="col-lg-6 col-md-5 col-6 m-0">
                                        <p class="subttl-para">$23</p>
                                    </div>
                                </div>
                            </div>
                                <div class="sub-total">
                                    <div class="row align-items-center ">
                                        <div class="col-lg-6 col-md-5 col-6 m-0">
                                            <h4 class="subttl-hd">COUPON</h4>
                                        </div>
                                        <div class=" col-md-6 col-6  d-flex justify-content-end">
                                            <button class="ml-5subttl-para btn couponBtn" id="couponBtn">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                                    height="24" fill="currentColor">
                                                    <path
                                                        d="M11 11V7H13V11H17V13H13V17H11V13H7V11H11ZM12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20Z">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="d-flex justify-content-end coupon-hidden" style="display: none">
                                            <input type="text" style="display: none" id="couponInput" name=""
                                                class="">
                                            <br>
                                            <button style="display: none" class="btn btn-light " id="couponSubmitBtn">Apply
                                                Coupon</button>

                                            <p class="text-success" id="flashMessage"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="sub-total">
                                    <div class="row align-items-center ">
                                        <div class="col-lg-6 col-md-5 col-6 m-0">
                                            <h4 class="subttl-hd">TOTAL</h4>
                                        </div>
                                        <div class="col-lg-6 col-md-5 col-6 m-0">
                                            @if ($shipping == 'FREE SHIPPING')
                                                <p class="subttl-para" id="total">${{ $subTotal }}</p>
                                                <input type="text" style="display: none" name="total" id="total" value="{{ $subTotal }}">
                                            @else
                                                <p class="subttl-para" id="totalValue">${{ $total }}</p>
                                                <input type="text" style="display: none" name="total" id="total" value="{{ $total }}">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="mt-5">
                                    <h4>PAYMENT METHOD</h4>
                                    <label class="form-check-label payment-radio" for="flexRadioDefault1">
                                        <input class="form-check-input" type="checkbox" name="flexRadioDefault"
                                            id="flexRadioDefault1" onclick="toggleCardInput()">
                                        Cash on Delivery
                                    </label>
                                </div>
                                <div class="card-main-area">
                                    <div class="mb-2">
                                        <input type="text" class="" placeholder="Card Number">
                                    </div>
                                    <div class="mb-2 card-input-area ">
                                        <input type="text" class="" placeholder="M M">
                                        <input type="text" class="" placeholder="YY">
                                        <input type="text" class="" placeholder="CVC">
                                    </div>
                                </div> --}}
                                <label class="form-check-label payment-radio tearm-label" for="flexRadioDefault2">
                                    <input class="form-check-input" type="checkbox" name="flexRadioDefault"
                                        id="flexRadioDefault2">
                                    I have read and agree to the website terms and conditions
                                </label>
                                <button class="primary-btn" type="submit">Place Order</button>
                            </div>
                        </div>
                    </div>

            </form>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        var total = document.getElementById("total").value;
        console.log(total);


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
                    url: "applyCoupon/" + couponCode + "/" + "724",
                    type: 'GET',
                    success: function(response) {
                        console.log(response);
                        $('#flashMessage').text(response.message);
                        $('#total').text(`$`+response.total);
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


        // notBtn.addEventListener("click", function() {
        //     noteArea.classList.toggle("active")
        //     if (icon.classList.contains("fa-plus")) {
        //         icon.classList.remove("fa-plus");
        //         icon.classList.add("fa-minus");
        //     } else {
        //         icon.classList.remove("fa-minus");
        //         icon.classList.add("fa-plus");
        //     }
        // })

        // cpBtn.addEventListener("click", function() {
        //     cpArea.classList.toggle("active")
        //     if (icon2.classList.contains("fa-plus")) {
        //         icon2.classList.remove("fa-plus");
        //         icon2.classList.add("fa-minus");
        //     } else {
        //         icon2.classList.remove("fa-minus");
        //         icon2.classList.add("fa-plus");
        //     }
        // })


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
