<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href={{asset('/home/css/style2.css')}}>  
    <link rel="stylesheet" href={{asset('/home/css/notify.css')}}>  
    {{-- <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('a72b09cd71426c5a340b', {
            cluster: 'eu'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            alert(JSON.stringify(data));
        });

    </script> --}}

    <link rel="stylesheet" href="@yield('css')">
    {{-- <link rel="icon" href="{{asset('home/img/logo 102.png')}}"> --}}
    <title>Food Solidarity</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        
        <div class="container" style="position: relative">

            <a class="navbar-brand" href="/">Food Solidarity</a>


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse " id="navbarNavDropdown">

                <ul class="navbar-nav me-auto mb-2 mt-3">
                    
                    @if(Auth::guard('dist')->check())
                    <li class="nav-item">
                        <a href="{{ route('dist.donations.index')}}" class="nav-link text-capitalize">Donations</a>
                    </li>
                    @endif

                    @if(Auth::guard('web')->check())
                    <li class="nav-item">
                        <a href="{{ route('needs.index')}}" class="nav-link text-capitalize">Requests</a>
                    </li>
                    @endif
                    
                </ul>

                
                @if(Auth::guard('dist')->check())
                <a  href="{{ route('dist.notifications') }}" class="notification mx-3" style="position: relative; cursor: pointer !important;display: inline-block;">

                    <i class="fas fa-bell" style="font-size: 25px;color: black;"></i>
                    <span class="badge" id="counter"
                    style="position: absolute;
                    top: -8px;
                    right: -8px;
                    background-color: red;
                    color: white;
                    border-radius: 50%;
                    padding: 5px 8px;
                    font-size: 12px;">{{ count(Auth::guard('dist')->user()->unreadNotifications) }}</span>
                    
                </a>
                <div class="nav-item dropdown">


                    <a class="nav-link dropdown-toggle text-capitalize nav_item text-center border rounded" style="color: black !important" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                
                @elseif(Route::has('login'))
                    @auth
                    @if(Auth::guard('web')->check())
                    <a  href="{{ route('notifications') }}" class="notification mx-3" style="position: relative; cursor: pointer !important;display: inline-block;">

                        <i class="fas fa-bell" style="font-size: 25px; color: black;"></i>
                        <span class="badge" id="counter"
                        style="position: absolute;
                        top: -8px;
                        right: -8px;
                        background-color: red;
                        color: white;
                        border-radius: 50%;
                        padding: 5px 8px;
                        font-size: 12px;">{{ count(Auth::guard('web')->user()->unreadNotifications) }}</span>
                        
                    </a>
                    @endif
                    <div class="nav-item dropdown">
                        
                        <a class="nav-link dropdown-toggle text-capitalize nav_item text-center border rounded" style="color: black !important" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php
                                $userNameParts = explode(' ', Auth::user()->name, 2);
                                $displayName = $userNameParts[0];
                            ?>
                            {{ $displayName }}
                        </a>
                        @if(Auth::guard('dist')->check())
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('profile.edit') }}" class="dropdown-item">Profile</a></li>
                            <form action="{{ route('dist.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">log out</button>
                            </form>
                        </ul>
                        @endif
                        @if(Auth::guard('web')->check())
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('profile.edit') }}" class="dropdown-item">Profile</a></li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">log out</button>
                            </form>
                        </ul>
                        @endif
                    </div>
                    
                @else
                    <div class="d-flex"> 
                        <a class="btn btn-outline-success m-2" aria-current="page" href="{{ route('select.login') }}">Log in</a>
                        <a class="btn btn-success m-2" aria-current="page" href="{{ route('select.register') }}">Register</a>
                    </div> 
                    @endauth
                @endif

                
            </div>
            
            
        </div>

        
    </nav>

    {{-- <div class="toast-container position-fixed top-0 end-0 p-3">
        <div role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-bs-autohide="false">
            <div class="toast-header">
                <img src="..." class="rounded me-2" alt="...">
                <strong class="me-auto">Bootstrap</strong>
                <small>11 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Hello, world! This is a toast message.
            </div>
        </div>
    </div> --}}
    

    @yield('content')

    <footer class="p-2 bg-body-tertiary text-center">
        <p class="mb-0">© 2024 Food Solidarity. All rights reserved.</p>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
    crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
    crossorigin="anonymous"></script>

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>


    @yield('script')

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toastElement = document.querySelector('.toast');
            const toast = new bootstrap.Toast(toastElement);
            console.log(toast);
            toast.show();
        });
    </script> --}}


    <script>
        const id = "{{ Auth::id() }}";

        // Pusher.logToConsole = true;

        // var pusher = new Pusher('a72b09cd71426c5a340b', {
        //     cluster: 'eu'
        // });

        // var channel = pusher.subscribe('App.Models.User.' + id);

        // channel.bind(function(data) {
        //     console.log("pusher is here");
        //     alert(JSON.stringify(data));
        // });

    </script>


    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    @vite(['resources/js/app.js'])

</body>
</html>