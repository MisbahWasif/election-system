@extends('frontend.layout.app')

@section('content')

<div style="padding: 40px 20px; max-width: 900px; margin: 0 auto;">

    <h2>All Candidates</h2>

    <a href="{{ route('admin.dashboard') }}">Back to Dashboard</a> |
    <a href="{{ route('candidates.create') }}">+ Add New Candidate</a>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="8">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Party</th>
            <th>Symbol</th>
            <th>Election</th>
            <th>Actions</th>
        </tr>

        @foreach ($candidates as $candidate)
        <tr>
            <td>{{ $candidate->name }}</td>
            <td>{{ $candidate->email }}</td>
            <td>{{ $candidate->party }}</td>
            <td>{{ $candidate->symbol }}</td>
            <td>{{ $candidate->election->title ?? 'N/A' }}</td>
            <td>
                <a href="{{ route('candidates.edit', $candidate->id) }}">Edit</a>

                <form action="{{ route('candidates.destroy', $candidate->id) }}" method="POST" style="display:inline;">
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