@extends('layout.admin.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="fw-bold">All Blogs</h2>
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
                                            colspan="1" aria-label="Category: activate to sort column ascending">Blog
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Image: activate to sort column ascending">
                                            Image</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="CSS grade: activate to sort column ascending">Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($blogs as $blog)
                                        <tr class="odd">
                                            <td class="dtr-control sorting_1" tabindex="0">{{ $blog->id }}</td>
                                            <td>{{ $blog->name }}</td>
                                            <td><img src="{{ asset('images/blogs/' . $blog->image) }}" width="50"
                                                    height="50" alt=""></td>

                                            <td>
                                                <a href="{{ route('admin.blog.edit', $blog->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                                <a href="{{ route('admin.blog.destroy', $blog->id) }}"
                                                    class="btn btn-danger">Delete</a>
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
