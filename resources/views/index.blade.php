<!doctype html>
<html class="no-js" lang="" ng-app="arkControl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Ark Control </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
        ============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/notika/img/favicon.ico') }}">
    <!-- Google Fonts
        ============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">

    <script src="{{ asset('lib/jquery/jquery.js') }}"></script>
    <script src="{{ asset('lib/jquery-ui/jquery-ui.js') }}"></script>
    {{--<script src="{{ asset('lib/mindmap/mindmap.js') }}"></script>--}}
    {{--<script src="{{ asset('lib/popper.js/popper.js') }}"></script>--}}
    <script src="{{ asset('lib/bootstrap/bootstrap.js') }}"></script>
    <script src="{{ asset('lib/angular-1.5.8/angular.js') }}"></script>
    <script src="{{ asset('lib/angular-1.5.8/angular-animate.js') }}"></script>
    <script src="{{ asset('lib/angular-1.5.8/angular-sanitize.js') }}"></script>
    <script src="{{ asset('lib/angular-ui-router.min.js') }}"></script>
    <script src="{{ asset('lib/ui-bootstrap-tpls-2.1.2.js') }}"></script>
    {{--<script src="{{ asset('lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js') }}"></script>--}}
    {{--<script src="{{ asset('lib/jquery-toggles/toggles.min.js') }}"></script>--}}
    <script src="{{ asset('lib/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('lib/datatables-responsive/dataTables.responsive.js') }}"></script>
    <script src="{{ asset('lib/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('lib/fullcalendar/dist/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('lib/ui-calendar-1.0.2/src/calendar.min.js') }}"></script>
    {{--<script src="{{ asset('lib/ng-file-upload-12.2.13/dist/ng-file-upload-shim.min.js') }}"></script>--}}
    {{--<script src="{{ asset('lib/ng-file-upload-12.2.13/dist/ng-file-upload.min.js') }}"></script>--}}
    <script src="{{ asset('lib/calendar.js') }}"></script>
    <script src="{{ asset('lib/ngStorage.min.js') }}"></script>
    {{--<script src="{{ asset('lib/angular.audio.min.js') }}"></script>--}}
    {{--<script src="{{ asset('lib/select2/js/select2.min.js') }}"></script>--}}
    {{--<script src="{{ asset('lib/jsPDF-1.3.4/dist/jspdf.min.js') }}"></script>--}}
    {{--<script src="{{ asset('lib/jsPDF-AutoTable-2.3.1/dist/jspdf.plugin.autotable.min.js') }}"></script>--}}
    <script src="{{ asset('lib/datetime-picker.min.js') }}"></script>



    {{--<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/satellizer/0.14.1/satellizer.js"></script>

    <!-- Angular JS
       ============================================ -->

    <script src="{{ asset("/arkcontrol/main.js") }}"></script>
    <script src="{{ asset("/arkcontrol/router.js") }}"></script>
    <script src="{{ asset("/arkcontrol/controller/UserController.js") }}"></script>
    <script src="{{ asset("/arkcontrol/controller/ClientController.js") }}"></script>
    <script src="{{ asset("/arkcontrol/service/ClientFactory.js") }}"></script>
    {{--<script src="{{ asset("/arkcontrol/service/UserService.js") }}"></script>--}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.14.3/ui-bootstrap-tpls.min.js"></script>


    <!-- Bootstrap CSS
        ============================================ -->
    {{--<link rel="stylesheet" href="{{ asset('/notika/css/bootstrap.min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('/notika/css/bootstrap.css') }}">

    <!-- Bootstrap CSS
        ============================================ -->
    <link rel="stylesheet" href="{{ asset('/notika/css/font-awesome.min.css') }}">

    <!-- wave CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ asset('/notika/css/wave/waves.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/notika/css/wave/button.css') }}">



    <!-- meanmenu CSS
        ============================================ -->
    <link rel="stylesheet" href="{{ asset('/notika/css/meanmenu/meanmenu.min.css') }}">
    <!-- animate CSS
        ============================================ -->
    <!-- normalize CSS
        ============================================ -->
        <link rel="stylesheet" href="{{ asset('/notika/css/normalize.css') }}">
    <!-- mCustomScrollbar CSS
        ============================================ -->
    <link rel="stylesheet" href="{{ asset('/notika/css/scrollbar/jquery.mCustomScrollbar.min.css') }}">
    <!-- jvectormap CSS
        ============================================ -->

    <!-- notika icon CSS
        ============================================ -->
    <link rel="stylesheet" href="{{ asset('/notika/css/notika-custom-icon.css') }}">
    <!-- wave CSS
        ============================================ -->

    <!-- main CSS
        ============================================ -->
    <link rel="stylesheet" href="{{ asset('/notika/css/main.css') }}">
    <!-- style CSS
        ============================================ -->
    <link rel="stylesheet" href="{{ asset('/notika/style.css') }}">
    <!-- responsive CSS
        ============================================ -->
    <link rel="stylesheet" href="{{ asset('/notika/css/responsive.css') }}">

</head>

<body>
<!-- Main Menu area End-->

<!-- Body Start --->

<div ui-view></div>

<!-- Body End -->



<!-- jquery
    ============================================ -->
<script src="{{ asset('/notika/js/vendor/jquery-1.12.4.min.js') }}"></script>
<!-- bootstrap JS
    ============================================ -->
<script src="{{ asset('/notika/js/bootstrap.min.js') }}"></script>

<!-- scrollUp JS
    ============================================ -->
<script src="{{ asset('/notika/js/jquery.scrollUp.min.js') }}"></script>


<script src="{{ asset('/notika/js/meanmenu/jquery.meanmenu.js') }}"></script>

<!-- plugins JS
    ============================================ -->
<script src="{{ asset('/notika/js/plugins.js') }}"></script>
<!--  Chat JS
    ============================================ -->
<script src="{{ asset('/notika/js/chat/moment.min.js') }}"></script>
{{--<!-- main JS--}}
    {{--============================================ -->--}}
<script src="{{ asset('/notika/js/main.js') }}"></script>

</body>

</html>