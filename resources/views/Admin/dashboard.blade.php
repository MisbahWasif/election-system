<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>

    <h2>Welcome, {{ Auth::guard('admin')->user()->name }}!</h2>

    <p>This is the Admin Dashboard.</p>

    <form action="/admin/logout" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>

</body>
</html>