@extends('Client.layouts.masterlayout')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Shopping Cart</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shopping Cart</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-9 table-responsive mb-5">
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
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($carts as $index => $cart)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="align-middle">
                                    <img src="{{ asset('client/img/product-1.jpg') }}" alt="" style="width: 50px;">
                                    @if ($cart->product)
                                        {{ $cart->product->name }}
                                    @else
                                        <span>Product not found</span>
                                    @endif
                                </td>
                                <td class="align-middle">{{ $cart->bienthe->size}}</td>
                                <td class="align-middle">{{ $cart->bienthe->color }}</td>
                                <td class="align-middle">{{ number_format($cart->price, 0, ',', '.') }} VNĐ</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm bg-secondary text-center"
                                            value="{{ $cart->quantity }}" min="1">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    {{ number_format($cart->price * $cart->quantity, 0, ',', '.') }}VNĐ
                                </td>
                                <td class="align-middle">
                                    <form action="{{ route('cart.delete', $cart->product_id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-primary"
                                            onclick="return confirm('bạn có chắc muốn xóa không')">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </form>
                                    {{-- <button class="btn btn-sm btn-primary" onclick="removeFromCart({{ $cart->id }})"></button> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-3">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Tóm tắt giỏ hàng</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            @if ($carts->isEmpty())
                                <h6 class="font-weight-medium">Tổng số lượng</h6>
                                <h6 class="font-weight-medium">0 VNĐ</h6>
                            @else
                                <h6 class="font-weight-medium">Tổng số lượng</h6>
                                @php
                                    // Tính tổng số lượng
                                    $totalQuantity = $carts->sum('quantity');
                                @endphp
                                <h6 class="font-weight-medium">
                                    {{ $totalQuantity }}
                                </h6>
                            @endif
                        </div>
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            @if ($carts->isEmpty())
                                <h6 class="font-weight-medium">Tổng số lượng</h6>
                                <h6 class="font-weight-medium">0 VNĐ</h6>
                            @else
                                <h6 class="font-weight-medium">Tổng số lượng</h6>
                                @php
                                    // Tính tổng số lượng
                                    $totalPrice = $carts->sum('price');
                                @endphp
                                <h6 class="font-weight-medium">
                                    {{ $totalPrice }}
                                </h6>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Tổng tất cả</h5>

                            @if ($carts->isEmpty())
                                <h5 class="font-weight-bold">0 VNĐ</h5>
                            @else
                                @php
                                    $total = $carts->sum(function ($cart) {
                                        return $cart->price * $cart->quantity;
                                    });
                                @endphp
                                <h5 class="font-weight-bold">{{ number_format($total, 0, ',', '.') }} VNĐ</h5>
                            @endif
                        </div>
                        <a href="{{route('order.checkout')}}" class="btn btn-block btn-primary my-3 py-3">Tiến hành thanh toán</a>
                        {{-- <button class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</button> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
