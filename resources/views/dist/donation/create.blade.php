@extends('layout')

@section('content')
<div class="container mt-3 min-height d-flex justify-content-center align-items-center">
    <div class="row d-flex justify-content-center align-items-center box_shadow pos add-donation-height w-100 " style="position: relative;">

        <div class="alert alert-danger mx-3 d-none" id="alert"><p></p></div>

        <div class="mainSpinner d-none" id="mainSpinner">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only"></span>
            </div>
        </div>



        @foreach ($donationType as $key => $type)
        <div class="col-md-6 p-2 d-flex @if($key % 2 == 0) justify-content-end @else justify-content-start @endif align-items-center donation1 d-none">
            <div class="card" style="width: 18rem;">
                <img src="{{asset('/images/' . $type->image)}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <form method="post" id="dry">
                        @csrf
                        @method('post')
                        <input type="hidden" name="type_id" id="type_id" value="{{$type->id}}">
                        <input type="hidden" name="donation_id" id="donation_id" value="{{$donation->id}}">
                        <h5 class="card-title">{{$type->name}}</h5>
                        <p class="card-text">{{$type->description}}</p>
                        <button type="submit" class="btn btn-primary">Click here</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach


        <div class="col-md-4 p-2 d-none">
            <img src="{{asset('/home/img/6931987.jpg')}}" class="img-fluid rounded" alt="...">
        </div>

        <img src="{{asset('/home/img/main3.png')}}" alt="..." class="bg-size">

        <div class="col-md-6 p-2  donation2">
            <div class="content-card p-2 m-2">

                <form class="row g-3 needs-validation" action="{{ route('dist.donations.dryFood') }}" method="post">
                    @csrf
                    <div class="col-md-12 border-bottom">
                        <h1 class="text-center text-capitalize">Select Items</h1>
                    </div>
                    <input type="hidden" name="type_id" id="type_id">
                    
                    @foreach ($dryFoods as $food)
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="dryFoods[]" value="{{ $food->id }}" id="flexCheck{{ $food->id }}">
                            <label class="form-check-label" for="flexCheck{{ $food->id }}">
                                {{ $food->name }} - Quantity:
                            </label>
                            <input type="number" min="1" class="form-control" name="quantities[{{ $food->id }}]">
                        </div>
                    </div>
                    @endforeach
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                
            </div>
        </div>

        
    </div>
</div>
@endsection

@section('script')
<script>
    
$(document).ready(function() {

    //choose Donation type
    $('#dry').on('submit', function(e) {
        e.preventDefault();

        $('#mainSpinner').removeClass('d-none');
        var alert = document.getElementById('alert');
        
        $.ajax({
            url: "{{route('dist.donations.donationType')}}",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                type_id: $('#type_id').val()
            },
            success: function(data) {
                if(data.status == 200){
                    $('#mainSpinner').addClass('d-none');
                    if(data.type == 7){
                        $('.donation1').addClass('d-none');
                        $('.donation2').removeClass('d-none');
                    }
                    // if(data.type == 8)
                }else{
                    alert.classList.remove('d-none');
                    alert.querySelector('p').textContent = 'Something went wrong';
                }
            }
        })
    });
})
</script>
@endSection