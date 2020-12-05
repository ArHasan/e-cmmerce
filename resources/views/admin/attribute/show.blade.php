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
                <h3 class="card-title ">Attribute View </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    @php
                    $i=1;
                    @endphp
                    @forelse ($attribute as $key=> $item)

                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->slug }} </td>
                            <td>{{ $item->description }}</td>
                            <td>
                                @php
                                    if($item->status == 1){
                                            echo  "<div class='badge badge-success badge-shadow'>Active</div>";
                                        }else{
                                            echo  "<div class='badge badge-danger badge-shadow'>Inactive</div>";
                                        }
                                @endphp
                            </td>
                            <td>
                                <a href="{{ route('attribute.show',$item->id)}}">
                                    <button class="badge bg-primary">Edit</button>
                                </a>
                                <form action="{{ route('attribute.destroy',$item->id)}}" method="POST">
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
                    {{ $attribute->links() }}
                </div>
            </div>
        </div>

    </div>

@endsection
