@extends('Client.layouts.masterlayout')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hiệu ứng hover ảnh sản phẩm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Container chính */
        .product-card {
            position: relative;
            overflow: hidden;
            width: 300px;
            text-align: center;
        }

        /* Ảnh chính */
        .product-image {
            width: 100%;
            transition: opacity 0.3s ease;
        }

        /* Danh sách ảnh con (ẩn ban đầu) */
        .product-thumbnails {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        /* Ảnh con */
        .product-thumbnails img {
            width: 50px;
            height: 50px;
            cursor: pointer;
            border: 2px solid transparent;
            transition: border 0.3s ease;
        }

        .product-thumbnails img:hover {
            border: 2px solid #007bff;
        }

        /* Khi hover vào ảnh chính, hiển thị ảnh con */
        .product-card:hover .product-thumbnails {
            opacity: 1;
        }
    </style>
</head>
<body>


    <div class="row">
        <div class="col-md-4">
            <div class="product-card">
                <!-- Ảnh chính -->
                <img src="https://via.placeholder.com/300" class="product-image" id="mainImage" alt="Sản phẩm">

                <!-- Ảnh nhỏ (ẩn ban đầu) -->
                <div class="product-thumbnails">
                    <img src="https://via.placeholder.com/300/007bff" class="thumbnail" data-image="https://via.placeholder.com/300/007bff" alt="Thumb 1">
                    <img src="https://via.placeholder.com/300/ff0000" class="thumbnail" data-image="https://via.placeholder.com/300/ff0000" alt="Thumb 2">
                    <img src="https://via.placeholder.com/300/00ff00" class="thumbnail" data-image="https://via.placeholder.com/300/00ff00" alt="Thumb 3">
                </div>
            </div>
        </div>
    </div>


<script>
    $(document).ready(function () {
        let originalImage = $("#mainImage").attr("src");

        $(".thumbnail").on("click", function () {
            let newImage = $(this).attr("data-image");
            $("#mainImage").attr("src", newImage);
        });

        $(".product-card").on("mouseleave", function () {
            $("#mainImage").attr("src", originalImage);
        });
    });
</script>

</body>
@endsection
