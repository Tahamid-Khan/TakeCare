<style>
    .bg-sky-cust{
        background-color: #0071C1 !important;

    }
    .font-white{
        color: white !important;
    }
</style>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light bg-sky-cust font-white">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link font-white" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a style="color: black" href="{{ route('dashboard') }}" class="nav-link font-white">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a style="color: black" href="{{route('notice-board')}}" class="nav-link font-white">Notice
{{--                <span class="badge bg-danger position-absolute top-0 start-100 translate-middle badge-rounded-pill">3</span>--}}
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a style="color: black" href="{{route('message.index')}}" class="nav-link font-white">Messages</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a style="color: black" href="{{route('holidays')}}" class="nav-link font-white">Holidays</a>
        </li>
    </ul>


    <div class="sidebar  ml-auto">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-1 pb-1 mb-1 d-flex">
            <div class="image">
                @if(isset(auth()->user()->image) && !empty(auth()->user()->image))
                    <img src="{{ asset('img/registration/'.auth()->user()->image)}}" class="img-circle" alt="User Image">
                @else
                    <img src="{{ asset('img/avatar.png')}}" class="img-circle" alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="#"  class="d-block font-white">{{auth()->user()->name}}</a>
            </div>
        </div>
</nav>
  <!-- /.navbar -->
