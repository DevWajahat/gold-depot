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
                        <h2 class="fw-bold">My Profile</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <x-profile-navigation/>

                <div class="col-lg-9 bg-light pl-4 " style="min-height: 80vh">
                    <table class="table table-borderless mt-4">
                        <thead>
                            <tr>
                                <th>
                                    <h4>First Name</h4>
                                </th>
                                <th>
                                    <h4>Last Name</h4>
                                </th>
                                <th>
                                    <h4>Email</h4>
                                </th>

                                <th>
                                    <h4>Phone</h4>
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    {{ $user->first_name }}
                                </td>
                                <td>
                                    {{ $user->last_name }}
                                </td>
                                <td>
                                    {{ $user->email }}
                                </td>
                                <td>
                                    {{ $user->phone }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <a href="{{ route('profile.edit') }}" class="btn btn-primary col-lg-5 mt-5">Edit Profile </a><br>
                    <a href="{{ route('profile.edit.password') }}" class="btn btn-primary col-lg-5 mt-5">Change Password
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
