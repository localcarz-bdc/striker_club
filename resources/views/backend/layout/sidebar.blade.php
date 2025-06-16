        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{route('admin.dashboard')}}" class="brand-link">
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
                            <a href="{{route('admin.dashboard')}}" class="nav-link {{ request()->routeIs('admin.dashboard.index') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Dashboard
                                    <span class="right badge badge-danger">New</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item  {{ request()->routeIs('admin.contact.index', 'admin.member.index') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->routeIs('admin.contact.index', 'admin.member.index') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                User Requests
                                <i class="fas fa-angle-left right"></i>
                                <span class="badge badge-info right">{{ count(array_intersect(['admin.contact.index', 'admin.member.index'])) }}</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.contact.index') }}" class="nav-link {{ request()->routeIs('admin.contact.index') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Contact Us</p>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="{{ route('admin.debutante.index') }}" class="nav-link {{ request()->routeIs('admin.debutante.index') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Debutante Applicants</p>
                                </a>
                            </li> --}}

                            <li class="nav-item">
                                <a href="{{ route('admin.member.index') }}" class="nav-link {{ request()->routeIs('admin.member.index') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Membership Application</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                        <li class="nav-item  {{ request()->routeIs('admin.membersData.index', 'admin.gallery.index','admin.hero_slider.index') ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link {{ request()->routeIs('admin.membersData.index', 'admin.gallery.index','admin.hero_slider.index') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Site Management
                                    <i class="fas fa-angle-left right"></i>
                                    <span class="badge badge-info right">{{ count(array_intersect(['admin.membersData.index', 'admin.gallery.index', 'admin.hero_slider.index'])) }}</span>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{ route('admin.membersData.index') }}" class="nav-link {{ request()->routeIs('admin.membersData.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Members</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.gallery.index') }}" class="nav-link {{ request()->routeIs('admin.gallery.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Gallery</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.hero_slider.index') }}" class="nav-link {{ request()->routeIs('admin.hero_slider.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Home Page Slider</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item  {{ request()->routeIs('admin.designation.index','admin.profile.index','admin.ownInvoice.list') ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link {{ request()->routeIs('admin.designation.index','admin.profile.index','admin.ownInvoice.list') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Function
                                    <i class="fas fa-angle-left right"></i>
                                    <span class="badge badge-info right">{{ count(array_intersect(['admin.designation.index','admin.profile.index','admin.ownInvoice.list'])) }}</span>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.designation.index') }}" class="nav-link {{ request()->routeIs('admin.designation.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Designation</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.profile.index') }}" class="nav-link {{ request()->routeIs('admin.profile.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Profile</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.ownInvoice.list') }}" class="nav-link {{ request()->routeIs('admin.ownInvoice.list') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Transactions</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-header">Financial Management</li>
                        <li class="nav-item">
                            <a href="{{route('admin.invoice.list')}}" class="nav-link">
                                <i class="nav-icon fas fa-ellipsis-h"></i>
                                <p>Payment</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.blank') }}" class="nav-link">
                                <i class="nav-icon fas fa-file"></i>
                                <p>Blank</p>
                            </a>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
