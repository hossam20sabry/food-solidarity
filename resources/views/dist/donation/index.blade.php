@extends('layout')

@section('content')
<div class="min_hei">

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
        <div class="row center flex-space-between mx-1">
        
            <div class="col-md-4 box_shadow p-3 my-1">
                <form action="{{ route('dist.donations.store') }}" method="post">
                    @csrf
                    <button  class="btn btn-primary w-100 text-capitalize" id="create_btn">Add Donation</button>
                </form>
            </div>
            
        </div>
                
    </div>

    <div class="container mt-3">
        
        {{-- @if(isset($types) && $types->count() > 0) --}}
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
                {{-- @foreach ($types as $type)
                <tr>
                    <th class="table_responsive">{{$type->id}}</th>
                    <td>{{$type->name}}</td>
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
                @endforeach --}}
            </tbody>
        </table>
        {{-- @else
        <h3 class="text-center">No Author Types</h3>
        @endif --}}
    </div>
</div>
@endsection

{{-- @section('script')
<script>
    var create = document.querySelector('#create');
    var create_btn = document.querySelector('#create_btn');

    create_btn.addEventListener('click', function(){
        create.classList.toggle('d-none');
    });

</script>
@endSection --}}