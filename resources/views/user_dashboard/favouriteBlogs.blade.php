<x-user-dashboard-layout>
    <!-- Additional CSS for Hover Effects -->
    <style>
        .hover-card:hover .card-body {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .hover-card .overlay {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            opacity: 0;
            transition: all 1.2s ease;
            border-radius: 0 0 0.25rem 0.25rem; 
        }

        .hover-card:hover .overlay {
            opacity: 1;
        }

        .hover-card .description-overlay {
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        .hover-card:hover .description-overlay {
            opacity: 1;
        }
    </style>
    <main class="container-fluid py-4" style="min-height: 80vh;">
        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show p-2" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Dashboard Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex flex-column">
                <h4>My Favorite Blogs</h4>
                <hr class="col-12 mb-3">
            </div>
            <div class="d-flex align-items-center gap-3">
                <!-- Search Bar -->
                <form method="GET" action="{{ route('account.favourites') }}" class="d-flex align-items-center">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control " placeholder="Search favourites..." style="border-radius: 50px;">
                </form>

                <!-- Sort Options -->
                <form method="GET" action="{{ route('account.favourites') }}">
                    <select name="sort" class="form-select" onchange="this.form.submit()" style="border-radius: 50px;">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                        <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>Title (A-Z)</option>
                        <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>Title (Z-A)</option>
                    </select>
                </form>

                <!-- Reset Filter Button -->
                <a href="{{ route('account.favourites') }}" class="btn btn-outline-secondary " style="border-radius: 50px;">Reset Filter</a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row">
            <!-- Favourites Section -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 mb-4">
                    
                    <div class="card-body">
                        @if($favourites->isEmpty())
                            <div class="text-center my-5">
                                <i class="bi bi-heartbreak display-1 text-muted"></i>
                                <p class="mt-3 text-secondary">You have no favourite blog posts.</p>
                            </div>
                        @else
                            <div class="row g-4">
                                @foreach($favourites as $favourite)
                                    <div class="col-md-6">
                                        <div class="card h-100 shadow-sm border-0 position-relative hover-card">
                                            @if($favourite->post->image)
                                                <div class="card-img-container position-relative">
                                                    <img src="{{ asset('storage/' . $favourite->post->image) }}" class="card-img-top rounded-top" alt="{{ $favourite->post->title }}" style="height: 200px; object-fit: cover;">
                                                    <div class="overlay d-flex flex-column justify-content-center align-items-center">
                                                        <p class="description-overlay text-white text-center mb-3">{{ Str::limit(strip_tags($favourite->post->content), 120) }}</p>
                                                        <a href="{{ route('blog.detail', $favourite->post->id) }}" class="btn btn-light btn-sm text-primary">View Post</a>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="card-body d-flex flex-column">
                                                <h5 class="card-title fw-bold">{{ $favourite->post->title }}</h5>
                                                <div class="mt-2">
                                                    <span class="badge bg-info text-dark">{{ $favourite->post->category->name ?? 'Uncategorized' }}</span>
                                                    <span class="badge bg-secondary">{{ $favourite->post->created_at->format('d M Y') }}</span>
                                                </div>
                                            </div>
                                            <div class="card-footer bg-light border-0 d-flex justify-content-between">
                                                <form id="remove-favourite-form-{{$favourite->id}}" action="{{ route('favourite.remove', $favourite->id) }}" method="POST" onsubmit="return confirmRemoveFavourite(event, {{ $favourite->id }});">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" type="submit" style="border-radius: 20px;">Remove</button>
                                                </form>
                                                <button class="btn btn-outline-success btn-sm" style="border-radius: 20px;">Share</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- Pagination -->
                            <div class="d-flex justify-content-center mt-4">
                                {{ $favourites->links('pagination::bootstrap-5') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Side Widgets Section -->
            <div class="col-lg-4">
                <!-- Recently Watched Blogs -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white">
                        <h4 class=" text-secondary mb-0">Recently Watched Blogs</h4>
                    </div>
                    <div class="card-body">
                        @if($recentlyWatched->isEmpty())
                            <div class="text-center my-3">
                                <i class="bi bi-eye-slash display-1 text-muted"></i>
                                <p class="mt-3 lead">You have not watched any blog posts recently.</p>
                            </div>
                        @else
                            <ul class="list-group list-group-flush">
                                @foreach($recentlyWatched as $post)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>{{ $post->title }}</span>
                                        <a href="{{ route('blog.detail', $post->id) }}" class="btn btn-link text-primary p-0">Read More</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <!-- Recommended Blogs -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white">
                        <h4 class=" text-secondary mb-0">Recommended Blogs</h4>
                    </div>
                    <div class="card-body">
                        @if($recommendedBlogs->isEmpty())
                            <div class="text-center my-3">
                                <i class="bi bi-emoji-neutral display-1 text-muted"></i>
                                <p class="mt-3 lead">No recommended blog posts for you at the moment.</p>
                            </div>
                        @else
                            <ul class="list-group list-group-flush">
                                @foreach($recommendedBlogs as $post)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>{{ $post->title }}</span>
                                        <a href="{{ route('blog.detail', $post->id) }}" class="btn btn-link text-primary p-0">Read More</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- JavaScript for Confirmation Dialog -->
    <script>
        function confirmRemoveFavourite(event, postId) {
            event.preventDefault();
            if (confirm('Are you sure you want to remove this blog post from your favourites?')) {
                document.getElementById(`remove-favourite-form-${postId}`).submit();
            }
        }
    </script>
    
    
</x-user-dashboard-layout>
