@extends('layout.admin.app')


@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col col-lg-2"></div>
            <div class="col col-lg-8">
                <div class="mt-3">
                    <h2>Add Category</h2>
                </div>

                @if(session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                @endif

                <form action="{{ route('admin.category.store') }}" method="post" class="mt-4" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-3">
                        <label for="name" class="form-label">Category Name:</label>
                        <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid  @enderror" name="name" id="name">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="name" class="form-label">Category image:</label>
                        <input type="file" class="form-control" name="image" id="img">
                        @error('image')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-5">
                        <input type="submit" value="Add Category" class="btn btn-primary col-lg-12" name="" id="">
                    </div>
                </form>

            </div>
            <div class="col col-lg-2"></div>
        </div>
    </div>
@endsection
