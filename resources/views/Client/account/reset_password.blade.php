<form action="{{ route('password.email') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="email">Email của bạn</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Gửi link đặt lại mật khẩu</button>
</form>