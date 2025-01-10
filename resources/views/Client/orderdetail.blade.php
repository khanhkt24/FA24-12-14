@extends('Client.layouts.masterlayout')

@section('content')
<style>
    .input-disabled {
        background-color: #f7f7f7; /* Màu nền giống như input disabled */
        border: 1px solid #ddd; /* Viền nhẹ */
        color: #aaa; /* Màu chữ nhạt đi */
        pointer-events: none; /* Không cho phép tương tác với input */
        cursor: not-allowed; /* Con trỏ chuột thay đổi thành dấu không cho phép */
    }
</style>
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Shopping Cart</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{route('client.home')}}">Trang chủ</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shopping Cart</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Cart Start -->
    <section class="my-account-area py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
    
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (Session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session('success') }}
                        </div>
                    @endif
    
                    <div class="myaccount-content mb-4">
                        <h3 class="text-uppercase">Thông tin vận chuyển</h3>
                        <div class="account-details-form">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="order-id" class="required">Mã đơn hàng</label>
                                        <input type="text" id="orders-id" class="form-control" value="{{ $orders->order_code }}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="payment-method" class="required">Trạng thái thanh toán</label>
                                        <input type="text" id="payment-method" class="form-control" value="{{ $orders->giaohang }} " disabled>
                              
                                    
                                    
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="payment-status" class="required">Phương thức thanh toán</label>
                                        <input type="text" id="payment-status" class="form-control" 
                                            value="<?php echo ($orders->thanhtoan == 0) ? 'Thanh toán khi nhận hàng (COD)' : (($orders->thanhtoan == 1) ? 'Thanh toán với VNPAY' : 'Chưa xác định'); ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="customer-name" class="required">Tên khách hàng</label>
                                        <input type="text" id="customer-name" class="form-control" value="{{ $orders->customer->name }}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="phone" class="required">Số điện thoại</label>
                                        <input type="text" id="phone" class="form-control" value="{{ $orders->phone }}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="address" class="required">Địa chỉ nhận hàng</label>
                                        <input type="text" id="address" class="form-control" value="{{ $orders->address }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="myaccount-content">
                        <h3 class="text-uppercase mb-3">Chi tiết đơn hàng</h3>
                        <div class="myaccount-table table-responsive text-center">
                            @php
                                $tongTien = 0;
                            @endphp
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Hình ảnh</th>
                                        <th>Size</th>
                                        <th>Số lượng</th>
                                        <th>Giá bán</th>
                                        {{-- <th>Tổng tiền</th> --}}
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders->proOrder as $index => $proOrder)
                                    @php
                                        $tongTien += $proOrder->total;
                                    @endphp
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $proOrder->name_pro }}</td>
                                        <td>
                                            <img src="{{ \Storage::url($proOrder->img) }}" alt="Product Image" style="width: 50px;">
                                        </td>
                                        <td>{{ $proOrder->size }}</td>
                                        <td>{{ $proOrder->quantity }}</td>
                                        <td>{{ number_format($proOrder->price, 0, ',', '.') }} VNĐ</td>
                                        <td>{{ number_format($proOrder->total, 0, ',', '.') }} VNĐ</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="6" class="text-right"><strong>Tổng tiền</strong></td>
                                    <td><strong>{{ number_format($tongTien, 0, ',', '.') }} VNĐ</strong></td>
                                </tr>
                                </tbody>
                            </table>
                                @if($orders->giaohang == \App\Models\Order::TYPE_0) <!-- Đang xác nhận -->
                                    <td>
                                        <form action="{{ route('order.cancel1', $orders->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button onclick="return confirm('Bạn có muốn hủy đơn hàng này không?');">Hủy</button>
                                        </form>
                                    </td>
                                    @else
                                    <td>Không thể hủy</td>
                                @endif
                                    <a href="{{route('checkout.index')}}">Trở Về</a>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    </section>
    <!-- Cart End -->
@endsection
