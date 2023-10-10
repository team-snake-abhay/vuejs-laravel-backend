<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link">
        <img src="{{asset('pub_template/images/favicon.ico')}}" alt="Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->


        <!-- SidebarSearch Form -->
        <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="{{url(Auth::user()->url)}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <!--span class="right badge badge-danger">New</span-->
                        </p>
                    </a>
                </li>
                @if(Auth::user()->hasAnyRole(['Admin']))
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Admin Users
                            <i class="fas fa-angle-left right"></i>
                            <!--span class="badge badge-info right">.</span-->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- <li class="nav-item">
                            <a href="{{url('/admin/user/role')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Role</p>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="{{url('/admin/user')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Admin User Management</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                @if(Auth::user()->hasAnyRole(['Admin']))
                <li class="nav-item">
                    <a href="{{route('manage.customer')}}" class="nav-link">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            Subscribers
                            <!--span class="right badge badge-danger">New</span-->
                        </p>
                    </a>
                </li>
                @endif
                <!--li class="nav-header">LABELS</li-->
                <li class="nav-item">
                    <a href="{{url('logout')}}" class="nav-link text-danger">
                        <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                        <p class="text">Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>