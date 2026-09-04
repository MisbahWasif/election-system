@extends('frontend.layout.app')

@section('content')

<div style="padding: 40px 20px; max-width: 500px; margin: 0 auto;">

    <h2>Edit Candidate</h2>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('candidates.update', $candidate->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Name:</label><br>
        <input type="text" name="name" value="{{ old('name', $candidate->name) }}"><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email', $candidate->email) }}"><br><br>

        <label>Party:</label><br>
        <input type="text" name="party" value="{{ old('party', $candidate->party) }}"><br><br>

        <label>Symbol:</label><br>
        <input type="text" name="symbol" value="{{ old('symbol', $candidate->symbol) }}"><br><br>

        <label>Election:</label><br>
        <select name="election_id">
            @foreach ($elections as $election)
                <option value="{{ $election->id }}" {{ $candidate->election_id == $election->id ? 'selected' : '' }}>
                    {{ $election->title }}
                </option>
            @endforeach
        </select><br><br>

        <button type="submit">Update Candidate</button>
    </form>

    <a href="{{ route('candidates.index') }}">Back to Candidates List</a>

</div>

@endsection