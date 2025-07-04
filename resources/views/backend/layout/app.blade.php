@include('backend.layout.header')
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        {{-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="{{asset('bankend')}}dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60"
                width="60">
        </div> --}}

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">


                        <i class="fa fa-cart-plus"></i>
                        <span class="badge badge-danger navbar-badge"
                            id="cart-count">{{ isset($invoices) ? count($invoices) : '' }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                        <div class="cart-content" id="cart-content" style="height: 200px; overflow:auto">
                            <div id="invoice-section"></div>
                        </div>

                    </div>
                </li>

                <!-- Messages Dropdown Menu -->
                {{--<li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="dist/img/user1-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="dist/img/user8-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="dist/img/user3-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i
                                                class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>--}}
                <!-- Notifications Dropdown Menu -->
                @php
                    $notification_object = App\Models\Notification::orderByDesc('id')->take(10)->where('admin_is_read',0);
                    $notification_categories = App\Models\Notification::select('category', \DB::raw('COUNT(*) as count'))
                                            ->where('admin_is_read',0)
                                            ->groupBy('category')
                                            ->get();
                    $notification_data = $notification_object->get();
                    $notification_count = $notification_object->count();
                @endphp
                {{-- @dd($notification_count,$notification_object) --}}
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">{{$notification_count}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">{{$notification_count}} Notifications</span>
                        <div class="dropdown-divider"></div>
                        @if(isset($notification_categories[0]['count']))
                            <a href="#" class="dropdown-item" id="contact">
                                    <i class="fas fa-envelope mr-2"></i>  {{$notification_categories[0]['count']}}  Contact new messages
                                    <span class="float-right text-muted text-sm">3 mins</span>
                            </a>
                        @endif
                        <div class="dropdown-divider"></div>

                        @if(isset($notification_categories[1]['count']))
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-users mr-2"></i>  {{$notification_categories[1]['count']}}  Membership requests
                                <span class="float-right text-muted text-sm">12 hours</span>
                            </a>
                        @endif

                        <div class="dropdown-divider"></div>
                        {{-- <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a> --}}
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <!-- Notifications login Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                            <img style="width:20%; padding:0" src="{{asset('backend')}}/dist/img/3541871.png" class="img-circle elevation-2" alt="User Image">
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('admin.profile.index') }}" class="dropdown-item">
                            <i class="ion ion-person-add"></i>&nbsp; Profile
                        </a>
                        <div class="dropdown-divider"></div>


                        <a href="{{ route('logout') }}" class="dropdown-item"  onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <i class="fas fa-file mr-2"></i>Logout
                        </a>

                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    {{--<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"
                        role="button">
                        <i class="fas fa-th-large"></i>
                    </a>--}}
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
@include('backend.layout.sidebar')

@yield('content')

@include('backend.layout.footer')

@stack('js')
<script>
    $(document).ready(function(){
        $(document).on('click', '#contact', function(){
            var url = "{{ route('admin.contact.isAdminRead')}}"
            $.ajax({
                type: 'get',
                url: url,
                data: {is_Read:1,action:'contact'},
                success: function (response) {
                    console.log(response)
                    if(response.msg == 'contact'){

                        window.location.href = 'admin/contact';
                    }else{
                        window.location.reload()
                    }
                        // window.reload('/contact')
                    // Handle success response
                },
                error: function (error) {
                    // Handle error response
                }
            });
        })
    })
</script>
<script>

    function showSuccessNotification() {
        showNotification('success', 'Operation completed successfully.');
    }

    function showErrorNotification() {
        showNotification('error', 'An error occurred while processing your request.');
    }
</script>

</body>
</html>
