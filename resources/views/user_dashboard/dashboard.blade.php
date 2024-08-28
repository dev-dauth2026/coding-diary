<x-user-dashboard-layout>
    <main class="p-md-3 py-3">
        <!-- Message Component -->
        <x-message.message></x-message.message>
        
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex flex-column">
                <h4>User Dashboard</h4>
                <hr class="col-12 mb-3">
            </div>
            <div>
                <a href="{{ route('account.settings.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-cog"></i> Settings
                </a>
            </div>
        </div>

        <!-- Dashboard Overview Cards -->
        <div class="row g-3">
            <!-- Total Favorites -->
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card dashboardCard shadow-sm border-0 h-100">
                    <div class="card-body d-flex align-items-center gap-3 text-center">
                        <div class="icon mb-3 ">
                            <i class="fas fa-heart display-4 text-danger"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <h5 class="card-title text-secondary">Total Favorites</h5>
                            <p class="card-text display-4">{{ $totalFavorites }}</p>
                        </div>

                    </div>
                </div>
            </div>

            <!-- New Messages -->
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card dashboardCard shadow-sm border-0 h-100">
                    <div class="card-body d-flex align-items-center gap-3 text-center">
                        <div class="icon mb-3">
                            <i class="fas fa-envelope display-4 text-warning"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <h5 class="card-title text-secondary">New Messages</h5>
                            <p class="card-text display-4">{{ $newMessages }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Messages -->
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card dashboardCard shadow-sm border-0 h-100">
                    <div class="card-body d-flex align-items-center gap-3 text-center">
                        <div class="icon mb-3">
                            <i class="fas fa-comments display-4 text-info"></i>
                        </div>
                        <div class="d-flex flex-column">
                        <h5 class="card-title text-secondary">Total Messages</h5>
                        <p class="card-text display-4">{{ $totalMessages }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Comments -->
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card dashboardCard shadow-sm border-0 h-100">
                    <div class="card-body d-flex align-items-center gap-3 text-center">
                        <div class="icon mb-3">
                            <i class="fas fa-comment-dots display-4 text-success"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <h5 class="card-title text-secondary">Total Comments</h5>
                            <p class="card-text display-4">{{ $totalComments }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- New Replies -->
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card dashboardCard shadow-sm border-0 h-100">
                    <div class="card-body d-flex align-items-center gap-3 text-center">
                        <div class="icon mb-3">
                            <i class="fas fa-reply display-4 text-primary"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <h5 class="card-title text-secondary">New Replies</h5>
                            <p class="card-text display-4">{{ $newReplies }}</p>
                        </div>
                 
                    </div>
                </div>
            </div>

         

            <!-- Notifications -->
            <div class="col-6 col-md-4 col-lg-3">
                <a href="{{ route('account.notifications') }}" class="text-decoration-none card dashboardCard shadow-sm border-0 h-100">
                    <div class="card-body d-flex align-items-center gap-3 text-center">
                        <div class="icon mb-3">
                            <i class="fas fa-bell display-4 text-info"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <h5 class="card-title text-secondary">Notifications</h5>
                            <p class="card-text display-4">5</p>
                        </div>
                 
                    </div>
                </a>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header">
                        <h5 class="mb-0">Recent Activity</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @if($activities)
                                @foreach($activities as $activity)
                                <li class="list-group-item">
                                    <i class="{{$activity->icon}} me-2 text-primary"></i>
                                    You {{$activity->description}} <strong>{{$activity->subject_type}} </strong>
                                </li>
                                @endforeach
                            @endif
                           
                        </ul>
                        <div class="text-end mt-3">
                            <a href="{{route('account.activities')}}" class="btn btn-outline-primary"><i class="fas fa-list"></i> View All Activity</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Subscriptions and Recommendations -->
        <div class="row mt-4">
            <!-- Manage Subscriptions -->
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header">
                        <h5 class="mb-0">Manage Subscriptions</h5>
                    </div>
                    <div class="card-body">
                        <p>Stay updated with the latest posts and updates.</p>
                        <a href="#" class="btn btn-secondary"><i class="fas fa-rss"></i> Manage Subscriptions</a>
                    </div>
                </div>
            </div>

            <!-- Recommended Posts -->
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header">
                        <h5 class="mb-0">Recommended for You</h5>
                    </div>
                    <div class="card-body">
                        @if($recommendedPosts)
                        <ul class="list-group list-group-flush">
                            @foreach($recommendedPosts as $post)
                                <li class="list-group-item">
                                    <i class="fas fa-arrow-right me-2 text-success"></i>
                                    <a href="{{ route('blog.detail', $post->id) }}" class="text-decoration-none">{{ $post->title }}</a>
                                    <small class="text-muted">By {{ $post->author }}</small>
                                </li>
                            @endforeach
                        </ul>
                        <div class="text-end mt-3">
                            <a href="#" class="btn btn-outline-primary"><i class="fas fa-search"></i> Explore More</a>
                        </div>
                        @endif
                        @empty($recommendedPosts)
                        <div>
                            You have already liked all the posts.
                        </div>
                        @endempty
                    </div>
                </div>
            </div>
        </div>

        <!-- Motivational Quote or Tip -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card shadow-sm border-0 bg-light">
                    <div class="card-body text-center">
                        <blockquote class="blockquote mb-0">
                            <p class="mb-2">"The best way to predict the future is to create it."</p>
                            <footer class="blockquote-footer">Peter Drucker</footer>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-user-dashboard-layout>
