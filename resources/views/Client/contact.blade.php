@extends('Client.layouts.masterlayout')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Liên Hệ Chúng Tôi</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{route('client.home')}}">Trang Chủ</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Liên Hệ</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Contact Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Liên Hệ Cho Chúng Tôi</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form">
                    <div id="success"></div>
                    <form action="{{route('client.contactt')}}" method="post" >
                        @csrf
                        <div class="control-group">
                            <input name="name" type="text" class="form-control" id="name" placeholder="Ho ten"
                                required="required" data-validation-required-message="Please enter your name" >
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input name="email" type="email" class="form-control" id="email" placeholder="Email"
                                required="required" data-validation-required-message="Please enter your email" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <textarea name="body" class="form-control" rows="6" id="message" placeholder="Noi dung"
                                required="required"
                                data-validation-required-message="Please enter your message"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Send
                                Message</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 mb-5">
                <h5 class="font-weight-semi-bold mb-3">Get In Touch</h5>
                <p>Justo sed diam ut sed amet duo amet lorem amet stet sea ipsum, sed duo amet et. Est elitr dolor elitr erat sit sit. Dolor diam et erat clita ipsum justo sed.</p>
                <div class="d-flex flex-column mb-3">
                    <h5 class="font-weight-semi-bold mb-3">Địa Chỉ 1</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>Tây Hồ, Hà Nội</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>doingucleo@gmail.com</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+8499999999</p>
                </div>
                <div class="d-flex flex-column">
                    <h5 class="font-weight-semi-bold mb-3">Địa Chỉ 2</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>Mỹ Đình, Hà Nội</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>doingucleo@gmail.com</p>
                    <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+8499999999</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
