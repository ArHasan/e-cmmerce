@extends('layouts.dashboard')

@section('home')

    <!-- Horizontal Form -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>👍</strong> {{session('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card card-primary mt-4">
        <div class="card-header">
            <h3 class="card-title">Attribute Add</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('attribute.store') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
            @csrf
            <div class="card-body">

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control"
                               class="@error('name') is-invalid @enderror" id="inputEmail3"
                               placeholder="Name">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <input type="text" name="description" class="form-control"
                               class="@error('description') is-invalid @enderror" id="inputEmail3"
                               placeholder="Description">
                        @error('description')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select name="status" id="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

        </form>
    </div>


@endsection
