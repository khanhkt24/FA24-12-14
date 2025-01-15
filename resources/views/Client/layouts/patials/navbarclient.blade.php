<div class="container-fluid">
    <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                <h6 class="m-0">Danh Mục</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
                <div class="navbar-nav w-100 overflow">
                    <div class="nav-item dropdown">
                        @foreach ($cats as $item)
                            <a href="#" class="nav-link" data-toggle="dropdown"> {{$item->name}} <i class="fa fa-angle-down float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                <a href="" class="dropdown-item">Men's Dresses</a>
                                <a href="" class="dropdown-item">Women's Dresses</a>
                                <a href="" class="dropdown-item">Baby's Dresses</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="{{route('client.home')}}" class="nav-item nav-link">Trang Chủ</a>
                        <a href="{{route('client.shop')}}" class="nav-item nav-link">Sản Phẩm</a>
                        {{-- <a href="detail.html" class="nav-item nav-link">Shop Detail</a> --}}
                        {{-- <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle active" data-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="cart.html" class="dropdown-item">Shopping Cart</a>
                                <a href="checkout.html" class="dropdown-item">Checkout</a>
                            </div>
                        </div> --}}
                        <a href="{{route('client.contact')}}" class="nav-item nav-link">Liên Hệ</a>
                    </div>
                    <div class="navbar-nav ml-auto py-0">
                        @if (auth('cus')->check())
                            <a href="{{route('client.profile')}}" class="nav-item nav-link">Hi, {{ auth('cus')->user()->name }}</a>
                            <a href="{{route('acount.logout')}}" class="nav-item nav-link">Đăng xuất</a>
                        @else
                            <a href="{{route('acount.login')}}" class="nav-item nav-link">Đăng Nhập</a>
                            <a href="{{route('acount.register')}}" class="nav-item nav-link">Đăng Ký</a>
                        @endif
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
