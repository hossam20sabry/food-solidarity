@extends('layout')

@section('content')
    <div class="container">
        <div class="row min-height d-flex flex-column justify-content-center align-items-center" style="position: relative;">
            <div class="col-md-6">
                <h3 class="text-success">Donation Details</h3>
                <table class="table table-light">
                    <tr>
                        <th>ID</th>
                        <td>{{$donation->id}}</td>
                    </tr>
                    @if($donation->status == 'matched')
                    <tr>
                        <th>Beneficiary</th>
                        <td>{{$donation->need->user->name}}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{$donation->need->user->email}}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{$donation->need->user->phone}}</td>
                    </tr>
                    @endif
                    <tr>
                        <th>Quantity</th>
                        <td>{{$donation->quantity}}</td>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <td>@if($donation->donation_type == 1) Dry @elseif($donation->donation_type == 2) Cooked Meals @elseif($donation->donation_type == 3) Proteins @endif</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td @if($donation->status == 'matched') class="text-success" @endif>{{$donation->status}}</td>
                    </tr>
                </table>
            </div>

            <img src="{{asset('/home/img/main3.png')}}" alt="..." class="bg-size">
        </div>
    </div>
@endsection