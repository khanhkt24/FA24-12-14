@extends('admin.layouts.master')
@section('content')
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Thông tin đơn hàng</h4>

                    <div class="page-title-right">
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-9">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h5 class="card-title flex-grow-1 mb-0">Mã đơn hàng: {{$order->order_code}}</h5>
                            <div class="flex-shrink-0">
                                <a href="apps-invoices-details.html" class="btn btn-success btn-sm"><i class="ri-download-2-fill align-middle me-1"></i> In PDF</a>
                                <a href="{{route('order.index')}}" class="btn btn-warning btn-sm">Quay lại</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-card">
                            <table class="table table-nowrap align-middle table-borderless mb-0">
                                <thead class="table-light text-muted">
                                    <tr>
                                        <th scope="col">Thông tin sản phẩm</th>
                                        <th scope="col">Giá sản phẩm</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col" class="text-end">Tổng giá</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                    <img src="{{Storage::url($item->img)}}" alt="" class="img-fluid d-block">
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h5 class="fs-15"><a href="apps-ecommerce-product-details.html" class="link-primary">{{$item->name_pro}}</a></h5>
                                                    <p class="text-muted mb-0">Color: <span class="fw-medium">{{$item->color}}</span></p>
                                                    <p class="text-muted mb-0">Size: <span class="fw-medium">{{$item->size}}</span></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{$item->price}}VNĐ</td>
                                        <td>{{$item->quantity}}</td>
                                        <td class="fw-medium text-end">
                                            {{$item->price * $item->quantity}}VNĐ
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr class="border-top border-top-dashed">
                                        <td colspan="3"></td>
                                        <td colspan="2" class="fw-medium p-0">
                                            <table class="table table-borderless mb-0">
                                                <tbody>
                                                    <tr class="border-top border-top-dashed">
                                                        <th scope="row">Tổng tiền :</th>
                                                        <th class="text-end">${{$item->price * $item->quantity}}VNĐ</th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--end card-->
                <div class="card">
                    <div class="card-header">
                        <div class="d-sm-flex align-items-center">
                            <h5 class="card-title flex-grow-1 mb-0"> Trạng thái đơn hàng</h5>
                            <div class="flex-shrink-0 mt-2 mt-sm-0">
                                <a href="javascript:void(0);" class="btn btn-soft-info btn-sm mt-2 mt-sm-0"><i class="ri-map-pin-line align-middle me-1"></i> Change Address</a>
                                <a href="javascript:void(0);" class="btn btn-soft-danger btn-sm mt-2 mt-sm-0"><i class="mdi mdi-archive-remove-outline align-middle me-1"></i> Cancel Order</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="profile-timeline">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item border-0">
                                    <div class="accordion-header" id="headingOne">
                                        <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 avatar-xs">
                                                    <div class="avatar-title bg-success rounded-circle">
                                                        <i class="ri-shopping-bag-line"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="fs-15 mb-0 fw-semibold">Đơn hàng đã được xác nhận - <span class="fw-normal">{{$date}}</span></h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body ms-2 ps-5 pt-0">
                                            <h6 class="mb-1">Đơn hàng đang được kiểm tra, đóng gói và vận chuyển</h6>
                                            <p class="text-muted">{{$order->created_at}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end accordion-->
                        </div>
                    </div>
                </div>
                <!--end card-->
            </div>
            <!--end col-->
            <div class="col-xl-3">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <h5 class="card-title flex-grow-1 mb-0"><i class="mdi mdi-truck-fast-outline align-middle me-1 text-muted"></i>Thông tin vận chuyển</h5>
                            <div class="flex-shrink-0">
                                <a href="javascript:void(0);" class="badge bg-primary-subtle text-primary fs-11">Track Order</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <lord-icon src="https://cdn.lordicon.com/uetqnvvg.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:80px;height:80px"></lord-icon>
                            <h5 class="fs-16 mt-2">Xpx Logistics</h5>
                            <p class="text-muted mb-0">Trạng thái đơn hàng: {{$order->giaohang}}</p>
                            <p class="text-muted mb-0">Phương thức thanh toán : {{$order->thanhtoan}}</p>
                        </div>
                    </div>
                </div>
                <!--end card-->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><i class="ri-map-pin-line align-middle me-1 text-muted"></i>Thông tin người đặt hàng</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                            <li class="fw-medium fs-14">{{$order->name}}</li>
                            <li>+(84) {{$order->phone}}</li>
                            <li>{{$order->address}}</li>
                            <li>{{$order->email}}</li>
                        </ul>
                    </div>
                </div>
                <!--end card-->
                <!--end card-->
            </div>
            <!--end col-->
        <!--end row-->
<!-- End Page-content -->
@endsection