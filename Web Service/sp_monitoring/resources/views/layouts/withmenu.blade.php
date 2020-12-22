<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Quras IEO Admin') }}</title>

    <!-- Global stylesheets -->
    <!--<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">-->
    <link href="{{ asset('assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/core.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/components.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/colors.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/icons/fontawesome/styles.min.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/pace.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/blockui.min.js') }}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/extensions/responsive.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/core/libraries/jquery_ui/interactions.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/uploaders/fileinput/plugins/purify.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/uploaders/fileinput/plugins/sortable.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/uploaders/fileinput/fileinput.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/visualization/echarts/echarts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/ui/moment/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/pagination/bootpag.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/pagination/bs_pagination.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/js/core/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/datatables_responsive.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/form_select2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/form_inputs.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/uploader_bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/components_modals.js') }}"></script>
    <!-- /theme JS files -->

    <style>
        .border-box {
            border: 1px solid black;
            overflow: hidden;
        }

        a:hover {
            text-decoration: underline;
            color: hotpink;
        }

        .inactive {
            opacity: 0.6!important;
        }

        a.disabled {
            color: lightgray;
            cursor: not-allowed;
            opacity: 0.8;
            text-decoration: none;
            pointer-events: none;
        }
        tr .wide-xl-col {
            min-width: 300px;
            max-width: 400px;
        }
        
        tr .wide-col {
            min-width: 100px;
            max-width: 120px;
        }

        tr .common-col {
            min-width: 80px;
            max-width: 100px;
        }

        tr .narrow-col {
            min-width: 30px;
            max-width: 50px;
        }

        tr.slave {
            background-color: rgb(55, 71, 79);
            opacity: 0.8;
            color: rgba(255, 255, 255, 0.75);
        }

        tr.master {
            background-color: rgb(55, 71, 79);
            color: rgba(255, 255, 255, 0.75);
        }

        tr.summary {
            background-color: rgb(116 137 148);
            color: rgba(255, 255, 255, 0.75);
        }
    </style>
</head>
<body>

<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand pt-5" href="{{ route('login') }}">
            <h1 class="text-black no-margin">{{config('app.name')}}</h1>
        </a>
        <ul class="nav navbar-nav">
            <li><a hrefe="javscript:;" onclick="toggleSideBar()"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">

        <ul class="nav navbar-nav navbar-right">

            <li>
                <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon-switch2"></i> {{ trans('common.logout') }}</a>
            </li>

        </ul>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
    </div>
</div>

<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        <div id="sidebar" class="sidebar sidebar-main">
            <div class="sidebar-content"> 
                <!-- Main navigation -->
                <div class="sidebar-category sidebar-category-visible">
                    <div class="category-content no-padding">
                        <ul class="navigation navigation-main navigation-accordion">
                            <!-- Main -->
                            <li id="broker_list"><a href="{{ route('broker') }}"><i class="icon-office"></i> {{ trans('common.side_menu.broker') }}</a></li>
                            <li id="vps_list"><a href="{{ route('vpslist') }}"><i class="icon-server"></i> {{ trans('common.side_menu.vps_list') }}</a></li>
                            <li id="account_list"><a href="{{ route('accountlist') }}"><i class="icon-wallet"></i> {{ trans('common.side_menu.account_list') }}</a></li>
                            <li id="spclient_list"><a href="{{ route('spclient') }}"><i class="icon-user-tie"></i> {{ trans('common.side_menu.spclient') }}</a></li>
                            <li id="accdetail_list"><a href="{{ route('accdetail') }}"><i class="icon-eye"></i> {{ trans('common.side_menu.accdetail') }}</a></li>
                            <li id="setting"><a href="{{ route('setting') }}"><i class="icon-lock"></i> {{ trans('common.side_menu.setting') }}</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /main navigation -->

            </div>
        </div>
        <!-- /main sidebar -->

        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Page header -->
            <div class="page-header page-header-default">
                <div class="page-header-content">
                    <div class="page-title">
                        <h4><i class="@yield('page_title_ico', trans('dashboard.title_ico')) position-left"></i> <span class="text-black">@yield('page_title', trans('dashboard.title'))</span></h4>
                    </div>
                </div>
            </div>
            <!-- /page header -->
            @yield('content')
        </div>

    </div>
    <!-- /page content -->

</div>
</body>
<script>
    function toggleSideBar() {
        if ($('#sidebar').hasClass('sidebar-main'))
            $('#sidebar').removeClass('sidebar-main').addClass('sidebar-opposite');
        else
            $('#sidebar').removeClass('sidebar-opposite').addClass('sidebar-main');
    }
</script>
</html>
