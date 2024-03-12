@extends('layout')

@section('content')
    <div class="container">
        <div class="row min-height d-flex flex-column justify-content-center align-items-center" style="position: relative;">
            <div class="col-md-6">
                <h3 class="text-success">Request Details</h3>
                <table class="table table-light">
                    <tr>
                        <th>Need ID</th>
                        <td>{{$need->id}}</td>
                    </tr>
                    @if($need->status == 'matched')
                    <tr>
                        <th>Donation ID</th>
                        <td>{{$need->donation->id}}</td>
                    </tr>
                    <tr>
                        <th>Donor</th>
                        <td>{{$need->donation->dist->name}}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{$need->donation->dist->email}}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{$need->donation->dist->address}}</td>
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
                        <td class="text-capitalize" @if($need->status == 'matched') class="text-success" @endif>{{$need->status}}</td>
                    </tr>
                    <tr>
                        <th>Added At</th>
                        <td>{{$need->created_at->toDayDateTimeString()}}</td>
                    </tr>
                    @if(isset($need->donation->foods) && $need->donation->foods->count() > 0)
                    <tr>
                        <th>Foods <br><p class="text-danger" style="font-size: 12px;">Quantity Mesured by Kg</p></th>
                        <td>
                            <ul>
                                @foreach ($need->donation->foods as $food)
                                <li class="text-capitalize">{{$food->name}} - {{$food->quantity}} Kg</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                    @endif
                    @if(isset($need->donation->cookedMeals) && $need->donation->cookedMeals->count() > 0)
                    <tr>
                        <th>Foods</th>
                        <td>
                            <ul>
                                @foreach ($need->donation->cookedMeals as $food)
                                <li class="text-capitalize">{{$food->quantity}} Meal</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                    @endif
                </table>
            </div>

            <img src="{{asset('/home/img/main3.png')}}" alt="..." class="bg-size">
        </div>
    </div>
@endsection