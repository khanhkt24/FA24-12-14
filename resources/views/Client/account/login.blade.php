@extends('Client.layouts.masterlayout')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Đăng Nhập</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Đăng Nhập</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Contact Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Đăng Nhập</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form">
                    <div id="success"></div>
                    <form action="{{route('acount.login')}}" method="post">
                        @csrf

                        <div class="control-group">
                            <label for="" class="form-lable fw-bold ">Nhập email của bạn</label>

                            <input type="email" class="form-control" name="email"  placeholder="Your Email"
                                data-validation-required-message="Please enter your email" />
                            <p class="help-block text-danger"></p>
                            @error('email')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        <div class="control-group">
                            <label for="" class="form-lable fw-bold">Nhập mật khẩu của bạn</label>

                            <input type="text" class="form-control" name="password"  placeholder="Mật khẩu của bạn"
                                data-validation-required-message="Please enter your email" />
                            <p class="help-block text-danger"></p>
                            @error('password')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" >
                                Đăng Nhập</button>
                        </div>
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
    <!-- Contact End -->
@endsection
