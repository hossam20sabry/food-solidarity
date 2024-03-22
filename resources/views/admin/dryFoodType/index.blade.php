@extends('admin.layout')

@section('content')
<div class="container my-4">
    @if (session('status'))
    <div class="row">
        <div class="col-md-12 box_shadow alert alert-success ">
            {{session('status')}}
        </div>
    </div>
    @endif
    @if (session('error'))
    <div class="row">
        <div class="col-md-12 box_shadow alert alert-danger ">
            {{session('error')}}
        </div>
    </div>
    @endif
    <div class="row center flex-space-between mx-1">
    
        <div class="col-md-4 box_shadow p-3 my-1">
            <button class="btn btn-primary w-100 text-capitalize" id="create_btn">Create Dry Food Type</a>
        </div>
        
    </div>
    <form action="{{ route('admin.dryFoodTypes.store')}}" method="post" id="create" class="d-none">
        @csrf
        <div class="row box_shadow m-2 p-2 my-3">
            <div class="col-12 border-bottom">
                <h4>Create Dry Food Type</h4>
            </div>
            <div class="col-md-4">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">_</label>
                <button type="submit" class="btn btn-primary w-100">Store</button>
            </div>
        </div>
    </form>
            
    </div>
<div class="container mt-3">
    
    @if(isset($types) && $types->count() > 0)
    <table class="table table-secondary">
        <thead>
            <tr>
                <th class="table_responsive">id</th>
                <th>name</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($types as $type)
            <tr>
                <th class="table_responsive">{{$type->id}}</th>
                <td>{{$type->name}}</td>
                <td>
                    <a href="{{ route('admin.dryFoodTypes.edit', $type->id)}}">
                        <button class="btn btn-primary">Edit</button>
                    </a>
                </td>
                <td>
                    <form action="{{ route('admin.dryFoodTypes.destroy', $type->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <h3 class="text-center">No Author Types</h3>
    @endif
</div>
@endsection

@section('script')
<script>
    var create = document.querySelector('#create');
    var create_btn = document.querySelector('#create_btn');

    create_btn.addEventListener('click', function(){
        create.classList.toggle('d-none');
    });

</script>
@endSection