@extends('frontend.layout.app')

@section('content')

<div class="banner-img">
    <img src="{{ asset('images/voter.jpg') }}">
</div>

<div style="padding: 40px 20px; text-align: center;">

    <h2>Welcome, {{ Auth::guard('voter')->user()->name }}!</h2>

    <p>This is the Voter Dashboard.</p>

    <p><a href="{{ route('vote.index') }}">Cast Your Vote</a></p>

    <form action="{{ route('voter.logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit">Logout</button>
    </form>

</div>

@endsection