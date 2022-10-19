<div>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
            <img src="{{asset('assets/adminlte/dist/img/AdminLTELogo.png')}}"
                 alt="AdminLTE Logo"
                 class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{asset('assets/adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">AdminLte</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    @if(Auth::user()->role_id == '2')
                        <li class="nav-header">HALAMAN GURU</li>
                        <li class="nav-item">
                            <a href="{{route('guru.dashboard')}}"
                               class="nav-link {{($tagSubMenu == 'dashboard')?"active":""}}">

                                <i class="nav-icon fa fa-tachometer-alt"></i>
                                <p>
                                    DASHBOARD
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('guru.kelas')}}"
                               class="nav-link {{($tagSubMenu == 'materi')?"active":""}}">
                                <i class="nav-icon fa fa-boxes"></i>
                                <p>
                                    KELAS
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('guru.mapel')}}"
                               class="nav-link {{($tagSubMenu == 'mapel')?"active":""}}">
                                <i class="nav-icon fa fa-book"></i>
                                <p>
                                    MATA PELAJARAN
                                </p>
                            </a>
                        </li>
                    @endif
                    @if(Auth::user()->role_id == '1')
                        <li class="nav-header">MASTER DATA</li>
                        <li class="nav-item">
                            <a href="{{route('admin.users')}}" class="nav-link {{($tagSubMenu == 'user')?"active":""}}">
                                <i class="nav-icon fa fa-clipboard-list"></i>
                                <p>
                                    DATA USER
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.guru')}}" class="nav-link {{($tagSubMenu == 'guru')?"active":""}}">
                                <i class="nav-icon fa fa-clipboard-list"></i>
                                <p>
                                    DATA GURU
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.kelas')}}"
                               class="nav-link {{($tagSubMenu == 'kelas')?"active":""}}">
                                <i class="nav-icon fa fa-clipboard-list"></i>
                                <p>
                                    DATA KELAS
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.mapel')}}" class="nav-link {{($tagSubMenu == 'mapel')?"active":""}}">
                                <i class="nav-icon fa fa-clipboard-list"></i>
                                <p>
                                    DATA MATA PELAJARAN
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.jadwal')}}" class="nav-link {{($tagSubMenu == 'jadwal')?"active":""}}">
                                <i class="nav-icon fa fa-clipboard-list"></i>
                                <p>
                                    DATA JADWAL
                                </p>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</div>
