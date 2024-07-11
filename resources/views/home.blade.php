<x-user-layout>
    <!-- Hero Section -->
    <div class="position-relative bg-body-tertiary " style="min-height: 60vh;width:100vw">
        <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(58, 201, 209, 0.6), rgba(128, 0, 128, 0.6)); z-index: 1;"></div>
        <div class=" position-relative  text-white d-flex align-items-center  h-100 w-100" style="z-index: 2;">
            <div class="row w-100" >
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="col-12 col-md-6 d-flex justify-content-center align-items-center py-5 h-100">
                    <div class="">
                        <h1>Welcome to Coding Diary</h1>
                        <a href="{{route('account.blog')}}" class="btn bg-danger-subtle bg-opacity-50 mt-3">Get Started</a>
                    </div>
                </div>
                <div class="col-12 col-md-6 d-flex justify-content-center align-items-center py-5">
                    <p>Your go-to place for coding tips, tutorials, and insights.</p>
                </div>
            </div>
        </div>
    </div>



        <!-- About Section -->
        <div class="about-section py-5">
            <div class="container">
                <div class="text-center mb-5">
                    <h1>About Coding Diary</h1>
                    <p class="lead">Discover more about our mission, offerings, and how to connect with us.</p>
                </div>
                <div class="row g-4">
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card p-4 h-100 shadow-sm" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); border: none; border-radius: 10px;">
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-flag-fill me-2 text-primary" style="font-size: 2rem;"></i>
                                <h2 class="h5 mb-0">Our Mission</h2>
                            </div>
                            <p>At Coding Diary, our mission is to make learning to code accessible and enjoyable for everyone. Whether you're a beginner looking to start your coding journey or an experienced developer seeking advanced techniques, we've got you covered.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card p-4 h-100 shadow-sm" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); border: none; border-radius: 10px;">
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-box-seam me-2 text-success" style="font-size: 2rem;"></i>
                                <h2 class="h5 mb-0">What We Offer</h2>
                            </div>
                            <p>Explore a variety of topics including web development, software engineering, programming languages, and more. Our comprehensive guides, tutorials, and real-world examples empower you to build practical skills and apply them in your projects.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card p-4 h-100 shadow-sm" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); border: none; border-radius: 10px;">
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-people-fill me-2 text-warning" style="font-size: 2rem;"></i>
                                <h2 class="h5 mb-0">Connect With Us</h2>
                            </div>
                            <p>Join our community by subscribing to our newsletter for updates on new articles, tips, and exclusive content. Follow us on social media for daily insights and interact with fellow developers.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card p-4 h-100 shadow-sm" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); border: none; border-radius: 10px;">
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-envelope-fill me-2 text-danger" style="font-size: 2rem;"></i>
                                <h2 class="h5 mb-0">Contact Us</h2>
                            </div>
                            <p>Have questions, suggestions, or feedback? We'd love to hear from you! Reach out to us at <a href="mailto:contact@codingdiary.com">contact@codingdiary.com</a> or connect with us on <a href="https://twitter.com/codingdiary" target="_blank">Twitter</a>, <a href="https://facebook.com/codingdiary" target="_blank">Facebook</a>, and <a href="https://instagram.com/codingdiary" target="_blank">Instagram</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    

    
</x-user-layout>
