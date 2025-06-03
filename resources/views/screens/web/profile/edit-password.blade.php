@extends('layout.web.app')

@section('content')
    <div class="container mb-5">

        <h3 class="mt-4 mb-4">Update Password</h3>

        <form action="{{ route('profile.update.password') }}" method="post">
            @csrf
            <div class="mt-3">
                <label for="" class="form-label">Old Password</label>
                <input type="password" name="old_password" value=""
                    class="form-control @error('old_password') is-invalid @enderror" id="">
                @error('old_password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-4">
                <label for="" class="form-label">New Password</label>
                <input type="password" name="new_password" value=""
                    class="form-control @error('new_password') is-invalid @enderror" id="">
                @error('new_password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-4">
                <label for="" class="form-label">Confirm Password</label>
                <input type="password" name="new_password_confirmation" value=""
                    class="form-control @error('new_password_confirmation') is-invalid @enderror" id="">
                @error('new_password_confirmation')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-4">
                <input type="submit" value="Update Profile" class="btn btn-primary w-100">
            </div>
        </form>
    </div>
@endsection
