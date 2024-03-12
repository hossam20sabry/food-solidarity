@extends('admin.layout')

@section('content')
<div class="container my-4">
    @if (session('success'))
    <div class="row">
        <div class="col-md-12 box_shadow alert alert-success">
            {{session('success')}}
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
    
    <form action="{{ route('admin.benAnswersComplains.store', $complaint->id)}}" method="post">
        @csrf
        <div class="row box_shadow m-2 p-2 my-3">
            <div class="col-12 border-bottom">
                <h4>Send Answer to {{$complaint->user->name}}</h4>
            </div>
            <div class="col-md-12">
                <label for="text" class="form-label">Complain</label>
                <textarea  id="" rows="10" class="p-2" style="width: 100%">{{$complaint->content}}</textarea>
            </div>
            
            <div class="col-md-6 my-3">
                <button type="submit" class="btn btn-primary w-50">Answered</button>
            </div>
        </div>
    </form>
            
    </div>

@endsection
