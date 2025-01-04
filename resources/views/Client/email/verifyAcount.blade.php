<h1>{{$account->name}}</h1>

<p>Cảm ơn vì đã đăng ký tài khoản tại website của chúng tôi. Bạn đã đăng ký tài khoản thành công </p>

<div>
    <a href="{{route('acount.verify',$account->email)}}">Click vào đây để kích hoạt tài khoản</a>
</div>
