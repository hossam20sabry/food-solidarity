@extends('layout')

@section('content')
    <div class="container">
        <div class="row min-height d-flex flex-column justify-content-center align-items-center" style="position: relative;">
            <div class="col-md-6">
                <h3 class="text-success">Request Details</h3>
                <table class="table table-light">
                    <tr>
                        <th>ID</th>
                        <td>{{$need->id}}</td>
                    </tr>
                    @if($need->status == 'matched')
                    <tr>
                        <th>Donor</th>
                        <td>{{$need->donation->dist->name}}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{$need->donation->dist->email}}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{$need->donation->dist->phone}}</td>
                    </tr>
                    @endif
                    <tr>
                        <th>Quantity</th>
                        <td>{{$need->quantity}}</td>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <td>@if($need->donation_type_id == 1) Dry @elseif($need->donation_type_id == 2) Cooked Meals @elseif($need->donation_type_id == 3) Proteins @endif</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td @if($need->status == 'matched') class="text-success" @endif>{{$need->status}}</td>
                    </tr>
                </table>
            </div>

            <img src="{{asset('/home/img/main3.png')}}" alt="..." class="bg-size">
        </div>
    </div>
@endsection