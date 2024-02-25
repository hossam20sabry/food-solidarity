@extends('layout')

@section('content')
    <div class="mainBackground">
        <div class="container">
            <div class="content">
                <h1 class="color-green h1-text-responsive">Food Solidarity</h1>
                <h2 class="color-green text-responsive2">Between Institutions and Individuals</h2>
                <div class="background-text-responsive">
                    <p class="text-responsive">In a world of plenty, it is disheartening to acknowledge that millions of our fellow<br>
                        human beings go to bed hungry every night. The stark reality of food insecurity persists<br>
                        despite an abundance of resources, and it demands our urgent attention. This essay serves<br>
                        as a call to action, aiming to raise awareness about the concept of food solidarity and inspire<br>
                        individuals to extend a helping hand to those who have no food.</p>
                </div>
                @if(Auth::guard('web')->guest() && Auth::guard('dist')->guest())
                    <a href="./pages/selectAuth.html" class="btn btn-success">Get Started</a>
                @endif
            </div>
        </div>
        <img src="{{asset('/home/img/mainBackgound.png')}}" alt="background"  style="height: 100vh; width: 100%">
    </div>

    <div class="container mt-5">
        <h1 class="text-center color-green mb-4 border-bottom p-2">Top Donors</h1>
        <table class="table table-success  table-striped-columns">
            <tr>
                <td>name</td>
                <td>email</td>
                <td>donations</td>
            </tr>
            <tr>
                <td>name</td>
                <td>email</td>
                <td>donations</td>
            </tr>
            <tr>
                <td>name</td>
                <td>email</td>
                <td>donations</td>
            </tr>
            <tr>
                <td>name</td>
                <td>email</td>
                <td>donations</td>
            </tr>
            <tr>
                <td>name</td>
                <td>email</td>
                <td>donations</td>
            </tr>
            <tr>
                <td>name</td>
                <td>email</td>
                <td>donations</td>
            </tr>
            <tr>
                <td>name</td>
                <td>email</td>
                <td>donations</td>
            </tr>
        </table>
    </div>

    @if(isset($article))
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-6">                        
                <p>{{$article->text}}</p>
            </div>
            <div class="col-sm-6 mb-5">
                <div class="row">
                    <div class="col">
                        <img src="{{asset('/images/' . $article->img)}}" alt="" class="img-fluid">
                    </div>
                </div>
                
            </div>
        </div>

        {{-- <div class="row">
            <div class="col-sm-6 mt-5">
                <div class="row mt-3">
                    <div class="col">
                        <img src="{{asset('/home/img/2202_w037_n003_165b_p1_165.jpg')}}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                
                        <p>In a world of plenty, it is disheartening to acknowledge that millions of our fellow human beings go to bed hungry every night. The stark reality of food insecurity persists despite an abundance of resources, and it demands our urgent attention. This essay serves as a call to action, aiming to raise awareness about the concept of food solidarity and inspire individuals to extend a helping hand to those who have no food.<br><br>
        
                            The Crisis of Food Insecurity:
                            
                            Food insecurity is a profound global challenge, touching the lives of countless individuals who lack access to sufficient, nutritious food. While we dine in the comfort of our homes, a significant portion of the global population faces the harsh reality of hunger. The reasons behind this crisis are complex, ranging from economic disparities and social inequalities to environmental factors and systemic shortcomings.<br><br>
                            
                            Understanding Food Solidarity:
                            
                            Food solidarity is not merely a term; it embodies a powerful ethos of shared responsibility and collective action. It entails recognizing that the abundance of food resources is a gift that should be shared equitably. It is a call to bridge the gap between those who have surplus food and those who desperately need it. The essence of food solidarity lies in the belief that no one should go to bed hungry when there is a surplus that can nourish and sustain lives.<br><br>
                            
                            The Impact of Food Solidarity:
                            
                            When we embrace the principles of food solidarity, we contribute to a positive ripple effect that extends far beyond the mere act of sharing a meal. By helping those in need, we address the root causes of hunger and promote sustainable solutions. Food solidarity fosters community resilience, reduces food waste, and creates a sense of interconnectedness that transcends geographical boundaries.</p>
                        
                
            </div>
            
        </div> --}}
        
    </div>
    @endif
@endsection