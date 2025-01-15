@extends('admin.layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Quản Lý Bình luận</h4>
        </div>
    </div>
</div>
<div class="row">
                        <div class="col-xl-12 col-lg-8">
                            <div>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Quản lý Bình luận</h4>
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
                                                        <th>Sản Phẩm</th>
                                                        <th>Bình Luận</th>
                                                        <th>Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($comment as $index=> $item )
                                                    <tr id="comment-row-{{$item->id}}">
                                                        <td>{{$index + 1}}</td>
                                                        <td>{{$item->customer->name}}</td>
                                                        <td>{{$item->customer->email}}</td>
                                                        <td>{{$item->product->name}}</td>
                                                        <td>{{$item->content}}</td>
                                                        <td>
                                                            <form action="{{route('admin.binhluan.destroy', $item->id)}}" method="post">
                                                                @csrf
                                                                @method('put') <!-- Cập nhật thay vì delete -->
                                                                <button onclick="return confirm('Bạn có muốn thay đổi trạng thái không?')" class="btn btn-warning">
                                                                    @if ($item->is_hidden)
                                                                        Hiện
                                                                    @else
                                                                        Ẩn
                                                                    @endif
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
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
                    <script>
                        function toggleCommentVisibility(commentId) {
    if (confirm('Bạn có muốn thay đổi trạng thái bình luận này không?')) {
        $.ajax({
            url: '/admin/binhluan/' + commentId,  // Route đến phương thức delete
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                var row = $('#comment-row-' + commentId);
                var button = row.find('button');
                
                if (response.status === 'success') {
                    button.toggleClass('btn-danger btn-primary');
                    button.text(response.message);
                }
            },
            error: function() {
                alert('Có lỗi xảy ra. Vui lòng thử lại!');
            }
        });
    }
}
                    </script>
    @endsection