@extends('main')

@section('title', 'About Us')

@section('content')
<div class="py-5">
<div class="container-fluid bg-light py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-4 text-dark fw-bold">About <span class="text-danger display-4">Medi</span><span class="text-info display-5">Mart</span></h1>
            <p class="lead text-muted">
                Your trusted partner in health and wellness, providing high-quality healthcare products and services to improve your life.
            </p>
        </div>
        <div class="row g-5">
            <!-- Mission Section -->
            <div class="col-lg-6">
                <h2 class="text-dark fw-bold">Our Mission</h2>
                <p class="text-muted">
                    At MediMart, our mission is to make healthcare accessible, reliable, and affordable for everyone. 
                    We are dedicated to offering a wide range of medicines, health supplements, and wellness products to cater to all your needs.
                </p>
                <p class="text-muted">
                    With a commitment to excellence, we ensure every product we offer meets the highest standards of quality and authenticity.
                </p>
            </div>

            <!-- Vision Section -->
            <div class="col-lg-6">
                <h2 class="text-dark fw-bold">Our Vision</h2>
                <p class="text-muted">
                    We envision a world where quality healthcare is available at the click of a button. 
                    MediMart strives to be the leading platform for healthcare solutions, trusted by millions.
                </p>
                <p class="text-muted">
                    Our innovative approach combines convenience with reliability, ensuring you get the care you deserve anytime, anywhere.
                </p>
            </div>
        </div>

        <hr class="my-5">

        <!-- Values Section -->
        <div class="text-center mb-5">
            <h2 class="text-dark fw-bold">Our Core Values</h2>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 text-center">
                <div class="p-4 bg-white rounded shadow-sm">
                    <i class="fas fa-heartbeat fa-3x text-danger mb-3"></i>
                    <h5 class="text-danger fw-bold">Compassion</h5>
                    <p class="text-muted">We care deeply about your health and well-being.</p>
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <div class="p-4 bg-white rounded shadow-sm">
                    <i class="fas fa-certificate fa-3x text-warning mb-3"></i>
                    <h5 class="text-warning fw-bold">Integrity</h5>
                    <p class="text-muted">We uphold the highest standards of honesty and transparency.</p>
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <div class="p-4 bg-white rounded shadow-sm">
                    <i class="fas fa-shield-alt fa-3x text-success mb-3"></i>
                    <h5 class="text-success fw-bold">Reliability</h5>
                    <p class="text-muted">Count on us for authentic products and timely service.</p>
                </div>
            </div>
        </div>

        <hr class="my-5">

        <!-- Call to Action -->
        <div class="text-center">
            <h3 class="text-success fw-bold">Have Questions or Need Assistance?</h3>
            <p class="text-muted">Our team is here to help you with any inquiries or support you need.</p>
            <a class="btn btn-info btn-lg text-white" href="{{ route('contact') }}">Contact Us</a>
        </div>
    </div>
</div>
</div>
@endsection
