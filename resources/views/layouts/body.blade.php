<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-boxed">
    <div class="page-wrapper">
        <!-- BEGIN HEADER -->
        @include('layouts.header')
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="container_">
            <div class="page-container">
                <!-- BEGIN SIDEBAR -->
                <div class="page-sidebar-wrapper">
                    <div class="page-sidebar navbar-collapse collapse">
                        @include('layouts.sidebar-opened')
                        @include('layouts.sidebar')
                        </ul>
                    </div>
                </div>
                <!-- END SIDEBAR -->
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        @yield('content')
                        <!-- BEGIN FOOTER -->
                        @include('layouts.footer')
                        <!-- END FOOTER -->
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
                <!-- BEGIN QUICK SIDEBAR -->
                <a href="javascript:;" class="page-quick-sidebar-toggler">
                    <i class="icon-login"></i>
                </a>
                <!-- END QUICK SIDEBAR -->
            </div>
        </div>
        <!-- END CONTAINER -->
    </div>
    @include('layouts.script')
</body>
