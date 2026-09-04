@extends('frontend.layout.app')

@section('content')
<div class="banner-img">
    <img src="{{ asset('images/home.jpg') }}">
</div>
<div style="padding: 40px 20px; text-align: center;">
    <h1>Welcome to Digital Election System</h1>
    <p>A secure, transparent platform for online voting.</p>
</div>
@endsection