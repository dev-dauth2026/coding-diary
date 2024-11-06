<x-user-dashboard-layout>
    <div class="container py-3" style="min-height: 90vh;">
        <div>
            <h4>Notifications</h4>
            <hr class="col-2 mb-3">
        </div>

        <!-- Filter and Search Options in One Row -->
        <form method="GET" action="{{ route('account.notifications') }}" class="mb-4">
            <div class="row g-3 align-items-end">
                <!-- Search Input -->
                <div class="col-md-3">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search notifications...">
                </div>
                

                <!-- Start Date Filter -->
                <div class="col-md-2">
                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
                </div>

                <!-- End Date Filter -->
                <div class="col-md-2">
                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
                </div>

                <!-- Filter and Reset Buttons -->
                <div class="col-md-1 mt-2 mt-md-0 d-flex justify-content-start">
                    <button type="submit" class="btn btn-info me-2">Filter</button>
                    <a href="{{ route('account.notifications') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>

        <div class="row">
            <!-- Left Column: Notifications List -->
            <div class="col-md-11">
                <div class="card">
                    <ul class="list-group list-group-flush">
                        @forelse($notifications as $notification)
                            <li class="list-group-item d-flex flex-column flex-sm-row justify-content-start justify-content-sm-between align-items-start align-items-sm-center ">
                                <div>
                                    <!-- Display notification icon and message -->
                                    <i class="{{ $notification->type == 'comment' ? 'fas fa-comment' : 'fas fa-heart' }} me-2 text-primary"></i>
                                    <a href="{{ route('account.notifications', ['id' => $notification->id]) }}" class="text-decoration-none {{$notification->is_read ? 'text-secondary' : 'text-dark'}}">
                                     {{$notification->user->name}}   {{ $notification->data['content'] }}
                                    </a>
                                </div>
                                <div>
                                    <small class="text-secondary">{{ $notification->created_at->diffForHumans() }}</small>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item text-center text-muted">No notifications at the moment.</li>
                        @endforelse
                    </ul>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $notifications->links('pagination::bootstrap-5') }}
                </div>
            </div>

        
        </div>
    </div>
</x-user-dashboard-layout>
