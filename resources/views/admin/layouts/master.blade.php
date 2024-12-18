<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Products | Velzon - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    @include('admin.layouts.partials.css')

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">
         <!-- Header -->
        <header id="page-topbar">
            @include('admin.layouts.partials.header')
        </header>

        <!-- Side Bar -->
        <div class="app-menu navbar-menu">
            <!-- ========== LOGO Velzon trên cùng sidebar ========== -->
            @include('admin.layouts.partials.logo-navbar')
            <!-- ========== Link điều hướng từ Apps - Ecommerce - products/product-detail.... ========== -->
            @include('admin.layouts.partials.scroll-bar')
        </div>

        <!--  Content -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    
                    <!-- Content -->
                    @yield('content')
                </div>
            </div>
            
            <!-- Footer  -->
            <footer class="footer">
               @include('admin.layouts.partials.footer')
            </footer>
        </div>
       

    </div>
    

    <!-- JAVASCRIPT -->
    @include('admin.layouts.partials.js')
</body>

</html>
