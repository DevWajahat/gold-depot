@extends('layout.admin.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="fw-bold">All Categories</h2>
        </div>
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!-- /.card-header -->
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        {{-- @dd($categories) --}}
                        @if ($categories)
                            <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                aria-describedby="example1_info">
                                <thead>
                                    <tr>
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example1"
                                            rowspan="1" colspan="1" aria-sort="ascending"
                                            aria-label="id: activate to sort column ascending">id
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Category: activate to sort column ascending">Category
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Image: activate to sort column ascending">
                                            Image</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Status: activate to sort column ascending">
                                            Status</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="CSS grade: activate to sort column ascending">Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr class="odd">
                                            <td class="dtr-control sorting_1" tabindex="0">{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td><img src="{{ asset('images/category/' . $category->image) }}" width="50"
                                                    height="50" alt=""></td>
                                            <td>
                                                <select name="status" id="status-{{ $category->id }}"
                                                    class="form-control status">
                                                    <option value="available"
                                                        {{ $category->status == 'available' ? 'selected' : '' }}>Available
                                                    </option>
                                                    <option value="unavailable"
                                                        {{ $category->status == 'unavailable' ? 'selected' : '' }}>
                                                        Unavailable</option>
                                                </select>

                                            </td>
                                            <td>
                                                <a href="{{ route('admin.category.edit', $category->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

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
                var category = $(this).attr('id');
                category = category.split("-")
                category = category[1];
                $.ajax({
                    type: 'POST',
                    url: '/admin/category/update-status/',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "status": status,
                        "category": category
                    },
                    success: function(response){
                        console.log(response)
                    }
                });
            });
        });
    </script>
@endpush
