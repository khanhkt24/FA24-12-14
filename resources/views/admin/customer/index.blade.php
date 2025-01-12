@extends('admin.layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Quản Lý Người Dùng</h4>
        </div>
    </div>
</div>
<div class="row">
                        <div class="col-xl-12 col-lg-8">
                            <div>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Quản lý Người dùng </h4>
                                </div>
                                <div class="card-body">
                                    <div class="listjs-table" id="customerList">
                                    <form method="get">
                                        @csrf
                                        <div class="row g-4 mb-3">
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