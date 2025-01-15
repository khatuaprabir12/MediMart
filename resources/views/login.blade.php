@extends('main')

@section('title', 'Login')

@section('content')
@if(session('message'))
<script>
    alert("{{ session('message') }}");
</script>
@endif
<div class="container mt-5 p-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-info text-light text-center">
                    <h4>Login</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('data_login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="username">User Name</label>
                            <input type="text" name="username" id="email" class="form-control" placeholder="Enter your email or mobile number" required autofocus>
                            @error('username')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                                <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                    <i class="fa fa-eye"></i>
                                </button>
                                @error('password')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" name="remember" id="remember" class="form-check-input">
                            <label for="remember" class="form-check-label">Remember Me</label>
                        </div>
                        <button type="submit" class="btn btn-info btn-block">Login</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a href="" class="text-secondary">Forgot Your Password?</a>
                    <br>
                    <a href="{{ route('register') }}" class="text-secondary">Don't have an account? Register</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('password');
        const icon = this.querySelector('i');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
</script>
@endsection
