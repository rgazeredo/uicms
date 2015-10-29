<!DOCTYPE html>
<html>

<head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <title>uiCMS</title>
    <meta name="keywords" content="uiCMS" />
    <meta name="description" content="uiCMS">
    <meta name="author" content="Raphael Azeredo">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font CSS (Via CDN) -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800'>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto:400,500,700,300">

    <!-- Theme CSS -->
    <link rel="stylesheet" type="text/css" href="{{ url('admin/assets/skin/default_skin/css/theme.css') }}">

    <!-- uiCustom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ url('admin/assets/skin/default_skin/css/uicustom.css') }}">

    <!-- Admin Forms CSS -->
    <link rel="stylesheet" type="text/css" href="{{ url('admin/assets/admin-tools/admin-forms/css/admin-forms.css') }}">

    <!-- Favicon -->
    <link rel="stylesheet" type="text/css" href="{{ url('admin/assets/img/favicon.ico', array('rel' => 'shortcut icon')) }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
   <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
   <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
   <![endif]-->
</head>

<body class="external-page sb-l-c sb-r-c">

    <!-- Start: Main -->
    <div id="main" class="animated fadeIn">

        <!-- Start: Content -->
        <section id="content_wrapper">

            <!-- begin canvas animation bg -->
            <div id="canvas-wrapper">
                <canvas id="demo-canvas"></canvas>
            </div>

            <!-- Begin: Content -->
            <section id="content">
                @yield('content')
            </section>
            <!-- End: Content -->

        </section>
        <!-- End: Content-Wrapper -->

    </div>
    <!-- End: Main -->

    <!-- BEGIN: PAGE SCRIPTS -->
	
	<!-- jQuery -->
    <script type="text/javascript" src="{{ url('admin/vendor/jquery/jquery-1.11.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('admin/vendor/jquery/jquery_ui/jquery-ui.min.js') }}"></script>

    <!-- Bootstrap -->
    <script type="text/javascript" src="{{ url('admin/assets/js/bootstrap/bootstrap.min.js') }}"></script>

    <!-- jQuery Validation -->
    <script type="text/javascript" src="{{ url('admin/vendor/plugins/validation/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('admin/vendor/plugins/validation/localization/messages_pt_BR.min.js') }}"></script>

    <!-- END: PAGE SCRIPTS -->

    @yield('scripts')

</body>

</html>
