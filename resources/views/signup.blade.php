<body>
@extends('template.header')
<div class="container">
    <h1>Welcome To Signup Page</h1>
    <form method="post" action="{{ route('user-signup') }}">
        @csrf
        <div class="mb-3 mt-3">
            <label for="namefield" class="form-label">Name</label>
            <input type="text" class="form-control" id="namefield" name="name" required>

        </div>
        <div class="mb-3">
            <label for="emailfield" class="form-label">Email</label>
            <input type="email" class="form-control" id="emailfield" name="email" required >
        </div>
        <button type="submit" class="btn btn-primary">Sign Up</button>
        <a href="{{ route('login') }}" class="btn btn-outline-success">Back To Login</a>
    </form>
</div>
@extends('template.footer')
</body>
</html>
