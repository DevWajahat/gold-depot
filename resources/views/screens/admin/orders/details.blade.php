@extends('layout.admin.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">DataTable with default features</h3>
        </div>
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
                                        colspan="1" aria-label="Full Name: activate to sort column ascending">Product
                                        Name
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="Price: activate to sort column ascending">
                                        Price</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="Quantity: activate to sort column ascending">Quantity
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="Total Price: activate to sort column ascending">Total
                                        Price</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="Product Name: activate to sort column ascending">Product
                                        Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="Category: activate to sort column ascending">Category
                                    </th>

                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="CSS grade: activate to sort column ascending">Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->products as $orderProduct)
                                    <tr class="odd">
                                        <td class="dtr-control sorting_1" tabindex="0">{{ $orderProduct->id }}</td>
                                        <td>{{ $orderProduct->name }}</td>
                                        <td>{{ $orderProduct->pivot->price }}</td>
                                        <td>{{ $orderProduct->pivot->quantity }}</td>
                                        <td>{{ $orderProduct->pivot->total_price }}</td>
                                        <td>{{ $orderProduct->pivot->product_name }}</td>
                                        <td>{{ $orderProduct->pivot->category }}</td>

                                        <td>

                                            {{-- <a href="{{ route('') }}" class="btn btn-warning">Edit</a>
                                        <a href="{{ route('') }}" class="btn btn-danger">Delete</a> --}}
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

    </script>
@endpush
