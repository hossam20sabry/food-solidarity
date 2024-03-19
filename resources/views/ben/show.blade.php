@extends('layout')

@section('content')
    <div class="container">
        <div class="row min-height d-flex justify-content-center align-items-center" style="position: relative;">
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
                        <th>Phone</th>
                        <td>{{$need->donation->dist->phone}}</td>
                    </tr>
                    <tr>
                        <th>Donor Location</th>
                        <td ><a href="{{$need->donation->dist->location_link}}" class="btn btn-success" target="_blank">google maps</a></td>
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
            {{-- <div class="col-md-6">
                <h3 class="text-success">Donor location</h3>

                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13828.691426885103!2d31.249323718676745!3d29.945706216951066!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145847fdb554b405%3A0x8b51139c313d8043!2sTaracina%20Wedding%20on%20the%20Nile!5e0!3m2!1sar!2seg!4v1710628994325!5m2!1sar!2seg" 
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div> --}}

            <img src="{{asset('/home/img/main3.png')}}" alt="..." class="bg-size img_res">
        </div>
    </div>
@endsection