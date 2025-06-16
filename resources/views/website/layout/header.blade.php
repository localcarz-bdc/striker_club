<header>
    <div class="header-area">
        <div class="main-header ">
            <div class="header-top d-none d-sm-block">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="d-flex justify-content-between flex-wrap align-items-center">
                                <div class="header-info-left">
                                    <ul>
                                        <li><i class="ti-home"></i></li>
                                        <li>1100 SpringHill Ave, Mobile, AL 36604</li>
                                    </ul>
                                </div>
                                <div class="header-info-right">
                                    <ul class="header-social">
                                        <li><a href="https://www.facebook.com/people/The-Strikers-Club-Inc/100080884837286/"><i class="fab fa-facebook"></i>&nbsp;Facebook</a></li>
                                        {{--<li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                        <li> <a href="#"><i class="fab fa-instagram"></i></a></li>--}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom  header-sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">

                        <div class="col-xl-2 col-lg-2 col-sm-2">
                            <div class="logo">
                                <a href="{{ route('home') }}"><img src="{{ asset('frontend') }}/assets/img/logo/logo_01.png" alt="Strikers Logo " style="width:50%; padding: 3%;"></a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10">

                            <div class="main-menu f-right d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a href="{{ route('home') }}">Home</a></li>
                                        <li><a href="{{ route('debutante.program') }}">Debutante Program</a></li>
                                        {{-- <li><a href="{{ route('debutante.application') }}" >Debutante Application</a></li> --}}
                                        {{-- <li><a href="{{ route('member.application') }}" >Member Application</a></li> --}}
                                        <li><a href="https://form.jotform.com/212704070043138" >Member Application</a></li>
                                        <li><a href="{{ route('board.members') }}">Board Members</a></li>
                                        <li><a href="{{ route('Mens-Health-2025') }}" >Men's Health 2025</a></li>
                                        <li><a href="#">Other</a>
                                            <ul class="submenu">
                                                <li><a href="{{ route('members') }}" style="font-size: 80%">Other Members</a></li>
                                                <li><a href="{{ route('deceased.member') }}" style="font-size: 80%">Deceased Members</a></li>
                                                @guest
                                                <li><a href="{{ route('noAuth.event.calendar') }}" style="font-size: 80%">Calendar of Events</a></li>
                                                @else
                                                <li><a href="{{ route('event.calendar') }}" style="font-size: 80%">Calendar of Events</a></li>

                                                @endguest
                                                <li><a href="{{ route('gallery') }}" >Gallery</a></li>
                                                <li><a href="{{ route('about') }}" style="font-size: 80%">About Us</a></li>
                                                <li><a href="{{ route('contact') }}" style="font-size: 80%">Contact</a></li>
                                                <li><a href="{{ route('test.paypal') }}" style="font-size: 80%">PayPal</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <div class="header-right-btn f-right  ml-15">
                                                @guest
                                                    @if (Route::has('login'))
                                                        <a href="{{ route('login') }}" class="header-btn">Login</a>
                                                    @endif
                                                @else

                                                <li class="nav-item dropdown "><a class="nav-link dropdown-toggle" href="#" ><i class="fa fa-user"></i>&nbsp;{{ Auth::user()->name }}</a>
                                                    <ul class="submenu">
                                                        <li><a href="{{ route('admin.dashboard') }}" style="font-size: 80%">Dashboard</a></li>
                                                        <li><a href="{{ route('logout') }}"
                                                        onclick="event.preventDefault();
                                                                        document.getElementById('logout-form').submit();" style="font-size: 80%">Log Out</a></li>
                                                    </ul>
                                                </li>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                            @csrf
                                                </form>
                                                @endguest
                                            </div>
                                        </li>


                                    </ul>
                                </nav>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
