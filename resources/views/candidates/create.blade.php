@extends('frontend.layout.app')

@section('content')

<div style="padding: 40px 20px; max-width: 500px; margin: 0 auto;">

    <h2>Add New Candidate</h2>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('candidates.store') }}" method="POST">
        @csrf

        <label>Name:</label><br>
        <input type="text" name="name" value="{{ old('name') }}"><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email') }}"><br><br>

        <label>Password:</label><br>
        <input type="password" name="password"><br><br>

        <label>Party:</label><br>
        <input type="text" name="party" value="{{ old('party') }}"><br><br>

        <label>Symbol:</label><br>
        <input type="text" name="symbol" value="{{ old('symbol') }}"><br><br>

        <label>Election:</label><br>
        <select name="election_id">
            <option value="">-- Select Election --</option>
            @foreach ($elections as $election)
                <option value="{{ $election->id }}">{{ $election->title }}</option>
            @endforeach
        </select><br><br>

        <button type="submit">Add Candidate</button>
    </form>

    <a href="{{ route('candidates.index') }}">Back to Candidates List</a>

</div>

@endsection