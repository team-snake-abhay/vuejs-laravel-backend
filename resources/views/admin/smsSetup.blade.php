@extends('layouts.admin')
@section('title','Basic')
@section('content')
@if (Session::has('success'))
<div class="alert alert-success message-div">{{ Session::get('success') }}</div>
@endif
<!-- general form elements -->
<form role="form" method="POST" enctype="multipart/form-data" id="addEditForm">
    <input type="hidden" id="company_id" name="id" value="{{old('id')}}">
    @csrf
    <input type="hidden" name="id" value="{{@$config->id}}">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">SMS Setup</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xs-12 col-md-3">
                    <label for="username">Username*</label>
                    <input class="form-control" id="username" name="username" type="text"
                        value="{{@$config->username}}" autocomplete="off">
                    <div id="usernameerror" class="text-danger"></div>
                    @if ($errors->has('username'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="col-xs-12 col-md-3">
                    <label for="token">Password*</label>
                    <input class="form-control" id="token" name="token" type="text" value="{{@$config->token}}"
                        autocomplete="off">
                    <div id="tokenerror" class="text-danger"></div>
                    @error('token')
                        <span class="text-danger"><strong>{{$token}}</strong></span>
                    @enderror
                </div>
                <div class="col-xs-12 col-md-3">
                    <label for="masking">Masking*</label>
                    <input class="form-control" id="masking" name="masking" type="text"
                        value="{{@$config->masking}}" autocomplete="off">
                    <div id="maskingerror" class="text-danger"></div>
                    @if ($errors->has('masking'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('masking') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="col-xs-12 col-md-3">
                    <label for="msg_type">Message Type*</label>
                    <input class="form-control" id="msg_type" name="msg_type" type="text"
                        value="{{@$config->msg_type}}" autocomplete="off">
                    <div id="msg_typeerror" class="text-danger"></div>
                    @if ($errors->has('msg_type'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('msg_type') }}</strong>
                    </span>
                    @endif
                </div>
                
            </div>
            <br />
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <label for="base_uri">Base URI*</label>
                    <textarea class="form-control" id="base_uri" name="base_uri">{{@$config->base_uri}}</textarea>
                    <div id="base_urierror" class="text-danger"></div>
                    @if ($errors->has('base_uri'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('base_uri') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="msg_template">Message Template*</label>
                    <textarea class="form-control" id="msg_template" name="msg_template">{{@$config->msg_template}}</textarea>
                    <div id="msg_templateerror" class="text-danger"></div>
                    @if ($errors->has('msg_template'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('msg_template') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            
        </div>
        <div class="card-footer" style="text-align:right">
            <button type="submit" class="btn btn-primary col-lg-4"><i class="far fa-save"></i> Save </button>
        </div>
    </div>
</form>

@endsection
@section('css')
<link rel="stylesheet" href="{{url('AdminLTE/plugins/select2/css/select2.min.css')}}">
@endsection
@section('js')
<!-- DataTables -->
<!-- DataTables  & Plugins -->
<script src="{{url('AdminLTE/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Page specific script -->
<script>
$(function() {
    $('.select2').select2();
    //Message
    setTimeout(function() {
        $(".message-div").fadeOut(2000);
    }, 3000);
});
</script>
@endsection