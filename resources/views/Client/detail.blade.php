@extends('Client.layouts.masterlayout')

@section('content')
<style>
    .thumbnail {
    width: 80px;
    height: 80px;
    cursor: pointer;
    transition: opacity 0.3s ease;
}

#main-image {
    width: 100%;
    max-width: 500px;
    display: block;
}

.thumbnail:hover {
    opacity: 0.7;
}
</style>

  <!-- Page Header Start -->
  <div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Shop Detail</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Shop Detail</p>
        </div>
    </div>
</div>
<
<!-- Shop Detail Start -->
<form action="{{route('cart.add',$product)}}" method="POST">
    @csrf
    <div class="container-fluid py-5">
        <div class="row">
            <!-- Thêm class "col-lg-5" cho ảnh để chiếm 5 phần trên 12 phần của grid -->
            <div class="col-lg-5 pb-5">
                <div class="product-images">
                    <img id="main-image" src="{{ \Storage::url($product->img) }}" alt="Main Image" class="img-fluid">
                    @foreach($product->bienthe as $bienthe)
                        <img class="thumbnail img-thumbnail mr-2" src="{{ \Storage::url($bienthe->img) }}" alt="Thumbnail" 
                        onmouseover="changeMainImage(this)" onmouseout="resetImage()" onclick="setMainImage(this)">
                    @endforeach
                </div>
            </div>
            <!-- Thêm class "col-lg-7" cho phần thông tin sản phẩm để chiếm 7 phần trên 12 phần của grid -->
            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold">{{ $product->name }}</h3>
                <h3 class="font-weight-semi-bold mb-4">{{ $product->cost }} VNĐ</h3>
                <p class="mb-4">Mô tả: {{ Str::limit($product->description, 120) }}</p>
            
                <!-- Chọn Size -->
                <div class="d-flex mb-3">
                    <p class="text-dark font-weight-medium mb-0 mr-3">Sizes:</p>
                    @php
                        $sizes = collect($product->bienthe)->unique('size');
                    @endphp
                    @foreach($sizes as $index => $size)
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input size-selector" id="size-{{ $index }}" name="size" value="{{ $size->size }}">
                            <label class="custom-control-label" for="size-{{ $index }}">{{ $size->size }}</label>
                        </div>
                    @endforeach
                </div>
            
                <!-- Chọn Color -->
                <div class="d-flex mb-3">
                    <p class="text-dark font-weight-medium mb-0 mr-3">Colors:</p>
                    @foreach($product->bienthe as $index => $bienthe)
                        <div class="custom-control custom-radio custom-control-inline color-container" data-size="{{ $bienthe->size }}" style="display: none;">
                            <input type="radio" class="custom-control-input color-selector" id="color-{{ $index }}" name="bienthe_id" value="{{ $bienthe->id }}">
                            <label class="custom-control-label" for="color-{{ $index }}">{{ $bienthe->color }}</label>
                        </div>
                    @endforeach
                </div>
            
                <!-- Hiển thị số lượng -->
                <div class="quantity-info" id="quantity" style="display: none;">
                    <p class="text-muted">Số lượng: <span id="stock-quantity"></span></p>
                </div>
            
                <!-- Input số lượng -->
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-minus"><i class="fa fa-minus"></i></button>
                        </div>
                        <input type="text" class="form-control bg-secondary text-center" name="quantity" value="1" min="1">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-plus"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>
            
                <div class="mt-3 mb-3">
                    <button class="btn btn-primary px-3" type="submit"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                    <button class="btn btn-warning px-3"><i class="fa fa-money-bill mr-1"></i> Buy Now</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Phần bình luận -->
<!-- Phần bình luận -->
<div class="row px-xl-5">
    <div class="col">
        <div class="nav nav-tabs justify-content-center border-secondary mb-4">
            <a class="nav-item nav-link " data-toggle="tab" href="#tab-pane-1">Description</a>
            <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">Information</a>
            <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-3">Reviews (0)</a>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade show " id="tab-pane-1">
                <h4 class="mb-3">Chi tiết sản phẩm</h4>
                <p>{{$product->description}}</p>
            </div>
            <div class="tab-pane fade" id="tab-pane-2">
                <h4 class="mb-3">Thông tin sản phẩm</h4>
                <p>E Shopping mong muốn mang tới cho các bạn trẻ những sản phẩm áo thun với những nét thiết kế đơn giản, tinh tế, trẻ trung, phù hợp với nhiều phong cách đa dạng.</p>
                <p>Với mong muốn mỗi sản phẩm áo thun đều được tỉ mỉ, chu đáo từ khâu thiết kế, sản xuất cho tới trải nghiệm, tụi mình luôn cố gắng nỗ lực mỗi ngày để đạt được những yêu cầu tốt nhất cùng mức giá phù hợp.

                    Mọi vấn đề về tư vấn hay trải nghiệm sản phẩm, bạn có thể để lại tin nhắn cho chúng mình để được giải đáp và hỗ trợ sớm nhất</p>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0">
                                Nhớ lộn trái áo khi giặt và không giặt ngâm.
                            </li>
                            <li class="list-group-item px-0">
                                Không giặt máy trong 10 ngày đầu.
                            </li>
                            <li class="list-group-item px-0">
                                Không sử dụng nước tẩy.
                            </li>
                            <li class="list-group-item px-0">
                                Khi phơi lộn trái và không phơi trực tiếp dưới ánh nắng mặt trời.
                            </li>
                          </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0">
                                Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                            </li>
                            <li class="list-group-item px-0">
                                Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                            </li>
                            <li class="list-group-item px-0">
                                Duo amet accusam eirmod nonumy stet et et stet eirmod.
                            </li>
                            <li class="list-group-item px-0">
                                Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                            </li>
                          </ul>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade show active" id="tab-pane-3">
                <div class="row">
                    <div class="col-md-12">
                        {{-- Bình luận --}}
                        <div class="container mt-5">
                            <h3 class="mb-4">Bình luận</h3>
                    
                            <!-- Kiểm tra nếu có comments -->
                            @if(isset($product->comments) && $product->comments->count() > 0)
                            <div class="list-group mb-4">
                                @foreach ($product->comments as $comment)
                                    @if (!$comment->is_hidden) <!-- Kiểm tra nếu bình luận không bị ẩn -->
                                        <div class="list-group-item">
                                            <strong>{{ $comment->customer->name ?? 'Khách hàng' }}</strong> 
                                            <p class="mb-1">{{ $comment->content }}</p>
                                            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            @else
                                <p class="text-muted">Chưa có bình luận nào.</p>
                            @endif
                    
                            <!-- Kiểm tra nếu khách đã mua sản phẩm để hiển thị form bình luận -->
                            {{-- @if(auth()->check() && isset($hasPurchased) && $hasPurchased) --}}
                                <!-- Form nhập bình luận -->
                                <form action="{{route('comment.store',$product->id)}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <div class="form-group">
                                        <textarea name="content" class="form-control" rows="3" placeholder="Nhập bình luận..." required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Gửi bình luận</button>
                                </form>
                            {{-- @else --}}
                                <p class="text-muted mt-3">Chỉ những khách hàng đã mua sản phẩm mới có thể bình luận.</p>
                            {{-- @endif --}}
                        </div>
                    </div>
                    {{-- <div class="col-md-6">
                        <h4 class="mb-4">Leave a review</h4>
                        <small>Your email address will not be published. Required fields are marked *</small>
                        <div class="d-flex my-3">
                            <p class="mb-0 mr-2">Your Rating * :</p>
                            <div class="text-primary">
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                        <form>
                            <div class="form-group">
                                <label for="message">Your Review *</label>
                                <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="name">Your Name *</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                            <div class="form-group">
                                <label for="email">Your Email *</label>
                                <input type="email" class="form-control" id="email">
                            </div>
                            <div class="form-group mb-0">
                                <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                            </div>
                        </form>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <div class="container mt-5">
    <h3 class="mb-4">Bình luận</h3>

    <!-- Kiểm tra nếu có comments -->
    @if(isset($product->comments) && $product->comments->count() > 0)
        <div class="list-group mb-4">
            @foreach ($product->comments as $comment)
                <div class="list-group-item">
                    <strong>{{ $comment->customer->name ?? 'Khách hàng' }}</strong> 
                    <p class="mb-1">{{ $comment->content }}</p>
                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-muted">Chưa có bình luận nào.</p>
    @endif

    <!-- Form nhập bình luận (chỉ hiển thị nếu khách đã mua hàng) -->
    @if(auth()->check() && isset($hasPurchased) && $hasPurchased)
        <form action="{{ route('comments.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="form-group">
                <textarea name="content" class="form-control" rows="3" placeholder="Nhập bình luận..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Gửi bình luận</button>
        </form>
    @else
        <p class="text-muted">Chỉ những khách hàng đã mua sản phẩm mới có thể bình luận.</p>
    @endif
</div> --}}


<!-- Products Start -->
<div class="container-fluid py-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">You May Also Like</span></h2>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel related-carousel">
                <div class="card product-item border-0">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid w-100" src="{{asset('client/img/cat-1.jpg')}}" alt="">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                        <div class="d-flex justify-content-center">
                            <h6>$123.00</h6><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                        <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                    </div>
                </div>
                <div class="card product-item border-0">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid w-100" src="{{asset('client/img/cat-3.jpg')}}" alt="">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                        <div class="d-flex justify-content-center">
                            <h6>$123.00</h6><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                        <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                    </div>
                </div>
                <div class="card product-item border-0">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid w-100" src="{{asset('client/img/cat-2.jpg')}}" alt="">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                        <div class="d-flex justify-content-center">
                            <h6>$123.00</h6><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                        <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                    </div>
                </div>
                <div class="card product-item border-0">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid w-100" src="{{asset('client/img/cat-3.jpg')}}" alt="">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                        <div class="d-flex justify-content-center">
                            <h6>$123.00</h6><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                        <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                    </div>
                </div>
                <div class="card product-item border-0">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid w-100" src="{{asset('client/img/cat-1.jpg')}}" alt="">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                        <div class="d-flex justify-content-center">
                            <h6>$123.00</h6><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>

                        <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Products End -->

<script>
    document.addEventListener("DOMContentLoaded", function () {
    // Lấy các nút + và -
    let btnPlus = document.querySelector(".btn-plus");
    let btnMinus = document.querySelector(".btn-minus");
    let inputQuantity = document.querySelector("input[name='quantity']");

    // Xử lý khi nhấn nút cộng
    btnPlus.addEventListener("click", function(e) {
        e.preventDefault();  // Ngừng hành động mặc định
        let currentValue = parseInt(inputQuantity.value);
        inputQuantity.value = currentValue ;
    });

    // Xử lý khi nhấn nút trừ
    btnMinus.addEventListener("click", function(e) {
        e.preventDefault();  // Ngừng hành động mặc định
        let currentValue = parseInt(inputQuantity.value);
        if (currentValue > 1  ) {
            inputQuantity.value = currentValue;
        }
    });
});
document.addEventListener("DOMContentLoaded", function () {
    let sizeRadios = document.querySelectorAll(".size-selector");
    let colorRadios = document.querySelectorAll(".color-selector");
    let colorContainers = document.querySelectorAll(".color-container");

    function updateColors() {
        let selectedSize = document.querySelector(".size-selector:checked");
        if (selectedSize) {
            let selectedSizeValue = selectedSize.value;

            // Ẩn tất cả màu trước
            colorContainers.forEach(container => {
                container.style.display = "none";
            });

            // Hiển thị màu sắc liên quan đến size đã chọn
            document.querySelectorAll(`.color-container[data-size='${selectedSizeValue}']`).forEach(container => {
                container.style.display = "inline-block";
            });

            // Tự động chọn màu đầu tiên nếu chưa có màu nào được chọn
            let firstColor = document.querySelector(`.color-container[data-size='${selectedSizeValue}'] input[name='bienthe_id']`);
            if (firstColor) {
                firstColor.checked = true;
            }
        }
    }

    // Gán sự kiện khi chọn size
    sizeRadios.forEach(radio => {
        radio.addEventListener("change", updateColors);
    });

    // Ẩn màu sắc ban đầu
    updateColors();
});



    //
    let mainImage = document.getElementById('main-image');  // Lấy ảnh chính

    // Thay đổi ảnh chính khi hover vào ảnh con
    function changeMainImage(imgElement) {
        mainImage.src = imgElement.src;
    }

    // Đặt lại ảnh chính khi bỏ chuột
    function resetImage() {
        mainImage.src = '{{ \Storage::url($product->img) }}';
    }

    // Thay đổi ảnh chính khi nhấn vào ảnh con
    function setMainImage(imgElement) {
        mainImage.src = imgElement.src;
    }
</script>
@endsection
