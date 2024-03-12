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
<div class="container mt-3">
    
    @if(isset($complaints) && $complaints->count() > 0)
    <table class="table table-secondary">
        <thead>
            <tr>
                <th class="table_responsive">id</th>
                <th>name</th>
                <th>Answer</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($complaints as $complaint)
            <tr>
                <th class="table_responsive">{{$complaint->id}}</th>
                <td>{{$complaint->user->name}}</td>
                <td>
                    <a href="{{ route('admin.benAnswersComplains.create', $complaint->id)}}">
                        <button class="btn btn-primary">Answer</button>
                    </a>
                </td>
                

            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <h3 class="text-center">No Complaints</h3>
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