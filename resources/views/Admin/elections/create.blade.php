<!DOCTYPE html>
<html>
<head>
    <title>Create Election</title>
</head>
<body>

    <h2>Create New Election</h2>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('elections.store') }}" method="POST">
        @csrf

        <label>Election Title:</label><br>
        <input type="text" name="title" value="{{ old('title') }}"><br><br>

        <label>Start Date:</label><br>
        <input type="date" name="start_date" value="{{ old('start_date') }}"><br><br>

        <label>End Date:</label><br>
        <input type="date" name="end_date" value="{{ old('end_date') }}"><br><br>

        <button type="submit">Create Election</button>
    </form>

    <a href="{{ route('elections.index') }}">Back to Elections List</a>

</body>
</html>