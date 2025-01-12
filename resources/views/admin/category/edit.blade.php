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
                                    <h4 class="card-title mb-0">Sửa danh mục {{$category->name}}</h4>
                                </div><!-- end card header --><!-- end card -->
                            </div>
                            <!-- end col -->
                            <form action="{{route('category.update',$category)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tên danh mục lớn</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" name="name" value="{{$category->name}}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-check">
                                </div>
                                <button type="submit" class="btn btn-success">Lưu</button>
                                </form>
                        </div>
                        <!-- end col -->
                    </div>
    @endsection