@extends('layout.admin.app')

@section('content')
    <div class="container mt-4 mb-5">
        <div class="row">
            <div class="col col-lg-2">

            </div>
            <div class="col col-lg-8">
                <div class="mt-3">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary mt-3 mb-3">Back</a>
                    <h2>Add Product</h2>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

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
                        <input type="number" step=".01" value="{{ old('base_price') }}" name="base_price"
                            class="form-control @error('base_price') is-invalid  @enderror" id="price">
                        @error('base_price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="parent-container">
                        <div class="mt-3 par border border-secondary">
                            <label for=""
                                class="form-label d-flex justify-content-between align-items-center">Attribute: <button
                                    class="btn btn-light closebtn" type="button"><span
                                        class="btn-close"></span></button></label>
                            <select name="product_attributes[]" class="form-control" id="attrDropDown">
                                <option value="" selected>Select Attribute</option>
                                @foreach ($attributes as $attribute)
                                    <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                @endforeach
                            </select>
                            <div class="mt-3 variant-par ">
                                <div class="var-par  border border-primary">
                                    <label for="" class="form-label">Variant: </label>
                                    <div class="input-group">
                                        <select name="variants[]" class="form-control" id="variantsDropDown">
                                        </select>
                                        <button class="btn btn-light remove-variant" type="button"><span
                                                class="btn-close"></span></button>
                                    </div>

                                    <div class="mt-3">
                                        <label for="" class="form-label">Price: </label>
                                        <input type="number" name="prices[]" class="form-control" step="0.01">
                                    </div>
                                </div>
                                <button class="btn add-variant-btn" id="" type="button"><i
                                        class="ri-add-fill"></i>Add Variant</button>
                            </div>
                        </div>
                        <button class="btn" id="addBtn"><i class="ri-add-fill"></i>Add Attribute</button>
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
            // Add new attribute
            $('#addBtn').on('click', function(e) {
                e.preventDefault();
                var parentContainer = $('.parent-container');
                var par = parentContainer.find('.par').first().clone();

                // Clear values and reset select
                par.find('select').val('');
                par.find('input').val('');
                // Remove all variants except the first one
                par.find('.var-par').slice(1).remove();

                parentContainer.append(par);
            });

            // Remove attribute
            $(document).on('click', '.closebtn', function(e) {
                e.preventDefault();
                if ($('.parent-container .par').length > 1) {
                    $(this).closest('.par').remove();
                }
            });

            // Add new variant
            $(document).on('click', '.add-variant-btn', function(e) {
                e.preventDefault();
                var varParentContainer = $(this).closest('.variant-par');
                var varPar = varParentContainer.find('.var-par').first().clone();

                // Clear values
                varPar.find('select').val('');
                varPar.find('input').val('');

                varPar.insertBefore($(this));
            });

            // Remove variant
            $(document).on('click', '.remove-variant', function(e) {
                e.preventDefault();
                var varPar = $(this).closest('.var-par');
                if (varPar.closest('.variant-par').find('.var-par').length > 1) {
                    varPar.remove();
                }
            });
        });
        $(document).ready(function() {
            $(document).on("change", "#attrDropDown", function() {
                var attrDropDown = $(this);
                variantDropDown = $(this).parent(".par").first().find("#variantsDropDown");
                var attr = $(this).val();
                if (attrDropDown.val() == '') {
                    variantDropDown.empty();
                }
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
    </script>
@endpush
