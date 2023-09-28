@extends('layouts.pub')

@section('content')
<!-- Start Page Title Section -->
<div class="page-ttl page-dark">
    <div class="layer-stretch">
    </div>
</div><!-- End Page Title Section -->
@if (Session::has('success'))
   <div class="alert alert-info message-div font-20" style="text-align:center">{{ Session::get('success') }}</div>
@endif
<div class="wrapper">
    <div class="layer-stretch">
        <div class="layer-wrapper">
            <div class="p-4">
                <h1>Page content will be added soon</h1>
            </div>
        </div>
    </div>
</div>
@endsection
