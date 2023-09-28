
@extends('adminlte.auth.auth-template')
@section('box-msg')
@if (session('status') == 'verification-link-sent')
<div class="mb-4 font-medium text-sm text-green-600">
  {{ __('A new verification link has been sent to the email address you provided during registration.') }}
</div>
@endif
@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <form method="POST" action="{{ route('verification.send') }}">
      @csrf
      <button type="submit" class="btn btn-default btn-block">Resend Verification Email</button>
    </form>
  </div>

  <div class="col-12">
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="btn btn-danger btn-block">Logout</button>
    </form>
  </div>
</div>
@endsection