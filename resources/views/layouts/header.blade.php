<!-- Navbar -->
<style type="text/css">
    .dropdown-menu-lg {
        min-width: 376px;
    }
</style>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li> -->
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">{{ Auth::user()->notifications->count() }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">{{ Auth::user()->notifications->count() }} Notifications</span>

                @foreach(Auth::user()->notifications as $notification)
                    <div class="dropdown-divider"></div>
                    <div class="row p-2">
                        <div class="col-sm-9">
                            {{$notification->content}}
                        </div>
                        <div class="col-sm-3">
                            <div class="text-right">
                                <small>{{$notification->created_at}}</small>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if(Auth::user()->notifications->count() > 0) 
                    <a href="{{ route('notification.clearAll') }}" class="dropdown-item dropdown-footer">Clear All Notifications</a>
                @endif
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.logout') }}">
                Logout
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->