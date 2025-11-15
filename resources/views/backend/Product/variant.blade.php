@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>Color list</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Color Name</th>
                        <th>Color Code</th>
                        <th>Action</th>
                    </tr>
                    @foreach ( $colors as $color )
                    <tr>
                        <td>{{ $color->color_name }}</td>
                        <td><i class="d-block" style="width: 30px; height: 30px; background: {{ $color->color_code }};"></i></td>
                        <td>
                            <button class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
         <div class="card">
            <div class="card-header">
                <h3>Size list</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Size Name</th>
                        <th>Action</th>
                    </tr>
                    @foreach ( $sizes as $size )
                    <tr>
                        <td>{{ $size->size_name }}</td>
                        <td>
                            <button class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Add color</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('add.color') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Color Name</label>
                        <input type="text" class="form-control" name="color_name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Color Code</label>
                        <input type="text" class="form-control" name="color_code">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3>Add Size</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('add.size') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Size Name</label>
                        <input type="text" class="form-control" name="size_name">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
