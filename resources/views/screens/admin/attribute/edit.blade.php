@extends('layout.admin.app')
@section('content')
    <div class="row mt-5 mb-5">
        <div class="col-lg-2"></div>
        <div class="col-lg-8 mt-5">
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</strong>
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <h3>Edit Attribute</h3>
            <form action="{{ route('admin.product.attribute.update', $attribute->id) }}" method="POST">
                @csrf
                <div class="mt-3">
                    <label for="" class="form-label">Attribute Name:</label>
                    <input type="text" value="{{ $attribute->name }}"
                        class="form-control @error('attr_name') is-invalid @enderror" name="attr_name" id="">
                    @error('attr_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="parent-container">
                    @foreach ($attribute->variants as $variant)
                    {{-- @dd($variant) --}}
                    {{-- @empty --}}
                        <div class="mt-3 par">
                            <label for="" class="form-label">Variant Name</label>
                            <input type="text" name="variant_name[]" value="{{ $variant->name }}" class="form-control"
                                id="variantName">
                            <button class="btn btn-light closebtn" type="button"><span class="btn-close"></span></button>
                        </div>
                    @endforeach
                    <button class="btn" id="addBtn"><i class="ri-add-fill"></i></button>
                </div>

                <div class="mt-4">
                    <input type="submit" class="btn btn-primary w-100" id="">
                </div>

            </form>
        </div>
        <div class="col-lg-2"></div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $("#addBtn").on("click", function(e) {
                    e.preventDefault();
                    let parentContainer = $(".parent-container");
                    let par = parentContainer.find(".par").first().clone();
                    par.find("input").val('');
                    par.insertBefore("#addBtn");
                });
                $(document).on("click", ".closebtn", function(e) {
                    console.log($(this).parent(`.par`).first());

                    if ($(".parent-container .par").length > 1) {
                        $(this).closest(".par").remove();
                    } else {
                        alert("At least one variant is required.");
                    }
                })
            })
        </script>
    @endpush
@endsection
