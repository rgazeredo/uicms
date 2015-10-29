<!DOCTYPE html>
<html>

<head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <title>UiCMS</title>
    <meta name="keywords" content="UiCMS CMS" />
    <meta name="description" content="UiCMS - A simple CMS built with Laravel">
    <meta name="author" content="Raphael Azeredo">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
    <!-- Font CSS (Via CDN) -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800'>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto:400,500,700,300">

	<!-- Required Plugin CSS -->
	<link rel="stylesheet" type="text/css" href="{{ url('admin/vendor/plugins/datatables/media/css/dataTables.bootstrap.css') }}">

    <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="{{ url('admin/vendor/plugins/magnific/magnific-popup.css') }}">
    
    <!-- Nestable CSS -->
    <link rel="stylesheet" type="text/css" href="{{ url('admin/vendor/plugins/nestable/nestable.css') }}">

    <!-- Select2 Plugin CSS  -->
    <link rel="stylesheet" type="text/css" href="{{ url('admin/vendor/plugins/select2/css/core.css') }}">

    <!-- DatePicker Plugin CSS  -->
    <link rel="stylesheet" type="text/css" href="{{ url('admin/vendor/plugins/datepicker/css/bootstrap-datepicker.min.css') }}">

    <!-- Theme CSS -->
    <link rel="stylesheet" type="text/css" href="{{ url('admin/assets/skin/default_skin/css/theme.css') }}">

    <!-- Admin Forms CSS -->
    <link rel="stylesheet" type="text/css" href="{{ url('admin/assets/admin-tools/admin-forms/css/admin-forms.css') }}">

    <!-- Admin Modals CSS -->
    <link rel="stylesheet" type="text/css" href="{{ url('admin/assets/admin-tools/admin-plugins/admin-modal/adminmodal.css') }}">
    
    <!-- uiCustom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ url('admin/assets/skin/default_skin/css/uicustom.css') }}">

    <!-- jQuery Validation CSS -->
    <link rel="stylesheet" type="text/css" href="{{ url('admin/vendor/plugins/validation/screen.css') }}">

    <!-- Favicon -->
    <link rel="stylesheet" type="text/css" href="{{ url('admin/assets/img/favicon.ico') }}" rel="shortcut icon">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->

</head>

<body class="blank-page">
	
    <!-- Start: Main -->
    <div id="main">

        <!-- Start: Header -->
        <header class="navbar navbar-fixed-top bg-primary">
            <div class="navbar-branding">
                <a class="navbar-brand" href="dashboard.html"> <b>UiCMS</b> </a>
                <span id="toggle_sidemenu_l" class="glyphicons glyphicons-show_lines"></span>
                <ul class="nav navbar-nav pull-right hidden">
                    <li>
                        <a href="#" class="sidebar-menu-toggle">
                            <span class="octicon octicon-ruby fs20 mr10 pull-right "></span>
                        </a>
                    </li>
                </ul>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a class="request-fullscreen toggle-active" href="#">
                        <span class="octicon octicon-screen-full fs18"></span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle fw600 p15" data-toggle="dropdown"> 
                        <img src="{{ url('admin/assets/img/avatars/1.jpg') }}" alt="avatar" class="mw30 br64 mr15">
                        <span>{{ $ui_admin_auth->name }}</span>
                        <span class="caret caret-tp"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-persist pn w250 bg-white" role="menu">
                        <!-- <li class="br-t of-h">
                            <a href="#" class="fw600 p12 animated animated-short fadeInDown">
                                <span class="fa fa-user pr5"></span> Account Settings </a>
                        </li> -->
                        <li class="br-t of-h">
                            <a href="{{ url('uiadmin/logout') }}" class="fw600 p12 animated animated-short fadeInDown">
                                <span class="fa fa-power-off pr5"></span> Sair 
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </header>
        <!-- End: Header -->

        <!-- Start: Sidebar -->
        <aside id="sidebar_left" class="nano nano-primary">
            <div class="nano-content">
                {!! $ui_admin_auth->admin_menu !!}
            </div>
        </aside>

        <!-- Start: Content -->
        <section id="content_wrapper">

            <!-- Start: Topbar -->
            <header id="topbar" class="affix">
                <div class="topbar-left">
                    <ol class="breadcrumb">
                        <li class="crumb-active">
                            <a href="dashboard.html">Dashboard</a>
                        </li>
                        @if(!empty($module_title))
	                        <li class="crumb-link">
                                <a href="{{ url($module_link) }}">{{ $module_title }}</a>
	                        </li>
	                    @endif
	                    @if(!empty($module_action))
                        	<li class="crumb-trail">{{ $module_action }}</li>
	                    @endif
                    </ol>
                </div>
            </header>
            <!-- End: Topbar -->

            <!-- Begin: Content -->
            <section id="content">
				@yield('content')
            </section>
            <!-- End: Content -->

        </section>

    </div>
    <!-- End: Main -->

    <!-- BEGIN: PAGE SCRIPTS -->

    <!-- jQuery -->
    <script type="text/javascript" src="{{ url('admin/vendor/jquery/jquery-1.11.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('admin/vendor/jquery/jquery_ui/jquery-ui.min.js') }}"></script>

    <!-- Bootstrap -->
    <script type="text/javascript" src="{{ url('admin/assets/js/bootstrap/bootstrap.min.js') }}"></script>
    
    <!-- Select2 Plugin -->
    <script type="text/javascript" src="{{ url('admin/vendor/plugins/select2/select2.min.js') }}"></script>

    <!-- DatePicker Plugin -->
    <script type="text/javascript" src="{{ url('admin/vendor/plugins/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('admin/vendor/plugins/datepicker/js/bootstrap-datepicker.pt-BR.min.js') }}"></script>

    <!-- MaskMoney Plugin -->
    <script type="text/javascript" src="{{ url('admin/vendor/plugins/maskmoney/jquery.maskMoney.min.js') }}"></script>

	<!-- Datatables -->
	<script type="text/javascript" src="{{ url('admin/vendor/plugins/datatables/media/js/jquery.dataTables.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('admin/vendor/plugins/datatables/media/js/dataTables.bootstrap.js') }}"></script>
	<script type="text/javascript" src="{{ url('admin/vendor/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js') }}"></script>
	
	<!-- jQuery Validation -->
	<script type="text/javascript" src="{{ url('admin/vendor/plugins/validation/jquery.validate.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('admin/vendor/plugins/validation/localization/messages_pt_BR.min.js') }}"></script>
    
    <!-- Plugin JS -->
    <script type="text/javascript" src="{{ url('admin/vendor/plugins/nestable/jquery.nestable.js') }}"></script>

    <!-- Theme Javascript -->
    <script type="text/javascript" src="{{ url('admin/assets/js/utility/utility.js') }}"></script>
    <script type="text/javascript" src="{{ url('admin/assets/js/main.js') }}"></script>
    <script type="text/javascript" src="{{ url('admin/assets/js/demo.js') }}"></script>

    <script type="text/javascript">
        jQuery(document).ready(function() {

            "use strict";

            // Init Theme Core    
            Core.init();

            // Init Theme Core    
            Demo.init();

        });
    </script>

    @yield('scripts')

    <!-- END: PAGE SCRIPTS -->

</body>

</html>