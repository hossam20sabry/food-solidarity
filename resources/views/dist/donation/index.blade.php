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
                    <button  class="btn btn-success w-100 text-capitalize" id="create_btn">Add Donation</button>
                </form>
            </div>
            
        </div>
                
    </div>

    <div class="container mt-3">
        
        @if(isset($donations) && $donations->count() > 0)
        <h4 class="text-green border-bottom p-1">Donations List</h4>
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
                @foreach ($donations as $donation)
                @if($donation->status == 'confirmed')
                <tr>
                    <th>{{$donation->id}}</th>
                    <td>@if($donation->donation_type == 1) Dry @elseif($donation->donation_type == 2) Cooked Meals @elseif($donation->donation_type == 3) Proteins @endif</td>
                    <td class="table_responsive">{{$donation->quantity}}</td>
                    <td class="table_responsive text-uppercase text-success">{{$donation->status}}</td>
                    <td class="table_responsive">{{$donation->created_at}}</td>
                    <td>
                        <a href="{{ route('dist.donations.show', $donation->id)}}">
                            <button class="btn btn-success">Details</button>
                        </a>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
        @else
        <h3 class="text-center">No Donations Added</h3>
        @endif
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