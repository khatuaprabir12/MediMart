@extends('main')
@section('title', 'Register Page')
@section('content')
<style>
    body {
    background: linear-gradient(to bottom, #a8e6cf, #dcedc1, #ffd3b6, #ffaaa5);
    font-family: 'Poppins', sans-serif;
}

.card {
    background: #a997af;
    border-radius: 15px;
    border: none;
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
}

.card-body {
    padding: 30px;
}

h2 {
    font-size: 2.5rem;
    font-weight: 700;
}

input::placeholder {
    font-style: italic;
    color: #888;
}

input[type="file"] {
    border: 1px solid #ccc;
    padding: 5px;
    border-radius: 25px;
    cursor: pointer;
}

button:hover {
    transform: scale(1.05);
    transition: all 0.3s ease;
}

.modal-header {
    border-bottom: none;
}

</style>
@if(session('message'))
<script>
    alert("{{ session('message') }}");
</script>
@endif
<div class="container mt-5 pt-5">
    <div class="row justify-content-center">
        <h2 class="text-center mb-4 text-info fw-bold">User Registration Form</h2>
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    <form action="{{ url('/signup') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label text-dark fw-semibold">Name</label>
                            <input type="text" class="form-control form-control-md rounded-pill shadow-sm" id="name" name="name" placeholder="Enter your name" required>
                            @error('name')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label text-dark fw-semibold">Email</label>
                            <input type="email" class="form-control form-control-md rounded-pill shadow-sm" id="email" name="email" placeholder="Enter your email" required>
                            @error('email')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Phone -->
                        <div class="mb-4">
                            <label for="phone" class="form-label text-dark fw-semibold">Phone</label>
                            <input type="tel" class="form-control form-control-md rounded-pill shadow-sm" id="phone" name="phone" placeholder="Enter your phone number" required>
                            @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="form-label text-dark fw-semibold">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control form-control-md rounded-pill shadow-sm" id="password" name="password" placeholder="Enter your password" required>
                                <button type="button" class="btn btn-outline-dark rounded-pill ms-2" onclick="togglePassword('password')">
                                    <i class="bi bi-eye" id="togglePasswordIcon-password"></i>
                                </button>
                                @error('password')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label text-dark fw-semibold">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control form-control-md rounded-pill shadow-sm" id="password_confirmation" name="conf_password" placeholder="Confirm your password" required>
                                <button type="button" class="btn btn-outline-dark rounded-pill ms-2" onclick="togglePassword('password_confirmation')">
                                    <i class="bi bi-eye" id="togglePasswordIcon-password_confirmation"></i>
                                </button>
                            </div>
                        </div>
                        <!-- Image Upload -->
                        <div class="mb-4">
                            <label for="image" class="form-label text-dark fw-semibold">Profile Image</label>
                            <input type="file" class="form-control form-control-md rounded-pill shadow-sm" id="image" name="image" required>
                            @error('image')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-info btn-lg w-100 rounded-pill shadow-sm text-white fw-bold">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function togglePassword(fieldId) {
        const passwordField = document.getElementById(fieldId);
        const toggleIcon = document.getElementById(`togglePasswordIcon-${fieldId}`);
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            toggleIcon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            passwordField.type = 'password';
            toggleIcon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }
</script>
@endsection
