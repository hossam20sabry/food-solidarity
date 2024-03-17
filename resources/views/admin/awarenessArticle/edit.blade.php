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
    
    <form action="{{ route('admin.awarenessArticles.update', ['awarenessArticle' => $article->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="row box_shadow m-2 p-2 my-3">
            <div class="col-12 border-bottom">
                <h4>Create Article</h4>
            </div>
            <label for="name" class="form-label">Text <span class="text-danger">if you want to make space write "s1p1a1ce" </span></label>
            <div class="col-md-6">
                <textarea name="text" id="" rows="10" class="p-2" style="width: 100%; height: 100%">{{$article->text}}</textarea>
            </div>
            <div class="col-md-6">
                <div class="w-100">
                    <img src="{{asset('/images/'. $article->img)}}" alt="..." class="w-100">
                </div>
            </div>
            <div class="col-md-6 my-3">
                <label for="name" class="form-label">Image</label>
                <input type="file" name="img" class="form-control">
            </div>
            <div class="col-md-6 my-3">
                <label for="name" class="form-label">_</label>
                <button type="submit" class="btn btn-primary w-100">Update</button>
            </div>
        </div>
    </form>
            
    </div>

@endsection
