{{-- @extends('main')

@section('content')
<div class="container mt-5 p-5">
    <h1>Checkout</h1>

    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea name="address" id="address" class="form-control" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="payment_method" class="form-label">Payment Method</label>
            <select name="payment_method" id="payment_method" class="form-select" required>
                <option value="credit_card">Credit Card</option>
                <option value="paypal">PayPal</option>
            </select>
        </div>

        <h4>Order Summary</h4>
        <p>Subtotal: ₹{{ number_format($subtotal, 2) }}</p>
        <p>Tax (10%): ₹{{ number_format($tax, 2) }}</p>
        <p><strong>Total: ₹{{ number_format($total, 2) }}</strong></p>

        <button type="submit" class="btn btn-primary">Place Order</button>
    </form>
</div>
@endsection --}}
