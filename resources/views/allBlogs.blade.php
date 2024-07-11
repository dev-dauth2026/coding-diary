<x-user-layout>
    <div class="bg-gradient" style="min-height: 100vh;">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 ">
                    <div class="card bg-glass border-0 shadow p-5">
                        <div class="card-body">
                            <h2 class="text-center mb-4 text-dark">
                                @if(empty($query))
                                    All Blogs
                                @else
                                    Searched Results
                                @endif
                            </h2>
                            <hr class="col-12 col-lg-2 col-md-5 col-sm-10 mx-auto mb-4 bg-white">

                            {{-- Search Form --}}
                            <form action="{{ route('blog.search') }}" method="get" class="mb-4">
                                <div class="input-group">
                                    <input type="text" class="form-control border-0 bg-transparent rounded-pill py-2 px-4 shadow-sm @error('blogSearch') is-invalid @enderror text-dark" placeholder="Search blog topics..." name="blogSearch" id="blogSearch" value="{{ old('blogSearch', $query ?? '') }}">
                                    <button class="btn btn-outline-secondary rounded-pill px-4" type="submit">Search</button>
                                    @error('blogSearch')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </form>

                            {{-- Blog List --}}
                            @forelse ($posts as $post)
                                <div class="card mb-3 bg-glass border-0 shadow-sm">
                                    <div class="card-body">
                                        <a href="{{ route('blog.detail', $post->id) }}" class="text-decoration-none text-dark">
                                            <h5 class="card-title mb-2">{{ $post->title }}</h5>
                                            <p class="card-text text-muted mb-1"><small>{{ $post->created_at->format('M d, Y') }}</small></p>
                                            <p class="card-text mb-0"><small>By {{ $post->author ?: 'N/A' }}</small></p>
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center text-white">No blogs found.</p>
                            @endforelse

                            {{-- Pagination Links --}}
                            <div class="d-flex justify-content-center mt-4">
                                {{ $posts->links('vendor.pagination.bootstrap-5') }}
                            </div>

                            {{-- Link to All Blogs --}}
                            @if(!empty($query))
                                <div class="text-center mt-4">
                                    <a href="{{ route('account.allBlogs') }}" class="text-decoration-none text-white">All Blogs</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-gradient {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        .bg-glass {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
        }
    </style>
</x-user-layout>
