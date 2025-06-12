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

                <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data"
                    class="mt-4">
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
                        <input type="file" class="form-control" name="images[]" id="img" multiple>
                        @error('images')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="price" class="form-label">Price: </label>
                        <input type="number" step=".01" value="{{ old('price') }}" name="price"
                            class="form-control @error('price') is-invalid  @enderror" id="price">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

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
                                        {{-- @foreach ($attributes as $attribute)
                                            @foreach ($attribute->variants as $variant) --}}
                                        {{-- <option class="varDropDown" id="varDropDown" value="{{ $variant->id }}">
                                                    {{ $variant->name }}
                                                </option> --}}
                                        {{-- @endforeach
                                        @endforeach --}}
                                    </select>
                                    <button class="btn btn-light closebtn" type="button"><span
                                            class="btn-close"></span></button>
                                </div>

                            </div>
                        </div>
                        <button class="btn" id="addBtn"><i class="ri-add-fill"></i></button>
                    </div>

                    <div class="mt-3">
                        <label for="shortdescription">Short Description</label>
                        <textarea name="shortdescription" id="shortDescription" class="form-control" cols="30" rows="5">{{ old('shortdescription') }}</textarea>
                        @error('shortdescription')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="longdescription">Long Description</label>
                        <textarea name="longdescription" id="longDescription" class="form-control" cols="30" rows="8">{{ old('longdescription') }}</textarea>
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
@push('scripts')
    <script>
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
                // console.log()
                variantDropDown = $(this).parent(".par").first().find("#variantsDropDown");
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



                // }, 1000);
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
    </script>
@endpush
