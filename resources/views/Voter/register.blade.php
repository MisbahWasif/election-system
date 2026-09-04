@extends('frontend.layout.app')

@section('content')

<div style="padding: 60px 20px; max-width: 500px; margin: 0 auto;">

    <h2>Voter Registration</h2>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/voter/register" method="POST">
        @csrf

        <label>Name:</label><br>
        <input type="text" name="name" value="{{ old('name') }}"><br><br>

        <label>CNIC:</label><br>
        <input type="text" name="cnic" value="{{ old('cnic') }}"><br><br>

        <label>Registration Number:</label><br>
        <input type="text" name="reg_no" value="{{ old('reg_no') }}"><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email') }}"><br><br>

        <label>Password:</label><br>
        <input type="password" name="password"><br><br>

        <label>Confirm Password:</label><br>
        <input type="password" name="password_confirmation"><br><br>

        <button type="submit">Register</button>
    </form>

    <p>Already have an account? <a href="/voter/login">Login here</a></p>

</div>

@endsection