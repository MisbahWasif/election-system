<!DOCTYPE html>
<html>
<head>
    <title>Voter Dashboard</title>
</head>
<body>

    <h2>Welcome, {{ Auth::guard('voter')->user()->name }}!</h2>

    <p>This is the Voter Dashboard.</p>
    <p><a href="{{ route('vote.index') }}">Cast Your Vote</a></p>

    <form action="/voter/logout" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>

</body>
</html>