@extends('frontend.layout.app')

@section('content')

<div style="padding: 40px 20px; max-width: 900px; margin: 0 auto;">

    <h2>All Elections</h2>

    <a href="{{ route('admin.dashboard') }}">Back to Dashboard</a> |
    <a href="{{ route('elections.create') }}">+ Create New Election</a>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="8">
        <tr>
            <th>Title</th>
            <th>Status</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Actions</th>
        </tr>

        @foreach ($elections as $election)
        <tr>
            <td>{{ $election->title }}</td>
            <td>{{ $election->status }}</td>
            <td>{{ $election->start_date }}</td>
            <td>{{ $election->end_date }}</td>
            <td>
                <form action="{{ route('elections.updateStatus', $election->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PUT')
                    <select name="status" onchange="this.form.submit()">
                        <option value="upcoming" {{ $election->status == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                        <option value="active" {{ $election->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="ended" {{ $election->status == 'ended' ? 'selected' : '' }}>Ended</option>
                    </select>
                </form>

                <form action="{{ route('elections.destroy', $election->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

</div>

@endsection