        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{route('member.dashboard')}}" class="brand-link">
                <img src="{{asset('backend')}}/dist/img/strickers_club_inc_logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Strikers Club, Inc.</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{asset('backend')}}/dist/img/3541871.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">@if(auth()->check()) {{ auth()->user()->name }} @endif</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
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
                        <li class="nav-item">
                            <a href="{{route('member.dashboard')}}" class="nav-link {{ request()->routeIs('member.dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Dashboard
                                    <span class="right badge badge-danger">New</span>
                                </p>
                            </a>
                        </li>

                        <li class="nav-item  {{ request()->routeIs('member.profile.index') || request()->routeIs('member.invoice.list')  ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->routeIs('member.profile.index') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Profile & Transaction
                                    <i class="fas fa-angle-left right"></i>
                                    &nbsp;&nbsp;<span class="badge badge-info right">{{ count(array_intersect(['member.profile.index', 'member.invoice.list'])) }}</span>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('member.profile.index')}}" class="nav-link {{ request()->routeIs('member.profile.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Profile</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('member.invoice.list', Auth::user()->id)}}" class="nav-link {{ request()->routeIs('member.invoice.list') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Transactions</p>
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a href="{{route('admin.designation.index')}}" class="nav-link {{ request()->is('admin.designation.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Membership Applicants</p>
                                    </a>
                                </li> --}}
                            </ul>
                        </li>

                        {{-- <li class="nav-header">MISCELLANEOUS</li>
                        <li class="nav-item">
                            <a href="{{ route('member.dashboard.blanc') }}" class="nav-link {{ request()->routeIs('member.dashboard.blanc') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-file"></i>
                                <p>Blank</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-ellipsis-h"></i>
                                <p>Documentation</p>
                            </a>
                        </li> --}}
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
