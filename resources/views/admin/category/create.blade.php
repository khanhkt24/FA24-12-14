@extends('admin.layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Danh mục lớn</h4>
        </div>
    </div>
</div>
<div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Thêm danh mục lớn</h4>
                                </div><!-- end card header --><!-- end card -->
                            </div>
                            <!-- end col -->
                            <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tên danh mục lớn</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" name="name" placeholder="Tên danh mục lớn..." value="{{old('name')}}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-check">
                                </div>
                                <button type="submit" class="btn btn-success">Tạo mới</button>
                                </form>
                        </div>
                        <!-- end col -->
                    </div>
    @endsection