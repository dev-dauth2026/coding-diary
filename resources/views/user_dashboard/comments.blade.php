<x-user-dashboard-layout>
    <main style="min-height:90vh;">
        <div class="container py-3 py-md-3">
            <!-- Page Header -->
            <div class="mb-3">
                <h4>My Comments</h4>
                <hr class="col-2">
            </div>

            <!-- Comment Statistics Section -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title">Total Comments</h5>
                            <p class="display-5">{{ $totalComment }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title">Comments This Month</h5>
                            <p class="display-5">{{ $totalCommentsThisMonth }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title">Most Liked Comment</h5>
                            @if($mostLikedComment)
                                <p class="display-6"><a class="text-decoration-none" href="{{ route('blog.detail', $mostLikedComment->blogPost->id) }}"> "{{ Str::limit($mostLikedComment->blogPost->title, 30) }}" </a></p>
                                <p class="text-muted">{{ Str::limit($mostLikedComment->content, 50) }}</p>
                                <p class="text-muted">Likes: {{ $mostLikedComment->likes_count }}</p>
                            @else
                                <p class="text-muted">No comments yet.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters and Search Bar -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Search comments..." aria-label="Search">
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option selected>Filter by Post</option>
                        <option value="1">Post A</option>
                        <option value="2">Post B</option>
                        <option value="3">Post C</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option selected>Filter by Date</option>
                        <option value="1">Last 7 Days</option>
                        <option value="2">Last 30 Days</option>
                        <option value="3">This Year</option>
                    </select>
                </div>
            </div>

            <!-- Comments List -->
            <div class="row">
                @if($comments)
                    @foreach($comments as $comment)
                    <!-- Comment Card -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body position-relative">
                                <!-- Dropdown Toggle for Edit and Delete -->
                                <div class="dropdown position-absolute top-0 end-0">
                                    <button class="btn btn-sm btn-light" type="button" id="dropdownMenuButton{{ $comment->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton{{ $comment->id }}">
                                        <li><a class="dropdown-item" href="#">Edit</a></li>
                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                    </ul>
                                </div>

                                <h5 class="card-title">{{ $comment->blogPost->title }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Posted on: {{ $comment->created_at->format('d F Y') }} | {{ $comment->created_at->diffForHumans() }}</h6>
                                <p class="card-text">
                                    {{ $comment->content }}
                                </p>
                                <!-- Reply and Like Feature -->
                                <div class="d-flex justify-content-start align-items-center">
                                    <button class="btn btn-transparent text-decoration-none text-secondary me-3" type="button" onclick="replyFormShow({{ $comment->id }})">
                                        <small class="text-nowrap"><i class="fa-solid fa-reply"></i> Reply</small>
                                    </button>
                                    <button class="btn btn-transparent text-decoration-none text-secondary" type="button">
                                        <small class="text-nowrap"><i class="fa-solid fa-thumbs-up"></i> Like</small>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $comments->links('pagination::bootstrap-5') }} <!-- Use Bootstrap 5 pagination links -->
            </div>

            <!-- Top Commented Posts Section -->
            <div class="mt-5">
                <h5>Top Commented Posts</h5>
                <hr class="col-2">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        How to Learn Laravel
                        <span class="badge bg-primary rounded-pill">10 Comments</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Understanding MVC Architecture
                        <span class="badge bg-primary rounded-pill">8 Comments</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Laravel vs. Other Frameworks
                        <span class="badge bg-primary rounded-pill">5 Comments</span>
                    </li>
                </ul>
            </div>

            <!-- Bulk Actions and Export Comments -->
            <div class="mt-4 d-flex justify-content-between">
                <div>
                    <button class="btn btn-outline-secondary me-2">Delete All</button>
                    <button class="btn btn-outline-secondary">Mark All as Read</button>
                </div>
                <div>
                    <button class="btn btn-outline-secondary">Export Comments</button>
                </div>
            </div>

            <!-- Notifications Panel -->
            <div class="mt-5">
                <h5>Recent Notifications</h5>
                <hr class="col-2">
                <ul class="list-group">
                    <li class="list-group-item">Jane Smith replied to your comment on "How to Learn Laravel".</li>
                    <li class="list-group-item">New comment on your post "Understanding MVC Architecture".</li>
                    <li class="list-group-item">Your comment on "Laravel vs. Other Frameworks" received a new like.</li>
                </ul>
            </div>
        </div>
    </main>
</x-user-dashboard-layout>
