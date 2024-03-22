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
                <button  class="btn btn-success w-100 text-capitalize" id="create_btn">Add Needs</button>
            </div>
            <form action="{{ route('needs.store')}}" method="post" id="create" class="d-none">
                @csrf
                <div class="row box_shadow  py-2 my-3">
                    <div class="col-12 border-bottom">
                        <h4>Request new Donation</h4>
                    </div>
                    <div class="col-md-4 my-2">
                        <label for="name" class="form-label">Donation Type</label>
                        <select name="type" class="form-select" id="">
                            <option value="">Select</option>
                            <option value="1">Dry Food</option>
                            <option value="2">Cooked Meals</option>
                            <option value="3">Proteins <span class="text-muted">(meat, fish, eggs)</span></option>
                        </select>
                    </div>
                    <div class="col-md-4 my-2">
                        <label for="qty" class="form-label">Quantity</label>
                        <input type="number" name="qty" placeholder="Quantity" min="1" class="form-control">
                    </div>
                    
                    <div class="col-md-4 my-2">
                        <label for="name" class="form-label">_</label>
                        <button type="submit" class="btn btn-success w-100">Store</button>
                    </div>
                </div>
            </form>
            
        </div>
                
    </div>

    <div class="container mt-3">
        
        @if(isset($needs) && $needs->count() > 0)
        <h4 class="text-green border-bottom p-1">Needs List</h4>
        <table class="table table-light table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Type</th>
                    <th class="table_responsive">Quantity</th>
                    <th class="table_responsive">Status</th>
                    <th class="table_responsive">Added At</th>
                    <th>Show</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($needs as $need)
                @if($need->status != 'pending')
                <tr>
                    <th>{{$need->id}}</th>
                    <td>@if($need->donation_type_id == 1) Dry @elseif($need->donation_type_id == 2) Cooked Meals @elseif($need->donation_type_id == 3) Proteins @endif</td>
                    <td class="table_responsive">{{$need->quantity}}</td>
                    <td class="table_responsive text-uppercase text-success">{{$need->status}}</td>
                    <td class="table_responsive">{{$need->created_at}}</td>
                    <td>
                        <a href="{{ route('needs.show', $need->id)}}">
                            <button class="btn btn-success">Details</button>
                        </a>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
        @else
        <h3 class="text-center">No needs Added</h3>
        @endif
    </div>
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