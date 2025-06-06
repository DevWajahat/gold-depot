@extends('layout.admin.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="fw-bold">All Orders</h2>
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
                                        colspan="1" aria-label="Full Name: activate to sort column ascending">Full Name
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="Sub total: activate to sort column ascending">
                                        Sub Total</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="Shipping: activate to sort column ascending">
                                        Shipping</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="Total Amount: activate to sort column ascending">
                                        Total Amount</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="Price: activate to sort column ascending">Address</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="City: activate to sort column ascending">City</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="Country: activate to sort column ascending">Country</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="Zip Code: activate to sort column ascending">Zip Code</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="Phone: activate to sort column ascending">Phone</th>

                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="Price: activate to sort column ascending">Status</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="CSS grade: activate to sort column ascending">Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr class="odd">
                                        <td class="dtr-control sorting_1" tabindex="0">{{ $order->id }}</td>
                                        <td>{{ $order->full_name }}</td>
                                        <td>{{ $order->sub_total }}</td>
                                        <td>{{ $order->shipping }}</td>
                                        <td>{{ $order->total_amount }}</td>
                                        <td>{{ $order->address }}</td>
                                        <td>{{ $order->city }}</td>
                                        <td>{{ $order->country }}</td>
                                        <td>{{ $order->zip_code }}</td>
                                        <td>{{ $order->phone }}</td>
                                        <td>
                                            <select name="status" id="status-{{ $order->id }}"
                                                class="form-control status">
                                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                                    pending</option>
                                                <option value="processing"
                                                    {{ $order->status == 'processing' ? 'selected' : '' }}>processing
                                                </option>
                                                <option value="approved"
                                                    {{ $order->status == 'approved' ? 'selected' : '' }}>
                                                    approved</option>
                                                <option value="delivered"
                                                    {{ $order->status == 'delivered' ? 'selected' : '' }}>delivered</option>
                                                <option value="on the way"
                                                    {{ $order->status == 'on the way' ? 'selected' : '' }}>on the way
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.order.detail', $order->id) }}"
                                                class="btn btn-secondary">View</a>
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
        $(document).ready(function() {
            $(document).on("change", ".status", function() {
                var status = $(this).find(":selected").val();
                var order = $(this).attr('id');
                order = order.split("-");
                order = order[1];

                $.ajax({
                    type: 'POST',
                    url: '/admin/orders/status-update',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "order" : order,
                        "status" : status,
                    },
                    success: function(response){
                        console.log(response)
                    }

                })

            });
        });
    </script>
@endpush
