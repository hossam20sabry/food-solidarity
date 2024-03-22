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
        
        <div class="alert alert-danger mx-3 d-none" id="alert">
            <p></p>
        </div>
        
        {{-- Coose food type--}}
        <div class="row d-flex justify-content-center align-items-center box_shadow pos add-donation-height w-100" id="choose">
            <div class="col-md-4 p-2 d-flex justify-content-center">
                <div class="card" style="width: 18rem;">
                    <img src="{{asset('/home/img/dry1.png')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <form action="{{route('dist.donations.donationType')}}" method="post" id="dry">
                            @csrf
                            <input type="hidden" name="type_id" id="type_id" value="1">
                            <input type="hidden" name="donation_id" id="donation_id"  value="{{$donation->id}}">
                            <h5 class="card-title">Dry Food</h5>
                            <p class="card-text">If you want to donate dry food..</p>
                            <button type="submit" class="btn btn-success">Click here</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 p-2 d-flex justify-content-center">
                <div class="card" style="width: 18rem;">
                    <img src="{{asset('/home/img/cooked1.png')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <form action="{{route('dist.donations.donationType')}}" method="post" id="cooked">
                            @csrf
                            <input type="hidden" name="type_id" id="type_id" value="2">
                            <input type="hidden" name="donation_id" id="donation_id"  value="{{$donation->id}}">
                            <h5 class="card-title">Cooked Food</h5>
                            <p class="card-text">If you want to donate cooked food..</p>
                            <button type="submit" class="btn btn-success">Click here</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 p-2 d-flex justify-content-center">
                <div class="card" style="width: 18rem;">
                    <img src="{{asset('/home/img/protein1.png')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <form action="{{route('dist.donations.donationType')}}" method="post" id="cooked">
                            @csrf
                            <input type="hidden" name="type_id" id="type_id" value="3">
                            <input type="hidden" name="donation_id" id="donation_id"  value="{{$donation->id}}">
                            <h5 class="card-title">Proteins</h5>
                            <p class="card-text">Like Meat or Fish...</p>
                            <button type="submit" class="btn btn-success">Click here</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        

        {{-- phase 1 --}}
        <div class="row d-flex justify-content-center align-items-center box_shadow pos add-donation-height w-100 d-none" id="phase1">

            <div class="col-md-6 p-2 ">
                <div class="row d-flex justify-content-center">

                    <h5 class="text-center">Select Dry Food</h5>

                    @foreach ($dryFoods as $key => $food)
                    <div class="col-3 m-1 border  hover rounded item{{$food->id}}" onclick="toggleFoodSelection({{$food->id}})" data-id="{{$food->id}}">
                        {{$food->name}}
                    </div>
                    @endforeach

                </div>
            </div>

            
            <div class="col-md-6 p-2">
                <div class="row d-flex justify-content-center">
                    <h5 class="text-center">Selected Dry Food</h5>
                    <p class="text-center text-muted">Quantity Measured per kilogram</p>
                    
                    <form action="{{ route('dist.donations.dry')}}" class="col-12 m-1 w-75 p-2" method="post" id="selectedDry">
                        @csrf
                        
                        <input type="hidden" name="donation_id" id="donation_id"  value="{{$donation->id}}">

                        <h6 class="text-center mt-5" id="selectedDryText">No Items Selected</h6>
                        <div id="submitContainer" class="row">
                            <!-- Inputs will be appended here -->
                        </div>
                        <button type="submit" id="submitButton" class="btn btn-primary w-100 d-none">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        
        {{-- phase 2 --}}
        <div class="row d-flex justify-content-center align-items-center box_shadow pos add-donation-height w-100 d-none" id="phase2">
            <div class="col-md-6">
                <form action="{{ route('dist.donations.cooked')}}" method="post">
                    <div class="row d-flex justify-content-center">

                        <h5 class="text-center">Select Cooked Food</h5>

                        <div class="col-md-6">
                            <label for="uantity" class="form-label">Quantity <small>(in kilograms)</small></label>
                            <input type="number" class="form-control" id="uantity" name="uantity">
                            @error('uantity')<p class="text-danger">{{$message}}</p>@enderror
                        </div>

                        <div class="col-md-6">
                            <label for="expDateTime" class="form-label">Expiry Date</label>
                            <input type="dateTime" class="form-control" id="expDateTime" name="expDateTime">
                            @error('expDateTime')<p class="text-danger">{{$message}}</p>@enderror
                        </div>

                        <div class="col-12 mt-3">
                            <button type="button" class="btn btn-primary w-100">Submit</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>


        <img src="{{asset('/home/img/main3.png')}}" alt="..." class="bg-size">

    </div>

    
    

</div>
@endsection

@section('script')
<script>
    var mainSpinner = document.getElementById('mainSpinner');
    var submitButton = document.getElementById('submitButton');
    var selectedDry = document.getElementById('selectedDry');
    var submitContainer = document.getElementById('submitContainer');
    var selectedDryText = document.getElementById('selectedDryText');


    function toggleFoodSelection(id) {
        if ($('.item'+id).hasClass('active')) {
            unchooseFood(id);
        } else {
            chooseFood(id);
        }

        //to toggle Submit Btn 
        setTimeout(() => {
            if (submitContainer.children.length > 3) {
                submitButton.classList.remove('d-none');
                selectedDryText.classList.add('d-none');
            } else {
                submitButton.classList.add('d-none');
                selectedDryText.classList.remove('d-none');
            }
        }, 500);
    }

    function chooseFood(id) {
        mainSpinner.classList.remove('d-none');
        setTimeout(() => {
            $('#submitContainer').append('<input type="hidden" name="dry_food_id[]" value="'+id+'">');
            $('#submitContainer').append('<div class="col-12 parent'+id+'"><label for="quantity" class="form-label lapel'+id+'">'+$('.item'+id).text()+' Quantity and Expiry</label></div>');
            $('#submitContainer').append('<div class="col-5 parent'+id+' m-1 p-2"><input type="number" required data-id="' + id + '" name="quantity[]" min="1" class="form-control mb-1"></div>');
            $('#submitContainer').append('<div class="col-5 parent'+id+' m-1 p-2"><input type="date" id="expDate" name="expDate[]" min="{{ date('Y-m-d') }}" required data-id="' + id + '" name="expDate[]"  class="form-control mb-3"></div>');
            mainSpinner.classList.add('d-none');
            $('.item'+id).addClass('active');
        }, 500);
    }

    function unchooseFood(id){
        mainSpinner.classList.remove('d-none');
        setTimeout(() => {
            console.log(id);
            $('#submitContainer').find('[name="dry_food_id[]"][value="'+id+'"]').closest('.parent'+id+'').remove();
            $('#submitContainer').find('[name="dry_food_id[]"][value="'+id+'"]').remove();
            $('#submitContainer').find('label[class="form-label lapel'+id+'"]').closest('.parent'+id+'').remove();
            $('#submitContainer').find('label[class="form-label lapel'+id+'"]').remove();
            $('#submitContainer').find('input[data-id="' + id + '"]').closest('.parent'+id+'').remove();
            $('#submitContainer').find('input[data-id="' + id + '"]').remove();
            mainSpinner.classList.add('d-none');
            $('.item'+id).removeClass('active');
        }, 500);
    }


</script>
@endSection