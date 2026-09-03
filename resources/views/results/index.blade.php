<!DOCTYPE html>
<html>
<head>
    <title>Election Results</title>
</head>
<body>

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

</body>
</html>