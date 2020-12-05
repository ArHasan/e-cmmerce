@extends('layouts.dashboard')

@section('home')
<div class="col-md-12">
    @if(session('delete'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>👍</strong> {{session('delete')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card">
        <div class="card-header bg-primary">
            <h3 class="card-title ">Category View </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 10px">ID</th>
                    <th>Category Name</th>
                    <th>Slug</th>
                    <th>Parent Category</th>
                    <th>Description</th>
                    <th>Thumbnail</th>
                    <th>Status</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>
                @forelse ($category as $item)

                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->category_name }}</td>
                        <td>{{ $item->slug }} </td>
                        <td>
                            @if($item->parent_category_id ==0)
                                {{'Main'}}
                            @else
                                    {{ $item->categoryname->category_name}}
                            @endif

                        </td>
                        <td>{{ $item->description }}</td>
                        <td>
                            <img src="{{asset('/img/category').'/'.$item->thumbnail }}" alt="image" width="50">
                        </td>
                        <td>
                            @php
                                if($item->status == 1){
                                        echo  "<div class='badge badge-success badge-shadow'>Active</div>";
                                    }else{
                                        echo  "<div class='badge badge-danger badge-shadow'>Inactive</div>";
                                    }
                            @endphp
                        </td>


                        </td>
                        <td>
                            <a href="{{ route('categroy.show',$item->id)}}">
                                   <button class="badge bg-primary">Edit</button>
                                </a>
                            <form action="{{ route('categroy.destroy',$item->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="badge bg-danger" >Delete </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="50"><p class="badge bg-danger">NO Data in your Database</p></td>

                    </tr>

                @endforelse

                </tbody>
            </table>
            <div>
                {{ $category->links() }}
            </div>
        </div>
        <!-- /.card-body -->
        {{-- <div>
            {{ $category->links() }}
        </div> --}}
        {{-- <div class="card-footer clearfix">
            <li class="page-item">{{ $category->links() }}</li>
        </div> --}}
    </div>

</div>

@endsection
