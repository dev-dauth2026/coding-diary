<x-user-layout>

    <!-- Additional Styles -->
    <style>
        .bg-gradient {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        .bg-glass {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
        }

        .btn-link {
            color: #5a5a5a;
            text-decoration: underline;
        }

        .btn-link:hover {
            color: #333;
        }
    </style>
    <!-- Main Content Wrapper -->
    <div class="bg-gradient min-vh-100 d-flex flex-column justify-content-center py-5">
        <div class="container-lg container-fluid- py-5">
            <div class="row justify-content-center">
                <!-- Blog Listing Section -->
                <div class="col-lg-12 col-12">
                  
                        <!-- Page Header -->
                        <div class="d-flex flex-column align-items-center mb-4">
                            <h2 class="text-center text-dark fw-bold mb-2">
                                @if(empty($query))
                                    <i class="fas fa-blog me-2"></i>All Blogs
                                @else
                                    <i class="fas fa-search me-2"></i>Search Results
                                @endif
                            </h2>
                            <hr class="col-12 col-lg-2 col-md-5 col-sm-10 mx-auto mb-4 bg-dark">
                        </div>

                        <!-- Search Form -->
                        <form action="{{ route('blog.search') }}" method="get" class="mb-4">
                            <div class="input-group gap-2">
                                <input type="text" class="form-control  bg-light rounded-pill py-2 px-4 shadow-sm @error('blogSearch') is-invalid @enderror text-dark" placeholder="Search blog topics..." name="blogSearch" id="blogSearch" value="{{ old('blogSearch', $query ?? '') }}" aria-label="Search blogs">
                                <button class="btn btn-outline-secondary bg-info-gradient rounded-pill px-4 d-md-block d-none" type="submit"><i class="fas fa-search"></i> Search</button>
                                @error('blogSearch')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            @if (!empty($query))
                                <div class="text-center mt-2">
                                    <a href="{{ route('account.blog.all') }}" class="btn btn-link text-decoration-none text-secondary">Clear All Filters</a>
                                </div>
                            @endif
                        </form>

                        <!-- Featured Blogs Section -->
                        @if(empty($query))
                            <div class="mb-5 bg-info-gradient shadow-lg rounded p-lg-5 p-2">
                                <h4 class="text-white fw-bold"><i class="fas fa-star me-2"></i>Featured Blogs</h4>
                                <hr class="col-3 mb-4">
                                <div class=" d-flex flex-row flex-wrap gap-4 justify-content-around">
                                    @foreach($featured_posts as $featured)
                                        <div class=" ">
                                            <div class="card bg-glass border-0 shadow-lg" style="width:300px;">
                                                <img src="{{ asset('storage/' . $featured->image) }}" class="card-img-top  rounded-top" alt="{{ $featured->title }}">
                                                <div class="card-body">
                                                    <a href="{{ route('blog.detail', $featured->id) }}" class="text-decoration-none text-dark">
                                                        <h6 class="card-title mb-2">{{ $featured->title }}</h6>
                                                        <div class="d-flex">
                                                            <p class="card-text text-muted mb-1"><small>{{ $featured->created_at->format('M d, Y') }}</small></p>
                                                            <p class="card-text mb-0"><small>By {{ $featured->author->name ?: 'N/A' }}</small></p>
                                                        </div>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Blog List -->
                        @forelse ($posts as $post)
                            <div class="card mb-3 bg-glass border-0 shadow-sm">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid w-100 rounded-start" alt="{{ $post->title }}">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <a href="{{ route('blog.detail', $post->id) }}" class="text-decoration-none text-dark">
                                                <h5 class="card-title mb-2">{{ $post->title }}</h5>
                                                <p class="card-text text-muted mb-1"><small>{{ $post->created_at->format('M d, Y') }}</small></p>
                                                <p class="card-text mb-0"><small>By {{ $post->author->name ?: 'N/A' }}</small></p>
                                                <p class="card-text mt-2">{{ Str::limit(strip_tags($post->content), 100) }}...</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-white fs-5">No blogs found. Try searching with different keywords.</p>
                        @endforelse

                        <!-- Pagination Links -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $posts->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    
                </div>
            </div>
        </div>
    </div>

</x-user-layout>
