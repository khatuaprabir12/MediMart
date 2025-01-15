<x-adminheader />
    <!-- Main Content -->
    
                 <!-- Added margin start -->
                 <div class="container ">
              <h1 class="mb-4">All Orders</h1>

              @if($orders->isEmpty())
                  <div class="alert alert-warning" role="alert">
                      No orders found. Please check back later.
                  </div>
              @else
                  <div class="table-responsive">
                      <table class="table table-striped table-bordered">
                          <thead class="table-dark">
                              <tr>
                                  <th>#</th>
                                  <th>User</th>
                                  <th>Address</th>
                                  <th>Payment Method</th>
                                  <th>Subtotal</th>
                                  <th>Tax</th>
                                  <th>Total</th>
                                  <th>Actions</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach($orders as $order)
                                  <tr>
                                      <td>{{ $order->id }}</td>
                                      <td>{{ $order->user_name }}</td>
                                      <td>{{ $order->address }}</td>
                                      <td>{{ $order->payment_method }}</td>
                                      <td>₹{{ number_format($order->subtotal, 2) }}</td>
                                      <td>₹{{ number_format($order->tax, 2) }}</td>
                                      <td>₹{{ number_format($order->total, 2) }}</td>
                                      <td>
                                          <a href="{{ route('admin.orders.details', $order->id) }}" class="btn btn-info btn-sm">
                                              <i class="fas fa-eye"></i> View Details
                                          </a>
                                      </td>
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
              @endif
            </div>
          </div>
       
          <x-adminfooter />
