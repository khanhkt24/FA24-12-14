@extends('admin.layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Quản lý {{$tag->name}}</h4>
        </div>
    </div>
</div>
<div class="row">
                        <div class="col-xl-3 col-lg-4">
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
                                            <p class="text-muted text-uppercase fs-12 fw-medium mb-2">Tag</p>
                                            <ul class="list-unstyled mb-0 filter-list">
                                            <li>
                                                    <a href="{{route('product.index')}}" class="d-flex py-1 align-items-center">
                                                        <div class="flex-grow-1">
                                                            <h5 class="fs-13 mb-0 listname">Tất cả sản phẩm</h5>
                                                        </div>
                                                    </a>
                                                </li>
                                                @foreach($tag1 as $item)
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

                                        <div id="product-price-range"></div>
                                        <div class="formCost d-flex gap-2 align-items-center mt-3">
                                            <input class="form-control form-control-sm" type="text" id="minCost" value="0" /> <span class="fw-semibold text-muted">to</span> <input class="form-control form-control-sm" type="text" id="maxCost" value="1000" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->

                        <div class="col-xl-9 col-lg-8">
                            <div>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Quản lý tag {{$tag->name}} </h4>
                                </div><!-- end card header -->
                                <div class="card-body">
                                    <div class="listjs-table" id="customerList">
                                    <form action="{{ route('product.search') }}" method="get">
                                        @csrf
                                        <div class="row g-4 mb-3">
                                            <div class="col-sm-auto">
                                                <div>
                                                    <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><a href="{{route('product.create')}}"><i class="ri-add-line align-bottom me-1"></i> Add</a></button>
                                                    <button class="btn btn-soft-danger"><a href="{{route('product.bin')}}">Thùng rác</a></button>
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
                                                        <th>Ảnh</th>
                                                        <th>Giá</th>
                                                        <th>Danh mục</th>
                                                        <th>Số lượng bán</th>
                                                        <th>Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($data as $item)
                                                    <tr>
                                                    <td>{{$item->id}}</td>
                                                    <td>{{$item->name}}
                                                        <br><span style="color:gray;">{{{$item->tag?->name}}}</span>
                                                    </td>
                                                    <td><img src="{{Storage::url($item->img)}}" alt="" width="100"></td>
                                                        <td class="email">${{$item->cost}}</td>
                                                        <td class="date">{{$item->category?->name}}</td>
                                                        <td class="status">{{$item->sale}}</td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                            <div class="edit">
                                                                    <button class="btn btn-sm btn-info edit-item-btn" data-bs-toggle="modal" data-bs-target="#showModal"><a href="{{route('product.show',$item)}}">Xem</a></button>
                                                                </div>
                                                                <div class="edit">
                                                                    <button class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal" data-bs-target="#showModal"><a href="{{route('product.edit',$item)}}">Sửa</a></button>
                                                                </div>
                                                                <div class="remove">
                                                                <form action="{{route('product.destroy',$item)}}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#deleteRecordModal">Ẩn</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <div class="d-flex justify-content-end">
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