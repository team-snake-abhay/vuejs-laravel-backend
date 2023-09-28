@extends('adminlte.auth.auth-template')
@section('content')
<form method="POST" action="{{ route('password.email') }}">
  @csrf
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
  <div class="row">
    <div class="col-12">
      <button type="submit" class="btn btn-default btn-block">Email Password Reset Link</button>
    </div>
  </div>
</form>
@endsection