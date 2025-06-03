@extends('layout.web.app')

@section('content')
    @if (session()->has('message'))
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    @endif


    <section class="cart-section sec-pd fix-pading">
        <div class="container">
            <div class="row">
                <div class="col-12 m-0">
                    <div class="sub-sec">
                        @if (session()->has('cart'))
                            <h1 class="cart-hd">Shopping Cart</h1>
                        @endif
                        @auth
                        @else
                            <div class="return-area">
                                <p>
                                    Returning customer?
                                </p>
                                <a href="{{ route('login') }}">Click here to login</a>
                            </div>
                        @endauth
                    </div>
                </div>
                {{-- @dd(count(session()->get('cart'))) --}}

                @if (session()->has('cart') && count(session()->get('cart')))
                    <div class="col-12 col-lg-12">
                        <div class="parent-table-area">
                            <table class="cart-table mt-3">
                                <tr>
                                    <th class="">
                                        ITEMS
                                    </th>
                                    <th class="">
                                        PRICE
                                    </th>
                                    <th class="qty-th">
                                        QUANTITY
                                    </th>
                                    <th class="">
                                        TOTAL
                                    </th>
                                    <th class="">

                                    </th>
                                </tr>
                                @foreach (session()->get('cart') as $id => $cart)
                                    @php
                                        $total = $cart['price'] * $cart['quantity'];
                                    @endphp
                                    <x-cart-item :name="$cart['name']" :category="$cart['category']" :price="$cart['price']" :image="$cart['image']"
                                        :quantity="$cart['quantity']" :total="$total" :dataid="$id" />
                                @endforeach
                            </table>
                        </div>
                    </div>


                    <div class="col-12 offset-lg-8 col-lg-4">
                        <div class="total total-area">
                            <div class="sub-total">
                                <div class="row align-items-center ">
                                    <div class="col-lg-6 col-md-5 col-6 m-0">
                                        <h4 class="subttl-hd">subtotal</h4>
                                    </div>
                                    <div class="col-lg-6 col-md-5 col-6 m-0">
                                        <p class="subttl-para" id="subTotal">${{ $subTotal }}</p>
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
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="sub-total">
                                <div class="row align-items-center ">
                                    <div class="col-lg-6 col-md-5 col-6 m-0">
                                        <h4 class="subttl-hd">SALES</h4>
                                    </div>
                                    <div class="col-lg-6 col-md-5 col-6 m-0">
                                        <p class="subttl-para">$23</p>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="sub-total">
                                <div class="row align-items-center ">
                                    <div class="col-lg-6 col-md-5 col-6 m-0">
                                        <h4 class="subttl-hd">COUPON</h4>
                                    </div>
                                    <div class=" col-md-6 col-6  d-flex justify-content-end">
                                        <button class="ml-5subttl-para btn" id="couponBtn">
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
                                    </div>
                                </div>
                            </div>
                            <div class="sub-total">
                                <div class="row align-items-center ">
                                    <div class="col-lg-6 col-md-5 col-6 m-0">
                                        <h4 class="subttl-hd">TOTAL</h4>
                                    </div>
                                    <div class="col-lg-6 col-md-5 col-6 m-0">
                                        @if($shipping == 'FREE SHIPPING')
                                        <p class="subttl-para" id="total">${{ $subTotal }}</p>
                                        @else

                                        <p class="subttl-para" id="total">${{ $subTotal + $shipping }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5">
                                <a class="primary-btn" href="{{ route('checkout.index') }}" class="white">Check Out </a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="container">
                        <h1>Cart Is empty</h1>

                        <h3>Start Shopping </h3>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script></script>
    <script>
        $(document).ready(function() {
            $('#couponBtn').click(function() {
                $('.coupon-hidden').toggle();
                $('#couponInput').toggle();
                $('#couponSubmitBtn').toggle();
            });
        });

        $(document).ready(function() {
            $('#couponSubmitBtn').on('click', function() {
                var couponCode = $('#couponInput').val()
                $.ajax({
                    url: "checkCoupon/" + couponCode,
                    type: 'GET',
                    success: function(response) {
                        console.log(response);
                        $('.coupon-hidden').after(
                            `<p class="text-success" id="flash" >${response.message}</p>`
                        );
                    }
                })
            });
        });




        $(document).ready(function() {
            $('.counter .increment').click(function() {
                var countElement = $(this).siblings('.count');
                var id = $(this).data('id');
                var price = parseInt($('#price').val());
                var count = Number(countElement.val());
                count++;
                let url = "cart/update/" + id;
                update(count, url, id);
                countElement.val(count);
            });

            $('.counter .decrement').click(function() {
                var countElement = $(this).siblings('.count');
                var id = $(this).data('id');
                var price = parseInt($('#price').val());
                var count = Number(countElement.val());
                if (count > 1) {
                    count--;
                    let url = "cart/update/" + id;
                    update(count, url, id);
                    countElement.val(count);
                }
            });
        })

        function update(value, url, id) {
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    value: value,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response);
                    $(`#item-total-${id}`).text(`$ ` + response.itemTotal);
                    $('#subTotal').text(`$` + response.subTotal);
                    $('#shipping').text(response.shipping);
                    $('#total').text(`$` + response.total)
                }
            })
        }
    </script>
@endpush
