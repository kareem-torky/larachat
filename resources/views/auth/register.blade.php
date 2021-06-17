@extends('layouts.auth')

@section('main')
<form method="POST" action="{{ route('register') }}">
    <h1 class="h3 mb-3 fw-normal">Register</h1>

    @csrf

    <div class="form-floating">
      <input type="text" name="name" class="form-control" id="floatingInput1" placeholder="name">
      <label for="floatingInput1">Name</label>
    </div>

    <div class="form-floating">
      <input type="email" name="email" class="form-control" id="floatingInput2" placeholder="name@example.com">
      <label for="floatingInput2">Email address</label>
    </div>

    <div class="form-floating">
      <input type="password" name="password" class="form-control" id="floatingPassword1" placeholder="Password">
      <label for="floatingPassword1">Password</label>
    </div>

    <div class="form-floating">
      <input type="password" name="password_confirmation" class="form-control form-last" id="floatingPassword2" placeholder="Confirm password">
      <label for="floatingPassword2">Confirm password</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
</form>
@endsection