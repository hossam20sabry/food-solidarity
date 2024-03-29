@extends('layout')

@section('content')
<div class="container mt-3 min-height d-flex justify-content-center align-items-center">
    <div class="row d-flex justify-content-center align-items-center gap-3">
        <div class="card m-2 card-responsive card-width">
            <img src="{{asset('/home/img/2355925.jpg')}}" class="card-img-top m-1 radius " alt="...">
            <div class="card-body">
                <h5 class="card-title">Donor</h5>
                <p class="card-text">Sign up as a Donor(Hotels & Restaurants & Individuals) to add your ecxess food to distribute it to who deserve it.</p>
                <a href="{{route('dist.login')}}" class="btn w-100 background4">Login </a>
            </div>
        </div>
        <div class="card m-2 card-responsive card-width">
            <img src="{{asset('/home/img/ssssss.png')}}" class="rounded card-img-top m-1 w-100 mb-2" alt="...">
            <div class="card-body">
                <h5 class="card-title">Beneficiary</h5>
                <p class="card-text">Sign up as a beneficiary(charity organization & chiken farmers) to Find available food donations from hotels and restaurants.</p>
                <a href="{{route('login')}}" class="btn w-100 background3">Login</a>
            </div>
        </div>
    </div>
    
</div>
@endsection