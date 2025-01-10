@extends('Client.layouts.masterlayout')

@section('content')
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Chỉnh Sửa Thông Tin</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="{{route('client.home')}}">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Chỉnh Sửa Thông Tin</p>
        </div>
    </div>
</div>
<div class="container my-5">
  <div class="row">
      <!-- Left Sidebar -->
      <div class="col-md-3">
          <div class="card shadow-sm mb-4">
              <div class="card-body text-center">
                  <div class="avatar-user mb-3">
                      <img src="{{asset('client/img/anhmd.jpg')}}" class="rounded-circle border border-2 border-primary" width="100" alt="">
                  </div>
                  <div class="name-user mb-3">
                      <h5 class="card-title">Tên người dùng</h5>
                  </div>
                  <ul class="list-group">
                    <li class="list-group-item"><a href="{{route('client.profile')}}" class="text-decoration-none text-dark hover-link"><i class="fa-solid fa-user"></i> Hồ sơ của tôi</a></li>
                    <li class="list-group-item"><a href="{{route('checkout.index')}}" class="text-decoration-none text-dark hover-link"><i class="fa-solid fa-basket-shopping"></i> Đơn mua</a></li>
                    <li class="list-group-item"><a href="{{route('acount.logout')}}" class="text-decoration-none text-dark hover-link"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a></li>
                  </ul>
              </div>
          </div>
      </div>

      <!-- Right Content (Edit Profile) -->
      <div class="col-md-9">
          <div class="card shadow-lg">
              <div class="card-body">
                  <h4 class="card-title text-primary">Chỉnh sửa hồ sơ</h4>
                  <p class="card-text mb-4">Cập nhật thông tin của bạn để bảo mật tài khoản tốt hơn</p>

                  <form action="./index.php?act=luuthongtin" method="post">
                      <div class="row">
                          <div class="col-md-6">
                              <div class="mb-3">
                                  <label for="hoTen" class="form-label">Họ và Tên</label>
                                  <input type="text" class="form-control" id="hoTen" name="hoTen" value="Tên người dùng">
                              </div>
                              <div class="mb-3">
                                  <label for="tenDangNhap" class="form-label">Tên đăng nhập</label>
                                  <input type="text" class="form-control" id="tenDangNhap" name="tenDangNhap" value="tendangnhap" readonly>
                              </div>
                              <div class="mb-3">
                                  <label for="email" class="form-label">Email</label>
                                  <input type="email" class="form-control" id="email" name="email" value="email@example.com">
                              </div>
                          </div>

                          <div class="col-md-6">
                              <div class="mb-3">
                                  <label for="sdt" class="form-label">Số điện thoại</label>
                                  <input type="text" class="form-control" id="sdt" name="sdt" value="0901234567">
                              </div>
                              <div class="mb-3">
                                  <label for="diaChi" class="form-label">Địa chỉ</label>
                                  <input type="text" class="form-control" id="diaChi" name="diaChi" value="Địa chỉ của bạn">
                              </div>
                          </div>
                      </div>

                      <div class="d-flex justify-content-center mt-4">
                          <button type="submit" class="btn btn-success shadow-lg hover-btn">Lưu thay đổi</button>
                          <a href="{{route('client.profile')}}" class="btn btn-secondary ms-3 shadow-lg">Hủy</a>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>

<!-- Custom Styles -->
<style>
.hover-link:hover {
  color: #0056b3;
  transition: color 0.3s ease;
}

.hover-btn:hover {
  transform: scale(1.05);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.shadow-lg {
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
}
</style>
@endsection
