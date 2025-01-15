@extends('main')
@section('title','Cart_list')
@section('content')
<div class="container py-5 border border-dark border-2">
    <div class="container mt-5 p-5 ">
        <h1>Your Cart</h1>

        @if(session('message'))
        <script>
            alert("{{ session('message') }}");
        </script>
        @endif

        @if(count($cartItems) > 0)
            <table class="table-border table table-striped">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td>₹<span class="item-price">{{ number_format($item->product_price, 2) }}</span></td>
                            <td>
                                <input type="number" name="quantities[{{ $item->product_id }}]" value="{{ $item->quantity }}" min="1" class="quantity-input form-control" style="width: 80px;">
                            </td>
                            <td class="item-total">₹{{ number_format($item->product_price * $item->quantity, 2) }}</td>
                            <td>
                                <form action="{{ route('remove.from.cart', $item->product_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Cart Summary -->
            <div class="mt-4">
                <p><strong>Subtotal:</strong> ₹<span id="subtotal">0.00</span></p>
                <p><strong>Tax (10%):</strong> ₹<span id="tax">0.00</span></p>
                <p><strong>Shipping:</strong> ₹<span id="shipping">50.00</span></p>
                <p><strong>Total:</strong> ₹<span id="total">0.00</span></p>
                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#checkoutModal">Proceed to Checkout</button>
            </div>
        @else
            <p class='border border-2'><span class='display-5 text-danger fw-bold'>Your cart is empty. </span><a href="{{ route('store') }}">Browse products</a></p>
        @endif
    </div>

    <!-- Checkout Modal -->
    <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="checkoutModalLabel">Checkout</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Payment Method</label>
                            <select class="form-select" id="payment_method" name="payment_method" required>
                                <option value="Credit Card">Credit Card</option>
                                <option value="Debit Card">Debit Card</option>
                                <option value="Cash on Delivery">Cash on Delivery</option>
                                <option value="UPI">UPI</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Confirm Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Calculate and update totals
        function updateTotals() {
            let subtotal = 0;
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const price = parseFloat(row.querySelector('.item-price').textContent.replace('₹', '').trim());
                const quantity = parseInt(row.querySelector('.quantity-input').value);
                const itemTotal = price * quantity;

                row.querySelector('.item-total').textContent = '₹' + itemTotal.toFixed(2);
                subtotal += itemTotal;
            });

            const tax = subtotal * 0.10; // 10% tax
            const shipping = 50.00; // Flat shipping charge
            const total = subtotal + tax + shipping;

            document.getElementById('subtotal').textContent = subtotal.toFixed(2);
            document.getElementById('tax').textContent = tax.toFixed(2);
            document.getElementById('shipping').textContent = shipping.toFixed(2);
            document.getElementById('total').textContent = total.toFixed(2);
        }

        // Add event listener to quantity inputs
        const quantityInputs = document.querySelectorAll('.quantity-input');
        quantityInputs.forEach(input => {
            input.addEventListener('input', updateTotals);
        });

        // Initial calculation
        updateTotals();
    });
    document.querySelectorAll('.quantity-input').forEach(input => {
    input.addEventListener('change', function () {
        const productId = this.name.match(/\d+/)[0];
        const quantity = this.value;

        fetch("{{ route('cart.update.quantity') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: JSON.stringify({ product_id: productId, quantity })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                location.reload(); // Optional: Recalculate totals dynamically instead
            } else {
                alert(data.message || 'Error updating quantity.');
            }
        })
        .catch(error => console.error('Error:', error));
    });
});


    
</script>

@endsection
