@extends('layout')

@section('content')
<div class="mainSpinner d-none" id="mainSpinner">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only"></span>
    </div>
</div>
@if(session()->has('error'))
<div class="container">
        <div class="alert alert-danger m-2">
            {{ session()->get('error') }}
        </div>
</div>
@endif

<div class="container">
    <div class="row min-height d-flex flex-column justify-content-center align-items-center" style="position: relative;">
        
        <div class="row d-flex justify-content-center align-items-center box_shadow pos add-donation-height w-100">
            <div class="col-md-6">
                <form action="{{ route('dist.donations.cooked') }}" method="post">
                    @csrf
                    <input type="hidden" name="donation_id" id="donation_id"  value="{{$donation->id}}">
                    <div class="border-bottom">
                        <h5 class="">Donate Cooked Meals</h5>
                        <p class=" text-muted">Quantity Measured by Meal</p>
                    </div>
                    <div class="mt-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" placeholder="Enter quantity" name="quantity" aria-describedby="emailHelp">
                        @error('quantity')<p class="text-danger">{{$message}}</p>@enderror
                    </div>
                    <div class="mt-3">
                        <label for="cooked_time" class="form-label">Cooked Time</label> 
                        <input type="datetime-local" class="form-control" placeholder="" id="cooked_time" name="cooked_time">
                        @error('cooked_time')<p class="text-danger">{{$message}}</p>@enderror
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-success w-25">Submit</button>
                    </div>
                </form>
            </div>
        </div>


        <img src="{{asset('/home/img/main3.png')}}" alt="..." class="bg-size img_res">
    </div>
</div>
@endsection

@section('script')
<script>
        var today = new Date();

        var sixDaysAgo = new Date(today);
        sixDaysAgo.setDate(today.getDate() - 6);

        var formattedDate = sixDaysAgo.toISOString().slice(0, 16);

        document.getElementById("cooked_time").min = formattedDate;
</script>
@endsection