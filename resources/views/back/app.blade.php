<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ url('/back/dist/css/bootstrap-theme.css') }}">
    <link rel="stylesheet" href="{{ url('/back/dist/css/rtl.css') }}">
    <link rel="stylesheet" href="{{ url('/back/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ url('/back/bower_components/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ url('/back/dist/css/AdminLTE.css') }}">
    <link rel="stylesheet" href="{{ url('/back/dist/css/skins/_all-skins.min.css') }}">


    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">

        @include('back.partials.header')

        @include('back.partials.sidebar')

        @yield('content')


    </div>


    <script src="{{ url('/back/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ url('/back/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('/back/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ url('/back/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ url('/back/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ url('/back/dist/js/demo.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.sidebar-menu').tree()
        })

    </script>

    @stack('scripts')

</body>

</html>
