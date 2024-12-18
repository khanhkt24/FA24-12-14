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
                                    <h4 class="card-title mb-0">Sửa sản phẩm {{$product->name}}</h4>
                                </div><!-- end card header -->
                                <div class="card-body">
                                <form action="{{route('product.update',$product)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mt-3 mb-4">
            <label for="" class="form-label">Tên</label>
            <input type="text" class="form-control" name="name" value="{{$product->name}}">
        </div>
        <div class="mt-3 mb-4">
            <label for="" class="form-label">Ảnh</label>
            <input type="file" class="form-control" name="img">
            @if(!empty($product->img))
                <div style="width: 100px; height: 100px;">
                    <img src="{{Storage::url($product->img)}}"
                         style="max-width: 100%; max-height: 100%"
                         alt="">
                </div>
            @endif
        </div>
        <div class="mt-3 mb-4">
            <label for="" class="form-label">Giá</label>
            <input type="text" class="form-control" name="cost" value="{{$product->cost}}">
        </div>
        <div class="mt-3 mb-4">
            <label for="" class="form-label">Tag</label>
            <select name="tag_id" id="" class="form-select">
                @foreach($tag as $id => $name)
                    <option value="{{$id}}" @selected($product->tag_id == $id)>{{$name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mt-3 mb-4">
            <label for="" class="form-label">Hãng sản xuất</label>
            <select name="category_id" id="" class="form-select">
                @foreach($category as $id => $name)
                    <option value="{{$id}}" @selected($product->category_id == $id)>{{$name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mt-3 mb-4">
            <label for="" class="form-check-label">Mô tả</label><br>
            <textarea name="description" id="" cols="200" rows="7">{{$product->description}}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Cập nhật</button>

    </form>
                                </div><!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end col -->
</div>
    @endsection