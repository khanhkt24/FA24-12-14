<!doctype html>
<html lang="en">

<head>
    <title>

    </title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <style>
        body {
            background-image: url('https://i.pinimg.com/736x/81/df/80/81df80af1f295f7913143c2d7fef8b4b.jpg');
            /* Thay đổi đường dẫn hình nền */
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            /* Đảm bảo chiều cao tối thiểu cho body */
        }
    </style>
</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main>

        <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-md-4">
                <div class="card text-black"
                    style="background-image: url('https://i.pinimg.com/736x/9c/ce/7b/9cce7b355b2370167c4f2497b1fd939f.jpg'); background-size: cover; background-position: center;">
                    <div class="card-body" style="background-color: rgba(255, 255, 255, 0.8);">
                        <!-- Thêm opacity cho nền -->
                        <form action="{{route('admin.login')}}" method="post">
                            @csrf
                            <legend class="text-center">FORM LOGIN</legend>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" id="email"
                                    aria-describedby="helpId" placeholder="" />
                                    @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password"
                                    aria-describedby="helpId" placeholder="" />
                                    @error('password')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                            <a href="{{route('admin.register')}}">Đăng ký tại đây</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <footer>
        <!-- place footer here -->
    </footer>


</body>

</html>
