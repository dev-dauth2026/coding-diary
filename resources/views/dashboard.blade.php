<x-user-layout>
    <div class="p-5">
        @if(session('loggedIn'))
        <p class="alert alert-success text-success p-2 my-4 text-center" >Welcome {{ Auth::user()->name }}! {{session('loggedIn')}} </p>
        @endif
        <div class="row p-5">
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card dashboardCard shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="icon mb-3">
                            <i class="bi bi-person-circle display-4 text-primary"></i>
                        </div>
                        <h5 class="card-title">My Account</h5>
                        <p class="card-text">Manage your personal information and settings.</p>
                        <a href="#" class="btn btn-primary-subtle">Go to My Account</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card dashboardCard shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="icon mb-3">
                            <i class="bi bi-heart-fill display-4 text-danger"></i>
                        </div>
                        <h5 class="card-title">My Favorite</h5>
                        <p class="card-text">View and manage your favorite blog posts.</p>
                        <a href="#" class="btn btn-primary-subtle">Go to My Favorite</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card dashboardCard shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="icon mb-3">
                            <i class="bi bi-bookmark-fill display-4 text-warning"></i>
                        </div>
                        <h5 class="card-title">Saved</h5>
                        <p class="card-text">View and manage your saved items.</p>
                        <a href="#" class="btn btn-primary-subtle">Go to Saved</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card  dashboardCard shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="icon mb-3">
                            <i class="bi bi-eye-fill display-4 text-success"></i>
                        </div>
                        <h5 class="card-title">Watch List</h5>
                        <p class="card-text">View and manage your watch list.</p>
                        <a href="#" class="btn btn-primary-subtle">Go to Watch List</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="icon mb-3">
                            <i class="bi bi-bell-fill display-4 text-info"></i>
                        </div>
                        <h5 class="card-title">Notifications</h5>
                        <p class="card-text">View your recent notifications.</p>
                        <a href="#" class="btn btn-primary-subtle">Go to Notifications</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="icon mb-3">
                            <i class="bi bi-graph-up-arrow display-4 text-secondary"></i>
                        </div>
                        <h5 class="card-title">Statistics</h5>
                        <p class="card-text">View your account statistics and activity.</p>
                        <a href="#" class="btn btn-primary-subtle">Go to Statistics</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class=" shadow-sm border-0">
                    <div class="">
                        <h5 class="">Recent Activity</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <i class="bi bi-hand-thumbs-up me-2 text-primary"></i>
                                You liked the blog post "How to Learn Laravel".
                            </li>
                            <li class="list-group-item">
                                <i class="bi bi-chat-left-text me-2 text-success"></i>
                                You commented on "Top 10 PHP Tips".
                            </li>
                            <li class="list-group-item">
                                <i class="bi bi-bookmark-plus me-2 text-warning"></i>
                                You saved the post "Understanding MVC Architecture".
                            </li>
                            <li class="list-group-item">
                                <i class="bi bi-eye me-2 text-danger"></i>
                                You added "Introduction to PHP" to your watch list.
                            </li>
                        </ul>
                        <a href="#" class="btn btn-primary-subtle mt-3">View All Activity</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-user-layout>
