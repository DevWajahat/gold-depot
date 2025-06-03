@extends('layout.admin.app')
@section('content')
  <div class="container mt-4 mb-5">
        <div class="row">
            <div class="col col-lg-2"></div>
            <div class="col col-lg-8">
                <div class="mt-3">
                    <h2>Edit Product</h2>
                </div>
                <form action="" method="post" class="mt-4">
                    <div class="mt-3">
                        <label for="name" class="form-label">Product Name:</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>

                    <div class="mt-3">
                        <label for="category" class="form-label">Category</label>
                        <select name="category" id="category" class="form-control">
                            <option value="1">Gold</option>
                            <option value="2">Silver</option>
                            <option value="3">Platinum</option>
                        </select>
                    </div>

                    <div class="mt-3">
                        <label for="name" class="form-label">Product Images:</label>
                        <input type="file" class="form-control" name="img" id="img" multiple>
                    </div>

                    <div class="mt-3">
                        <label for="price" class="form-label">Price: </label>
                        <input type="number" class="form-control" name="price" id="price" multiple>
                    </div>

                    <div class="mt-3">
                        <label for="shortdescription">Short Description</label>
                        <textarea name="shortdescription" id="shortdescription" class="form-control" cols="30" rows="5"></textarea>
                    </div>

                    <div class="mt-3">
                        <label for="longdescription">Long Description</label>
                         <textarea name="longdescription" id="longdescription" class="form-control" cols="30" rows="8"></textarea>
                    </div>


                    <div class="mt-5">
                        <input type="submit" value="Add Category" class="btn btn-primary col-lg-12" name=""
                            id="">
                    </div>
                </form>

            </div>
            <div class="col col-lg-2"></div>
        </div>
    </div>
@endsection
