@extends('Client.layouts.masterlayout')

@section('content')
<div class="container-fluid bg-secondary mb-5">
  <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
      <h1 class="font-weight-semi-bold text-uppercase mb-3">Thông Tin Cá Nhân</h1>
      <div class="d-inline-flex">
        <p class="m-0"><a href="{{route('client.home')}}">Trang chủ</a></p>
          <p class="m-0 px-2">-</p>
          <p class="m-0">Thông Tin Cá Nhân</p>
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
  
      <!-- Right Content -->
      <div class="col-md-9">
        <div class="card shadow-lg">
          <div class="card-body">
            <h4 class="card-title text-primary">Hồ Sơ Của Tôi</h4>
            <p class="card-text mb-4">Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
  
            <div class="row">
              <div class="col-md-12">
                <div class="mb-3">
                  <label for="hoTen" class="form-label">Họ và Tên</label>
                  <input type="text" class="form-control" id="hoTen" value="Tên người dùng" disabled>
                </div>
                <div class="mb-3">
                  <label for="tenDangNhap" class="form-label">Tên đăng nhập</label>
                  <input type="text" class="form-control" id="tenDangNhap" value="tendangnhap" disabled>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" value="email@example.com" disabled>
                </div>
                <div class="mb-3">
                  <label for="sdt" class="form-label">Số điện thoại</label>
                  <input type="text" class="form-control" id="sdt" value="0901234567" disabled>
                </div>
                <div class="mb-3">
                  <label for="diaChi" class="form-label">Địa chỉ</label>
                  <input type="text" class="form-control" id="diaChi" value="Địa chỉ của bạn" disabled>
                </div>
              </div>
            </div>
  
            <div class="d-flex justify-content-center mt-4">
              <a href="{{route('client.thongtincanhan')}}" class="btn btn-primary shadow-lg hover-btn">Thay đổi thông tin</a>
            </div>
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
  
    .btn:hover {
      transform: scale(1.05);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
  
    .hover-btn {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
  
    .shadow-lg {
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }
  
    .shadow-sm {
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .list-group-item:hover {
        background-color: #f9f9f9;
        cursor: pointer;
        transition: background-color 0.3s ease;
        color: #0056b3;
        border: none;
        text-decoration: none;
        font-weight: 600;
        border-radius: 0;
        box-shadow: none;
        border-left: 5px solid #0056b3;
        padding-left: 30px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 10px;
       
        
    }
  </style>
@endsection
