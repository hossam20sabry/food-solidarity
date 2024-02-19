<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href={{asset('/home/css/style.css')}}>   
    <link rel="stylesheet" href="@yield('css')">
    {{-- <link rel="icon" href="{{asset('home/img/logo 102.png')}}"> --}}
    <title>Food Solidarity</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar_color box_shadow" style="width: 100%; z-index: 100;">
        <div class="container-fluid px-lg-5">

            <a href="/" style="width: 40px; height: 40px;">
                    {{-- <img src="{{asset('/home/img/logo 102.png')}}" style="width: 40px; height: 40px;" 
                    class="img-fluid" alt="img logo"> --}}
                    Logo 
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse " id="navbarNavDropdown">

                <ul class="navbar-nav me-auto mb-2 mt-3">
                    <li class="nav-item">
                        <a href="" class="nav-link text-capitalize">test</a>
                    </li>
                    
                </ul>
                
                @if(Auth::guard('dist')->check())
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-capitalize nav_item text-center box_shadow" style="color: black !important" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php
                            $userNameParts = explode(' ', Auth::guard('dist')->user()->name, 2);
                            $displayName = $userNameParts[0];
                        ?>
                        {{ $displayName }}
                    </a>

                    <ul class="dropdown-menu">
                        <li><a href="{{ route('dist.profile.edit') }}" class="dropdown-item">Profile</a></li>
                        <form action="{{ route('dist.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">log out</button>
                        </form>
                    </ul>
                </div>
                @else
                <div class="d-flex">   
                    <a class="btn btn-outline-light m-2" aria-current="page" href="{{ route('login') }}">Log in</a>
                    <a class="btn btn-light m-2" aria-current="page" href="{{ route('register') }}">Register</a>
                </div>  
                @endif
            </div>
        </div>
    </nav>
    

    @yield('content')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
    crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
    crossorigin="anonymous"></script>

    @yield('script')
</body>
</html>