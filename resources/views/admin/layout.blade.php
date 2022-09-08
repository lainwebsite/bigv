<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

<body>
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
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-brand">
                        <!-- Logo icon -->
                        <a href="index-2.html">
                            <b class="logo-icon">
                                <!-- Dark Logo icon -->
                                <img src="{{ asset('assets/images/logo-icon.png') }}" alt="homepage"
                                    class="dark-logo" />
                                <!-- Light Logo icon -->
                                <img src="{{ asset('assets/images/logo-icon.png') }}" alt="homepage"
                                    class="light-logo" />
                            </b>
                            <!--End Logo icon -->
                            <!-- Logo text -->
                            <span class="logo-text">
                                <!-- dark Logo text -->
                                <img src="{{ asset('assets/images/logo-text.png') }}" alt="homepage"
                                    class="dark-logo" />
                                <!-- Light Logo text -->
                                <img src="{{ asset('assets/images/logo-light-text.png') }}" class="light-logo"
                                    alt="homepage" />
                            </span>
                        </a>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                        data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav float-left mr-auto ml-3 pl-1"></ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="ml-2 d-none d-lg-inline-block"><span>Hello,</span> <span
                                        class="text-dark">Big V Admin</span> <i data-feather="chevron-down"
                                        class="svg-icon"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <a class="dropdown-item" href="javascript:void(0)"><i data-feather="settings"
                                        class="svg-icon mr-2 ml-1"></i>
                                    Account Setting</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)"><i data-feather="power"
                                        class="svg-icon mr-2 ml-1"></i>
                                    Logout</a>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item @yield('dashboard-selected')"> <a
                                class="sidebar-link sidebar-link @yield('dashboard-link-active')"
                                href="{{ route('admin.dashboard') }}" aria-expanded="false"><i data-feather="home"
                                    class="feather-icon"></i><span class="hide-menu">Dashboard</span></a></li>
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Manage</span></li>

                        <li class="sidebar-item @yield('orders-manage-selected')"> <a class="sidebar-link @yield('orders-manage-active')"
                                href="{{ route('admin.transaction.index') }}" aria-expanded="false"><i
                                    data-feather="shopping-bag" class="feather-icon"></i><span
                                    class="hide-menu">Order</span></a></li>

                        <li class="sidebar-item @yield('categories-manage-selected')"> <a
                                class="sidebar-link sidebar-link @yield('categories-manage-active')"
                                href="{{ route('admin.product-category.index') }}" aria-expanded="false"><i
                                    data-feather="grid" class="feather-icon"></i><span
                                    class="hide-menu">Category</span></a></li>

                        <li class="sidebar-item @yield('products-manage-selected')"> <a
                                class="sidebar-link sidebar-link @yield('products-manage-active')"
                                href="{{ route('admin.product.index') }}" aria-expanded="false"><i
                                    data-feather="archive" class="feather-icon"></i><span
                                    class="hide-menu">Product</span></a></li>

                        <li class="sidebar-item @yield('discounts-manage-selected')"> <a
                                class="sidebar-link sidebar-link @yield('discounts-manage-active')" href="app-calendar.html"
                                aria-expanded="false"><i data-feather="percent" class="feather-icon"></i><span
                                    class="hide-menu">Discount</span></a></li>

                        <li class="sidebar-item @yield('customers-manage-selected')"> <a
                                class="sidebar-link sidebar-link @yield('customers-manage-active')" href="{{route('admin.user.index')}}"
                                aria-expanded="false"><i data-feather="users" class="feather-icon"></i><span
                                    class="hide-menu">Customer</span></a></li>

                        <li class="sidebar-item @yield('vendors-manage-selected')"> <a
                                class="sidebar-link sidebar-link @yield('vendors-manage-active')" href="{{route('admin.vendor.index')}}"
                                aria-expanded="false"><i data-feather="smile" class="feather-icon"></i><span
                                    class="hide-menu">Vendor</span></a></li>

                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Analytics</span></li>

                        <li class="sidebar-item @yield('orders-analytics-selected')"> <a
                                class="sidebar-link sidebar-link @yield('orders-analytics-active')" href="app-calendar.html"
                                aria-expanded="false"><i data-feather="shopping-bag" class="feather-icon"></i><span
                                    class="hide-menu">Order</span></a></li>

                        <li class="sidebar-item @yield('products-analytics-selected')"> <a
                                class="sidebar-link sidebar-link @yield('products-analytics-active')" href="app-calendar.html"
                                aria-expanded="false"><i data-feather="archive" class="feather-icon"></i><span
                                    class="hide-menu">Product</span></a></li>

                        <li class="sidebar-item @yield('customers-analytics-selected')"> <a
                                class="sidebar-link sidebar-link @yield('customers-analytics-active')" href="app-calendar.html"
                                aria-expanded="false"><i data-feather="users" class="feather-icon"></i><span
                                    class="hide-menu">Customer</span></a></li>

                        <li class="sidebar-item @yield('vendors-analytics-selected')"> <a
                                class="sidebar-link sidebar-link @yield('vendors-analytics-active')" href="app-calendar.html"
                                aria-expanded="false"><i data-feather="smile" class="feather-icon"></i><span
                                    class="hide-menu">Vendor</span></a></li>
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Extra</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                                href="authentication-login1.html" aria-expanded="false"><i data-feather="log-out"
                                    class="feather-icon"></i><span class="hide-menu">Logout</span></a></li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        @yield('content')
    </div>
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    @yield('javascript-extra')
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
    <script src="{{ asset('assets/libs/chartist/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
    <script src="{{ asset('assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('dist/js/pages/dashboards/dashboard1.min.js') }}"></script>
</body>

</html>
