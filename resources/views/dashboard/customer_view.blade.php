<x-adminheader />

<div class="container mt-5">
    @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Customer List</h2>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($totalUsers as $customer)
                        <tr>
                            <td>{{ $customer->id }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>
                                <img src="{{ $customer->profile_image }}" 
                                     class="img-thumbnail" 
                                     width="70" 
                                     height="70" 
                                     alt="Profile Image">
                            </td>
                            <td>
                                <a href="{{ url('/admin/customers/block/' . $customer->id) }}" 
                                   class="btn btn-warning btn-sm">Block</a>
                                <a href="{{ url('/admin/customers/unblock/' . $customer->id) }}" 
                                   class="btn btn-success btn-sm">Unblock</a>
                                <a href="{{ url('/admin/customers/delete/' . $customer->id) }}" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Are you sure you want to delete this customer?');">
                                   Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<x-adminfooter />
