<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('images/logo-unheval.png') }}" alt="AdminLTE Logo"  height="50" class=""
            style="opacity: .8">
        {{-- <span class="brand-text font-weight-light">AdminLTE 3</span> --}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('images/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->nombres.' '.Auth::user()->apellido_paterno }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        {{-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
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
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                    <a href="inicio" class="nav-link @if( Request::is('home')) active @endif ">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Inicio
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="usuario" class="nav-link @if( Request::is('usuario')) active @endif">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Usuario
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="alumno" class="nav-link @if( Request::is('alumno')) active @endif">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Alumno
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="repartir" class="nav-link @if( Request::is('registro')) active @endif">
                        <i class="nav-icon fas fa-cookie-bite"></i>
                        <p>
                            Repartir
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
