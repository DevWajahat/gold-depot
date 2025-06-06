@extends('layout.web.app')

@section('content')
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</strong>
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <section class="about-sec-content fix-pading">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-8 col-md-10 col-12">
                    <form action="{{ route('login') }}" method="post"  class="contact-form">
                        @csrf
                        <div class="contact-form-inner">
                            <h3 class="contact-hd">Sign In</h3>
                            <div class="row">
                                <div class="col-12">
                                    <input type="email" name="email"
                                        class="form-input @error('email')  is-invalid  @enderror" placeholder="Email">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="login-pass-area">
                                        <input type="password" name="password"
                                            class="form-input password @error('password')  is-invalid  @enderror"
                                            placeholder="Password">
                                        <button class="show-pass" type="button">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>

                                    </div>
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('forgotpassword') }}">Forget Password Click Here?</a>
                                </div>
                                <div class="col-12">
                                    <button class="primary-btn">Sign In</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        const showpassword = document.querySelector(".show-pass")
        const inputpassword = document.querySelector(".form-input.password")
        showpassword.addEventListener("click", () => {
            const changeIcon = showpassword.querySelector("i")
            if (inputpassword.type === "password") {
                inputpassword.type = "text"
                changeIcon.classList = "fa-solid fa-eye-slash"
            } else {
                changeIcon.classList = "fa-solid fa-eye"
                inputpassword.type = "password"
            }
        })
    </script>
@endsection
