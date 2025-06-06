@extends('layout.web.app')

@section('content')
    <section class="about-sec-content fix-pading">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-8 col-md-10 col-12">
                    <form action="{{ route('register') }}" method="post" class="contact-form">
                        @csrf
                        <div class="contact-form-inner">
                            <h3 class="contact-hd">Sign Up</h3>
                            <div class="row">
                                <div class="col-12">
                                    <input type="text" name="first_name"
                                        class="form-input @error('first_name') is-invalid   @enderror"
                                        placeholder="First Name">
                                    @error('first_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <input type="text" name="last_name"
                                        class="form-input @error('last_name') is-invalid   @enderror"
                                        placeholder="Last Name">
                                    @error('last_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <input type="text" name="phone"
                                        class="form-input @error('phone') is-invalid   @enderror" placeholder="phone">
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <input type="email" name="email"
                                        class="form-input @error('email') is-invalid   @enderror" placeholder="Email">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">

                                    <div class="login-pass-area">
                                        <input type="password" name="password" class="form-input password"
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
                                    <button class="primary-btn">Sign Up</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </section>
@endsection
@push('scripts')
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
@endpush
