<x-user-dashboard-layout>
    <div class="container py-3" style="min-height: 90vh;">
        <h4>Activities</h4>
        <hr class="col-2 mb-3">
        
        <!-- Filter and Search Options in One Row -->
        <form method="GET" action="{{ route('account.activities.index') }}" class="mb-4">
            <div class="row g-3 align-items-end">
                <!-- Search Input -->
                <div class="col-md-4">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search activities...">
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
                <div class="col-md-2 mt-2 mt-md-0 d-flex justify-content-start">
                    <button type="submit" class="btn btn-info me-2">Filter</button>
                    <a href="{{ route('account.activities.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>

        <!-- Activity List -->
        <div class="row">
            @if($activities->isNotEmpty())
                <div class="col-12 mx-0 px-0" style="min-height: 70vh;">
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            @foreach($activities as $activity)
                                <li class="list-group-item d-flex flex-column flex-sm-row justify-content-start justify-content-sm-between align-items-start align-items-sm-center">
                                    <div>
                                        <div>
                                         <i class="{{ $activity->icon }} me-2 text-primary"></i>
                                         {{ $activity->description }} 
                                        </div> 
                                       
                                    </div>
                                    <div>
                                        <small class="text-secondary">{{ $activity->created_at->diffForHumans() }}</small>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $activities->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            @else
                <div class="col-12 d-flex justify-content-center align-items-center" style="min-height: 70vh;">
                    No Activities at the moment.
                </div>
            @endif
        </div>
    </div>
</x-user-dashboard-layout>
