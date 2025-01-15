@extends('main')

@section('title', 'Home Page')

@section('content')
@if(session('message'))
<script>
    alert("{{ session('message') }}");
</script>
@endif

 <!-- Hero Start -->

    <div class="container p-5">
        <div class="row g-5 align-items-center p-5">
            <!-- Left Content -->
            <div class="col-md-12 col-lg-7 p-5">
                <h4 class="mb-3 text-success fw-bold">100% Authentic Products</h4>
                <h1 class="mb-4 display-4 fw-bold text-danger" style="background: linear-gradient(to right, #ff416c, #ff4b2b); -webkit-background-clip: text; color: transparent; text-shadow: none;">
                    Medicine at Your Doorsteps
                </h1>
                <p class="text-muted fs-5">
                    Bringing you the best in healthcare and wellness with just a few clicks. Experience convenience and quality with MediMart.
                </p>
                <a href="{{route('store')}}" class="btn btn-danger btn-lg px-4 py-2 mt-3 text-white shadow">Shop Now</a>
            </div>

            <!-- Right Content (Carousel) -->
            <div class="col-md-12 col-lg-5 ">
                <div id="carouselId" class="carousel slide position-relative shadow rounded" data-bs-ride="carousel">
                    <!-- Carousel Images -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="img/med5.jpeg" class="img-fluid w-100 h-100 rounded" alt="First slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h5 class="text-light display-5  p-2 rounded">Wide Range of Medicines</h5>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="img/img_med.jpeg" class="img-fluid w-100 h-100 rounded" alt="Second slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h5 class="text-light display-5  p-2 rounded">Fast & Reliable Delivery</h5>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="img/med4.jpeg" class="img-fluid w-100 h-100 rounded" alt="Third slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h5 class="text-light display-5  p-2 rounded">Fast & Reliable Delivery</h5>
                            </div>
                        </div>
                    </div>
                    <!-- Carousel Controls -->
                    {{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                        <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button> --}}
                </div>
            </div>
        </div>
    </div>

<!-- Hero End -->



   
<!-- Medicine Shop Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="tab-class text-center">
            <div class="row g-4">
                <div class="col-lg-4 text-start">
                    <h1 class="fw-bold">Our Products</h1>
                </div>
                <div class="col-lg-8 text-end">
                    <ul class="nav nav-pills d-inline-flex text-center mb-5">
                        <li class="nav-item">
                            <a class="d-flex m-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill" href="#tab-all">
                                <span class="text-dark fw-bold" style="width: 130px;">All Products</span>
                            </a>
                        </li>
                        @foreach ($categories as $category)
                        <li class="nav-item">
                            <a class="d-flex py-2 m-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-{{ $category->id }}">
                                <span class="text-dark fw-bold" style="width: 130px;">{{ $category->catagory_name }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <!-- All Products Tab -->
                <div id="tab-all" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        @foreach ($products as $product)
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="card border-0 shadow-sm rounded position-relative h-100 hover-effect">
                                <!-- Product Image -->
                                <div class="position-relative overflow-hidden">
                                    <img src="{{ asset($product->image) }}" class="card-img-top img-fluid" alt="{{ $product->name }}">
                                    {{-- <div class="badge bg-success position-absolute top-0 start-0 m-2 px-3 py-1 text-white">
                                        ₹{{ $product->price }}
                                    </div> --}}
                                </div>
                                <!-- Product Details -->
                                <div class="card-body text-center">
                                    <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                                   
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="badge bg-success text-light fs-5 fw-bold mb-0">₹{{ $product->price }}</p>
                                        @if ($product->quantity > 0)
                                        <a href="{{ route('mycart', ['product_id' => $product->id]) }}" class="btn btn-info btn-sm rounded-pill text-white px-4">
                                            <i class="fa fa-shopping-bag me-2"></i>Add to Cart
                                        </a>
                                        @else
                                        <button class="btn btn-danger" disabled>Out of Stock</button>
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Category-Specific Tabs -->
                @foreach ($categories as $category)
                <div id="tab-{{ $category->id }}" class="tab-pane fade p-0">
                    <div class="row g-4">
                        @foreach ($category->products as $product)
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="card border-0 shadow-sm rounded position-relative h-100 hover-effect">
                                <!-- Product Image -->
                                <div class="position-relative overflow-hidden">
                                    <img src="{{ asset($product->image) }}" class="card-img-top img-fluid" alt="{{ $product->name }}">
                                    {{-- <div class="badge bg-success position-absolute top-0 start-0 m-2 px-3 py-1 text-white">
                                        ₹{{ $product->price }}
                                    </div> --}}
                                </div>
                                <!-- Product Details -->
                                <div class="card-body text-center">
                                    <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                                    
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="badge bg-success text-light fs-5 fw-bold mb-0">₹{{ $product->price }}</p>
                                        @if ($product->quantity > 0)
                                        <a href="{{ route('mycart', ['product_id' => $product->id]) }}" class="btn btn-info btn-sm rounded-pill text-white px-4">
                                            <i class="fa fa-shopping-bag me-2"></i>Add to Cart
                                        </a>
                                        @else
                                        <button class="btn btn-danger" disabled>Out of Stock</button>
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Medicine Shop End -->




<!-- Features Section Start -->

    <div class="container py-5">
        <div class="row g-4 text-center">
            <!-- Feature Item -->
            <div class="col-md-6 col-lg-3">
                <div class="features-item d-flex flex-column align-items-center bg-white rounded shadow-sm p-4 h-100">
                    <div class="features-icon btn-square rounded-circle bg-secondary mb-4">
                        <i class="fas fa-car-side fa-2x text-white"></i>
                    </div>
                    <h5 class="mb-2">Free Shipping</h5>
                    <p class="text-muted mb-0">Free on orders over ₹300</p>
                </div>
            </div>

            <!-- Feature Item -->
            <div class="col-md-6 col-lg-3">
                <div class="features-item d-flex flex-column align-items-center bg-white rounded shadow-sm p-4 h-100">
                    <div class="features-icon btn-square rounded-circle bg-secondary mb-4">
                        <i class="fas fa-user-shield fa-2x text-white"></i>
                    </div>
                    <h5 class="mb-2">Secure Payment</h5>
                    <p class="text-muted mb-0">100% secure transactions</p>
                </div>
            </div>

            <!-- Feature Item -->
            <div class="col-md-6 col-lg-3">
                <div class="features-item d-flex flex-column align-items-center bg-white rounded shadow-sm p-4 h-100">
                    <div class="features-icon btn-square rounded-circle bg-secondary mb-4">
                        <i class="fas fa-exchange-alt fa-2x text-white"></i>
                    </div>
                    <h5 class="mb-2">30 Day Returns</h5>
                    <p class="text-muted mb-0">30-day money-back guarantee</p>
                </div>
            </div>

            <!-- Feature Item -->
            <div class="col-md-6 col-lg-3">
                <div class="features-item d-flex flex-column align-items-center bg-white rounded shadow-sm p-4 h-100">
                    <div class="features-icon btn-square rounded-circle bg-secondary mb-4">
                        <i class="fa fa-phone-alt fa-2x text-white"></i>
                    </div>
                    <h5 class="mb-2">24/7 Support</h5>
                    <p class="text-muted mb-0">Fast and reliable support</p>
                </div>
            </div>
        </div>
    </div>

<!-- Features Section End -->

<!-- Add Custom CSS -->



<!-- Custom CSS -->
<style>
    .hover-effect:hover {
        transform: scale(1.05);
        transition: all 0.3s ease-in-out;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
    }
    .features-item {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .features-item:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .features-icon {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 70px;
        height: 70px;
    }

    h5 {
        font-weight: 600;
    }

    p {
        font-size: 0.9rem;
    }
</style>
@endsection

