<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard.user') }}" class="brand-link">
        <img src="/assets/logo.png" class="footer-logo"  height="auto" width="60px" alt="" />
        {{--<img src="{{ asset('images/1637560976DLWluZ7.png')}}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">--}}
        Project2Morrow
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if(isset(auth()->user()->image) && !empty(auth()->user()->image))
                    <img src="{{ asset('img/registration/'.auth()->user()->image)}}" class="img-circle " alt="User Image">
                    {{--<img src="{{ asset('images/'.auth()->user()->image)}}" class="" alt="User Image">--}}
                @else
                    <img src="{{ asset('img/avatar-1577909_1280.png')}}" class="img-circle " alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="{{ route('my.profile') }}" class="d-block">{{auth()->user()->name}}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('my.profile') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>My Profile</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
