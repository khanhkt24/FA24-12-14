@extends('Client.layouts.masterlayout')

@section('content')
<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Quên mật khẩu</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Quên mật khẩu</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Contact Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Quên mật khẩu</span></h2>
    </div>
    <div class="row px-xl-5">
        <div class="col-lg-7 mb-5">
            <div class="contact-form">
                <div id="success"></div>
                <form action="{{route('password.email')}}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="email">Email của bạn</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Gửi link đặt lại mật khẩu</button>
                </form>
            </div><br>
            <a href="{{route('acount.reset_password')}}">Quên mật khẩu</a>
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