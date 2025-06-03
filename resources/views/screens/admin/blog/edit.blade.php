@extends('layout.admin.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col col-lg-2"></div>
            <div class="col col-lg-8">
                <div class="mt-3">
                    <h2>Edit Blog</h2>
                </div>



                <form action="{{ route('admin.blog.update',$blog->id) }}" method="post" class="mt-4"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mt-3">
                        <label for="name" class="form-label">Blog Name:</label>
                        <input type="text"
                            class="form-control @error('name') is-invalid @enderror" value="{{ $blog->name }}" name="name" id="name">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="name" class="form-label">Blog image:</label>
                        <input type="file" class="form-control @error('image') is-invalid   @enderror" name="image" id="img">
                        @error('image')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                      <div class="mt-5">
                        <label for="" class="form-label">Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="" cols="30" rows="10">{{ $blog->description }}</textarea>
                        @error('description')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-5">
                        <input type="submit" value="Update Blog" class="btn btn-primary col-lg-12" name=""
                            id="">
                    </div>


                </form>

            </div>
            <div class="col col-lg-2"></div>
        </div>
    </div>
@endsection
