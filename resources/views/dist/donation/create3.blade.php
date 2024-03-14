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

@if($errors->any())
<div class="container">
        <div class="alert alert-danger m-2">
            @foreach ($errors->all() as $error)
            {{ $error }}
            @endforeach
        </div>
</div>
@endif

<div class="container">
    <div class="row min-height d-flex flex-column justify-content-center align-items-center" style="position: relative;">
        
        <div class="row d-flex justify-content-center align-items-center box_shadow pos add-donation-height w-100 " id="phase1">

            <div class="col-md-6 p-2 ">
                <div class="row d-flex justify-content-center">

                    <h5 class="text-center">Select Food</h5>

                    @foreach ($proteins as $key => $food)
                    <div class="col-3 m-1 border  hover rounded item{{$food->id}}" onclick="toggleFoodSelection({{$food->id}})" data-id="{{$food->id}}">
                        {{$food->name}}
                    </div>
                    @endforeach

                </div>
            </div>

            <div class="col-md-6 p-2">
                <div class="row d-flex justify-content-center box_shadow rounded p-3">
                    <h5 class="">Selected Food</h5>
                    <p class=" text-muted">Quantity Measured by kilogram <br><span class="text-danger">If you enter empty fields, the food will be deleted</span></p>
                    
                    <form action="{{ route('dist.donations.proteins')}}" class="col-12 m-1  p-2" method="post" id="selectedDry">
                        @csrf
                        <input type="hidden" name="donation_id" id="donation_id"  value="{{$donation->id}}">
                        
                        <h6 class="text-center text-muted mt-5" id="selectedDryText">No Items Selected</h6>
                        <div id="submitContainer" class="row">
                            <!-- Inputs will be appended here -->
                        </div>
                        @error('quantity')
                            <p class="text-danger">
                                {{$message}}
                            </p>
                        @enderror
                        @error('expDate')
                            <p class="text-danger">
                                {{$message}}
                            </p>
                        @enderror
                        <button type="submit" id="submitButton" class="btn btn-primary w-25 d-none">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <img src="{{asset('/home/img/main3.png')}}" alt="..." class="bg-size img_res">
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
            $('#submitContainer').append('<input type="hidden" name="protein_id[]" value="'+id+'">');
            $('#submitContainer').append('<div class="col-12 parent'+id+'"><label for="quantity" class="form-label lapel'+id+'">'+$('.item'+id).text()+' Quantity and Expiry</label></div>');
            $('#submitContainer').append('<div class="col-5 parent'+id+' mb-1 p-2"><input type="number" placeholder="Enter quantity"  data-id="' + id + '" name="quantity[]" min="1" class="form-control mb-1"></div>');
            $('#submitContainer').append('<div class="col-5 parent'+id+' mb-1 p-2"><input type="date" id="expDate"  name="expDate[]"  data-id="' + id + '" name="expDate[]"  class="form-control mb-3"></div>');
            mainSpinner.classList.add('d-none');
            $('.item'+id).addClass('active');
        }, 500);
    }

    function unchooseFood(id){
        mainSpinner.classList.remove('d-none');
        setTimeout(() => {
            console.log(id);
            $('#submitContainer').find('[name="protein_id[]"][value="'+id+'"]').closest('.parent'+id+'').remove();
            $('#submitContainer').find('[name="protein_id[]"][value="'+id+'"]').remove();
            $('#submitContainer').find('label[class="form-label lapel'+id+'"]').closest('.parent'+id+'').remove();
            $('#submitContainer').find('label[class="form-label lapel'+id+'"]').remove();
            $('#submitContainer').find('input[data-id="' + id + '"]').closest('.parent'+id+'').remove();
            $('#submitContainer').find('input[data-id="' + id + '"]').remove();
            mainSpinner.classList.add('d-none');
            $('.item'+id).removeClass('active');
        }, 500);
    }
</script>
@endsection