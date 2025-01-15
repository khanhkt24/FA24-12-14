@extends('Client.layouts.masterlayout')

@section('content')
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Cập nhật mật khẩu</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Cập nhật mật khẩu</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Contact Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Nhập Mật khẩu mới</span></h2>
    </div>
    <div class="row px-xl-5">
        <div class="col-lg-7 mb-5">
            <div class="contact-form">
                <div id="success"></div>
                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ request()->token }}">
                    <input type="hidden" name="email" value="{{ request()->email }}">
                
                    <div class="form-group">
                        <label for="password">Mật khẩu mới</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Xác nhận mật khẩu</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật mật khẩu</button>
                </form>
            </div><br>

            
        </div>
        <div class="col-lg-5 mb-5">
            <div class="d-flex flex-column mb-3">
                <h5 class="font-weight-semi-bold mb-3">Địa chỉ 1 </h5>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>FPT Polytechnic - Trịnh văn Bô</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>caodangfpt@fpt.edu.vn</p>
                <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>0987654321</p>
            </div>
            <div class="d-flex flex-column">
                <h5 class="font-weight-semi-bold mb-3">Địa chỉ 2</h5>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>FPT Polytechnic - Cầu Diễn</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>caodangfpt@fpt.edu.vn</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>0312456789</p>
            </div>
        </div>
    </div>
</div>

@endsection