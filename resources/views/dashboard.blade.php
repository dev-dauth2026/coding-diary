<x-user-layout>
    <div class="p-md-5 py-5">
        @if(session('loggedIn'))
        <p class="alert alert-success text-success p-2 my-4 text-center" >Welcome {{ Auth::user()->name }}! {{session('loggedIn')}} </p>
        @endif
        <div class="row p-md-5 ">
            <div class="col-6 col-md-6 col-lg-4 mb-4">
                <a href="{{route('account.account')}}" class="text-decoration-none card dashboardCard shadow-sm border-0">
               
                    <div class="card-body text-center">
                        <div class="icon mb-3">
                            <i class="bi bi-person-circle display-4 text-primary"></i>
                        </div>
                        <h5 class="card-title">My Account</h5>
                        <small class="card-text text-secondary d-md-block d-none">Manage your personal information and settings.</small>
        
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-4 mb-4">
                <a href="{{route('account.favourites')}}" class="text-decoration-none card dashboardCard shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="icon mb-3">
                            <i class="bi bi-heart-fill display-4 text-danger"></i>
                        </div>
                        <h5 class="card-title">My Favorite</h5>
                        <small class="card-text text-secondary d-md-block d-none">View and manage your favorite blog posts.</small>

                    </div>
                </a>
            </div>

            <div class="col-6 col-md-4 col-lg-4 mb-4">
                <a href="#" class=" text-decoration-none card shadow-sm border-0">
                    <div  class="  card-body text-center">
                        <div class="icon mb-3">
                            <i class="bi bi-bell-fill display-4 text-info"></i>
                        </div>
                        <h5 class="card-title">Notifications</h5>
                        <small class="card-text text-secondary d-md-block d-none">View your recent notifications.</small>

                    </div>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-4 mb-4">
                <a href="#" class=" text-decoration-none card shadow-sm border-0">
                    <div  class=" card-body text-center">
                        <div class="icon mb-3">
                            <i class="bi bi-graph-up-arrow display-4 text-secondary"></i>
                        </div>
                        <h5 class="card-title">Statistics</h5>
                        <small class="card-text text-secondary d-md-block d-none">View your account statistics and activity.</small>

                    </div>
                </a>
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
