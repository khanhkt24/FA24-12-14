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
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Thêm sản phẩm mới</h4>
                                </div><!-- end card header -->
                                <div class="card-body">
                                <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <label for="" class="form-label">Tên</label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" >
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <label for="" class="form-label">Ảnh</label>
                                        <input type="file" class="form-control" name="img">
                                        @error('img')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <label for="" class="form-label">Cost</label>
                                        <input type="text" class="form-control" name="cost" value="{{ old('cost') }}">
                                        
                                        @error('cost')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                    <label for="" class="form-label">Tag</label>
                                        <select name="tag_id" id="" class="form-select">
                                            @foreach($tag as $id => $name)
                                                <option value="{{$id}}">{{$name}}</option>
                                            @endforeach
                                        </select></div>
                                        <div class="row">
                                    <label for="" class="form-label">Category</label>
                                        <select name="category_id" id="" class="form-select">
                                            @foreach($category as $id => $name)
                                                <option value="{{$id}}">{{$name}}</option>
                                            @endforeach
                                        </select></div>
                                        <div class="mt-3 mb-4">
                                        <label for="" class="form-check-label">Mô tả</label><br>
                                        <textarea name="description" id="" cols="200" rows="7" value="{{ old('description') }}"></textarea>
                                    </div><br>
                                    <button type="submit" class="btn btn-success">Tạo mới</button>
                                </form>
                                </div><!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end col -->
</div>
    @endsection