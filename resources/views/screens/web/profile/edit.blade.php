@extends('layout.web.app')

@section('content')
    <div class="container mb-5">

        <h3 class="mt-4 mb-4">Update Profile</h3>

        <form action="{{ route('profile.update') }}" method="post">
            @csrf
            <div class="mt-3">
                <label for="" class="form-label">First Name</label>
                <input type="text" name="first_name" value="{{ $user->first_name }}"
                    class="form-control @error('first_name') is-invalid @enderror" id="">
                @error('first_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-4">
                <label for="" class="form-label">Last Name</label>
                <input type="text" name="last_name" value="{{ $user->last_name }}"
                    class="form-control @error('last_name') is-invalid @enderror" id="">
                @error('last_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-4">
                <label for="" class="form-label">Phone</label>
                <input type="text" name="phone" value="{{ $user->phone }}"
                    class="form-control @error('phone') is-invalid @enderror" id="">
                @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-4">
                <input type="submit" value="Update Profile" class="btn btn-primary w-100">
            </div>
        </form>
    </div>
@endsection
