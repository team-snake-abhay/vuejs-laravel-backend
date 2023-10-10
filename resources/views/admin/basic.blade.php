@extends('layouts.admin')
@section('title','Basic')
@section('content')
@if (Session::has('success'))
<div class="alert alert-success message-div">{{ Session::get('success') }}</div>
@endif
<!-- general form elements -->
<form role="form" method="POST" enctype="multipart/form-data" id="addEditForm">
    <input type="hidden" id="company_id" name="id" value="{{old('id')}}">
    {{ csrf_field() }}
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Basic Information Setup</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xs-12 col-md-3">
                    <label for="company_name">Company Name*</label>
                    <input class="form-control" id="company_name" name="company_name" type="text"
                        value="{{@$basic->company_name}}" autocomplete="off">
                    <div id="company_nameerror" class="text-danger"></div>
                    @if ($errors->has('company_name'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('company_name') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="col-xs-12 col-md-3">
                    <label for="email">Email*</label>
                    <input class="form-control" id="email" name="email" type="text" value="{{@$basic->email}}"
                        autocomplete="off">
                    <div id="emailerror" class="text-danger"></div>
                    @if ($errors->has('email'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="col-xs-12 col-md-3">
                    <label for="contact_number">Contact Number*</label>
                    <input class="form-control" id="contact_number" name="contact_number" type="text"
                        value="{{@$basic->contact_number}}" autocomplete="off">
                    <div id="contact_numbererror" class="text-danger"></div>
                    @if ($errors->has('contact_number'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('contact_number') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="col-xs-12 col-md-3">
                    <label for="address">Address*</label>
                    <textarea class="form-control" id="address" name="address">{{@$basic->address}}</textarea>
                    <div id="addresserror" class="text-danger"></div>
                    @if ($errors->has('address'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <br />
            <div class="row">
                <div class="col-xs-12 col-md-3">
                    <label for="facebook_link">Facbook Profile</label>
                    <input class="form-control" id="facebook_link" name="facebook_link" type="text"
                        value="{{@$basic->facebook_link}}" autocomplete="off">
                </div>
                <div class="col-xs-12 col-md-3">
                    <label for="instagram_link">Instagram Profile</label>
                    <input class="form-control" id="instagram_link" name="instagram_link" type="text"
                        value="{{@$basic->instagram_link}}" autocomplete="off">
                </div>
                <div class="col-xs-12 col-md-3">
                    <label for="linkedin_link">LinkedIn Profile</label>
                    <input class="form-control" id="linkedin_link" name="linkedin_link" type="text"
                        value="{{@$basic->linkedin_link}}" autocomplete="off">
                </div>
                <div class="col-xs-12 col-md-3">
                    <label for="youtube_link">Youtube Profile</label>
                    <input class="form-control" id="youtube_link" name="youtube_link" type="text"
                        value="{{@$basic->youtube_link}}" autocomplete="off">
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-xs-12 col-md-3">
                    <label for="header_image" class="control-label">Header Photo</label><br />
                    <input id="header_image" type="file" class="form-control" name="header_image"
                        value="{{ old('header_image') }}">
                    @if ($errors->has('header_image'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('header_image') }}</strong>
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