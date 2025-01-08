<div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Quản lý</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Thống Kê</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarDashboards">
                                <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                        <a href="#" class="nav-link" data-key="t-analytics">Thống Kê Doanh Thu</a>
                                        <a href="#" class="nav-link" data-key="t-email"> Thống Kê Sản Phẩm
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li> <!-- end Dashboard Menu -->
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Quản Lý Đơn Hàng</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                                <i class="ri-apps-2-line"></i> <span data-key="t-apps">Quản Lý Sản Phẩm</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarApps">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            Thêm Sản Phẩm
                                        </a>
                                        <div class="collapse menu-dropdown" id="sidebarEcommerce">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="" class="nav-link" data-key="t-products"> Danh mục lớn</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="" class="nav-link" data-key="t-product-Details">Danh mục nhỏ </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="" class="nav-link" data-key="t-create-product">Sản phẩm </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="" class="nav-link" data-key="t-orders">
                                                        Thêm sản phẩm </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-ecommerce-order-details.html" class="nav-link" data-key="t-order-details"> Order Details </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-ecommerce-customers.html" class="nav-link" data-key="t-customers"> Customers </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-ecommerce-cart.html" class="nav-link" data-key="t-shopping-cart"> Shopping Cart </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-ecommerce-checkout.html" class="nav-link" data-key="t-checkout"> Checkout </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-ecommerce-sellers.html" class="nav-link" data-key="t-sellers">
                                                        Sellers </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-ecommerce-seller-details.html" class="nav-link" data-key="t-sellers-details"> Seller Details </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li> <!-- end Dashboard Menu -->
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                                <i class="ri-account-circle-line"></i> <span data-key="t-authentication">Quản Lý Admin</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarAuth">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{route('user.index')}}" class="nav-link"> Danh Sách Admin
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link"> Thêm
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarUser" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                                <i class="ri-account-circle-line"></i> <span data-key="t-authentication">Quản Lý Người Dùng</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarUser">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{route('customer.index')}}" class="nav-link"> Danh Sách Người Dùng
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link"> Thêm Người Dùng
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarUI" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarUI">
                                <i class="ri-pencil-ruler-2-line"></i> <span data-key="t-base-ui">Quản Lý Danh Mục</span>
                            </a>
                            <div class="collapse menu-dropdown mega-dropdown-menu" id="sidebarUI">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <ul class="nav nav-sm flex-column">
                                            <li class="nav-item">
                                                <a href="#" class="nav-link" data-key="t-alerts">Thêm Danh Mục</a>
                                            </li>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>