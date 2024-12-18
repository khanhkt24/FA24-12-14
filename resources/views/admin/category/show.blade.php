@extends('admin.layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Xem danh mục {{$category->name}}</h4>
        </div>
    </div>
</div>
<div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Tag của {{$category->name}}</h4>
                                </div><!-- end card header -->
                                <div class="card-body">
                                    <div class="listjs-table" id="customerList">
                                    <form action="{{ route('tag.search') }}" method="get">
                                        @csrf
                                        <div class="row g-4 mb-3">
                                            <div class="col-sm-auto">
                                                <div>
                                                    <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><a href="{{route('tag.create')}}"><i class="ri-add-line align-bottom me-1"></i> Add</a></button>
                                                    <button class="btn btn-soft-danger"><a href="{{route('tag.bin')}}">Thùng rác</a></button>
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
                                                        <th>Danh mục lớn</th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th >Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($data as $item)
                                                    <tr>
                                                    <td>{{$item->id}}</td>
                                                    <td>{{$item->name}}</td>
                                                    <td><img src="{{Storage::url($item->img)}}" alt="" width="100"></td>
                                                        <td class="email">{{$item->category?->name}}</td>
                                                        <td class="phone"></td>
                                                        <td class="date"></td>
                                                        <td class="status"><span class="badge bg-success-subtle text-success text-uppercase"></span></td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                            <div class="edit">
                                                                    <button class="btn btn-sm btn-info edit-item-btn" data-bs-toggle="modal" data-bs-target="#showModal">Xem</button>
                                                                </div>
                                                                <div class="edit">
                                                                    <button class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal" data-bs-target="#showModal"><a href="{{route('tag.edit',$item)}}">Sửa</a></button>
                                                                </div>
                                                                <div class="remove">
                                                                <form action="{{route('tag.destroy',$item)}}" method="POST">
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
                                            <div class="noresult" style="display: none">
                                                <div class="text-center">
                                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                                    <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any orders for you search.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end col -->
    @endsection