<x-user-layout>
    <div class="py-5 bg-light" style="min-height: 80vh;">

        @if (empty($posts))
            <div class="container">
                <div class="row">
                    <div class="col">
                        <p class="text-center fs-4">No blogs found.</p>
                    </div>
                </div>
            </div>
        @else
            <div class="container">
                <div class="row gx-5">
                    {{-- Main Content Area --}}
                    <div class="col-lg-9">
                        @if ($post && empty($query))
                            <div class="card shadow-sm mb-4">
                                <div class="card-body">
                                    <x-blog.main-blog :post="$post" />
                                </div>
                            </div>
                        @endif

                        {{-- Blog List Section --}}
                        <div class="row gx-4">
                            @foreach ($posts as $blogPost)
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <img src="{{asset('storage/' . $blogPost->image)  }}" class="card-img-top self-auto" alt="{{ $blogPost->title }}" style="height: auto;width:50;">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $blogPost->title }}</h5>
                                            <p class="card-text">{{ Str::limit(strip_tags($blogPost->content), 120) }}</p>
                                            <a href="{{ route('blog.detail', $blogPost->id) }}" class="btn btn-primary stretched-link">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Sidebar --}}
                    <div class="col-lg-3">
                        <div class="card shadow-sm mb-4">
                            <div class="card-body">
                                <x-blog.blog-search :posts="$posts" :totalBlogs="$totalBlogs" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
</x-user-layout>
