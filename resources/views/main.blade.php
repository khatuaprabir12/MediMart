<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Default Title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
       <!-- Google Web Fonts -->
       <link rel="preconnect" href="https://fonts.googleapis.com">
       <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
       <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

       <!-- Icon Font Stylesheet -->
       <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

       <!-- Libraries Stylesheet -->
       <link href="{{asset('lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet">
       <link href="{{asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

      <!-- Customized Bootstrap Stylesheet -->
      <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

      <!-- Template Stylesheet -->
      <link href="{{asset('css/style.css')}}" rel="stylesheet">

      <style>
        /* Style for carousel caption */
.carousel-caption-custom {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    color: white;
}

/* Style for buttons inside carousel */
.btn1 {
    background-color: #28a745; /* Green */
    color: white;
    padding: 10px 20px;
    border: none;
    font-size: 16px;
    border-radius: 5px;
    transition: background-color 0.2s ease;
}

.btn1:hover {
    background-color: #218838; /* Darker green on hover */
}

/* Image styling */
.carousel-item img {
    object-fit: cover; /* Ensures the image covers the space without distortion */
    width: 100%;
    height: 60vh; /* Height adjustment for the carousel images */
}

/* Custom styling for text */
.carousel-caption-custom h2 {
    font-family: 'Arial', sans-serif;
    font-weight: bold;
}

.carousel-caption-custom h2 span {
    font-size: 1.2em;
}

/* Customizing the carousel indicators */
.carousel-indicators li {
    background-color: #28a745;
}

/* Adjusting text sizes */
.carousel-caption-custom h2 {
    font-size: 2.5rem;
    margin: 0;
}

.carousel-caption-custom h2 span {
    font-size: 2.8rem;
    font-weight: bold;
}
.nav-link.active {
    color: #ff6600; /* Active link color */
    font-weight: bold;
}

/* ajax */
.product-item {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 10px;
}

.product-item img {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 5px;
}

.product-item h5 {
    margin: 0;
    font-size: 16px;
}

#searchResults {
    border: 1px solid #ddd;
    padding: 10px;
    background: #fff;
    max-height: 300px;
    overflow-y: auto;
}


      </style>
</head>
    <body>




        {{-- Navbar --}}

        <div class="container-fluid fixed-top border border-dark border-1">
            <div class="container">
                <nav class="navbar navbar-light bg-white navbar-expand-xl">
                    <a href="" class="navbar-brand">
                        <h1 class="text-info display-6"><span class='text-danger display-5'>Medi</span>Mart</h1>
                    </a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                        <div class="navbar-nav mx-auto">
                            <a href="{{ route('home') }}" class="nav-item nav-link {{ request()->is('home') ? 'active' : '' }}">Home</a>
                            <a href="{{ route('store') }}" class="nav-item nav-link {{ request()->is('store') ? 'active' : '' }}">Store</a>
                            <a href="{{ route('contact') }}" class="nav-item nav-link {{ request()->is('contact') ? 'active' : '' }}">Contact</a>
                            <a href="{{ route('about') }}" class="nav-item nav-link {{ request()->is('about') ? 'active' : '' }}">About Us</a>
                        </div>
                        <div class="d-flex align-items-center">
                            <!-- Search Button -->
                            {{-- <form action="{{ route('search') }}" method="GET" class="d-flex me-4">
                                <input id="searchInput" type="text" name="query" class="form-control form-control-sm" placeholder="Search..." aria-label="Search">
                                <button class="btn btn-info btn-sm ms-2" type="submit">
                                    <i class="fas fa-search text-white"></i>
                                </button>
                            </form>
                            <div id="searchResults" class="mt-3"></div> --}}


                            <form action="{{ route('search') }}" method="GET" class="d-flex me-4">
                                <input 
                                    id="searchInput" 
                                    type="text" 
                                    name="query" 
                                    class="form-control form-control-sm" 
                                    placeholder="Search for products..." 
                                    aria-label="Search"
                                    value="{{ request('query') }}" <!-- Preserve the query after submission -->
                                
                                <button class="btn btn-info btn-sm ms-2" type="submit">
                                    <i class="fas fa-search text-white"></i>
                                </button>
                            </form>
                            




                            <!-- Cart Icon -->
                            <a href="{{ route('view.cart') }}" class="position-relative me-4 my-auto">
                                <i class="fa fa-shopping-bag fa-2x" style="color: #ff6600;"></i>
                                <span id="bag" class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">
                                    1
                                </span>
                            </a>
        
                            @if(session()->has('session_id'))
                                @php
                                    $userId = session()->get('session_id');
                                    $user = DB::table('users')->where('id', $userId)->first();
                                @endphp
        
                                <!-- User Info -->
                                <div class="nav-item dropdown">
                                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="{{ asset($user->profile_image ?? 'default-user.png') }}" alt="User Image" class="rounded-circle me-2" width="40" height="40">
                                        <span class="text-dark">{{ $user->name }}</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                                    </div>
                                </div>
                            @else
                                <!-- Login and Signup Buttons -->
                                <a href="{{ route('login') }}" class="btn btn-outline-info me-2">Login</a>
                                <a href="{{ route('register') }}" class="btn btn-info text-white">Signup</a>
                            @endif
                        </div>
        
                    </div>
                </nav>
            </div>
        </div>
        
        <!-- Navbar End -->
        <div class="bgcolor">
            @yield('content')
            @include('footer')
        </div>
        


        {{-- ajax --}}
        <script>
            // $(document).ready(function () {
            //     $('#searchInput').on('keyup', function () {
            //         // let query = $(this).val();
        
            //         if (query.length > 2) {
            //             $('#searchResults').html('<p>Loading...</p>'); // Loading feedback
            //             $.ajax({
            //                 url: "{{ route('search') }}",
            //                 method: "GET",
            //                 data: {},
            //                 success: function (data) {
            //                     if (data.length > 0) {
            //                         let resultsHtml = data.map(product => `
            //                             <div class="product-item">
            //                                 <img src="${product.image}" alt="${product.name}" class="img-fluid">
            //                                 <h5>${product.name}</h5>
            //                                 <p><strong>$${product.price}</strong></p>
            //                             </div>
            //                         `).join('');
            //                         $('#searchResults').html(resultsHtml);
            //                     } else {
            //                         $('#searchResults').html('<p>No products found.</p>');
            //                     }
            //                 },
            //                 error: function () {
            //                     $('#searchResults').html('<p>Error loading results. Please try again.</p>');
            //                 }
            //             });
            //         } else {
            //             $('#searchResults').html('');
            //         }
            //     });
            // });
            
        </script>
        

        
      
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-ppYYX3Q4kz0ujlHjhkB8pjmQURpQ4wNRvvslMgy/IKp00glYiWwMzz8s1RG9IFWl" crossorigin="anonymous"></script>
    <!-- Include jQuery (if not already included) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="lib/easing/easing.min.js"></script>
    <script src="{{asset('lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('lib/lightbox/js/lightbox.min.js')}}"></script>
    <script src="{{asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>
</body>
</html>
