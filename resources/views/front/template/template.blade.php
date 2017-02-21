<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        <title>@yield('title') - Olympic Drive - Fruits et légumes frais près de chez vous</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="{{ asset('front/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('front/css/responsive.css') }}">
        <link rel="stylesheet" href="{{ asset('front/css/jquery.mCustomScrollbar.min.css') }}">
        <link href="{{ asset('front/css/revolution-slider.css') }}" rel="stylesheet">
        <link href="{{ asset('back/css/sweetalert.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('front/css/myCustom.css') }}" rel="stylesheet">

    </head>
    <body>
        <div class="page-wrapper">
            <div class="preloader"></div>
            @include('front.template.header')
            @include('front.template.menu')

            @yield('content')

            @include('front.template.footer')

            <script src="{{ asset('front/js/jquery.js') }}"></script>
            <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
            <script src="{{ asset('front/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
            <script src="{{ asset('front/js/revolution.min.js') }}"></script>
            <script src="{{ asset('front/js/jquery.fancybox.pack.js') }}"></script>
            <script src="{{ asset('front/js/jquery.fancybox-media.js') }}"></script>
            <script src="{{ asset('front/js/jquery.countdown.js') }}"></script>
            <script src="{{ asset('back/js/sweetalert.min.js') }}"></script>
            <script src="{{ asset('front/js/owl.js') }}"></script>
            <script src="{{ asset('front/js/wow.js') }}"></script>
            <script src="{{ asset('front/js/validate.js') }}"></script>
            <script src="{{ asset('front/js/script.js') }}"></script>
            <script type="text/javascript">
                $(function () {
                    $.ajaxSetup({
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                    });
                });
            </script>
            @yield('scripts')
        </div>
    </body>
</html>