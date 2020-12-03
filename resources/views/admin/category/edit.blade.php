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
            <h3 class="card-title">update Category </h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('categroy.update',$category->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
            @csrf
            @method('PUT')
            <div class="card-body">

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Category Name</label>
                    <div class="col-sm-10">
                        <input type="name" name="category_name" class="form-control"
                               class="@error('category_name') is-invalid @enderror" id="inputEmail3"
                               value="{{ $category->category_name }}" >
                        @error('category_name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="parent_category_id" class="col-sm-2 col-form-label">Parent Category  </label>
                    <div class="col-sm-10">
                        <select name="parent_category_id" id="parent_category_id"
                                class="form-control @error('parent_category_id') is-invalid @enderror">
                            <option value="0">Select One</option>
                            @foreach($parent_category_id as $category_id)
                                <option  value="{{$category_id->id}}">{{$category_id->category_name}}</option>
                            @endforeach
                        </select>
                        @error('parent_category_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select name="status" id="status" class="form-control">

                            <option value="1" @php echo $category->status==1?"selected":""; @endphp>Active</option>
                            <option value="0" @php echo $category->status==0?"selected":""; @endphp>Inactive</option>

                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label"> Description</label>
                    <div class="col-sm-10">
                    <textarea  type="textarea" name="description" class="form-control"
                               class="@error('description') is-invalid @enderror" id="inputEmail3"  value="{{ $category->description }}"></textarea>
                        @error('description')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label"> Thumbnail</label>
                    <div class="col-sm-10">
                        <input type="file" name="thumbnail" class="form-control"
                               class="@error('thumbnail') is-invalid @enderror" id="inputEmail3" value="{{ $category->thumbnail }}">
                        @error('thumbnail')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

        </form>
    </div>
@endsection
