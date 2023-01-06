<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('backend/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="pb-3 mt-3 mb-3 user-panel d-flex">
            <div class="image">
                <img src="{{ asset('backend/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{  Str::upper(Auth::user()->name) }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        {{-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-header text-secondary"><h6>Multy Users</h6></li>

                <li class="nav-item">
                    <a href="{{ route('admin.users') }}" class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.specializations') }}" class="nav-link {{ request()->is('admin/specializations') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>
                            Specializations
                        </p>
                    </a>
                </li>
                @role('superadmin')
                <li class="nav-item">
                    <a href="{{ url('/laratrust') }}" class="nav-link {{ request()->is('/laratrust') ? 'active' : '' }}">
                        <i class="fas fa-cog"></i>
                        <p>
                            Roles & Permissions
                        </p>
                    </a>
                </li>
                @endrole
                <li class="nav-header text-secondary"><h6>Events</h6></li>
                <li class="nav-item">
                    <a href="{{ route('admin.events') }}" class="nav-link {{ request()->is('admin/events') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-calendar"></i>
                        <p>
                            Events
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.events2') }}" class="nav-link {{ request()->is('admin/events2') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-calendar"></i>
                        <p>
                            Events2
                        </p>
                    </a>
                </li>

                <li class="nav-header text-secondary"><h6>Tasks</h6></li>
                <li class="nav-item">
                    <a href="{{ route('admin.tasks') }}" class="nav-link {{ request()->is('admin/tasks') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            Tasks
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.levels') }}" class="nav-link {{ request()->is('admin/levels') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            Levels
                        </p>
                    </a>
                </li>

                <li class="nav-header text-secondary"><h6>Semesters & Weeks</h6></li>

                <li class="nav-item">
                    <a href="{{ route('admin.semesters') }}" class="nav-link {{ request()->is('admin/semesters') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-graduation-cap"></i>
                        <p>
                            Semesters
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.weeks') }}" class="nav-link {{ request()->is('admin/weeks') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-graduation-cap"></i>
                        <p>
                            Weeks
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
