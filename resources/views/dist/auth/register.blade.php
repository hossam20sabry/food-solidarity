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
<div class="container center min_height">

    <div class="form_shape p-sm-3 m-sm-5 p-2">
        <a href="/" class="logo p-3">
            <img src="{{asset('/home/img/2355925.jpg')}}" alt="">
        </a>

    <form method="POST" action="{{ route('dist.register') }}">
        @csrf
        <h3 class="text-center">Distributor Registration</h3>
        <div class="row border-top mt-3">
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
                    <label for="dist_auth_type_id" class="form-label" >Author Type</label>
                    <select name="dist_auth_type_id" class="form-select">
                        <option selected disabled>Select Author Type</option>
                        @foreach ($authorTypes as $type)
                            <option value="{{$type->id}}">{{$type->name}}</option>
                        @endforeach
                    </select>
                </div>
                @error('dist_auth_type_id')
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
            <div class="col-12">
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
            <div class="col-12">
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
                <button type="submit" class="btn btn-primary w-100 spiner">Register</button>
                
                <div class="center mt-2">
                    <a href="{{ route('dist.login') }}" class="mx-3" id="spiner">Already have an account?</a>
                </div>
            </div>
        </div>
    </form>

</div>
{{-- <div class="container">
    <div id="map"></div>
</div> --}}
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

    <script>(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
        ({key: "AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg", v: "weekly"});
    </script>

<script>
    $('#spiner').on('click', function(){
        $('#mainSpinner').removeClass('d-none');
    });

    let map;

    async function initMap() {
    const { Map } = await google.maps.importLibrary("maps");

    map = new Map(document.getElementById("map"), {
        center: { lat: -34.397, lng: 150.644 },
        zoom: 8,
    });
    }

    initMap();

</script>

</body>
</html>