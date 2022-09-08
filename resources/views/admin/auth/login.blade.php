<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <title>Admin Big V</title>
    <!-- Custom CSS -->
    <link href="{{ asset('assets/extra-libs/c3/c3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/chartist/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body style="background: #f5f5f5;">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div id="main-wrapper" class="vw-100 vh-100" data-theme="light" data-layout="vertical" data-navbarbg="skin6"
            data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
            <div class="d-flex h-100 w-100 position-relative justify-content-center align-items-center">
                <div class="card m-0" style="z-index:1; box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                    <div class="card-body p-5">
                        <div class="d-flex flex-column">
                            <img src="{{ asset('assets/images/bigv-logo.png') }}" class="w-150x m-auto" alt="">
                            <h4 class="m-0 text-sm-center"><b>Admin</b></h4>
                            <form class="mt-4" action="" method="POST">
                                <div class="form-group">
                                    <label for="email">E-Mail</label>
                                    <input type="text" style="width:250px;" class="form-control" id="email"
                                        name="email" placeholder="E-Mail">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" style="width:250px;" class="form-control" id="password"
                                        name="password" placeholder="Password">
                                </div>
                                <button class="btn btn-primary w-100 mt-3">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
                <img src="{{ asset('assets/images/hbb.svg') }}"
                    style="width: 90vw; aspect-ratio: 734/423; bottom:-20%; z-index:0; opacity: 20%;pointer-events: none;"
                    alt="" class="position-absolute">
            </div>
        </div>
    </form>
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('dist/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('dist/js/custom.min.js') }}"></script>
    <!--This page JavaScript -->
    <script src="{{ asset('assets/extra-libs/c3/d3.min.js') }}"></script>
    <script src="{{ asset('assets/extra-libs/c3/c3.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/dashboards/dashboard1.min.js') }}"></script>
</body>
