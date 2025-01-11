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
                <p class="mb-4">Mô tả: {{ substr($product->description, 0, 120) }}{{ strlen($product->description) > 120 ? '...' : '' }}</p>
                
                <div class="d-flex mb-3">
                    <p class="text-dark font-weight-medium mb-0 mr-3">Sizes:</p>
                    @foreach($product->bienthe as $index => $bienthes)
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-{{ $index }}" name="bienthe_id" value="{{ $bienthes->id }}" required>
                            <label class="custom-control-label" for="size-{{ $index }}">{{ $bienthes->size }}</label>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex mb-4">
                
                    <p class="text-dark font-weight-medium mb-0 mr-3">Colors:</p>
                    @foreach($product->bienthe as $index => $bienthess)
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="color-{{ $index }}" name="color" value="{{ $bienthess->color }}" required>
                            <label class="custom-control-label" for="color-{{ $index }}">{{ $bienthess->color }}</label>
                        </div>
                    @endforeach
                </div>
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

                <!-- Các phần khác của thông tin sản phẩm -->
                <div class="mt-3 mb-3">
                    <button class="btn btn-primary px-3" type="submit"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                    <button class="btn btn-warning px-3"><i class="fa fa-money-bill mr-1"></i> Buy Now</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Shop Detail End -->


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
