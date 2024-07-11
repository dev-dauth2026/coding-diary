<div class="latestBlog col-12 col-sm-12 col-md-8  col-lg-9">
    <div class="heading mb-5 d-flex flex-column">
        <h3 class="">{{ $post->title }}</h3>
        <hr class="col-12 col-lg-2 col-md-5 col-sm-10  mb-5">

        <small class="text-secondary">Author: {{ $post->author }}</small>
        <small class="text-secondary">Published on: {{ $post->created_at->format('M d, Y') }}</small>
    </div>
    <div class="d-flex justify-content-center align-items-center">
        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid" style="width: 600px; min-width: 200px; height: auto;">
    </div>
    <p>{!! $post->content !!}</p>
</div>
