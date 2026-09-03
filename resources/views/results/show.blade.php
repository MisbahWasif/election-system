<!DOCTYPE html>
<html>
<head>
    <title>Result: {{ $election->title }}</title>
</head>
<body>

    <h2>Result: {{ $election->title }}</h2>
    <p>Status: {{ $election->status }}</p>
    <p>Total Votes Cast: {{ $totalVotes }}</p>

    @if ($candidates->isEmpty())
        <p>No candidates in this election.</p>
    @else
        <table border="1" cellpadding="8">
            <tr>
                <th>Candidate</th>
                <th>Party</th>
                <th>Votes</th>
                <th>Percentage</th>
            </tr>

            @foreach ($candidates as $candidate)
            <tr style="{{ $candidate->id === $winner->id ? 'background-color: lightgreen;' : '' }}">
                <td>
                    {{ $candidate->name }}
                    @if ($candidate->id === $winner->id && $totalVotes > 0)
                        🏆 Winner
                    @endif
                </td>
                <td>{{ $candidate->party }}</td>
                <td>{{ $candidate->votes_count }}</td>
                <td>
                    {{ $totalVotes > 0 ? round(($candidate->votes_count / $totalVotes) * 100, 1) : 0 }}%
                </td>
            </tr>
            @endforeach
        </table>
    @endif

    <br>
    <a href="{{ route('results.index') }}">Back to Elections List</a>

</body>
</html>