<div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Quản lý</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{route('admin.thongke')}}">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Thống Kê</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{route('order.index')}}">
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
                                        <a href="{{route('product.index')}}" class="nav-link">
                                            Danh Sách Sản Phẩm
                                        </a>
                                        <a href="{{route('product.create')}}" class="nav-link">
                                            Thêm Sản Phẩm
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li> <!-- end Dashboard Menu -->
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{route('user.index')}}">
                                <i class="ri-account-circle-line"></i> <span data-key="t-authentication">Quản Lý Admin</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{route('warehouse.index')}}">
                                <i class="ri-account-circle-line"></i> <span data-key="t-authentication">Quản Lý Biến Thể</span>
                            </a>
                            
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{route('customer.index')}}" >
                                <i class="ri-account-circle-line"></i> <span data-key="t-authentication">Quản Lý Người Dùng</span>
                            </a>
                            {{-- <div class="collapse menu-dropdown" id="sidebarUser">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{route('customer.index')}}" class="nav-link"> Danh Sách Người Dùng
                                        </a>
                                    </li>
                                </ul>
                            </div> --}}
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
                                                <a href="{{route('category.index')}}" class="nav-link" data-key="t-alerts">Danh Mục Lớn</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{route('tag.index')}}" class="nav-link" data-key="t-alerts">Danh Mục Nhỏ</a>
                                            </li>

                            </div>
                        </li>
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>