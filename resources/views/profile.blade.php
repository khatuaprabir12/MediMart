@extends('main')

@section('content')
@if(session('message'))
<script>
    alert("{{ session('message') }}");
</script>
@endif
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 p-5">
            <div class="card">
                <div class="card-header text-center bg-info text-white">
                    <h3>Your Profile</h3>
                </div>
                
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="{{ $users->profile_image }}" alt="Profile Image" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>Name:</strong> {{ $users->name }}
                        </li>
                        <li class="list-group-item">
                            <strong>Email:</strong> {{ $users->email }}
                        </li>
                        <li class="list-group-item">
                            <strong>Joined On:</strong> {{ $users->created_at }}
                        </li>
                    </ul>
                    <div class="text-center mt-4">
                        <!-- Edit Profile Button -->
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                            <i class="fas fa-edit"></i> Edit Profile
                        </button>
                        <!-- Change Password Button -->
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                            <i class="fas fa-key"></i> Change Password
                        </button>
                        <a href="" class="btn btn-danger" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Edit Profile -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('updateProfile') }}" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name='uid' value="{{$users->id}}">
          <div class="form-group">
            <label for="image">Profile Image</label>
            <input type="file" name="image" id="image" class="form-control" ><img src="{{ $users->profile_image }}" alt="Profile Image" class="img-fluid rounded-circle" style="width: 100px; height: 100px;">
          </div>
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $users->name }}" required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $users->email }}" required>
          </div>
          <div class="form-group">
            <label for="phone">Phone</label>
            <input type="number" name="phone" id="phone" class="form-control" value="{{ $users->phone }}" required>
          </div>
          <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary">Update Profile</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Modal for Change Password -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Display Alert Message -->
        @if(session('message'))
          <div class="alert alert-danger">
            {{ session('message') }}
          </div>
        @endif

        <form action="{{ route('changepass.submit') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="current_password">Current Password</label>
            <input type="password" name="current_password" id="current_password" class="form-control" required>
          </div>
          <div class="form-group mt-3">
            <label for="new_password">New Password</label>
            <input type="password" name="new_password" id="new_password" class="form-control" required>
          </div>
          <div class="form-group mt-3">
            <label for="new_password_confirmation">Confirm New Password</label>
            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
          </div>
          <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary">Change Password</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Automatically Show Modal if Message Exists -->
<script>
  @if(session('message'))
    var changePasswordModal = new bootstrap.Modal(document.getElementById('changePasswordModal'));
    changePasswordModal.show();
  @endif
</script>



@endsection
