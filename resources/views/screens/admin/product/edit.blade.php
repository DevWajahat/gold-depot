@extends('layout.admin.app')
@section('content')
    <div class="container mt-4 mb-5">
        <div class="row">
            <div class="col col-lg-2"></div>
            <div class="col col-lg-8">
                <div class="mt-3">
                    <h2>Edit Product</h2>
                </div>
                <form action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data" method="post"
                    class="mt-4">
                    @csrf
                    <div class="mt-3">
                        <label for="name" class="form-label">Product Name:</label>
                        <input type="text" class="form-control" name="name" value="{{ $product->name }}"
                            id="name">
                    </div>
                    {{-- @dd($product) --}}
                    <div class="mt-3">
                        <label for="category" class="form-label">Category</label>

                        <select name="category" id="category" class="form-control">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $product->category->name == $category->name ? 'selected' : '' }}>
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-3">
                        <img src="{{ asset('images/products/featured/' . $product->image) }}"
                            style="width: 100px !important; height:100px !important" alt="">

                    </div>
                    <div class="mt-3">
                        <label for="name" class="form-label">Featured Image:</label>
                        <input type="file" class="form-control" name="image" id="img">
                    </div>

                    <div class="mt-3 product-multi-img">
                        @foreach ($product->productImages as $productimage)
                            {{-- @dd() --}}

                            <img src="{{ asset('images/products/' . $productimage->image) }}"
                                style="width: 100px !important; height:100px !important" alt="">
                            <button class="ml-4 btn btn-danger deleteImg"
                                id="deleteImage-{{ $productimage->id }}">Delete</button>
                        @endforeach
                    </div>

                    <div class="mt-3">
                        <label for="name" class="form-label">Multiple Images:</label>
                        <input type="file" class="form-control" name="images[]" id="img" multiple>
                    </div>


                    <div class="mt-3">
                        <label for="price" class="form-label">Price: </label>
                        <input type="number" value="{{ $product->price }}" class="form-control" name="price"
                            id="price" multiple>
                    </div>

                    <div class="mt-3">
                        <label for="shortdescription">Short Description</label>
                        <textarea name="short_description" id="short_description" class="form-control" cols="30" rows="5"> {{ $product->short_description }}</textarea>
                    </div>

                    <div class="mt-3">
                        <label for="longdescription">Long Description</label>
                        <textarea name="long_description" id="long_description" class="form-control" cols="30" rows="8"> {{ $product->long_description }}</textarea>
                    </div>


                    <div class="mt-5">
                        <input type="submit" value="Update Prouduct" class="btn btn-primary col-lg-12" name=""
                            id="">
                    </div>
                </form>



            </div>
            <div class="col col-lg-2"></div>
        </div>
    </div>

    @push('scripts')
        <script>
            // var deleteImg = document.getElementById('deleteImage');
            // console.log(deleteImg)
            $(document).ready(function() {
                $(document).on("click",'.deleteImg',function(event) {
                    event.preventDefault();
                    var deleteBtn = $('.deleteImg');
                    var deleteId = deleteBtn.attr('id');
                    var deleteId = deleteId.split("-");
                    var product = {{ $product->id }};
                    var deleteId = deleteId[1];
                    console.log(deleteId)
                    $.ajax({
                        url: '/admin/product-image/destroy/',
                        type: 'POST',

                        data: {
                            "_token": "{{ csrf_token() }}",
                            'id': product,
                            'imageId': deleteId
                        },
                        success: function(response) {
                            console.log(response);
                            let html = '';
                            response.images.forEach(element => {
                                console.log(element);
                                let url = `{{ asset('images/products/') }}/` + element.image;
                                let id = `${element.id}`;
                                html +=
                                    `   <img src="${url}"
                                            style="width: 100px !important; height:100px !important" alt="">
                                        <button class="ml-4 btn btn-danger deleteImg" type="button" id="deleteImage-${id}">
                                            Delete
                                        </button>
                                        `

                            });
                            $(".product-multi-img").html(html);
                        }
                    })
                })
            })
        </script>
    @endpush
@endsection
