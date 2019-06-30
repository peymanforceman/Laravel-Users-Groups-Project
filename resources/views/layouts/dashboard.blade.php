<!DOCTYPE html>
<html>
@include('partials.head')

<body class="sidebar-mini skin-black">
<div class="wrapper">
    @include('partials.header')
    @include('partials.sidebar')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                {{ $path }}
                <small>{{ $msg }}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"></i> Home</a></li>
                <li class="active">{{ $path }}</li>
            </ol>
        </section>
        <section class="content">
            @yield('content')
        </section>
    </div>

    <div class="control-sidebar-bg"></div>
    @include('partials.footer_scripts')
</div>
</body>

</html>