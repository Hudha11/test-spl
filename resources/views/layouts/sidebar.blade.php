<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ asset('adminlte3/index3.html') }}" class="brand-link">
        <img src="{{ asset('adminlte3/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SPL</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- SidebarSearch Form -->
        <div class="form-inline mt-2">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                {{-- MANAGER --}}
                <li class="nav-header">MANAGER</li>
                <li class="nav-item">
                    <a wire:navigate href="{{ route('manager.user.index') }}" class="nav-link @yield('menuManagerUser')">
                        <i class="nav-icon far fa-list-alt"></i>
                        <p>
                            Data Department
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a wire:navigate href="{{ route('manager.spl.index') }}" class="nav-link @yield('menuManagerSpl')">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            SPL Requests
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a wire:navigate href="{{ route('manager.approval.index') }}" class="nav-link @yield('menuManagerApproval')">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Approvals
                        </p>
                    </a>
                </li>

                {{-- SUPERVISOR --}}
                <li class="nav-header">SUPERVISOR</li>
                <li class="nav-item">
                    <a wire:navigate href="{{ route('supervisor.spl.index') }}" class="nav-link @yield('menuSupervisorSpl')">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            SPL Requests
                        </p>
                    </a>
                </li>

                {{-- ADMIN SDM --}}
                <li class="nav-header">ADMIN SDM</li>
                <li class="nav-item">
                    <a wire:navigate href="{{ route('admin.user.index') }}" class="nav-link @yield('menuAdminUser')">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Data Karyawan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a wire:navigate href="{{ route('admin.approval.index') }}" class="nav-link @yield('menuAdminApproval')">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Approvals
                        </p>
                    </a>
                </li>

                {{-- KARYAWAN --}}
                <li class="nav-header">KARYAWAN</li>
                <li class="nav-item">
                    <a wire:navigate href="{{ route('karyawan.lembur.index') }}" class="nav-link @yield('menuKaryawanLembur')">
                        <i class="nav-icon far fa-list-alt"></i>
                        <p>
                            Lembur Saya
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
