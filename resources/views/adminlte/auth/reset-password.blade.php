@extends('adminlte.auth.auth-template')

@section('content')
<form method="POST" action="{{ route('password.update') }}">
  @csrf
  <!-- Password Reset Token -->
  <input type="hidden" name="token" value="{{ $request->route('token') }}">

  <div class="input-group mb-3">
    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}"
      placeholder="Email">
    <div class="input-group-append">
      <div class="input-group-text">
        <span class="fas fa-envelope"></span>
      </div>
    </div>
    @error('email')
    <span id="exampleInputEmail1-error" class="error invalid-feedback">{{$message}}</span>
    @enderror
  </div>
  <div class="input-group mb-3">
    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
      placeholder="Password">
    <div class="input-group-append">
      <div class="input-group-text">
        <span class="fas fa-lock"></span>
      </div>
    </div>
    @error('password')
    <span id="exampleInputPassword1-error" class="error invalid-feedback">{{$message}}</span>
    @enderror
  </div>
  <div class="input-group mb-3">
    <input type="password" name="password_confirmation"
      class="form-control @if ($errors->has('password_confirmation')) is-invalid @endif"
      placeholder="Password Confirmation">
    <div class="input-group-append">
      <div class="input-group-text">
        <span class="fas fa-lock"></span>
      </div>
    </div>
    @error('password_confirmation')
    <span id="exampleInputPassword2-error" class="error invalid-feedback">{{$message}}</span>
    @enderror
  </div>
  <div class="row">
    <div class="col-12">
      <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
    </div>
  </div>
</form>
@endsection