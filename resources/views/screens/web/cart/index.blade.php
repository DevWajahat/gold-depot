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

    {{-- @dd(session('cart')) --}}

    <section class="cart-section sec-pd fix-pading">
        <div class="container">
            <div class="row">
                <div class="col-12 m-0">
                    <div class="sub-sec">
                        @if (!empty(session()->get('cart')['items']))
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
                @if (!empty(session()->get('cart')['items']))
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
                                        VARIANTS
                                    </th>
                                    <th class="">
                                        TOTAL
                                    </th>
                                    <th class="">

                                    </th>
                                </tr>

                                @forelse (session()->get('cart')["items"] as $k => $item)
                                    {{-- @dd($item['name']) --}}
                                    <x-cart-item :name="$item['name']" :category="$item['category']" :price="$item['price']" :image="$item['image']"
                                        :quantity="$item['quantity']" :productid="$item['id']" :total="$item['product_total']" :dataid="$k"
                                        :item="$item" />
                                @empty
                                    :quantity="$item['quantity']" :productid="$item['id']" :total="$item['product_total']" :dataid="$k" />
                                @endforelse
                            </table>
                        </div>
                    </div>

                    @if (!empty(session()->get('cart')['items']))
                        <div class="col-12 offset-lg-8 col-lg-4">
                            <div class="total total-area">
                                <div class="sub-total">
                                    <div class="row align-items-center ">
                                        <div class="col-lg-6 col-md-5 col-6 m-0">
                                            <h4 class="subttl-hd">subtotal</h4>
                                        </div>
                                        <div class="col-lg-6 col-md-5 col-6 m-0">
                                            <p class="subttl-para" id="subTotal">
                                                ${{ session()->get('cart')['sub_total'] }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="sub-total">
                                    <div class="row align-items-center ">
                                        <div class="col-lg-6 col-md-5 col-6 m-0">
                                            <h4 class="subttl-hd">SHIPPING</h4>
                                        </div>
                                        @if (session()->get('cart')['shipping'] == 0)
                                            <div class="col-lg-6 col-md-5 col-6 m-0">
                                                <p class="subttl-para" id="shipping">$0</p>
                                            </div>
                                        @else
                                            <div class="col-lg-6 col-md-5 col-6 m-0">
                                                <p class="subttl-para" id="shipping">$
                                                    {{ session()->get('cart')['shipping'] }}</p>
                                            </div>
                                        @endif
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

                                <div class="mt-5">
                                    <a class="primary-btn" href="{{ route('checkout.index') }}" class="white">Check Out
                                    </a>
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


            dropdownValues = []
            $('.variant :selected').each(function(index) {
                var dropdownValues = $(".variant").map(function() {
                    var value = $(this).val()
                    var key = $(this).attr("id");
                    var object = {}
                    object[key] = value;
                    return object;

                }).get();


                console.log(dropdownValues)

                // $.ajax({
                //     type: 'POST',
                //     url: 'cart/calculate-price',
                //     data: {
                //         "_token": "{{ csrf_token() }}",
                //         "dropdownValues": dropdownValues,
                //         "product_id": Object.keys(dropdownValues)
                //     },
                //     success: function(response) {
                //         console.log(response)
                //         $("#price").text(`$ ${response.calculatedPrice}`)
                //     }
                // });
            });


            $(document).on("change", ".variant", function() {
                var dropdownValues = $(".variant").map(function() {
                    return $(this).val();
                }).get();



                // $.ajax({
                //     type: 'POST',
                //     url: '/calculate-price',
                //     data: {
                //         "_token": "{{ csrf_token() }}",
                //         "dropdownValues": dropdownValues,
                //         "product_id": product
                //     },
                //     success: function(response) {
                //         console.log(response)
                //         $("#price").text(`$ ${response.calculatedPrice}`)
                //     }
                // });

                console.log(dropdownValues);
            });

        })

        $(document).ready(function() {
            $('.variant').on("change", function() {

                var variant = $(this).val()
                // console.log(variant)
                var id = $(this).attr("id")
                var attribute = $(this).parent(".par").first().find(".attr-name").text();
                console.log(id)
                console.log(variant)
                console.log(attribute)
                $.ajax({
                    type: 'POST',
                    url: '/cart/update-variant/',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "variant": variant,
                        "id": id,
                        "attribute": attribute
                    },
                    success: function(response) {
                        console.log(response)
                        $('#sumPrice').html(`$ ${response.sumprice}`)
                        $(`#item-total-${id}`).html(`$ ${response.product_total}`)
                        $('#subTotal').text(`$` + response.sub_total);
                        $('#shipping').text(response.shipping);
                        $('#total').text(`$` + response.total)
                    }
                })
            })
        })



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
