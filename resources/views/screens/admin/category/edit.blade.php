@extends('layout.admin.app')


@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col col-lg-2"></div>
            <div class="col col-lg-8">
                <div class="mt-3">
                    <h2>Edit Category</h2>
                </div>
                <form action="{{ route('admin.category.update',$category->id) }}" method="post" class="mt-4" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-3">
                        <label for="name" class="form-label">Category Name:</label>
                        <input type="text" value="{{ $category->name }}" class="form-control" name="name" id="name">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <img src="{{ asset('images/category/'.$category->image) }}" width="100" height="100" alt="">
                    </div>
                    <div class="mt-3">
                        <label for="name" class="form-label">Category image:</label>
                        <input type="file" class="form-control" name="image" id="img">
                    </div>

                    {{-- <div class="mt-3">
                        <label for="" class="form-label">Status: </label>
                        <select name="status" id="">
                            <option value=""></option>
                        </select>
                    </div> --}}

                    <div class="mt-5">
                        <input type="submit" value="Update Category" class="btn btn-primary col-lg-12" name="" id="">
                        @error('image')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </form>

            </div>
            <div class="col col-lg-2"></div>
        </div>
    </div>
@endsection
