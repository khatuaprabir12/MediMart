
@extends('main')
@section('title', 'Product List')
@section('content')

<!-- Medicine Shop Start -->
@if(session('message'))
<script>
    alert("{{ session('message') }}");
</script>
@endif
<div class="bg-light container py-5">
    <div class="container-fluid py-5">
        <h1 class="mb-4 text-success">Genuine Medicine</h1>

        <!-- Search and Sorting -->
        <div class="row g-4 mb-4">
            <div class="col-xl-3">
                
            </div>
            <div class="col-xl-3 offset-xl-6">
                <div class="d-flex justify-content-end">
                    <label for="sort" class="me-2 text-danger">Sort By:</label>
                    <form method="GET" action="{{ route('store') }}">
                        <select id="sort" name="sort" class="form-select form-select-sm border border-warning" onchange="this.form.submit()">
                            <option value="default" {{ $sort == 'default' ? 'selected' : '' }}>Default</option>
                            <option value="name" {{ $sort == 'name' ? 'selected' : '' }}>Name</option>
                            <option value="price" {{ $sort == 'price' ? 'selected' : '' }}>Price</option>
                            <option value="latest" {{ $sort == 'latest' ? 'selected' : '' }}>Latest</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>

        <!-- Categories and Products -->
        <div class="row g-4">
            <!-- Categories -->
            <div class="col-lg-3">
                <div class="bg-white p-3 rounded shadow-sm">
                    <h4>Categories</h4>
                    <ul class="list-unstyled">
                        @foreach($catagories as $category)
                        <li class="d-flex justify-content-between py-2 category-item">
                            <a href="{{ route('products.filter', $category->id) }}" class="text-dark category-link">
                                {{ $category->catagory_name }}
                            </a><span>({{ $category->product_count }})</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Products -->
            <div class="col-lg-9">
                <div class="row g-4">
                    @foreach($products as $product)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm border-0 product-card">
                            <!-- Card Image -->
                            <div class="position-relative overflow-hidden rounded-top">
                                <img src="{{ asset($product->image) }}" class="card-img-top img-fluid" alt="{{ $product->name }}">
                                {{-- <div class="badge bg-success position-absolute top-0 start-0 m-2 px-3 py-1 text-white">
                                    ₹{{ $product->price }}
                                </div> --}}
                            </div>
                            <!-- Card Body -->
                            <div class="card-body d-flex flex-column text-center">
                                <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                                <div class=" fw-bold text-dark start-0 m-2 px-3 py-1">
                                   MRP ₹<span class="text-success">{{ $product->price }}</span>/-
                                </div>
                                {{-- <p class="card-text text-muted small">
                                    {{ Str::limit($product->description, 50, '...') }}
                                </p> --}}
                                @if ($product->quantity > 0)
                                <a href="{{ route('mycart', ['product_id' => $product->id]) }}" class="btn btn-info mt-auto rounded-pill text-white">
                                    <i class="fa fa-shopping-bag me-2"></i>Add to Cart
                                </a>
                                @else
                                    <button class="btn btn-danger" disabled>Out of Stock</button>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- <!-- Pagination -->
                <div class="d-flex justify-content-center mt-5">
                    
                </div> --}}
            </div>
        </div>
    </div>
</div>
<!-- Medicine Shop End -->

@endsection

<div class="container mt-4">
    @yield('footer')
</div>

<!-- Add Custom CSS -->
<style>
    /* Product Card Hover Effect */
    .product-card {
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    /* Custom hover effect for category list items */
    .category-item:hover {
        background-color: #f8f9fa; /* Light grey background on hover */
        cursor: pointer; /* Change cursor to pointer */
        transition: background-color 0.3s ease; /* Smooth transition */
    }

    .category-link {
        transition: all 0.3s ease;
    }

    .category-link:hover {
        color: #007bff;  /* Change color on hover */
        text-decoration: underline; /* Add underline on hover */
    }
</style>


