<header class="main-header">
    <!-- Logo -->
    <a href="{{ url("") }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>B</b>log</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Figured</b>Blog</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                @if (!empty($userx))
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset("/bower_components/AdminLTE/dist/img/rafael.jpg") }}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ $userx->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{ asset("/bower_components/AdminLTE/dist/img/rafael.jpg") }}" class="img-circle" alt="User Image">

                            <p>
                                {{ $userx->name }}
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ route('admin.blog.create') }}" class="btn btn-default btn-flat">Create Blog</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                @else
                    <li class="dropdown user user-menu">
                        <a href="{{ url('/register') }}" >
                            <span class="hidden-xs">Register</span>
                        </a>
                    </li>
                    <li class="dropdown user user-menu">
                        <a href="{{ url('/login') }}">
                            <span class="hidden-xs">Login</span>
                        </a>

                    </li>
                @endif
            </ul>
        </div>
    </nav>
</header>