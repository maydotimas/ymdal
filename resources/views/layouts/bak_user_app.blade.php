<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content="YMDAL | HOME"/>
    <meta name="author" content=""/>

    <link rel="icon" href="/neon/assets/images/favicon.ico">
    <link rel="stylesheet" href="/neon/assets/css/font-icons/entypo/css/entypo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>YMDAL | HOME</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="/css/neon_app.css">

    <script src="/neon/assets/js/jquery-1.11.3.min.js"></script>

    <!--[if lt IE 9]>
    <script src="/neon/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

{{--<script src="{{ asset('js/app.js') }}" defer></script>--}}

<!-- Styles -->
    {{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}

</head>
<body class="" data-url="http://neon.dev">

<div id="app" class="page-container">
    <!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

    <div class="sidebar-menu">

        <div class="sidebar-menu-inner">

            <header class="logo-env">

                <!-- logo -->
                <div class="logo">
                    <a href="/">
                        <img src="/neon/assets/images/logo@2x.png" width="120" alt=""/>
                    </a>
                </div>

                <!-- logo collapse icon -->
                <div class="sidebar-collapse">
                    <a href="#" class="sidebar-collapse-icon">
                        <!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                        <i class="entypo-menu"></i>
                    </a>
                </div>


                <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
                <div class="sidebar-mobile-menu visible-xs">
                    <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
                        <i class="entypo-menu"></i>
                    </a>
                </div>

            </header>


            <ul id="main-menu" class="main-menu">
                <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
                {{--DASHBOARD--}}
                <li @if($active=='dashboard')class="active opened active"@endif>
                    <a href="/home">
                        <i class="entypo-gauge"></i>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                {{--REPORTS--}}
                <li @if($active=='reports')class="active opened active"@endif >
                    <a href="#">
                        <i class="entypo-doc-text"></i>
                        <span class="title">Reports</span>
                    </a>
                    <ul>
                        <li @if($active=='reports')class="active"@endif>
                            <a href="/reports/per-transaction">
                                <span class="title">Per Transaction</span>
                            </a>
                        </li>

                    </ul>
                </li>
                {{--CSV--}}
                <li @if($active=='csv-upload' || $active=='csv-history')class="active opened active"@endif>
                    <a href="index.html">
                        <i class="entypo-upload-cloud"></i>
                        <span class="title">Third-Party CSV</span>
                    </a>
                    <ul>
                        <li @if($active=='csv-upload')class="active"@endif>
                            <a href="/csv/upload">
                                <span class="title">Upload CSV</span>
                            </a>
                        </li>
                        <li @if($active=='csv-history')class="active"@endif>
                            <a href="/csv/history">
                                <span class="title">Upload Summary</span>
                            </a>
                        </li>

                    </ul>
                </li>
            </ul>

        </div>

    </div>

    <div class="main-content">

        <div class="row">

            <!-- Profile Info and Notifications -->
            <div class="col-md-6 col-sm-8 clearfix">

                <ul class="user-info pull-left pull-none-xsm">

                    <!-- Profile Info -->
                    <li class="profile-info dropdown">
                        <!-- add class "pull-right" if you want to place this from right -->

                        <h2>YMDAL | DASHBOARD</h2>

                    </li>

                </ul>


            </div>


            <!-- Raw Links -->
            <div class="col-md-6 col-sm-4 clearfix hidden-xs">

                <ul class="list-inline links-list pull-right">

                    <li>
                        <b>ADMIN</b>: Role
                    </li>
                    <li class="sep"></li>
                    <li>
                        <b>version</b>: Role
                    </li>

                    <li class="sep"></li>

                    <li>
                        <form method="POST" action="/logout">
                            @csrf
                            <button class="btn btn-red btn-icon btn-sm check-changes-class">
                                Log out
                                <i class="entypo-logout right"></i>
                            </button>
                        </form>
                    </li>
                </ul>

            </div>

        </div>

        <hr/>

    @yield('content')


    <!-- Footer -->
        <footer class="main">

            &copy; 2020 <strong>YMDAL</strong> by <a href="http://nexbridgetech.com" target="_blank">NexBridge
                Technologies</a>

        </footer>
    </div>


</div>


<!-- Imported styles on this page -->
<link rel="stylesheet" href="/neon/assets/js/jvectormap/jquery-jvectormap-1.2.2.css">
<link rel="stylesheet" href="/neon/assets/js/rickshaw/rickshaw.min.css">

<!-- Bottom scripts (common) -->
<script src="/neon/assets/js/gsap/TweenMax.min.js"></script>
<script src="/neon/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
<script src="/neon/assets/js/bootstrap.js"></script>
<script src="/neon/assets/js/joinable.js"></script>
<script src="/neon/assets/js/resizeable.js"></script>
<script src="/neon/assets/js/neon-api.js"></script>
<script src="/neon/assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>


<!-- Imported scripts on this page -->
<script src="/neon/assets/js/jvectormap/jquery-jvectormap-europe-merc-en.js"></script>
<script src="/neon/assets/js/jquery.sparkline.min.js"></script>
<script src="/neon/assets/js/rickshaw/vendor/d3.v3.js"></script>
<script src="/neon/assets/js/rickshaw/rickshaw.min.js"></script>
<script src="/neon/assets/js/raphael-min.js"></script>
<script src="/neon/assets/js/morris.min.js"></script>
<script src="/neon/assets/js/toastr.js"></script>


<!-- JavaScripts initializations and stuff -->
<script src="/neon/assets/js/neon-custom.js"></script>


<!-- Demo Settings -->
<script src="/neon/assets/js/neon-demo.js"></script>

@yield('extra-scripts')

</body>
</html>