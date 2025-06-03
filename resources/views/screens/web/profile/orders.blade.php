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
                        <h2 class="fw-bold">ALL Orders</h2>
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
                                    <h4>Full Name</h4>
                                </th>
                                <th>
                                    <h4>City</h4>
                                </th>
                                <th>
                                    <h4>Address</h4>
                                </th>

                                <th>
                                    <h4>Phone</h4>
                                </th>

                                <th>
                                    <h4>Status</h4>
                                </th>
                                <th>
                                    <h4>Ordered At:</h4>
                                </th>
                                  <th>
                                    <h4>Details</h4>
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->orders as $order)
                                <tr>
                                    <td>
                                        {{ $order->full_name }}
                                    </td>
                                    <td>
                                        {{ $order->city }}
                                    </td>
                                    <td>
                                        {{ $order->address }}
                                    </td>
                                    <td>
                                        {{ $order->phone }}
                                    </td>
                                     <td>
                                       <button type="disabled" class="disable btn btn-primary ">{{ $order->status }}</button>
                                    </td>
                                    <td>
                                        {{ $order->created_at }}
                                    </td>
                                    <td>
                                        <a href="{{ route('profile.order.detail',$order->id) }}" class="btn  btn-dark">View</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
@endsection
