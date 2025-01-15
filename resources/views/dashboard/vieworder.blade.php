<x-adminheader />
 

    <div class="container ">
        <h1>Order Details</h1>
    
        <div class="mb-4">
            <h5>Order ID: {{ $order->id }}</h5>
            <p><strong>Name:</strong> {{ $order->name }}</p>
            <p><strong>Address:</strong> {{ $order->address }}</p>
            <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
            <p><strong>Subtotal:</strong> ₹{{ number_format($order->subtotal, 2) }}</p>
            <p><strong>Tax:</strong> ₹{{ number_format($order->tax, 2) }}</p>
            <p><strong>Total:</strong> ₹{{ number_format($order->total, 2) }}</p>
            <p><strong>Created At:</strong> {{ $order->created_at }}</p>
        </div>
    
        <h3>Order Items</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderItems as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>₹{{ number_format($item->product_price, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>₹{{ number_format($item->total_price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
<x-adminfooter />
