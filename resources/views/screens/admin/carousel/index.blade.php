@extends('layout.admin.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="fw-bold">All Carousels</h2>
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
                        @if ($carousels)
                         <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                aria-describedby="example1_info">
                                <thead>
                                    <tr>
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example1"
                                            rowspan="1" colspan="1" aria-sort="ascending"
                                            aria-label="id: activate to sort column ascending">id
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Banner: activate to sort column ascending">Banner
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Banner: activate to sort column ascending">Image
                                        </th>

                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Description: activate to sort column ascending">
                                            Description</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="CSS grade: activate to sort column ascending">Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carousels as $carousel)
                                        <tr class="odd">
                                            <td class="dtr-control sorting_1" tabindex="0">{{ $carousel->id }}</td>
                                            <td>{{ $carousel->title }}</td>
                                            <td><img src="{{ asset('images/banner/' . $carousel->banner) }}" width="50"
                                                    height="50" alt=""></td>
                                            <td>{{ $carousel->description }}</td>

                                            <td>
                                                <a href="{{ route('admin.carousel.edit', $carousel->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                                <a href="{{ route('admin.carousel.destroy', $carousel->id) }}"
                                                    class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach



                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th rowspan="1" colspan="1">id</th>
                                        <th rowspan="1" colspan="1">Category</th>
                                        <th rowspan="1" colspan="1">Image</th>

                                        <th rowspan="1" colspan="1">Actions</th>
                                    </tr>
                                </tfoot>
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
