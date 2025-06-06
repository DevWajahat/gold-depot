@extends('layout.web.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <section class="about-sec-content fix-pading">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-8 col-md-10 col-12">
                    <form action="{{ route('forgotpassword') }}" method="post" class="contact-form">
                        @csrf
                        <div class="contact-form-inner">
                            <h3 class="contact-hd">Forgot Password </h3>
                            <div class="row">
                                <div class="col-12">
                                    <input type="email" name="email"
                                        class="form-input @error('email')  is-invalid  @enderror" placeholder="Email">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <button class="primary-btn">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </section>
@endsection
