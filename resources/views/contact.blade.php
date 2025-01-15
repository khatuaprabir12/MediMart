@extends('main')

@section('title', 'Contact Us')

@section('content')
<div class="jumbotron">
    <!-- Contact Start -->
    <div class="container-fluid contact py-5">
        <div class="container py-5">
            <div class="p-5 bg-light rounded shadow-sm">
                <div class="row g-4">
                    <!-- Header Section -->
                    <div class="col-12">
                        <div class="text-center mx-auto" style="max-width: 700px;">
                            <h1 class="text-info">Get in Touch</h1>
                            <p class="mb-4">
                                We’re here to help! Reach out for inquiries, support, or feedback, and we’ll get back to you as soon as possible.
                            </p>
                        </div>
                    </div>

                    <!-- Google Maps Embed -->
                    <div class="col-lg-12">
                        <div class="h-100 rounded overflow-hidden">
                            <iframe class="rounded w-100 border" 
                                style="height: 400px;" 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3334.0801366108653!2d88.43160429999999!3d22.568685499999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a0275ad93c8289b%3A0xc099131033eb5917!2sSDF%20Building%2C%20GP%20Block%2C%20Sector%20V%2C%20Bidhannagar%2C%20Kolkata%2C%20West%20Bengal%20700091!5e1!3m2!1sen!2sin!4v1736365287498!5m2!1sen!2sin" 
                                alt="Google Maps Location"
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="col-lg-7">
                        <form action="" method="POST" class="bg-white p-4 rounded shadow-sm">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Your Name</label>
                                <input type="text" id="name" name="name" class="form-control border-0 shadow-sm py-2" placeholder="Enter your name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Your Email</label>
                                <input type="email" id="email" name="email" class="form-control border-0 shadow-sm py-2" placeholder="Enter your email" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Your Message</label>
                                <textarea id="message" name="message" class="form-control border-0 shadow-sm py-2" rows="5" placeholder="Type your message here" required></textarea>
                            </div>
                            <button class="btn btn-info w-100 py-2 shadow-sm" type="submit">Submit</button>
                        </form>
                    </div>

                    <!-- Contact Details -->
                    <div class="col-lg-5">
                        <div class="d-flex p-4 rounded mb-4 bg-white shadow-sm align-items-center">
                            <i class="fas fa-map-marker-alt fa-2x text-info me-4"></i>
                            <div>
                                <h5 class="mb-1">Address</h5>
                                <p class="mb-0">Address:GP Block, Sector V, Bidhannagar, Kolkata, West Bengal 700091</p>
                            </div>
                        </div>
                        <div class="d-flex p-4 rounded mb-4 bg-white shadow-sm align-items-center">
                            <i class="fas fa-envelope fa-2x text-info me-4"></i>
                            <div>
                                <h5 class="mb-1">Mail Us</h5>
                                <p class="mb-0">medimart@gmail.com</p>
                            </div>
                        </div>
                        <div class="d-flex p-4 rounded bg-white shadow-sm align-items-center">
                            <i class="fa fa-phone-alt fa-2x text-info me-4"></i>
                            <div>
                                <h5 class="mb-1">Phone</h5>
                                <p class="mb-0">+919589456625</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
</div>
@endsection
