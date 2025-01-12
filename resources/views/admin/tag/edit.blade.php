@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Sửa tag {{ $tag->name }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <form action="{{ route('tag.update', $tag) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mt-3 mb-4">
                <label for="" class="form-label">Tên</label>
                <input type="text" class="form-control" name="name" value="{{ $tag->name }}">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-3 mb-4">
                <label for="" class="form-label">Hãng sản xuất</label>
                <select name="category_id" id="" class="form-select">
                    @foreach ($category as $id => $name)
                        <option value="{{ $id }}" @selected($tag->category_id == $id)>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-3 mb-4">
                <label for="" class="form-label">Ảnh</label>
                <input type="file" class="form-control" name="img">
                @if (!empty($tag->img))
                    <br>
                    <div style="width: 100px; height: 100px;">
                        <img src="{{ Storage::url($tag->img) }}" style="max-width: 100%; max-height: 100%" alt="">
                    </div>
                @endif
            </div>
            <button type="submit" class="btn btn-success">Cập nhật</button>

        </form>
    </div>
@endsection
