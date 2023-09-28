@extends('layouts.admin')
@section('title')
Profile Management
@endsection
@section('content')
@if (Session::has('success'))
   <div class="alert alert-success message-div">{{ Session::get('success') }}</div>
@endif
<!-- general form elements -->
<form role="form" method="POST" enctype="multipart/form-data" id="addEditForm">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Profile Management</h3>
        </div>
        <div class="card-body">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-xs-12 col-md-3">
                    <label for="name">Name*</label>
                    <input class="form-control" id="name" name="name" type="text" value="{{$user->name}}" autocomplete="off">
                    <input name="id" type="hidden" value="{{$user->id}}">
                    <div id="nameerror" class="text-danger"></div>
                    @if ($errors->has('name'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="col-xs-12 col-md-3">
                    <label for="username">Username*</label>
                    <input class="form-control" id="username" name="username" type="text" value="{{$user->username}}" readonly>
                </div>
                <div class="col-xs-12 col-md-3">
                    <label for="email">Email*</label>
                    <input class="form-control" id="email" name="email" type="email" value="{{$user->email}}" autocomplete="off">
                    <div id="emailerror" class="text-danger"></div>
                    @if ($errors->has('email'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="col-xs-12 col-md-3">
                    <label for="password">Password</label>
                    <input class="form-control" id="password" name="password" type="text" autocomplete="off">
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-xs-12 col-md-3">
                    <label for="mobile">Mobile*</label>
                    <input class="form-control" id="mobile" name="mobile" type="text" value="{{$user->mobile}}" autocomplete="off">
                    <div id="mobileerror" class="text-danger"></div>
                    @if ($errors->has('mobile'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('mobile') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="col-xs-12 col-md-3">
                    <label for="nid">NID</label>
                    <input class="form-control" id="nid" name="nid" placeholder="National ID" type="text" value="{{$user->nid}}" autocomplete="off">                    
                </div>
                <div class="col-xs-12 col-md-3">
                    <label for="address">Address</label>
                    <textarea class="form-control" id="address" name="address" >{{$user->address}}</textarea>
                </div>                
                <div class="col-xs-12 col-md-3">
                    <label for="image" class="control-label">Image</label><br/>
                    <div id="holder_img_upload">
                        <input id="image" type="file" class="form-control" name="image">
                    </div>
                </div>
            </div>
            <br/>
            <div class="card-footer" style="text-align:right">
                <button type="submit" class="btn btn-primary col-lg-4"><i class="far fa-save"></i> Save </button>
            </div>
        </div>
    </div>
</form>

@endsection
@section('js')
    <!-- Page specific script -->
    <script>
    $(function () {
        //Message
        setTimeout(function() {
        $(".message-div").fadeOut(2000);
        },3000);
    });
</script>
@endsection
