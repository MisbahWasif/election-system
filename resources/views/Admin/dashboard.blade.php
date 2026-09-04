@extends('frontend.layout.app')

@section('content')
<div class="admin-banner">
    <img src="{{ asset('images/admin.jfif') }}">
</div>

<!-- <div class="banner-img">
    <img src="{{ asset('images/admin.jfif') }}">
</div> -->

<div style="padding: 60px 20px; text-align: center;">

    <h2>Welcome, {{ Auth::guard('admin')->user()->name }}!</h2>

    <p>This is the Admin Dashboard.</p>

    <p><a href="{{ route('elections.index') }}">Manage Elections</a></p>
    <p><a href="{{ route('candidates.index') }}">Manage Candidates</a></p>
    <p><a href="{{ route('results.index') }}">View Results</a></p>
    <p><a href="{{ route('admin.register') }}">Add New Admin</a></p>

    <form action="/admin/logout" method="POST" style="display:inline;">
        @csrf
        <button type="submit">Logout</button>
    </form>

</div>

@endsection