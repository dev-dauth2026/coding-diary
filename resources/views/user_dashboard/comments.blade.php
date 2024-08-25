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
                            <p class="display-5">56</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title">Comments This Month</h5>
                            <p class="display-5">12</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title">Most Commented Post</h5>
                            <p class="display-6">"How to Learn Laravel"</p>
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
                <!-- Example Comment Card -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">John Doe</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Posted on: July 20, 2024</h6>
                            <p class="card-text">
                                This is an example of a user's comment. It is designed to show the comment text along with the commenter's details.
                            </p>
                            <!-- Reply and Like Feature -->
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="#" class="btn btn-outline-primary btn-sm">Reply</a>
                                <a href="#" class="btn btn-outline-success btn-sm">Like (10)</a>
                            </div>
                        </div>
                        <div class="card-footer bg-white">
                            <div class="d-flex justify-content-between">
                                <a href="#" class="btn btn-outline-primary btn-sm">Edit</a>
                                <a href="#" class="btn btn-outline-danger btn-sm">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Another Example Comment Card -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Jane Smith</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Posted on: August 10, 2024</h6>
                            <p class="card-text">
                                Another example comment, showcasing how the design can accommodate various lengths of text while keeping a consistent style.
                            </p>
                            <!-- Reply and Like Feature -->
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="#" class="btn btn-outline-primary btn-sm">Reply</a>
                                <a href="#" class="btn btn-outline-success btn-sm">Like (5)</a>
                            </div>
                        </div>
                        <div class="card-footer bg-white">
                            <div class="d-flex justify-content-between">
                                <a href="#" class="btn btn-outline-primary btn-sm">Edit</a>
                                <a href="#" class="btn btn-outline-danger btn-sm">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Additional Comment Cards can be added similarly -->
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

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
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
