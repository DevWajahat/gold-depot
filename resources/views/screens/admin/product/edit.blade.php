@extends('layout.admin.app')
@section('content')
    <div class="container mt-4 mb-5">
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</strong>
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="col col-lg-2"></div>
            <div class="col col-lg-8">
                <div class="mt-3">
                    <h2>Edit Product</h2>
                </div>
                <form action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data"
                    method="post" class="mt-4">
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
                            @forelse ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $product->category->name == $category->name ? 'selected' : '' }}>
                                    {{ $category->name }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>

                    <div class="mt-3">
                        <label for="" class="form-label">Status: </label>
                        <select class="form-control" name="status" id="">
                            <option value="available" {{ $product->status == 'available' ? 'selected' : '' }}>Available
                            </option>
                            <option value="out-of-stock" {{ $product->status == 'out-of-stock' ? 'selected' : '' }}>Out Of
                                Stock</option>
                            <option value="discontinued" {{ $product->status == 'discontinued' ? 'selected' : '' }}>
                                Discontinued</option>
                        </select>
                    </div>

                    <div class="mt-3">
                        <label for="name" class="form-label">Featured Image:</label>
                        <input type="file" class="form-control" name="image" id="img">
                    </div>
                    <div class="mt-5">
                        <img src="{{ asset('images/products/featured/' . $product->image) }}"
                            style="width: 100px !important; height:100px !important" alt="">
                    </div>



                    <div class="mt-3">
                        <label for="name" class="form-label">Multiple Images:</label>
                        <input type="file" class="form-control" name="images[]" id="img" multiple>
                    </div>

                    <div class="mt-3 product-multi-img">
                        @forelse ($product->productImages as $productimage)
                            <img src="{{ asset('images/products/' . $productimage->image) }}"
                                style="width: 100px !important; height:100px !important" alt="">
                            <button class="ml-4 btn btn-danger deleteImg"
                                id="deleteImage-{{ $productimage->id }}">Delete</button>
                        @empty
                        @endforelse
                    </div>

                    <div class="mt-3">
                        <label for="price" class="form-label">Price: </label>
                        <input type="number" step=".01" value="{{ $product->price }}" class="form-control"
                            name="price" id="price" multiple>
                    </div>

                    <div class="parent-container">
                        @if ($product->attributes && $product->attributes->isNotEmpty())
                            @forelse($product->attributes as $index => $attribute)

                                <div class="mt-3 par">
                                   {{-- Attributes Ka selection --}}
                                    <label for="attrDropDown_{{ $index }}" class="form-label">Attribute:</label>
                                    <select name="product_attributes[]" class="form-control"
                                        id="attrDropDown">
                                        <option value="" {{ !$attribute->id ? 'selected' : '' }}>None
                                        </option>
                                        @foreach ($attributes as $attr)
                                            <option value="{{ $attr->id }}"
                                                {{ $attr->id == $attribute->id ? 'selected' : '' }}>
                                                {{ $attr->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <!-- Variants ka selection -->
                                    <div class="mt-3">
                                        <label for="variantsDropDown"
                                            class="form-label">Variant:</label>
                                        <div class="input-group">
                                            <select name="variants[]" class="form-control"
                                                id="variantsDropDown">
                                                <option value="" selected>Select Variant</option>
                                                @foreach ($variants as $var)
                                                    @if($attribute->id == $var->attribute_id)
                                                    <option value="{{ $var->id }}"  >{{ $var->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <button class="btn btn-light closebtn" type="button"><span
                                                    class="btn-close"></span></button>
                                        </div>
                                    </div>
                                </div>
                            @empty

                            @endforelse
                        @else
                            <!-- Default empty state -->
                            <div class="mt-3 par">
                                <label for="attrDropDown_0" class="form-label">Attribute:</label>
                                <select name="product_attributes[]" class="form-control" id="attrDropDown">
                                    <option value="" selected>Select Attribute</option>
                                    @foreach ($attributes as $attribute)
                                        <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                    @endforeach
                                </select>
                                <div class="mt-3">
                                    <label for="variantsDropDown_0" class="form-label">Variant:</label>
                                    <div class="input-group">
                                        <select name="variants[]" class="form-control" id="variantsDropDown">
                                            <option value="" selected>Select Variant</option>
                                            @foreach ($variants as $var)
                                                <option value="{{ $var->id }}">{{ $var->name }}</option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-light closebtn" type="button"><span
                                                class="btn-close"></span></button>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <button class="btn" id="addBtn"><i class="ri-add-fill"></i></button>
                    </div>
                    {{-- @if ($product->attributes)
                    <div class="parent-container">
                        @forelse ($product->attributes as $attribute)
                            <div class="mt-3 par">
                                <label for="" class="form-label">Attribute: </label>
                                <select name="product_attributes[]" class="form-control" id="attrDropDown">
                                    <option value="" selected>Select Attribute</option>
                                    @foreach ($attributes as $attr)
                                        <option value="{{ $attr->id }}"
                                            {{ $attr->id == $attribute->id ? 'selected' : '' }}>
                                            {{ $attr->name }}
                                        </option>
                                    @endforeach
                                </select>
                            @empty
                        @endforelse
                        @forelse ($product->variants as $variant)
                            <div class="mt-3">
                                <label for="" class="form-label">Variant: </label>
                                <div class="input-group">
                                    <select name="variants[]" class="form-control" id="variantsDropDown">
                                        @foreach ($variants as $var)
                                            <option value="{{ $var->id }}"
                                                {{ $var->id == $variant->id ? 'selected' : '' }}>{{ $var->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-light closebtn" type="button"><span
                                            class="btn-close"></span></button>
                                </div>
                            </div>
                    </div>
                        @empty
                    @endforelse
                        <button class="btn" id="addBtn"><i class="ri-add-fill"></i></button>
                    </div>
                    @else

                    <div class="parent-container">
                        <div class="mt-3 par">
                            <label for="" class="form-label">Attribute: </label>
                            <select name="product_attributes[]" class="form-control" id="attrDropDown">
                                <option value="" selected>Select Attribute</option>
                                @foreach ($attributes as $attribute)
                                    <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                @endforeach
                            </select>
                            <div class="mt-3">
                                <label for="" class="form-label">Variant: </label>
                                <div class="input-group">
                                    <select name="variants[]" class="form-control" id="variantsDropDown">
                                    </select>
                                    <button class="btn btn-light closebtn" type="button"><span
                                            class="btn-close"></span></button>
                                </div>

                            </div>
                        </div>
                        <button class="btn" id="addBtn"><i class="ri-add-fill"></i></button>
                    </div>
                    @endif --}}


                    <div class="mt-3">
                        <label for="shortdescription">Short Description</label>
                        <textarea name="short_description" id="shortDesription" class="form-control" cols="30" rows="5"> {{ $product->short_description }}</textarea>
                    </div>

                    <div class="mt-3">
                        <label for="longdescription">Long Description</label>
                        <textarea name="long_description" id="longDescription" class="form-control" cols="30" rows="8"> {{ $product->long_description }}</textarea>
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
            // $(document).ready(function() {
            //     $("#addBtn").on("click", function(e) {
            //         e.preventDefault();
            //         let parentContainer = $(".parent-container");
            //         let par = parentContainer.find(".par").first().clone();
            //         par.find("input").val('');
            //         par.insertBefore("#addBtn");
            //     });
            //     $(document).on("click", ".closebtn", function(e) {
            //         console.log($(this).parent(`.par`).first());

            //         $(this).closest(".par").remove();

            //     })
            // })

            $(document).ready(function() {
                $("#addBtn").on("click", function(e) {
                    e.preventDefault();
                    var parentContainer = $(".parent-container");
                    var par = parentContainer.find(".par").first().clone();

                    par.find("input").val('');
                    par.find("#variantsDropDown").empty();
                    par.insertBefore("#addBtn");
                });
                $(document).on("click", ".closebtn", function(e) {
                    console.log($(this).parent(`.par`).first());

                    if ($(".parent-container .par").length > 1) {
                        $(this).closest(".par").remove();
                    }


                })

                $(document).on("change", "#attrDropDown", function() {
                    var attrDropDown = $(this);

                    variantDropDown = $(this).parent(".par").first().find("#variantsDropDown");
                    if (attrDropDown.val() == '') {
                        variantDropDown.empty();
                    }
                    var attr = $(this).val();
                    console.log(attr);
                    var options;
                    $.ajax({
                        type: 'GET',
                        url: '/admin/attribute/variant/' + attr,
                        success: function(response) {
                            console.log(response);
                            options = response.variants;
                            $(variantDropDown).empty();
                            options.forEach(e => {
                                $(variantDropDown).append($('<option></option>').attr(
                                    'value', e.id).text(e.name))
                            });

                        }
                    });
                });
            })



            var shortDescription = new SimpleMDE({
                element: $("#shortDescription")[0]
            });
            shortDescription.value();

            var longDescription = new SimpleMDE({
                element: $("#longDescription")[0]
            });
            longDescription.value();



            $(document).ready(function() {
                $(document).on("click", '.deleteImg', function(event) {
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
                                let url = `{{ asset('images/products/') }}/` + element
                                    .image;
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
