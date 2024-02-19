@extends('dist.layout')

@section('content')
    <h1>Distributors Dashboard</h1>
    <form action="{{ route('dist.logout') }}" method="POST">
        @csrf
        <button type="submit" class="dropdown-item">log out</button>
    </form>
@endsection