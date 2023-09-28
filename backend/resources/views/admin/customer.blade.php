@extends('layouts.admin')
@section('title','User')
@section('content')
@if (Session::has('success'))
<div class="alert alert-success message-div">{{ Session::get('success') }}</div>
@endif


<div class="card">
    <!-- /.box-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
            aria-describedby="example1_info">
            <thead>
                <tr role="row">
                    <!-- <th>Username</th> -->
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Current Subscription</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $item)
                @if($item->hasRole('Customer'))
                <tr>
                    <!-- <td>{{$item->username}}</td> -->
                    <td>{{$item->name}}</td>
                    <td>{{$item->mobile}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->subscription}}</td>
                    <td>@if($item->status == 1) <span class="badge badge-success">Active</span>@else <span class="badge badge-danger"> Inactive </span> @endif</td>
                    <td>
                        @if($item->subscription != 'basic')
                        <a href="{{route('manage.customer.subscription',[$item->id,'basic'])}}" data-toggle="tooltip" title="Edit" class="btn btn-primary btn-sm edit">Basic</a>
                        @endif
                        @if($item->subscription != 'pro')
                        <a href="{{route('manage.customer.subscription',[$item->id,'pro'])}}" data-toggle="tooltip" title="Edit" class="btn btn-info btn-sm edit">Pro</a>
                        @endif
                        @if($item->subscription != 'recurring')
                        <a href="{{route('manage.customer.subscription',[$item->id,'recurring'])}}" data-toggle="tooltip" title="Edit" class="btn btn-warning btn-sm edit">Recurring</a>
                        @endif
                        @if($item->status == 1)
                            <a href="{{route('manage.customer.status',[$item->id,'0'])}}" data-toggle="tooltip" class="btn btn-danger btn-sm edit">Suspend</a>
                        @else 
                            <a href="{{route('manage.customer.status',[$item->id,'1'])}}" data-toggle="tooltip" class="btn btn-success btn-sm edit">Activate</a>
                        @endif
                    </td>
                </tr>
                @endif
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
        var editUrl = "{{url('admin/user/edit/show')}}";
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
                // console.log(obj);
                $('#user_id').val(obj.id);
                $('#name').val(obj.name);
                // $('#username').val(obj.username);
                $('#email').val(obj.email);
                $('#password').val(obj.password);
                // $('#nid').val(obj.nid);
                // $('#address').val(obj.address);
                $('#mobile').val(obj.mobile);
                $('#role').hide();
                if (obj.status == 1)
                    $('#status').prop('checked', true);
                else
                    $('#status').prop('checked', false);
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