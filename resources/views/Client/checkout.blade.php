@extends('Client.layouts.masterlayout')

@section('content')
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Checkout</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Checkout</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Checkout Start -->
    <div class="container-fluid pt-5">
        <form action="{{ route('order.checkout') }}" method="POST">
            @csrf
            <div class="row px-xl-5">
                <div class="col-lg-3">
                    <div class="mb-4">
                      <h4 class="font-weight-semi-bold mb-4">Billing Address</h4>
                        <div class="row">
                            <div class="col-md-8 form-group">
                                <label>Họ và tên</label>
                                <input class="form-control" name="name" value="{{$auth->name}}" type="text" placeholder="John">
                            </div>
                            <div class="col-md-8 form-group">
                                <label>Email</label>
                                <input class="form-control" name="email"  value="{{$auth->email}}" type="email" placeholder="Doe">
                            </div>
                            <div class="col-md-8 form-group">
                                <label>Số điện thoại</label>
                                <input class="form-control" name="phone"  value="{{$auth->phone}}" type="text" placeholder="example@email.com">
                            </div>
                            <div class="col-md-8 form-group">
                                <label>Địa chỉ</label>
                                <input class="form-control" name="address"  value="{{$auth->address}}" type="text" placeholder="+123 456 789">
                            </div>

                            <div class="col-md-8 form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="newaccount">
                                    <label class="custom-control-label" for="newaccount">Nhà riêng</label>
                                </div>
                            </div>
                            <div class="col-md-8 form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="shipto">
                                    <label class="custom-control-label" for="shipto" data-toggle="collapse"
                                        data-target="#shipping-address">Văn phòng</label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-9">
                    <table class="table table-bordered text-center mb-0">
                        <thead class="bg-secondary text-dark">
                            <tr>
                                <th>STT</th>
                                <th>Sản Phẩm</th>
                                <th>Size</th>
                                <th>Màu</th>
                                <th>Giá</th>
                                <th>Số Lượng</th>
                                <th>Tổng Tiền</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @foreach ($carts as $index => $cart)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="align-middle">
                                        <img src="{{ \Storage::url($cart->product->img) }}" alt="" style="width: 50px;">
                                        @if ($cart->product)
                                            {{ $cart->product->name }}
                                        @else
                                            <span>Product not found</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">{{ $cart->bienthe->size}}</td>
                                    <td class="align-middle">{{ $cart->bienthe->color }}</td>
                                    <td class="align-middle">{{ number_format($cart->price, 0, ',', '.') }} VNĐ</td>
                                    <td class="align-middle">{{ $cart->quantity }}</td>
                                    <td class="align-middle">
                                        {{ number_format($cart->price * $cart->quantity, 0, ',', '.') }}VNĐ
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div class="form-group">
                        <div class="card border-secondary mb-5">
                            <div class="card-header bg-secondary border-0">
                                <h4 class="font-weight-semi-bold m-0">Payment</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="thanhtoan" id="directcheck" value="0" >
                                        <label class="custom-control-label" for="directcheck">Thanh toán khi nhận hàng (COD)</label>
                                    </div>
                                </div>
   
                            </div>
                            <div class="card-footer border-secondary bg-transparent">
                                <button  class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Đặt hàng</button>
                            </div>
                        </div>

                        
                    </div>

                </div>
            </div>
        </form>
        <div class="form-group">
                                    <form action="{{route('vnpay.payment')}}" method="post">
                                        @csrf
                                        <div class="custom-control custom-radio">
                                            
                                            <input type="" name="total" value="{{ number_format($cart->price * $cart->quantity, 0, ',', '.') }}VNĐ">
                                            <button type="submit">thanhtoan</button>
                                        </div>
                                    </form>
                            </div>
    </div>
    <!-- Checkout End -->
@endsection
 {{-- <div class="card border-secondary mb-5">
                        <div class="card-header bg-secondary border-0">
                            <h4 class="font-weight-semi-bold m-0">Payment</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment" id="directcheck">
                                    <label class="custom-control-label" for="directcheck">Trả tiền trực tiếp</label>
                                </div>
                            </div>
                            <div class="">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment" id="banktransfer">
                                    <label class="custom-control-label" for="banktransfer">Quét mã ngân hàng</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-secondary bg-transparent">
                            <button class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Đăt hàng</button>
                        </div>
                    </div> --}}
