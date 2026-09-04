@extends('frontend.layout.app')

@section('content')

<div style="padding: 60px 20px; max-width: 500px; margin: 0 auto;">

    <h2>Voter Login</h2>

    @if (session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/voter/login" method="POST">
        @csrf

        <label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email') }}"><br><br>

        <label>Password:</label><br>
        <input type="password" name="password"><br><br>

        <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="/voter/register">Register here</a></p>

</div>

@endsection