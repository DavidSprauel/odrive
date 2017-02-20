<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        <title>Administration - Olympic Drive</title>
        <link href="{{ asset('back/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('back/css/sb-admin.css') }}" rel="stylesheet">
        <link href="{{ asset('back/css/plugins/morris.css') }}" rel="stylesheet">
        <link href="{{ asset('back/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('back/css/sweetalert.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('back/css/custom.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="wrapper">
            @include('back.template.header')
            <div id="page-wrapper">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>

            <!-- jQuery -->
            <script src="{{ asset('back/js/jquery.js') }}"></script>

            <!-- Bootstrap Core JavaScript -->
            <script src="{{ asset('back/js/bootstrap.min.js') }}"></script>
            <script src="{{ asset('back/js/bootstrap-toggle.js') }}"></script>
            <script src="{{ asset('back/js/sweetalert.min.js') }}"></script>

            <!-- Morris Charts JavaScript -->
            {{--<script src="{{ asset('js/plugins/morris/raphael.min.js') }}"></script>
            <script src="{{ asset('js/plugins/morris/morris.min.js') }}"></script>
            <script src="{{ asset('js/plugins/morris/morris-data.js') }}"></script>--}}
            <script type="text/javascript">
                $(function () {
                    $.ajaxSetup({
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                    });
                });
            </script>
            @yield('script')
        </div>
    </body>
</html>