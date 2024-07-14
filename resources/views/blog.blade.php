<x-user-layout>
    <div class="m-0 p-0" style="min-height: 80vh;">

        @if (empty($posts))
            <div class="container">
                <div class="row">
                    <div class="col">
                        <p class="text-center fs-4">No blogs found.</p>
                    </div>
                </div>
            </div>
        @endif
        
            
        {{-- Main Content Area --}}
        @if ($post && empty($query))
                <div class="position-relative d-flex justify-content-center align-items-center p-3 w-100" style="background: linear-gradient(135deg, rgba(149, 209, 58, 0.6), rgba(128, 0, 128, 0.6)); z-index: 1;">
                    <img class="rounded shadow" src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid" style="width: auto; height: 400px;">
                    <div class="position-absolute heading mb-5 d-flex flex-column p-5" style="z-index: 3;bottom:0;right:20px">
                
                        <small class="text-secondary">Author: {{ $post->author ? $post->author : 'CodingDiary'}}</small>
                        <small class="text-secondary">Published on: {{ $post->created_at->format('M d, Y') }}</small>
                    </div>
                </div>
                <div class="row  gx-5">
                    <div class="col-lg-9">
                        
                            <div class="  mb-4 p-5">
                                <div class="card-body">
                                    <x-blog.main-blog :post="$post" />
                                </div>
                            </div>
                    

                        {{-- Blog List Section --}}
                        <div class="row gx-4">
                            @foreach ($posts as $blogPost)
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100  shadow">
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
                    <div class="col-lg-3 position-relative " style="z-index: 1">
                        <div class="sticky-top shadow mb-4 p-3" style="top: 80px;">
                            <div class="card-body">
                                <x-blog.blog-search :posts="$posts" :totalBlogs="$totalBlogs" />
                            </div>
                        </div>
                    </div>
                    </div>
        @endif


    </div>
</x-user-layout>
