<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/home/css/login.css')}}">
    <link rel="icon" href="{{asset('/home/img/logo 102.png')}}">
    <title>register</title>
</head>
<body>
    <div class="container min_height">
    
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="row my-3 box_shadow p-2">
                <div class="col-md-6">
                    <div class="logo p-3">
                        <img src="{{asset('/home/img/ssssss.png')}}" class="rounded responsive_size" alt="" >
                    </div> 
                </div>
                <div class="col-md-6">
                    <h3 class="text-center ">Benficiary Registration</h3>
    
                    <div class="row border-top my-2 py-2">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="name" class="form-label" >Name</label>
                                <input type="text" class="form-control" id="name" name="name" :value="old('name')"  autofocus autocomplete="username" aria-describedby="emailHelp">
                            </div>
                            @error('name')
                            <div class="form-error">
                                <p class="text-danger mb-3">{{$message}}</p>
                            </div>
                            @enderror
                        </div>
    
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="phone" class="form-label" >Phone</label>
                                <input type="phone" class="form-control" id="phone" name="phone" :value="old('phone')"  autofocus autocomplete="username" aria-describedby="emailHelp">
                            </div>
                            @error('phone')
                            <div class="form-error">
                                <p class="text-danger mb-3">{{$message}}</p>
                            </div>
                            @enderror
                        </div>
                        
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="auth_type_id" class="form-label" >Author Type</label>
                                <select name="auth_type_id" class="form-select">
                                    <option selected disabled>Select Author Type</option>
                                    @foreach ($authorTypes as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('auth_type_id')
                            <div class="form-error">
                                <p class="text-danger mb-3">{{$message}}</p>
                            </div>
                            @enderror
                        </div>
    
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="city_id" class="form-label" >City</label>
                                <select name="city_id" class="form-select">
                                    <option selected disabled>Select City</option>
                                    @foreach ($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('city_id')
                            <div class="form-error">
                                <p class="text-danger mb-3">{{$message}}</p>
                            </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="address" class="form-label" >address</label>
                                <input type="text" class="form-control" id="address" name="address" :value="old('address')">
                            </div>
                            @error('address')
                            <div class="form-error">
                                <p class="text-danger mb-3">{{$message}}</p>
                            </div>
                            @enderror
                        </div>
    
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="email" class="form-label" >Email address</label>
                                <input type="email" class="form-control" id="email" name="email" :value="old('email')"  autofocus autocomplete="username" aria-describedby="emailHelp">
                            </div>
                            @error('email')
                            <div class="form-error">
                                <p class="text-danger mb-3">{{$message}}</p>
                            </div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password"  autocomplete="current-password">
                            </div>
                            @error('password')
                            <div class="form-error">
                                <p class="text-danger mb-3">{{$message}}</p>
                            </div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"  autocomplete="current-password">
                            </div>
                            @error('password_confirmation')
                            <div class="form-error">
                                <p class="text-danger mb-3">{{$message}}</p>
                            </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-success w-100" id="login">Register</button>
                            
                            <div class="center mt-2">
                                <a href="{{ route('login') }}" class="mx-3" >Already have an account?</a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </form>
</div>

<div class="mainSpinner d-none" id="mainSpinner">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only"></span>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
crossorigin="anonymous"></script>
<script>
    
    $(document).ready(function(){
        $('#login').click(function(){
            $('#mainSpinner').removeClass('d-none');
        });
    });

</script>

</body>
</html>