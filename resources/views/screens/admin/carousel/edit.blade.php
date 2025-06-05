@extends('layout.admin.app')
@section('content')
    <div class="container">
        <div class="row mt-5 mb-5">
            <div class="col-lg-1"></div>
            <div class="col col-lg-10">
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</strong>
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('admin.carousel.update',$carousel->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h2 class="fw-bold">Edit Carousel</h2>

                    <div class="mt-3">
                        <label for="" class="form-label">Title: </label>
                        <input type="text" name="title" id=""
                            class="form-control @error('title') is-invalid @enderror" value="{{ $carousel->title }}">
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="" class="form-label">Description: </label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id=""
                            cols="30" rows="8">{{ $carousel->description }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="" class="form-label">Banner Image: </label>
                        <input type="file" name="banner" class="form-control" id="">
                        @error('banner')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-primary">Update Slide</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
