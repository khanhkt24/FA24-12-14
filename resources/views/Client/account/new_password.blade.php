<form action="{{ route('password.update') }}" method="POST">
    @csrf
    <input type="hidden" name="token" value="{{ request()->token }}">
    <input type="hidden" name="email" value="{{ request()->email }}">

    <div class="form-group">
        <label for="password">Mật khẩu mới</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="password_confirmation">Xác nhận mật khẩu</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Cập nhật mật khẩu</button>
</form>