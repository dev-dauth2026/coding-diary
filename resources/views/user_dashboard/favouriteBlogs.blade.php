<x-user-dashboard-layout>
    <main class=" p-3" style="min-height: 80vh;">
       
        @if(session('success'))
            <div class="alert alert-success p-2">{{ session('success') }}</div>
        @endif
        <div class="mb-3">
            <h4 class="">My Favourite Blogs</h4>
            <hr class="col-2">
        </div>
        @if($favourites->isEmpty())
            <div class="text-center my-5 ">
                <i class="bi bi-heartbreak" style="font-size: 3rem; color: #ccc;"></i>
                <p class="mt-3">You have no favourite blog posts.</p>
            </div>
        @else
            <div class="row ">
                @foreach($favourites as $post)
                    <div class="col-md-4 mb-4 d-flex">
                        <div class="card h-100" style="width: 350px;">
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}" style="height: 200px; object-fit: cover;">
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text flex-grow-1">{{ Str::limit(strip_tags($post->content), 90) }} <a href="{{ route('blog.detail', $post->id) }}" class="">Read More</a></p>
                                
                            </div>
                            <div class="card-footer">
                                <form class="d-flex w-100" id="remove-favourite-form-{{$post->id}}" action="{{ route('favourite.remove', $post->id) }}" method="POST" onsubmit="return confirmRemoveFavourite(event, {{ $post->id }});">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger w-100" type="submit">Remove from Favourites</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </main>
    
    <script>
        function confirmRemoveFavourite(event, postId) {
            event.preventDefault();
            if (confirm('Are you sure you want to remove this blog post from your favourites?')) {
                document.getElementById(`remove-favourite-form-${postId}`).submit();
            }
        }
    </script>
</x-user-dashboard-layout>
