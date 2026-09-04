@extends('frontend.layout.app')

@section('content')

<div class="banner-img">
    <img src="{{ asset('images/elec.jpg') }}">
</div>

<div style="padding: 40px 20px; max-width: 900px; margin: 0 auto;">

    <h2>Active Elections</h2>

    <a href="{{ route('voter.dashboard') }}">Back to Dashboard</a>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    @if ($elections->isEmpty())
        <p>No active elections at the moment.</p>
    @endif

    <ul>
        @foreach ($elections as $election)
            <li>
                {{ $election->title }} ({{ $election->start_date }} to {{ $election->end_date }})
                — <a href="{{ route('vote.candidates', $election->id) }}">Vote Now</a>
            </li>
        @endforeach
    </ul>

</div>

@endsection