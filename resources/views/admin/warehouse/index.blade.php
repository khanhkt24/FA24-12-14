@extends('admin.layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Quản lý loại sản phẩm</h4>
        </div>
    </div>
</div>
<div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Quản lý loại sản phẩm </h4>
                                </div><!-- end card header -->
                                <div class="card-body">
                                    <div class="listjs-table" id="customerList">
                                    <form action="{{ route('product.search') }}" method="get">
                                        @csrf
                                        <div class="row g-4 mb-3">
                                            <div class="col-sm-auto">
                                                <div>
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
                                                        <th>Tag</th>
                                                        <th>Danh mục</th>
                                                        <th>Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($data as $item)
                                                    <tr>
                                                    <td>{{$item->id}}</td>
                                                    <td>{{$item->name}}</td>
                                                    <td><img src="{{Storage::url($item->img)}}" alt="" width="100"></td>
                                                        <td class="email">{{$item->cost}}</td>
                                                        <td class="phone">{{$item->tag?->name}}</td>
                                                        <td class="date">{{$item->category?->name}}</td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                            <div class="edit">
                                                            <a href="{{route('product.show',$item)}}"><button class="btn btn-sm btn-info edit-item-btn" data-bs-toggle="modal" data-bs-target="#showModal">Xem sản phẩm</button></a>
                                                                </div>
                                                                <div class="edit">
                                                                <a href="{{route('warehouse.create',$item)}}"><button class="btn btn-sm btn-warning edit-item-btn" data-bs-toggle="modal" data-bs-target="#showModal">Thêm biến thể</button></a>
                                                                </div>
                                                                <div class="edit">
                                                                <a href="{{route('warehouse.edit',$item)}}"><button class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal" data-bs-target="#showModal">Xem biến thể</button></a>
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
                                </div><!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end col -->
</div>
    @endsection