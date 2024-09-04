<x-user-layout>
    <style>

        .hero-section, .hero-card{
            height: 60vh;
            width: 100vw;
        }
        .hero-card{
            z-index: 2;
        }

        .hero-card{
            height: 
        }
        /* Styles for wavy bottom overlay */
        .wavy-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;

        }

        .wavy-overlay::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(58, 201, 209, 0.6), rgba(128, 0, 128, 0.6)); 
            /* border-radius: 0% 0% 40% 90% / 20% 10% 90% 90%; */
            animation: wave-animation 8s infinite  linear;
        }

        
        @keyframes wave-animation {
            0% {
                border-radius: 0% 0% 20% 90% / 0% 0% 90% 90%;
                
            }
            10% {
                border-radius: 0% 0% 30% 80% / 0% 0% 80% 80%;
            }
            20% {
                border-radius: 0% 0% 40% 70% / 0% 0% 70% 70%;
            }
            30% {
                border-radius: 0% 0% 50% 60% / 0% 0% 60% 60%;
            }
            40% {
                border-radius: 0% 0% 60% 50%/ 0% 0% 55% 50%;
            }
            50% {
                border-radius: 0% 0% 55% 55% / 0% 0% 50% 55%;
            }
            60% {
                border-radius: 0% 0% 50% 60% / 0% 0% 55% 60%;
            }
            70% {
                border-radius: 0% 0% 40% 70% / 0% 0% 60% 70%;
            }
            80% {
                border-radius: 0% 0% 30% 80% / 0% 0% 70% 80%;
            }
            90% {
                border-radius: 0% 0% 25% 85%/ 0% 0% 85% 85%;
            }
            100% {
                border-radius: 0% 0% 20% 90% / 0% 0% 90% 90%;
            }
        }

        @media only screen and (max-width: 650px){
            
            .hero-section, .hero-card{
            height: 40vh;
             }

             .wavy-overlay::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(58, 201, 209, 0.6), rgba(128, 0, 128, 0.6)); 
            /* border-radius: 0% 0% 40% 90% / 20% 10% 90% 90%; */
            animation: wave-animation-sm 8s infinite  linear;
        }

        
        @keyframes wave-animation-sm {
            0% {
                border-radius: 0% 0% 60% 60% / 0% 0% 40% 40%;
                
            }
            50% {
                border-radius: 0% 0% 90% 90% / 0% 0% 30% 80%;
            }

            100% {
                border-radius: 0% 0% 60% 60% / 0% 0% 40% 40%;
            }
          
        }

    
         
        }
      
    </style>

    <!-- Hero Section -->
    <div class="hero-section position-relative  bg-body-tertiary" >
        <div class="wavy-overlay  position-absolute top-0 start-0" ></div>
        <div class="hero-card position-relative text-white d-flex align-items-center " >
            <div class="row justify-content-center   m-0" style="width: 100vw;">
                @if (session('status'))
                    <div class="position-absolute top-0 w-100 alert alert-success p-2 mt-2" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @if (session('message'))
                <div class="position-absolute top-0 w-100 alert alert-success p-2 mt-2" role="alert">
                    {{ session('message') }}
                </div>
                  @endif
                <div class="col-12 col-md-6 col-lg-6 d-flex justify-content-center align-items-center  py-lg-2 py-1 ">
                    <div class="d-flex flex-column gap-3">
                        <h1>Welcome to Coding Diary</h1>
                        <div>
                            <a href="{{route('account.blog')}}" class="btn btn-outline-secondary  mt-3">Get Started</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6  d-flex justify-content-center align-items-center text-white-50  py-lg-2 py-1 ">
                    <p>Your go-to place for coding tips, tutorials, and insights.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Section ends-->

    {{-- About section  --}}
    <section class="about-section   bg-light">
        <div class="container py-5">
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
    {{-- About section ends --}}

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
                        <form action="{{route('subscriptions.subscribe')}}" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', session('subscription_email')) }}" name="email" id="email" placeholder="Your email address" aria-label="Your email address" aria-describedby="button-addon2">
                                <button class="btn " type="submit" id="button-addon2" style="background: linear-gradient(135deg, rgba(58, 201, 209, 0.6), rgba(128, 0, 128, 0.6)); z-index: 1;">Subscribe</button>
                                @error('email')
                                    <p class="invalid-feedback">{{$message}} </p>
                                @enderror
                            </div>
                        </form>
                        @if (session('subscription_email'))
                        <div class="col-md-12 d-flex justify-content-center mt-5">
                            <form id="resend-form" method="POST" action="{{route('verification.resend')}}">
                                @csrf
                                <input type="hidden" id="resend-email" name="email">
                                <button type="button" class="btn btn-outline-warning" onclick="resendVerification()">Resend Verification Email</button>
                            </form>
                        </div>
                        @endif

                    </div>
                   
                </div>

               
            </div>
        </div>
    </section>

    

    
</x-user-layout>

<script>
    function resendVerification() {
        const email = document.getElementById('email').value;
        if (!email) {
            alert('Please enter your email to resend the verification link.');
            return;
        }
        document.getElementById('resend-email').value = email;
        document.getElementById('resend-form').submit();
    }
</script>
