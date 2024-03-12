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
    @if(session()->has('success'))
        <div class="container">
                <div class="alert alert-success m-2">
                    {{ session()->get('success') }}
                </div>
        </div>
    @endif
    <div class="row min-height d-flex flex-column justify-content-center align-items-center" style="position: relative;">
        
        <div class="row d-flex justify-content-center align-items-center box_shadow pos add-donation-height w-100" id="phase1">

            <div class="col-md-6 p-2 ">
                <div class="row d-flex justify-content-center ">

                    <h5 class="">Send Complaint</h5>

                    <form action="{{ route('dist.complaints.store')}}" method="post">
                        @csrf
                        <div class="my-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Complaint Content:</label>
                            <textarea class="form-control" name="text"  id="exampleFormControlTextarea1" rows="5"></textarea>
                            @error('text')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="my-3">
                            <button type="submit" class="btn btn-success w-25">Submit</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>

        <img src="{{asset('/home/img/main3.png')}}" alt="..." class="bg-size">
    </div>
</div>
@endsection