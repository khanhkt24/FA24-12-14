@extends('admin.layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Thùng rác</h4>
        </div>
    </div>
</div>
<div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Quản lý thùng rác</h4>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="listjs-table" id="customerList">

                                        <div class="table-responsive table-card mt-3 mb-1">
                                            <table class="table align-middle table-nowrap" id="customerTable">
                                                <thead class="table-light">
                                                    <tr>
                                                    <th>ID</th>
                                                        <th>Customer</th>
                                                        <th>Ảnh</th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th >Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($data as $item)
                                                    <tr>
                                                    <td>{{$item->id}}</td>
                                                    <td>{{$item->name}}</td>
                                                    <td><img src="{{Storage::url($item->img)}}" alt="" width="100"></td>
                                                        <td class="email"></td>
                                                        <td class="phone"></td>
                                                        <td class="date"></td>
                                                        <td class="status"><span class="badge bg-success-subtle text-success text-uppercase"></span></td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                            <div class="edit">
                                                            <a href="{{route('category.restore', $item)}}"><button class="btn btn-sm btn-info edit-item-btn" data-bs-toggle="modal" data-bs-target="#showModal">Khôi Phục</button>
                                                                </div></a>
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
                    </div>
    @endsection