@extends('layouts.admin')
@section('title')
Home Page Management
@endsection
@section('content')
@if (Session::has('success'))
   <div class="alert alert-success message-div">{{ Session::get('success') }}</div>
@endif
<!-- general form elements -->
<form role="form" method="POST" enctype="multipart/form-data" id="addEditForm">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Home Page Management</h3>
        </div>
        <div class="card-body">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-xs-12 col-md-3">
                    <label for="meta_title">Meta Title</label>
                    <input class="form-control" id="meta_title" name="meta_title" type="text" value="{{@$home->meta_title}}" autocomplete="off">
                    <div id="meta_titleerror" class="text-danger"></div>
                    @if ($errors->has('meta_title'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('meta_title') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="meta_description">Meta Description</label>
                    <input class="form-control" id="meta_description" name="meta_description" type="text" value="{{@$home->meta_description}}" autocomplete="off">
                </div>
                <div class="col-xs-12 col-md-3">
                    <label for="meta_tag">Meta Tag</label>
                    <input class="form-control" id="meta_tag" name="meta_tag" type="text" value="{{@$home->meta_tag}}" autocomplete="off">
                    <div id="meta_tagerror" class="text-danger"></div>
                    @if ($errors->has('meta_tag'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('meta_tag') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-xs-12 col-md-3">
                    <label for="title">Content Title*</label>
                    <input class="form-control" id="title" name="title" type="text" value="{{@$home->title}}" autocomplete="off">
                    @if ($errors->has('title'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                    @endif
                </div>      
                <div class="col-xs-12 col-md-6 form-group">
                    <label for="content">Content*</label>
                    <textarea class="form-control summernote" id="content" name="content">{{@$home->content}}</textarea>                    
                    @if ($errors->has('content'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('content') }}</strong>
                    </span>
                    @endif
                </div> 
                <div class="col-xs-12 col-md-3">
                    <label for="youtube_link">Youtube Link*</label>
                    <input class="form-control" id="youtube_link" name="youtube_link" type="text" value="{{@$home->youtube_link}}" autocomplete="off">
                    @if ($errors->has('youtube_link'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('youtube_link') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <label for="why1_title">Title - Why Choose 1* [max 25 Charecters]</label>
                    <input class="form-control" id="why1_title" name="why1_title" type="text" value="{{@$home->why1_title}}" autocomplete="off">
                    @if ($errors->has('why1_title'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('why1_title') }}</strong>
                    </span>
                    @endif
                </div>      
                <div class="col-xs-12 col-md-4">
                    <label for="why2_title">Title - Why Choose 2* [max 25 Charecters]</label>
                    <input class="form-control" id="why2_title" name="why2_title" type="text" value="{{@$home->why2_title}}" autocomplete="off">
                    @if ($errors->has('why2_title'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('why2_title') }}</strong>
                    </span>
                    @endif
                </div>      
                <div class="col-xs-12 col-md-4">
                    <label for="why3_title">Title - Why Choose 3* [max 25 Charecters]</label>
                    <input class="form-control" id="why3_title" name="why3_title" type="text" value="{{@$home->why3_title}}" autocomplete="off">
                    @if ($errors->has('why3_title'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('why3_title') }}</strong>
                    </span>
                    @endif
                </div>      
            </div>
            <br/>
            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <label for="why1">Why Choose 1* [max 300 Charecters]</label>                    
                    <textarea class="form-control" id="why1" name="why1">{{@$home->why1}}</textarea>                    
                    @if ($errors->has('why1'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('why1') }}</strong>
                    </span>
                    @endif
                </div> 
                <div class="col-xs-12 col-md-4">
                    <label for="why2">Why Choose 2* [max 300 Charecters]</label>                    
                    <textarea class="form-control" id="why2" name="why2">{{@$home->why2}}</textarea>                    
                    @if ($errors->has('why2'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('why2') }}</strong>
                    </span>
                    @endif
                </div> 
                <div class="col-xs-12 col-md-4">
                    <label for="why1">Why Choose 3* [max 300 Charecters]</label>                    
                    <textarea class="form-control" id="why3" name="why3">{{@$home->why3}}</textarea>                    
                    @if ($errors->has('why3'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('why3') }}</strong>
                    </span>
                    @endif
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
@section('css')
    <link rel="stylesheet" href="{{url('AdminLTE/plugins/summernote/summernote-bs4.min.css')}}">
@endsection
@section('js')
    <script src="{{url('AdminLTE/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script>
    $(function () {
        setTimeout(function() {
        $(".message-div").fadeOut(2000);
        },3000);
        $('.summernote').summernote();
    });
</script>
@endsection
