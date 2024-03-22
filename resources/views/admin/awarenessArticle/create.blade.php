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
    
    <form action="{{ route('admin.awarenessArticles.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row box_shadow m-2 p-2 my-3">
            <div class="col-12 border-bottom">
                <h4>Create Article</h4>
            </div>
            <label for="name" class="form-label">Text</label>
            <div class="col-md-12">
                <textarea name="text" id="" rows="10" class="p-2" style="width: 100%"></textarea>
            </div>
            
            <div class="col-md-6 my-3">
                <label for="name" class="form-label">Image</label>
                <input type="file" name="img" class="form-control">
            </div>
            <div class="col-md-6 my-3">
                <label for="name" class="form-label">_</label>
                <button type="submit" class="btn btn-primary w-100">Store</button>
            </div>
        </div>
    </form>
            
    </div>

@endsection
