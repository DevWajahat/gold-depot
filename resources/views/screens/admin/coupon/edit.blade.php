@extends('layout.admin.app')
@section('content')
 <div class="container mt-4 mb-5">
        <div class="row">
            <div class="col col-lg-2"></div>
            <div class="col col-lg-8">
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="mt-3">
                    <h2>Update Coupon</h2>
                </div>

                <form action="{{ route('admin.coupon.update',$coupon->id) }}" method="post" class="mt-4">
                    @csrf
                    <div class="mt-3">
                        <label for="name" class="form-label">Coupon Code:</label>
                        <input type="text" value="{{ $coupon->coupon_code }}"
                            class="form-control @error('discount') is-invalid  @enderror" name="coupon_code"
                            id="coupon_code">
                        @error('coupon_code')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="type" class="form-label">Type:</label>
                        <select name="type" id="" class="form-control">
                            <option value="amount"  {{ $coupon->type == 'amount' ? 'selected' : '' }}>Amount</option>
                            <option value="percent" {{ $coupon->type == 'percent' ? 'selected' : '' }}>Percent</option>
                        </select>
                    </div>

                    <div class="mt-3">
                        <label for="type" class="form-label">Discount:</label>
                        <input type="number" value="{{ $coupon->discount }}"
                            class="form-control @error('discount') is-invalid  @enderror" name="discount" id="name">
                        @error('discount')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="type" class="form-label">Max Usage:</label>
                        <input type="number" value="{{ $coupon->max_usage }}"
                            class="form-control @error('max_usage') is-invalid  @enderror" name="max_usage" id="max_usage">
                        @error('max_usage')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="type" class="form-label">Expiry:</label>
                        <input type="datetime-local" value="{{ $coupon->expiry }}"
                            class="form-control @error('expiry') is-invalid  @enderror" name="expiry" id="expiry">
                        @error('expiry')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="type" class="form-label">Status:</label>
                        <select name="status" id="" class="form-control">
                            <option value="active" {{ $coupon->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive"{{ $coupon->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="mt-5">
                        <input type="submit" value="Update Coupon" class="btn btn-primary col-lg-12" id="">
                    </div>
                </form>

            </div>
            <div class="col col-lg-2"></div>
        </div>
    </div>

@endsection
