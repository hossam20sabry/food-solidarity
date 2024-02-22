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
            <a href="{{ route('admin.awarenessArticles.create')}}" class="btn btn-primary w-100 text-capitalize">Create Article</a>
        </div>
        
    </div>

            
    </div>
<div class="container mt-3">
    
    @if(isset($articles) && $articles->count() > 0)
    <table class="table table-secondary">
        <thead>
            <tr>
                <th class="table_responsive">id</th>
                <th>Image</th>
                <th>Explore</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
            <tr>
                <th class="table_responsive">{{$article->id}}</th>
                <td>
                    <img src="{{asset('/images/'. $article->img)}}" alt="..." class="img_table_size">
                </td>
                <td>
                    @if($article->explore == 0)
                    <a href="{{ route('admin.awarenessArticles.explore', $article->id)}}">
                        <button class="btn btn-success">Explore</button>
                    </a>
                    @else
                    Eplored
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.awarenessArticles.edit', $article->id)}}" class="btn btn-primary">Update</a>
                </td>
                <td>
                    <form action="{{ route('admin.awarenessArticles.destroy', $article->id)}}" method="post">
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
    <h3 class="text-center">No Author Article</h3>
    @endif
</div>
@endsection
