@extends('layout.web.app')
@section('content')
    <div class="container-fluid mb-5" style="min-height: 110vh; background-color:rgb(228, 228, 228)">
        <div class="container ">
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</strong>
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif


            <div class="pt-5 mb-5 col-lg-12">
                <div class="row">
                    <div class="col">
                        <h2 class="fw-bold">Account Details</h2>
                    </div>
                    <div class="col">
                        <h2 class="fw-bold">Order Detail</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <x-profile-navigation />
                <div class="col-lg-9 bg-light pl-4 " style="min-height: 80vh">
                    <table class="table table-striped mt-4">
                        <thead>
                            <tr>
                                <th>
                                    <h4>Product Name</h4>
                                </th>
                                <th>
                                    <h4>Price</h4>
                                </th>
                                <th>
                                    <h4>Quantity</h4>
                                </th>

                                <th>
                                    <h4>Total Price</h4>
                                </th>

                                <th>
                                    <h4>Category</h4>
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderProducts as $orderProduct)
                                <tr>
                                    <td>
                                        {{ $orderProduct->pivot->product_name }}
                                    </td>
                                    <td>
                                        {{ $orderProduct->pivot->price }}
                                    </td>
                                    <td>
                                        {{ $orderProduct->pivot->quantity   }}
                                    </td>
                                    <td>
                                        {{ $orderProduct->pivot->total_price }}
                                    </td>
                                     <td>
                                       {{ $orderProduct->pivot->category }}
                                    </td>

                                    {{-- <td>
                                        <a href="{{ route('profile.order.detail',$order->id) }}" class="btn  btn-dark">View</a>
                                    </td> --}}
                                </tr>
                            @endforeach

                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
@endsection
