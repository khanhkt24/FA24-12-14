@extends('admin.layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Quản lý sản phẩm</h4>
        </div>
    </div>
</div>
<div class="row">
                        {{-- <div class="col-xl-3 col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex mb-3">
                                        <div class="flex-grow-1">
                                            <h5 class="fs-16">Bộ lọc</h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion accordion-flush filter-accordion">

                                    <div class="card-body border-bottom">
                                        <div>
                                            <p class="text-muted text-uppercase fs-12 fw-medium mb-2">Tags</p>
                                            <ul class="list-unstyled mb-0 filter-list">
                                            <li>
                                                    <a href="{{route('product.index')}}" class="d-flex py-1 align-items-center">
                                                        <div class="flex-grow-1">
                                                            <h5 class="fs-13 mb-0 listname">Tất cả sản phẩm</h5>
                                                        </div>
                                                    </a>
                                                </li>
                                                @foreach($tag as $item)
                                                <li>
                                                    <a href="{{route('tag.show',$item)}}" class="d-flex py-1 align-items-center">
                                                        <div class="flex-grow-1">
                                                            <h5 class="fs-13 mb-0 listname">{{$item->name}}</h5>
                                                        </div>
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="card-body border-bottom">
                                        <p class="text-muted text-uppercase fs-12 fw-medium mb-4">Giá</p>
                                        <form action="{{ route('product.filter') }}" method="GET">
                                            @csrf
                                        <div id="product-price-range"></div>
                                        <div class="formCost d-flex gap-2 align-items-center mt-3">
                                            <input class="form-control form-control-sm" type="text" name="min_price" id="min_price" value="{{ request('min_price') }}" min="0" /> <span class="fw-semibold text-muted">to</span>
                                             <input class="form-control form-control-sm" type="text"  name="max_price" id="max_price" value="{{ request('max_price') }}" min="0" />
                                        </div><br>
                                        <button class="btn btn-warning" type="submit">Lọc theo giá</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end card -->
                        </div> --}}
                        <!-- end col -->

                        <div class="col-xl-12 col-lg-8">
                            <div>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Quản lý sản phẩm </h4>
                                </div><!-- end card header -->
                                <div class="card-body">
                                    <div class="listjs-table" id="customerList">
                                    <form method="get">
                                        @csrf
                                        <div class="row g-4 mb-3">
                                            <div class="col-sm-auto">
                                                <div>
                                                    <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><a href="{{route('product.create')}}"><i class="ri-add-line align-bottom me-1"></i> Add</a></button>
                                                    <button class="btn btn-soft-danger"><a href="#">Thùng rác</a></button>
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div class="d-flex justify-content-sm-end">
                                                    <div class="search-box ms-2">
                                                        <input type="text" class="form-control search" name="query"placeholder="Search...">
                                                        <i class="ri-search-line search-icon"></i>
                                                    </div>
                                                    <div class="search-box ms-2">
                                                        <button class="btn btn-success" type="submit">Tìm Kiếm</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                        <div class="table-responsive table-card mt-3 mb-1">
                                            <table class="table align-middle table-nowrap" id="customerTable">
                                                <thead class="table-light">
                                                    <tr>
                                                    <th>ID</th>
                                                        <th>Tên</th>
                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>Address</th>
                                                        <th>gender</th>
                                                        <th>Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($user as $item)
                                                    <tr>
                                                    <td>{{$item->id}}</td>
                                                    <td>{{$item->name}}</td>
                                                    <td>{{$item->email}}</td>
                                                    <td>{{$item->phone}}</td>
                                                    <td>{{$item->address}}</td>
                                                    <td> @if (Auth::user()->genre == 1)
                                                        Nam
                                                    @else
                                                        Nữ
                                                    @endif</td>
                                                    <td>
                                                        <form action="{{route('customer.destroy',$item->id)}}" method="post">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button class="btn btn-warning" type="submit">Xóa</button>
                                                        </form>
                                                    </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            {{-- <div class="d-flex justify-content-end">
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
                                            </div> --}} 
                                        </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
    @endsection