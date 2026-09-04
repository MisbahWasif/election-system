@extends('frontend.layout.app')

@section('content')

<div class="admin-banner">
    <img src="{{ asset('images/result.jfif') }}">
</div>

<div style="padding: 40px 20px; max-width: 900px; margin: 0 auto;">

<div style="padding: 40px 20px; max-width: 900px; margin: 0 auto;">

    <h2>All Elections — View Results</h2>

    <a href="{{ route('admin.dashboard') }}">Back to Dashboard</a>

    <ul>
        @foreach ($elections as $election)
            <li>
                {{ $election->title }} ({{ $election->status }})
                — <a href="{{ route('results.show', $election->id) }}">View Result</a>
            </li>
        @endforeach
    </ul>

</div>

@endsection