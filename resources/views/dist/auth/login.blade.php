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
    <title>login</title>
</head>
<body>
    <div class="container center min_height">
        <div class="row box_shadow m-1 form_shape">
            <a href="/" class="logo">
                <img src="{{asset('/home/img/2355925.jpg')}}" class="responsive_size" alt="" style="width: 280px; height: 250px">
            </a>
            <form method="POST" action="{{ route('dist.login') }}" class="p-3">
                @csrf
                <h3 class="text-uppercase text-center mb-2">Distributor Login</h3>
                <hr class="text-muted">
                <div class="mb-3">
                    <label for="email" class="form-label" >Email address</label>
                    <input type="email" class="form-control" id="email" name="email" :value="old('email')" autofocus autocomplete="username" aria-describedby="emailHelp">
                    @error('email')
                    <div class="form-error">
                        <p class="text-danger mb-3">{{$message}}</p>
                    </div>
                    @enderror               
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" autocomplete="current-password">
                    @error('password')
                    <div class="form-error">
                        <p class="text-danger mb-3">{{$message}}</p>
                    </div>
                    @enderror
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                    <label class="form-check-label" for="remember_me">Remember me</label>
                </div>
                <button type="submit" class="btn btn-success w-100 spiner" id="login">Log in</button>
                
                
                <div class="center mt-2">
                    @if (Route::has('dist.password.request'))
                        <a class=" text-success underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('dist.password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                    <a href="{{ route('dist.register') }}" class="mx-3 text-success" >Register?</a>

                </div>
                @if (session('status'))
                    <div class="my-2 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif
            </form>
        </div>
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
