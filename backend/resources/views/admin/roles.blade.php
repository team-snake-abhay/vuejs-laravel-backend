@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">User Role Assign</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Contact Info</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            @if(!$user->hasRole('Customer') && !$user->hasRole('Dealer'))
                            <tr>
                                <td>
                                    <b>{{$user->name}}</b><br>
                                    <i class="fa fa-user-circle"></i> {{$user->username}}
                                </td>
                                <td>
                                    <i class="fa fa-at"></i> {{$user->email}}<br>
                                    <i class="fa fa-phone-square-alt"></i> {{$user->mobile}}
                                </td>
                                <td>
                                    <form action="{{url('/admin/user/role/assign')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="email" value="{{$user->email}}">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="role_admin"
                                                {{ $user->hasRole('Admin')? 'checked':'' }}>
                                            <label class="form-check-label">Admin</label>
                                        </div>
                                        <!-- <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="role_manager"
                                                {{ $user->hasRole('Manager')? 'checked':'' }}>
                                            <label class="form-check-label"> Manager</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="role_viewer"
                                                {{ $user->hasRole('Viewer')? 'checked':'' }}>
                                            <label class="form-check-label">Viewer</label>
                                        </div> -->
                                        <!--div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="role_dealer"
                                                {{ $user->hasRole('Dealer')? 'checked':'' }}>
                                            <label class="form-check-label">Dealer</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="role_customer"
                                                {{ $user->hasRole('Customer')? 'checked':'' }}>
                                            <label class="form-check-label">Customer</label>
                                        </div-->
                                        <button type="submit">Assign Roles</button>
                                    </form>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                        <!-- <tfoot>
              <tr>
                <th>Rendering engine</th>
                <th>Browser</th>
                <th>Platform(s)</th>
                
              </tr>
            </tfoot> -->
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>

@endsection

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

@endsection

@section('js')
<!-- DataTables  & Plugins -->
<script src="{{asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script>
$(function() {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print"],
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
});
</script>
@endsection