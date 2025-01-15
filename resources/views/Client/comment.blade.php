@extends('Client.layouts.masterlayout')

@section('content')
    <h2>Bình luận sản phẩm</h2>
    @foreach ($order->proOrder as $item)
        <h3>{{ $item->product->name }}</h3>
        <form action="{{ route('comment.store', $item->product->id) }}" method="POST">
            @csrf
            <textarea name="content" required placeholder="Nhập bình luận của bạn..."></textarea>
            <button type="submit">Gửi bình luận</button>
        </form>
    @endforeach
@endsection