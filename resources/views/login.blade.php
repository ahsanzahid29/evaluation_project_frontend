<body>
@extends('template.header')
<div class="container">
    <h1>Welcome To Login Page</h1>
   <form class="mt-3" method="POST" action="{{ route('login_check') }}">
       @csrf
        <div class="mb-3">
            <label for="emailaddressfield" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="emailaddressfield" required>
        </div>
        <div class="mb-3">
            <label for="passwordfield" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="passwordfield" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
        <a href="{{route('signup')}}" class="btn btn-outline-info">SignUp</a>
    </form>

</div>
@extends('template.footer')



</body>
</html>
