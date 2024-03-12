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
    @if ($errors->any())
    <div class="row">
        <div class="col-md-12 box_shadow alert alert-danger ">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </div>
    </div>
    @endif
    <div class="row center flex-space-between mx-1">
    
        <div class="col-md-4 box_shadow p-3 my-1">
            <button class="btn btn-primary w-100 text-capitalize" id="create_btn">Create Author Type</a>
        </div>
        
    </div>
    <form action="{{ route('admin.authTypes.store')}}" method="post" id="create" class="d-none">
        @csrf
        <div class="row box_shadow m-2 p-2 my-3">
            <div class="col-12 border-bottom">
                <h4>Create Author Type</h4>
            </div>
            <div class="col-md-4 mt-2">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="col-md-4 mt-2">
                <label for="flag" class="form-label">Type Donor = 0 | Type Beneficiary = 1</label>
                <input type="number" min="0" max="1" value="0" name="flag" class="form-control">
            </div>
            <div class="col-md-4 mt-2 mb-3">
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
                <th>Type</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($types as $type)
            <tr>
                <th class="table_responsive">{{$type->id}}</th>
                <td>{{$type->name}}</td>
                <td>@if($type->flag == 0) Donor @else Beneficiary @endif</td>
                <td>
                    <a href="{{ route('admin.authTypes.edit', $type->id)}}">
                        <button class="btn btn-primary">Edit</button>
                    </a>
                </td>
                <td>
                    <form action="{{ route('admin.authTypes.destroy', $type->id)}}" method="post">
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