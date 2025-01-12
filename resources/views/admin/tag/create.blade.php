@extends('admin.layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Thêm danh mục nhỏ</h4>
        </div>
    </div>
</div>
<div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Quản lý danh mục nhỏ</h4>
                                </div><!-- end card header -->
                                <div class="card-body">
                                <form action="{{route('tag.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <label for="" class="form-label">Tên</label>
                                        <input type="text" class="form-control" name="name">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <label for="" class="form-label">Ảnh</label>
                                        <input type="file" class="form-control" name="img">
                                    
                                    </div><br>
                                    <div class="row">
                                    <label for="" class="form-label">Hãng sản xuất</label>
                                        <select name="category_id" id="" class="form-select">
                                            @foreach($category as $id => $name)
                                                <option value="{{$id}}">{{$name}}</option>
                                            @endforeach
                                        </select></div><br>
                                    <button type="submit" class="btn btn-success">Tạo mới</button>
                                </form>
                                </div><!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end col -->
</div>
    @endsection