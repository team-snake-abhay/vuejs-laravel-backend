@extends('layouts.admin')
@section('title','Customer')
@section('content')
@if (Session::has('success'))
<div class="alert alert-success message-div">{{ Session::get('success') }}</div>
@endif

<!-- general form elements -->
<form role="form" method="POST" enctype="multipart/form-data" id="addEditForm">
    {{ csrf_field() }}
    <input type="hidden" id="id" name="id" value="{{old('id')}}">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Customer Information Management</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xs-12 col-md-3">
                    <label for="name">Name*</label>
                    <input class="form-control" id="name" name="name" type="text" value="{{old('name')}}"
                        autocomplete="off">
                    <div id="nameerror" class="text-danger"></div>
                    @if ($errors->has('name'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="col-xs-12 col-md-3">
                    <label for="mobile">Mobile*</label>
                    <input class="form-control" id="mobile" name="mobile" type="text" value="{{old('mobile')}}"
                        autocomplete="off">
                    <div id="mobileerror" class="text-danger"></div>
                    @if ($errors->has('mobile'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('mobile') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="col-xs-12 col-md-3">
                    <label for="email">Email*</label>
                    <input class="form-control" id="email" name="email" type="email" value="{{old('email')}}"
                        autocomplete="off">
                    <div id="emailerror" class="text-danger"></div>
                    @if ($errors->has('email'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="col-xs-12 col-md-3">
                    <label for="address">Address</label>
                    <textarea class="form-control" id="address" name="address">{{old('address')}}</textarea>
                </div>
            </div>
            <br />
        </div>
        <div class="card-footer" style="text-align:right">
            <button type="submit" class="btn btn-primary col-lg-4"><i class="far fa-save"></i> Save </button>
        </div>
    </div>
</form>

<div class="card">
    <!-- /.box-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
            aria-describedby="example1_info">
            <thead>
                <tr role="row">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->mobile}}</td>
                    <td>{{$item->address}}</td>
                    <td>
                        <span data-toggle="tooltip" title="Edit" class="btn btn-primary btn-sm edit"
                            editId="{{$item->id}}"><i class="fa fa-edit"></i></span>
                        <!--a class="btn btn-primary btn-sm" href="{{url('admin/employee/print',$item->id)}}"><i class="fa fa-print"></i></a-->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>

@endsection
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{url('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('AdminLTE/plugins/select2/css/select2.min.css')}}">
@endsection
@section('js')
<!-- DataTables -->
<!-- DataTables  & Plugins -->
<script src="{{url('AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{url('AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{url('AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{url('AdminLTE/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{url('AdminLTE/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{url('AdminLTE/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{url('AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{url('AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{url('AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{url('AdminLTE/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Page specific script -->
<script>
$(function() {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('.select2').select2();
    //Message
    setTimeout(function() {
        $(".message-div").fadeOut(2000);
    }, 3000);
    //edit
    $('#example1').on('click', '.edit', function(e) {
        // $('.edit').click(function() {
        var editId = $(this).attr('editId');
        var editUrl = "{{url('manage/customers/edit/show')}}";
        var token = $('input[name="_token"]').val();
        console.log(token);
        $.ajax({
            url: editUrl,
            method: "POST",
            data: {
                'editId': editId,
                '_token': token
            },
            success: function(result) {
                var obj = jQuery.parseJSON(result);
                //updateUrl = "{{url('/user/edit')}}/"+editId;
                console.log(obj);
                $('#id').val(obj.id);
                $('#name').val(obj.name);
                $('#email').val(obj.email);
                $('#address').val(obj.address);
                $('#mobile').val(obj.mobile);
                //$('#holder_img').attr('src',"{{url('/images/employees')}}/"+obj.image).show();
                //console.log(obj.name);
                //$('#addEditForm').attr('action',updateUrl);
                window.scrollTo(0, 0);
            }
        });
    });
});
</script>
@endsection