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
                        @if (!empty(session()->get('cart')["items"]))
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
                @if (!empty(session()->get('cart')["items"]))
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
                                @forelse (session()->get('cart')["items"] as $k => $item)

                                        <x-cart-item :name="$item['name']" :category="$item['category']" :price="$item['price']" :image="$item['image']"
                                            :quantity="$item['quantity']" :total="$item['product_total']" :dataid="$k" />

                                    @empty
                                @endforelse
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
                                        <p class="subttl-para" id="subTotal">${{ session()->get('cart')["sub_total"] }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="sub-total">
                                <div class="row align-items-center ">
                                    <div class="col-lg-6 col-md-5 col-6 m-0">
                                        <h4 class="subttl-hd">SHIPPING</h4>
                                    </div>
                                    @if (session()->get('cart')["shipping"] == 0)
                                    <div class="col-lg-6 col-md-5 col-6 m-0">
                                        <p class="subttl-para" id="shipping">FREE SHIPPING</p>
                                    </div>

                                    {{-- @else --}}

                                    <div class="col-lg-6 col-md-5 col-6 m-0">
                                        <p class="subttl-para" id="shipping">$ {{ session()->get('cart')["shipping"] }}</p>
                                    </div>

                                    {{-- @endif --}}
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
                                        <h4 class="subttl-hd">TOTAL</h4>
                                    </div>
                                    <div class="col-lg-6 col-md-5 col-6 m-0">
                                            <p class="subttl-para" id="total">${{ session()->get('cart')["total"] }}</p>

                                    </div>
                                </div>
                            </div>

                            <div class="mt-5">
                                <a class="primary-btn" href="{{ route('checkout.index') }}" class="white">Check Out </a>
                            </div>
                        </div>
                    </div>
                    @endif
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
                    url: "check-coupon/" + couponCode,
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
