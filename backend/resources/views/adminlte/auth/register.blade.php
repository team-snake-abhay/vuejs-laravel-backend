@extends('adminlte.auth.auth-template')

@section('content')
<form method="POST" action="{{ route('register') }}">
  @csrf
  <div class="input-group mb-3">
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
      value="{{old('name')}}" placeholder="Name">
    <div class="input-group-append">
      <div class="input-group-text">
        <span class="fas fa-envelope"></span>
      </div>
    </div>
    @error('name')
    <span id="exampleInputName1-error" class="error invalid-feedback">{{$message}}</span>
    @enderror
  </div>
  <div class="input-group mb-3">
    <input type="email" name="email1" class="form-control @error('email1') is-invalid @enderror"
      value="{{old('email1')}}" placeholder="Email">
    <div class="input-group-append">
      <div class="input-group-text">
        <span class="fas fa-envelope"></span>
      </div>
    </div>
    @error('email1')
    <span id="exampleInputEmail1-error" class="error invalid-feedback">{{$message}}</span>
    @enderror
  </div>
  <div class="input-group mb-3">
    <input type="password" name="password1" class="form-control @error('password1') is-invalid @enderror"
      placeholder="Password">
    <div class="input-group-append">
      <div class="input-group-text">
        <span class="fas fa-lock"></span>
      </div>
    </div>
    @error('password1')
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
    <div class="col-6">
      <p class="mb-0">
        <a href="{{ route('login') }}" class="text-center">Already Registered</a>
      </p>
    </div>
    <div class="col-6">
      <button type="submit" class="btn btn-primary btn-block">Sign In</button>
    </div>
  </div>
</form>
@endsection