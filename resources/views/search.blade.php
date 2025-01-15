
@extends('main')

@section('content')
<div class="p-5">
    <div class="container p-5">
        <h2 class="mt-4">Search Results for "{{ $query }}"</h2>

        @if($products->isEmpty())
            <p class="text-muted">No products found.</p>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td><img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="70" height="70"></td>
                            <td>{{ $product->name }}</td>
                            <td><strong>₹{{ $product->price }}</strong></td>
                            <td>
                                <a href="{{ route('mycart', ['product_id' => $product->id]) }}" class="btn btn-info btn-sm">Add to Cart</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
<div class="d-flex justify-content-center mt-4">
    <button class="btn btn-info">
        <a href="{{ route('home') }}" class="text-white text-decoration-none">Back</a>
    </button>
</div>
@endsection


