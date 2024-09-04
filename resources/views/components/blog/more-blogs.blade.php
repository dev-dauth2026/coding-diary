<section class="container">
    <div class="row ">

        <h3 class="text-center mb-4">More Recent Blogs</h3>
        <hr class="col-4 mb-5 mx-auto">
            <!-- Carousel for blogs -->
        <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner  ">
                @foreach ($posts as $index =>$blogPost)
                <div class="carousel-item {{$index == 0?'active':''}}" >
                    <div class="d-flex justify-content-center w-100">
                        <div class="col-md-4 mb-4">
                            <a class="text-decoration-none" href="{{ route('blog.detail', $blogPost->id) }}" >
                                <div class="card h-100  shadow">
                                    <img src="{{asset('storage/' . $blogPost->image)  }}" class="card-img-top self-auto" alt="{{ $blogPost->title }}" style="height: 200px;width:auto;">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $blogPost->title }}</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
    
                </div>
                @endforeach
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
