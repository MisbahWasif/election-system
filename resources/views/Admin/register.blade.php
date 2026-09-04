@extends('frontend.layout.app')

@section('content')

<div style="padding: 60px 20px; max-width: 500px; margin: 0 auto;">

    <h2>Admin Registration</h2>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/admin/register" method="POST">
        @csrf

        <label>Name:</label><br>
        <input type="text" name="name" value="{{ old('name') }}"><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email') }}"><br><br>

        <label>Password:</label><br>
        <input type="password" name="password"><br><br>

        <label>Confirm Password:</label><br>
        <input type="password" name="password_confirmation"><br><br>

        <label>Phone:</label><br>
        <input type="text" name="phone" value="{{ old('phone') }}"><br><br>

        <label>CNIC:</label><br>
        <input type="text" name="cnic" value="{{ old('cnic') }}"><br><br>

        <button type="submit">Register</button>
    </form>

    <p>Already have an account? <a href="/admin/login">Login here</a></p>

</div>

@endsection