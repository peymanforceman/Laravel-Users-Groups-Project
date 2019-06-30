<!-- jQuery 3 -->

<script src="{{URL::asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{URL::asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
@yield('footer')
<!-- iCheck -->
<script src="{{URL::asset('plugins/iCheck/icheck.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{URL::asset('js/adminlte.min.js') }}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
</script>