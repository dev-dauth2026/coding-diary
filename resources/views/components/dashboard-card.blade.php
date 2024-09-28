<a href="{{ $url }}" class="text-decoration-none">
    <div class="card dashboardCard shadow-sm border-0 h-100">
        <div class="card-body d-flex justify-content-center align-items-center gap-3 text-center">
            <div class="icon mb-3">
                <i class="fas fa-{{$icon}} display-4 text-{{$iconColor}}"></i>
            </div>
            <div class="d-flex flex-column">
                <h5 class="card-title text-secondary fs-sm-3 fs-6">{{ $title }}</h5>
                <p class="card-text display-4 display-sm-5">{{ $text }}</p>
            </div>
        </div>
    </div>
</a>
