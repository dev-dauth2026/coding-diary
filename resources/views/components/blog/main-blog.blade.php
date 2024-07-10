<div class="latestBlog col-12 col-sm-12 col-md-8  col-lg-9">
    <div class="heading mb-5 d-flex flex-column">
        <h3>{{ $latestPost->title }}</h3>
        <small class="text-secondary">Author: {{ $latestPost->author }}</small>
        <small class="text-secondary">Published on: {{ $latestPost->created_at->format('M d, Y') }}</small>
    </div>
    <div class="d-flex justify-content-center align-items-center">
        <img src="{{ asset('storage/' . $latestPost->image) }}" alt="{{ $latestPost->title }}" class="img-fluid" style="width: 600px; min-width: 200px; height: auto;">
    </div>
    <p>{!! $latestPost->content !!}</p>
</div>