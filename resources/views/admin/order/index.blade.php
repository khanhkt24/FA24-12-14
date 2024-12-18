@extends('admin.layouts.master')
@section('content')
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Đơn hàng</h4>

                    <div class="page-title-right">
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card" id="orderList">
                    <div class="card-header border-0">
                        <div class="row align-items-center gy-3">
                            <div class="col-sm">
                                <h5 class="card-title mb-0">Quản lý đơn hàng</h5>
                            </div>
                            <div class="col-sm-auto">
                                <div class="d-flex gap-1 flex-wrap">
                                    <button type="button" class="btn btn-info"><i class="ri-file-download-line align-bottom me-1"></i> In PDF</button>
                                    <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border border-dashed border-end-0 border-start-0">
                        <form>
                            <div class="row g-3">
                                <div class="col-xxl-5 col-sm-6">
                                    <div class="search-box">
                                        <input type="text" class="form-control search" placeholder="Search for order ID, customer, order status or something...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-2 col-sm-6">
                                </div>
                                <!--end col-->
                                <div class="col-xxl-2 col-sm-4">
                                    <div>
                                        <select class="form-control" data-choices data-choices-search-false name="choices-single-default" id="idStatus">
                                            <option value="">Status</option>
                                            <option value="all" selected>All</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Inprogress">Inprogress</option>
                                            <option value="Cancelled">Cancelled</option>
                                            <option value="Pickups">Pickups</option>
                                            <option value="Returns">Returns</option>
                                            <option value="Delivered">Delivered</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-2 col-sm-4">
                                    <div>
                                        <select class="form-control" data-choices data-choices-search-false name="choices-single-default" id="idPayment">
                                            <option value="">Select Payment</option>
                                            <option value="all" selected>All</option>
                                            <option value="Mastercard">Mastercard</option>
                                            <option value="Paypal">Paypal</option>
                                            <option value="Visa">Visa</option>
                                            <option value="COD">COD</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-1 col-sm-4">
                                    <div>
                                        <button type="button" class="btn btn-primary w-100" onclick="SearchData();"> <i class="ri-equalizer-fill me-1 align-bottom"></i>
                                            Filters
                                        </button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </form>
                    </div>
                    <div class="card-body pt-0">
                        <div>
                            <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active All py-3" data-bs-toggle="tab" id="All" href="#home1" role="tab" aria-selected="true">
                                        <i class="ri-store-2-fill me-1 align-bottom"></i>Tất cả đơn hàng
                                    </a>
                                </li>
                            </ul>

                            <div class="table-responsive table-card mb-1">
                                <table class="table table-nowrap align-middle" id="orderTable">
                                    <thead class="text-muted table-light">
                                        <tr class="text-uppercase">
                                            <th data-sort="id">ID</th>
                                            <th data-sort="customer_name">Người đặt hàng</th>
                                            <th data-sort="product_name">Email</th>
                                            <th data-sort="date">Số Điện thoại</th>
                                            <th data-sort="amount">Địa chỉ</th>
                                            <th data-sort="payment">Tổng tiền</th>
                                            <th data-sort="status">Ngày đặt hàng</th>
                                            <th data-sort="status">Tình trạng đơn hàng</th>
                                            <th ata-sort="status">Phương thức thanh toán</th>
                                            <th data-sort="city">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @foreach($data as $item)
                                        <tr>
                                            <td class="id">{{$item->id}}</td>
                                            <td class="customer_name">{{$item->name}}</td>
                                            <td class="product_name">Puma Tshirt</td>
                                            <td class="date">{{$item->email}},</td>
                                            <td class="amount">{{$item->address}}</td>
                                            <td class="payment">${{$item->total}}</td>
                                            <td class="payment">{{$item->created_at->format("Y-m-d")}}</td>
                                            <td class="payment">
                                                <select class="form-control" data-choices data-choices-search-false name="choices-single-default" id="idStatus">
                                                                <option value=""><span class="badge bg-warning-subtle text-warning text-uppercase"><option value="">{{$item->giaohang}}</option></span>
                                                                <option value="all" selected>All</option>
                                                                <option value="Pending">Pending</option>
                                                                <option value="Inprogress">Inprogress</option>
                                                                <option value="Cancelled">Cancelled</option>
                                                                <option value="Pickups">Pickups</option>
                                                                <option value="Returns">Returns</option>
                                                                <option value="Delivered">Delivered</option>
                                        </select></td>
                                            <td class="payment">{{$item->thanhtoan}}</td>
                                            <td>
                                                <ul class="list-inline hstack gap-2 mb-0">
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View">
                                                        <a href="{{route('order.show',$item)}}" class="text-primary d-inline-block">
                                                            <i class="ri-eye-fill fs-16"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                        <a href="#showModal" data-bs-toggle="modal" class="text-primary d-inline-block edit-item-btn">
                                                            <i class="ri-pencil-fill fs-16"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                        <a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal" href="#deleteOrder">
                                                            <i class="ri-delete-bin-5-fill fs-16"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="noresult" style="display: none">
                                    <div class="text-center">
                                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px"></lord-icon>
                                        <h5 class="mt-2">Sorry! No Result Found</h5>
                                        <p class="text-muted">We've searched more than 150+ Orders We did not find any orders for you search.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="pagination-wrap hstack gap-2">
                                                @if ($data->onFirstPage())
                                                    <span class="page-item pagination-prev">Previous</span>
                                                @else
                                                    <a class="page-item pagination-prev" href="{{ $data->previousPageUrl() }}">Previous</a>
                                                @endif
                                                <ul class="pagination listjs-pagination mb-0"></ul>
                                                @if ($data->hasMorePages())
                                                    <a  class="page-item pagination-next" href="{{ $data->nextPageUrl() }}">Next</a>
                                                @else
                                                    <span  class="page-item pagination-next">Next</span>
                                                @endif
                                            </div>
                        </div>
                        <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-light p-3">
                                        <h5 class="modal-title" id="exampleModalLabel">&nbsp;</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                    </div>
                                    <form class="tablelist-form" autocomplete="off">
                                        <div class="modal-body">
                                            <input type="hidden" id="id-field" />

                                            <div class="mb-3" id="modal-id">
                                                <label for="orderId" class="form-label">ID</label>
                                                <input type="text" id="orderId" class="form-control" placeholder="ID" readonly />
                                            </div>

                                            <div class="mb-3">
                                                <label for="customername-field" class="form-label">Customer Name</label>
                                                <input type="text" id="customername-field" class="form-control" placeholder="Enter name" required />
                                            </div>

                                            <div class="mb-3">
                                                <label for="productname-field" class="form-label">Product</label>
                                                <select class="form-control" data-trigger name="productname-field" id="productname-field" required />
                                                    <option value="">Product</option>
                                                    <option value="Puma Tshirt">Puma Tshirt</option>
                                                    <option value="Adidas Sneakers">Adidas Sneakers</option>
                                                    <option value="350 ml Glass Grocery Container">350 ml Glass Grocery Container</option>
                                                    <option value="American egale outfitters Shirt">American egale outfitters Shirt</option>
                                                    <option value="Galaxy Watch4">Galaxy Watch4</option>
                                                    <option value="Apple iPhone 12">Apple iPhone 12</option>
                                                    <option value="Funky Prints T-shirt">Funky Prints T-shirt</option>
                                                    <option value="USB Flash Drive Personalized with 3D Print">USB Flash Drive Personalized with 3D Print</option>
                                                    <option value="Oxford Button-Down Shirt">Oxford Button-Down Shirt</option>
                                                    <option value="Classic Short Sleeve Shirt">Classic Short Sleeve Shirt</option>
                                                    <option value="Half Sleeve T-Shirts (Blue)">Half Sleeve T-Shirts (Blue)</option>
                                                    <option value="Noise Evolve Smartwatch">Noise Evolve Smartwatch</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="date-field" class="form-label">Order Date</label>
                                                <input type="date" id="date-field" class="form-control" data-provider="flatpickr" required data-date-format="d M, Y" data-enable-time required placeholder="Select date" />
                                            </div>

                                            <div class="row gy-4 mb-3">
                                                <div class="col-md-6">
                                                    <div>
                                                        <label for="amount-field" class="form-label">Amount</label>
                                                        <input type="text" id="amount-field" class="form-control" placeholder="Total amount" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div>
                                                        <label for="payment-field" class="form-label">Payment Method</label>
                                                        <select class="form-control" data-trigger name="payment-method" required id="payment-field">
                                                            <option value="">Payment Method</option>
                                                            <option value="Mastercard">Mastercard</option>
                                                            <option value="Visa">Visa</option>
                                                            <option value="COD">COD</option>
                                                            <option value="Paypal">Paypal</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                <label for="delivered-status" class="form-label">Delivery Status</label>
                                                <select class="form-control" data-trigger name="delivered-status" required id="delivered-status">
                                                    <option value="">Delivery Status</option>
                                                    <option value="Pending">Pending</option>
                                                    <option value="Inprogress">Inprogress</option>
                                                    <option value="Cancelled">Cancelled</option>
                                                    <option value="Pickups">Pickups</option>
                                                    <option value="Delivered">Delivered</option>
                                                    <option value="Returns">Returns</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success" id="add-btn">Add Order</button>
                                                <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade flip" id="deleteOrder" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body p-5 text-center">
                                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px"></lord-icon>
                                        <div class="mt-4 text-center">
                                            <h4>You are about to delete a order ?</h4>
                                            <p class="text-muted fs-15 mb-4">Deleting your order will remove all of your information from our database.</p>
                                            <div class="hstack gap-2 justify-content-center remove">
                                                <button class="btn btn-link link-success fw-medium text-decoration-none" id="deleteRecord-close" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</button>
                                                <button class="btn btn-danger" id="delete-record">Yes, Delete It</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end modal -->
                    </div>
                </div>

            </div>
            <!--end col-->
        </div>
        <!--end row-->

<!-- End Page-content -->
@endsection
