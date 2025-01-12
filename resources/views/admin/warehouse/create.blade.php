@extends('admin.layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Quản lý biến thể</h4>
        </div>
    </div>
</div>
<div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Thêm biến thể sản phẩm {{$data->name}}</h4>
                                </div><!-- end card header -->
                                <div class="card-body">
                                <form action="{{route('warehouse.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <label for="" class="form-label">Tên sản phẩm : {{$data->name}}</label>
                                        <input type="hidden" name="product_id" value="{{$data->id}}">
                                    </div>
                                    <div class="row">
                                        <label for="" class="form-label">Ảnh</label>
                                        <input type="file" class="form-control" name="img">
                                        @error('img')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <label for="" class="form-label">Kích cỡ</label>
                                        <input type="text" class="form-control" name="size">
                                        @error('size')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <label for="" class="form-label">Màu</label>
                                        <input type="text" class="form-control" name="color">
                                        @error('color')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <label for="" class="form-label">Số lượng</label>
                                        <input type="text" class="form-control" name="quantity">
                                        @error('quantity')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div><br>
                                    <div class="row">
                                    <button type="submit" class="btn btn-success">Tạo mới</button>
                                </form>
                                </div><!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end col -->
</div>
    @endsection