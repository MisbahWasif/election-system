@extends('frontend.layout.app')

@section('content')
<div class="banner-img">
    <img src="{{ asset('images/about.jpg') }}">
</div>
<div style="padding: 40px 20px; text-align: center;">
    <h1>About Us</h1>
    <p>This is a Final Year Project — Online Election System built with Laravel and MySQL.</p>
</div>
@endsection