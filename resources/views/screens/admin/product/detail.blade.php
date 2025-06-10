@extends('layout.admin.app')

@section('content')
    <style>
        body {
            background-color: #f8f9fa;
        }

        .product-img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: white;
            border-radius: 10px 10px 0 0;
        }
    </style>
    <div class="container my-5">

      
        <!-- Product Detail Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">Product Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Product Image -->
                    <div class="col-md-4">
                        <h3>Featured Image</h3>
                        <img src="{{ asset('images/products/featured/' . $product->image) }}"
                            style=" width:200px; height:200px" alt="">
                        {{-- @dd($product->image) --}}
                        <h3>Product Images</h3>
                        <div id="carouselExample" class="carousel slide">
                            <div class="carousel-inner">
                                @foreach ($product->productImages as $image)
                                    <div class="carousel-item active">
                                        {{-- @dd($image->image) --}}
                                        <img src="{{ asset('images/products/' . $image->image) }}" class="d-block w-100"
                                            alt="...">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <!-- Product Information -->
                    <div class="col-md-8">
                        <h4 class="card-title">{{ $product->name }}</h4> &nbsp;<br>&nbsp;
                        <p class="card-text"><strong>Product ID:</strong> {{ $product->id }}</p>
                        <p class="card-text"><strong>Category:</strong> {{ $product->category->name }}</p>
                        <p class="card-text"><strong>Price:</strong> ${{ $product->price }}</p>
                        {{-- <p class="card-text"><strong>Stock:</strong> 50 units</p> --}}
                        {{-- <p class="card-text"><strong>Status:</strong> <span class="badge bg-success">In Stock</span></p> --}}
                        <p class="card-text"><strong>Short Description:</strong> {{ $product->short_description }}</p>
                        <p class="card-text"><strong>Long Description:</strong> {{ $product->long_description }}</p>
                        <p class="card-text"><strong>Added On:</strong> {{ $product->created_at }}</p>
                        <p class="card-text"><strong>Last Updated:</strong> {{ $product->updated_at }}</p>
                        <!-- Action Buttons -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
