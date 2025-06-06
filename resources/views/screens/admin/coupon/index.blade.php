@extends('layout.admin.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class=" fw-bolder">All Coupons List</h3>
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
                                        colspan="1" aria-label="Coupon Code: activate to sort column ascending">Coupon
                                        Code
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="Type: activate to sort column ascending">
                                        Type</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="Discount: activate to sort column ascending">Discount
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="Max Usage: activate to sort column ascending">Max Usage
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="Remaining: activate to sort column ascending">Remaining
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="Expiry: activate to sort column ascending">Expiry</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="Status: activate to sort column ascending">Status</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="CSS grade: activate to sort column ascending">Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $coupon)
                                    <tr class="odd">
                                        <td class="dtr-control sorting_1" tabindex="0">{{ $coupon->id }}</td>
                                        <td>{{ $coupon->coupon_code }}</td>
                                        <td>{{ $coupon->type }}</td>
                                        <td>{{ $coupon->discount }}</td>
                                        <td>{{ $coupon->max_usage }}</td>
                                        <td>{{ $coupon->remaining }}</td>
                                        <td>{{ $coupon->expiry }}</td>
                                        <td>
                                            <select name="status" id="status-{{ $coupon->id }}"
                                                class="form-control status">
                                                <option value="active" {{ $coupon->status == 'active' ? 'selected' : '' }}>
                                                    Active</option>
                                                <option value="inactive"
                                                    {{ $coupon->status == 'inactive' ? 'selected' : '' }}>In Active</option>
                                            </select>
                                        </td>

                                        <td>
                                            <a href="{{ route('admin.coupon.edit', $coupon->id) }}"
                                                class="btn btn-warning">Edit</a>
                                            <a href="{{ route('admin.coupon.destroy', $coupon->id) }}"
                                                class="btn btn-danger">Delete</button>
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
                var status =$(this).find(":selected").val();

                var coupon = $(this).attr('id');
                coupon = coupon.split("-");
                coupon = coupon[1];
                $.ajax({
                    type: 'POST',
                    url: '/admin/coupon/update-status',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "coupon": coupon,
                        "status": status
                    }
                });
            })
        })
    </script>
@endpush
