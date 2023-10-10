@extends('adminlte.auth.auth-template')
@section('content')
<form method="POST" action="{{ route('login') }}">
  @csrf
  <div class="input-group mb-3">
    <input type="email" name="email" class="form-control @if ($errors->has('email')) is-invalid @endif"
      value="{{old('email')}}" placeholder="Email">
    <div class="input-group-append">
      <div class="input-group-text">
        <span class="fas fa-envelope"></span>
      </div>
    </div>
    @error('email'))
    <span id="exampleInputEmail1-error" class="error invalid-feedback">{{$message}}</span>
    @enderror
  </div>
  <div class="input-group mb-3">
    <input type="password" name="password" class="form-control @if ($errors->has('password')) is-invalid @endif"
      placeholder="Password">
    <div class="input-group-append">
      <div class="input-group-text">
        <span class="fas fa-lock"></span>
      </div>
    </div>
    @error('password')
    <span id="exampleInputPassword1-error" class="error invalid-feedback">{{$message}}</span>
    @endif
  </div>
  <div class="row">
    <div class="col-8">
      <div class="icheck-primary">
        <input type="checkbox" id="remember" name="remember">
        <label for="remember">
          Remember Me
        </label>
      </div>
    </div>
    <!-- /.col -->
    <div class="col-4">
      <button type="submit" class="btn btn-primary btn-block">Sign In</button>
    </div>
    <!-- /.col -->
  </div>
</form>

@if (Route::has('password.request'))
<!-- <p class="mb-1">
  <a href="{{ route('password.request') }}">Forgot password</a>
</p> -->
@endif

<!-- <p class="mb-0">
  <a href="{{ route('register') }}" class="text-center">Signup</a>
</p> -->
@endsection