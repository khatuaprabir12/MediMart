<x-adminheader />

<div class="container py-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    {{-- Admin Image --}}
                    {{-- Uncomment and replace with your logic for displaying the image --}}
                    <img src="{{ $admin->profile_image ?? asset('default-avatar.png') }}" 
                         class="rounded-circle mb-3" 
                         alt="Admin Image" 
                         style="width: 150px; height: 150px;">
                    <h4>{{ $admin->name }}</h4>
                    <p class="text-muted">{{ $admin->email }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Profile Details</h5>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Name:</strong> {{ $admin->name }}</li>
                        <li class="list-group-item"><strong>Email:</strong> {{ $admin->email }}</li>
                        <li class="list-group-item"><strong>Role:</strong> Admin</li>
                        <li class="list-group-item"><strong>Joined At:</strong> {{ $admin->created_at }}</li>
                        <li class="list-group-item"><strong>Last Updated:</strong> {{ $admin->updated_at }}</li>
                    </ul>
                    <!-- Edit Profile Button -->
                    <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        Edit Profile
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $admin->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $admin->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="profile_image" class="form-label">Profile Image</label>
                        <input type="file" name="profile_image" id="profile_image" class="form-control">
                        <img src="{{ $admin->profile_image }}" alt="Profile Image" class="img-fluid rounded-circle" style="width: 70px; height: 70px;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<x-adminfooter />
