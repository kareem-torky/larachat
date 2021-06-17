@extends('layouts.auth')

@section('main')
<form method="POST" action="{{ route('login') }}">
    <h1 class="h3 mb-3 fw-normal">Login</h1>

    @csrf

    <div class="form-floating">
      <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>

    <div class="form-floating">
      <input type="password" name="password" class="form-control form-last" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" name="remember" value="remember-me"> Remember me
      </label>
    </div>

    <div class="text-center">
        <button class="w-100 btn btn-lg btn-primary mb-3" type="submit">Login</button>
        Or <a href="{{ route('register') }}">Sign up</a>?
    </div>
</form>
@endsection