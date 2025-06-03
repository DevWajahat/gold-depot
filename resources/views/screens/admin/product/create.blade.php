@extends('layout.admin.app')

@section('content')
    <div class="container mt-4 mb-5">
        <div class="row">
            <div class="col col-lg-2"></div>
            <div class="col col-lg-8">
                <div class="mt-3">
                    <h2>Add Product</h2>
                </div>

                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data" class="mt-4">
                    @csrf
                    <div class="mt-3">
                        <label for="name" class="form-label">Product Name:</label>
                        <input type="text" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror" name="name" id="name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="category" class="form-label">Category</label>
                        <select name="category" id="category" class="form-control">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-3">
                        <label for="" class="form-label">Featured Image:</label>
                        <input type="file" name="image" id="" class="form-control">
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="name" class="form-label">Product Images:</label>
                        <input type="file" class="form-control" name="images[]" id="img" multiple >
                        @error('images')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="price" class="form-label">Price: </label>
                        <input type="number" value="{{ old('price') }}" name="price"
                            class="form-control @error('price') is-invalid  @enderror" id="price">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="shortdescription">Short Description</label>
                        <textarea name="shortdescription" id="shortdescription" class="form-control" cols="30" rows="5">{{ old('shortdescription') }}</textarea>
                        @error('shortdescription')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="longdescription">Long Description</label>
                        <textarea name="longdescription" id="longdescription" class="form-control" cols="30" rows="8">{{ old('longdescription') }}</textarea>
                        @error('longdescription')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-5">
                        <input type="submit" value="Add Product" class="btn btn-primary col-lg-12" id="">
                    </div>
                </form>

            </div>
            <div class="col col-lg-2"></div>
        </div>
    </div>
@endsection
