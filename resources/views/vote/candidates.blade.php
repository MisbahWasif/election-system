<!DOCTYPE html>
<html>
<head>
    <title>Cast Your Vote</title>
</head>
<body>

    <h2>Vote for: {{ $election->title }}</h2>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($candidates->isEmpty())
        <p>No candidates registered for this election yet.</p>
    @else
        <form action="{{ route('vote.cast', $election->id) }}" method="POST">
            @csrf

            @foreach ($candidates as $candidate)
                <label>
                    <input type="radio" name="candidate_id" value="{{ $candidate->id }}" required>
                    {{ $candidate->name }} — {{ $candidate->party }} ({{ $candidate->symbol }})
                </label><br><br>
            @endforeach

            <button type="submit" onclick="return confirm('Are you sure? You cannot change your vote after this.')">
                Submit Vote
            </button>
        </form>
    @endif

    <a href="{{ route('vote.index') }}">Back to Elections List</a>

</body>
</html>