<x-user-layout>
    <style>
        /* Styles for wavy bottom overlay */
        .wavy-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            overflow: hidden;
        }

        .wavy-overlay::before {
            content: '';
            position: absolute;
            bottom: -20%;
            left: 0;
            width: 100%;
            height: 120%;

            animation: wave-animation 1s infinite linear;
        }

  
    </style>

    <!-- Hero Section -->
    <div class="position-relative bg-body-tertiary " style="min-height: 60vh;width:100vw">
        <div class="wavy-overlay overlay position-absolute top-0 start-0 w-100 h-100 " style="background: linear-gradient(135deg, rgba(58, 201, 209, 0.6), rgba(128, 0, 128, 0.6)); z-index: 1; border-radius: 0% 0% 30% 60% / 0% 0% 30% 60%"></div>
        <div class=" position-relative  text-white d-flex  align-items-center  h-100 w-100" style="z-index: 2;">
            <div class=" w-100 " >
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @if (session('subscribed'))
                <div class="alert alert-success" role="alert">
                    {{ session('subscribed') }}
                </div>
                  @endif
                <div class="col-12 col-md-6 d-flex justify-content-center align-items-center py-5 h-100">
                    <div class="">
                        <h1>Welcome to Coding Diary</h1>
                        <hr class="col-12 mx-auto">
                        <a href="{{route('account.blog')}}" class="btn btn-outline-secondary  mt-3">Get Started</a>
                    </div>
                </div>
                <div class="col-12 col-md-6 d-flex justify-content-center align-items-center py-5">
                    <p>Your go-to place for coding tips, tutorials, and insights.</p>
                </div>
            </div>
        </div>
    </div>



    <section class="about-section my-5 py-5 bg-light">
        <div class="container my-5">
            <div class="text-center mb-5">
                <h1 class="fw-bold text-info text-opacity-7">About Coding Diary</h1>
                <hr class="col-4 mx-auto mb-4">
                <p class="lead text-secondary">Discover more about our mission, offerings, and how to connect with us.</p>
            </div>
            <div class="row g-4 my-5 justify-content-center">
                <div class="col-12 col-md-8 col-lg-4">
                    <div class="card p-4 h-100 shadow-lg" style="background: linear-gradient(120deg, #6a85b6 0%, #bac8e0 100%); border: none; border-radius: 15px;">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-flag-fill me-3 text-primary" style="font-size: 2.5rem;"></i>
                            <h2 class="h5 mb-0">Our Mission</h2>
                        </div>
                        <p>At Coding Diary, our mission is to make learning to code accessible and enjoyable for everyone, from beginners to advanced developers.</p>
                    </div>
                </div>
                <div class="col-12 col-md-8 col-lg-4">
                    <div class="card p-4 h-100 shadow-lg" style="background: linear-gradient(120deg, #a1c4fd 0%, #c2e9fb 100%); border: none; border-radius: 15px;">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-box-seam me-3 text-success" style="font-size: 2.5rem;"></i>
                            <h2 class="h5 mb-0">What We Offer</h2>
                        </div>
                        <p>Explore a variety of topics including web development, software engineering, and programming languages through our guides and tutorials.</p>
                    </div>
                </div>
                <div class="col-12 col-md-8 col-lg-4">
                    <div class="card p-4 h-100 shadow-lg" style="background: linear-gradient(120deg, #fbc2eb 0%, #a6c1ee 100%); border: none; border-radius: 15px;">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-people-fill me-3 text-warning" style="font-size: 2.5rem;"></i>
                            <h2 class="h5 mb-0">Connect With Us</h2>
                        </div>
                        <p>Join our community by subscribing to our newsletter for updates and follow us on social media for daily insights and interactions.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
<section class="testimonial-section py-5 ">
    <div class="container">
        <h2 class="text-center text-info text-opacity-70">What People Are Saying</h2>
        <hr class="col-4 mx-auto mb-4">
        <p class="text-center text-secondary mb-4">Hear from our users and how Coding Diary has helped them in their coding journey.</p>
        
        <!-- Carousel for testimonials -->
        <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner  ">
                <div class="carousel-item active" >
                    <div class="d-flex justify-content-center w-100">
                        <div class="testimonial d-flex flex-column align-items-center text-center bg-secondary bg-opacity-10 p-5 rounded-5" style="height: auto; width:400px">
                            <img src="{{asset('storage/profile_picture/menprofile1.jpg')}}" alt="User Image" class="rounded-circle mb-3" style="width: 100px; height: 100px;">
                            <blockquote class="blockquote">
                                <p class="mb-0">"Coding Diary has been instrumental in refining my coding skills with its clear, concise tutorials and examples."</p>
                            </blockquote>
                            <footer class="blockquote-footer">Jane Doe, <cite title="Company Name">Developer at Tech Co.</cite></footer>
                        </div>
                    </div>
                  
                   
                </div>
                <div class="carousel-item" >
                    <div class="d-flex justify-content-center w-100">
                        <div class="testimonial d-flex flex-column align-items-center text-center bg-secondary bg-opacity-10 p-5 rounded-5" style="height: auto; width:400px">
                            <img src="{{asset('storage/profile_picture/profile2.jpg')}}" alt="User Image" class="rounded-circle mb-3" style="width: 100px; height: 100px;">
                            <blockquote class="blockquote">
                                <p class="mb-0">"Coding Diary has been instrumental in refining my coding skills with its clear, concise tutorials and examples."</p>
                            </blockquote>
                            <footer class="blockquote-footer">Jane Doe, <cite title="Company Name">Developer at Tech Co.</cite></footer>
                        </div>
                    </div>
                  
                   
                </div>
                <div class="carousel-item  " >
                    <div class="d-flex justify-content-center w-100">
                        <div class="testimonial d-flex flex-column align-items-center text-center  bg-secondary bg-opacity-10 p-5 rounded-5" style="height: auto; width:400px">
                            <img src="{{asset('storage/profile_picture/profile3.jpg')}}" alt="User Image" class="rounded-circle mb-3" style="width: 100px; height: 100px;">
                            <blockquote class="blockquote">
                                <p class="mb-0">"Coding Diary has been instrumental in refining my coding skills with its clear, concise tutorials and examples."</p>
                            </blockquote>
                            <footer class="blockquote-footer">Jane Doe, <cite title="Company Name">Developer at Tech Co.</cite></footer>
                        </div>
                    </div>
                 
                   
                </div>
             
                <!-- Additional testimonial items -->
            </div>
            <a class="carousel-control-prev text-secondary" href="#testimonialCarousel" role="button" data-bs-slide="prev">
                <i class="bi bi-chevron-left" style="font-size: 2rem; color: gray;"></i>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next text-secondary" href="#testimonialCarousel" role="button" data-bs-slide="next">
                <i class="bi bi-chevron-right" style="font-size: 2rem; color: gray;"></i>
                <span class="visually-hidden">Next</span>
            </a>
        </div>

        
    </div>
</section>

    

         <!-- Newsletter Section -->
    <section class="newsletter-section py-5" style="background: linear-gradient(135deg, rgba(58, 201, 209, 0.6), rgba(128, 0, 128, 0.6)); z-index: 1;">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-11">
                    <div class="card shadow p-4" style=" border-radius: 10px;">
                        <h2 class="text-center mb-4">Subscribe to Our Newsletter</h2>
                        <form action="{{route('newsletter.subscription')}}" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Your email address" aria-label="Your email address" aria-describedby="button-addon2">
                                <button class="btn " type="submit" id="button-addon2" style="background: linear-gradient(135deg, rgba(58, 201, 209, 0.6), rgba(128, 0, 128, 0.6)); z-index: 1;">Subscribe</button>
                                @error('email')
                                    <p class="invalid-feedback">{{$message}} </p>
                                @enderror
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    

    
</x-user-layout>
