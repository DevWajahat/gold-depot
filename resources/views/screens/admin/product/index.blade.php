@extends('layout.admin.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class=" bold">All Products List</h3>
        </div>

        @if (session()->has('message'))
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        @endif
        <!-- /.card-header -->
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                            aria-describedby="example1_info">
                            <thead>
                                <tr>
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="id: activate to sort column ascending">id
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="Category: activate to sort column ascending">Category
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="Name: activate to sort column ascending">
                                        Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="Price: activate to sort column ascending">price</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="Status: activate to sort column ascending">Status</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="CSS grade: activate to sort column ascending">Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr class="odd">
                                        <td class="dtr-control sorting_1" tabindex="0">{{ $product->id }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>
                                            <select  name="status" id="status-{{ $product->id }}" class="form-control status">
                                                <option value="available" {{ $product->status == "available" ? 'selected': '' }}>Available</option>
                                                <option value="out-of-stock" {{ $product->status == "out-of-stock" ? 'selected': '' }}>Out Of Stock</option>
                                                <option value="discontinued" {{ $product->status == "discontinued" ? 'selected': '' }}>Discontinued</option>
                                            </select>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.products.detail', $product->id) }}"
                                                class="btn btn-secondary">View</a>
                                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                                class="btn btn-warning">Edit</a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /.card-body -->
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on("change", ".status", function() {
                 var status = $(this).find(":selected").val();
                 var product = $(this).attr('id');
                 product = product.split('-');
                 product = product[1];
                 console.log(status + product)

                 $.ajax({
                    type: 'POST',
                    url: '/admin/products/update-status',
                    data: {
                        '_token': "{{ csrf_token() }}",
                        "product": product,
                        "status" : status
                    },
                    success: function (response){
                        console.log(response)
                    }
                 });
            });
        });
    </script>
@endpush
