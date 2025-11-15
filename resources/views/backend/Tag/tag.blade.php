@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">

            <div class="card-header">
                <h3>Tag List</h3>
            </div>
            <div class="card-body">
                <table class="table table-borered">
                    <tr>
                        <th>SL</th>
                        <th>Tag Name</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($tags as $index=>$tag )
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $tag->tag_name }}</td>
                        <td>
                            <a href="{{ route('delete.tag',$tag->id) }}" class="btn btn-danger">Delete</a>
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
                <h3>Add New Tag</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('store.tag') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                          @if(session('success'))
                      <div class="alert alert-success">
                         {{ session('success') }}
                      </div>
                          @endif
                        <label for="">Tag Name</label>
                        <input type="text" name="tag name" class="form-control">
                         @error('tag_name')
                         <strong class="text-danger">{{ $message }}</strong>
                         @enderror
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
