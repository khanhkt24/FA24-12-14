@extends('Client.layouts.masterlayout')

@section('content')
<div class="container-fluid bg-secondary mb-5">
  <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
      <h1 class="font-weight-semi-bold text-uppercase mb-3">Đơn hàng đã mua</h1>
      <div class="d-inline-flex">
        <p class="m-0"><a href="{{route('client.home')}}">Trang chủ</a></p>
          <p class="m-0 px-2">-</p>
          <p class="m-0">Đơn hàng đã mua</p>
      </div>
  </div>
</div>
<div class="container my-5">
  <div class="row">
    <!-- Sidebar bên trái -->
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

    <!-- Giỏ hàng bên phải -->
    <div class="col-md-9">
      <div class="card shadow-lg">
        <div class="card-body">
          <h4 class="card-title text-primary mb-4">Giỏ Hàng</h4>
          <form action="">
            <div class="table-responsive">
              <table class="table table-bordered text-center align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Tổng Tiền</th>
                        <th>Ngày Đặt Hàng</th>
                        <th>Trạng Thái</th>
                        <th>Phương Thức Thanh Toán</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $index => $order)
                    <tr>
                        <td>
                          <span>{{$order->order_code}}</span> <!-- Hiển thị mã đơn hàng được tạo một lần duy nhất -->
                        </td>
                        <td>{{ number_format($order->total, 0, ',', '.') }} VNĐ</td>
                        <td>{{ $order->ngaydathang->format('d/m/Y') }}</td>
                        <!-- <td>{{ $order->payment_status=='success'?'Thanh toans thanh cong' : 'Chưa thanh toán'}}</td> -->
                         <td>
                          @if ($order->payment_status == 'success')
                              thanh toan thanh cong
                              @elseif ($order->payment_status == '')                          
                          @endif
                         </td>
                        <td>
                            @php
                                $statusClasses = [
                                    'Đang xác nhận' => 'bg-warning',
                                    'Đang vận chuyển' => 'bg-info',
                                    'Đã giao hàng' => 'bg-success',
                                    'Đã bị hủy' => 'bg-danger',
                                ];
                            @endphp
                            <span class="badge {{ $statusClasses[$order->giaohang] ?? 'bg-secondary' }}">
                                {{ $order->giaohang }}
                            </span>
                        </td>
                        <td>
                          @if ($order->thanhtoan == 0)
                              Thanh toán khi nhận hàng (COD)
                          @elseif ($order->thanhtoan == 1)
                              Thanh toán với VNPAY
                          @else
                              Chưa xác định
                          @endif
                      </td>
                      <td>
                      @if ($order->thanhtoan == 0)
                      <a href="{{route('detail.detail',$order->id)}}">
                          <i class="fas fa-eye"></i>
                        </a>
                          @elseif ($order->thanhtoan == null)
                             <a href="{{route('detail.payment',$order->id)}}">
                          <i class="fas fa-eye"></i>
                        </a>
                          @else
                              Chưa xác định
                          @endif
                        
                      </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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

  .btn:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
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
