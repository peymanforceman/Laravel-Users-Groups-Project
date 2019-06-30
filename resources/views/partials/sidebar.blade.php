<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu tree" data-widget="tree">

            <li @if($path== __('admin.dashboard')) class="active" @endif>
                <a href="{{ route('admin') }}">
                    <i class="fa fa-dashboard"></i> <span>{{ __('admin.dashboard') }}</span>
                </a>
            </li>
            <li @if($path== __('admin.Group Management')) class="active" @endif>
                <a href="{{ route('groups') }}">
                    <i class="fa fa-list"></i> <span>{{ __('admin.Group Management') }}</span>
                </a>
            </li>
            <li @if($path== __('admin.User Management')) class="active" @endif>
                <a href="{{ route('users') }}">
                    <i class="fa fa-users"></i> <span>{{ __('admin.User Management') }}</span>
                </a>
            </li>
            <li>
                <a target="_blank" href="{{ route('api_doc') }}">
                    <i class="fa fa-book"></i> <span>{{ __('admin.API Documentation') }}</span>
                </a>
            </li>
        </ul>
    </section>
</aside>