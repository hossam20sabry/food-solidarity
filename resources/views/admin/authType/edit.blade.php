@extends('admin.layout')

@section('content')
<div class="container my-4">
    @if (session('status'))
    <div class="row">
        <div class="col-md-12 box_shadow alert alert-success">
            {{session('status')}}
        </div>
    </div>
    @endif
    @if (session('error'))
    <div class="row">
        <div class="col-md-12 box_shadow alert alert-danger">
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
    
    <form action="{{ route('admin.authTypes.update', ['authType' => $type->id])}}" method="post" id="create">
        @csrf
        @method('patch')
        <div class="row box_shadow m-2 p-2 my-3">
            <div class="col-12 border-bottom">
                <h4>Update Author Type</h4>
            </div>
            <div class="col-md-4">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{$type->name}}">
            </div>
            <div class="col-md-4">
                <label for="flag" class="form-label">Type Donor = 0 | Type Beneficiary = 1</label>
                <input type="number" min="0" max="1"  value="{{$type->flag}}" name="flag" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">_</label>
                <button type="submit" class="btn btn-primary w-100">Update</button>
            </div>
        </div>
    </form>
            
    </div>

@endsection
