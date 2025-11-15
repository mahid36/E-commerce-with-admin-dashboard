@extends('layouts.admin');
@section('content');
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h1>Update Profile</h1>
                @if (session('success'))
            <div class="alert alert-success ">
                {{ session('success') }}

    </div>
@endif
            </div>
            <div class="card-body">
                <form action="{{ route('update_profile') }}"method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label"> Update Name</label>
                        <input type="text" name="name"class="form-control" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Upload image</label>
                        <input type="file" name="photo"class="form-control">
                        @error('photo')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
            <div class="card-header">
                <h3>Change password</h3>
            </div>
            <div class="card-body">
                @if (session('pass_update'))
                <div class="alert alert-success">{{ (session('pass_update'))  }}</div>

                @endif
                <form action="{{ route('update_password') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Current Password</label>
                        <input type="password" name="current_password" class="form-control">
                         @error('current_password')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                        @if (session('wrong'))
                        <strong class="text-danger">{{ (session('wrong')) }}</strong>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" name="new_password" class="form-control">
                         @error('new_password')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="new_password_confirmation" class="form-control">
                         @error('new_password_confirmation')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
