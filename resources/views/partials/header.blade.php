<header class="main-header">
    <a href="#" class="logo">
        <span class="logo-mini">{{ __('admin.dashboard') }}</span>
        <span class="logo-lg">{{ __('admin.dashboard') }}</span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">{{ __('admin.Toggle navigation') }}</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{URL::asset('img/avatar5.png') }}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ Auth::guard('web')->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="{{URL::asset('img/avatar5.png') }}" class="img-circle" alt="User Image">
                            <p>
                                {{ Auth::guard('web')->user()->name }}
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                   class="btn btn-default btn-flat">{{ __('Logout') }}</a>
                            </div>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>