@extends('layout')

@section('content')
    <div class="mainBackground">
        <div class="container">
            <div class="content">
                <h1 class="color-green h1-text-responsive">Food Solidarity</h1>
                <h2 class="color-green text-responsive2">Between Institutions and Individuals</h2>
                <div class="background-text-responsive">
                    <p class="text-responsive">In a world of plenty, it is disheartening to acknowledge that millions of our fellow<br>
                        human beings go to bed hungry every night. The stark reality of food insecurity persists<br>
                        despite an abundance of resources, and it demands our urgent attention. This essay serves<br>
                        as a call to action, aiming to raise awareness about the concept of food solidarity and inspire<br>
                        individuals to extend a helping hand to those who have no food.</p>
                </div>
                @if(Auth::guard('web')->guest() && Auth::guard('dist')->guest())
                    <a href="{{ route('select.register')}}" class="btn btn-success my-3">Get Started</a>
                @endif
            </div>
        </div>
        <img src="{{asset('/home/img/mainBackgound.png')}}" alt="background"  style="height: 100vh; width: 100%">
    </div>

    @if(isset($topDonors) && $topDonors->count() > 0)
    <div class="container mt-5">
        <h1 class="color-green mb-4 border-bottom py-2">Top Donors</h1>
        <table class="table table-light  table-striped">
            <tr>
                <th style="max-width: 70px; overflow-x: scroll">Name</th>
                <th style="max-width: 100px; overflow-x: scroll">Email</th>
                <th>Total Quantity</th>
            </tr>
            @foreach($topDonors as $topDonor)
            <tr>
                <td style="max-width: 70px; overflow-x: scroll">{{$topDonor->name}}</td>
                <td style="max-width: 100px; overflow-x: scroll">{{$topDonor->email}}</td>
                <td>
                    @php
                        $totalQuantity = 0;
                        foreach ($topDonor->donations as $donation) {
                            $totalQuantity += $donation->quantity;
                        }
                    @endphp
                    {{ $totalQuantity }}
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    @endif

    @if(isset($article))
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-6">                        
                <p id="textFilter">{!! str_replace('s1p1a1ce', '<br>', $article->text) !!}</p>
            </div>
            <div class="col-sm-6 mb-5">
                <div class="row">
                    <div class="col">
                        <img src="{{asset('/images/' . $article->img)}}" alt="" class="img-fluid">
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    @endif
@endsection
