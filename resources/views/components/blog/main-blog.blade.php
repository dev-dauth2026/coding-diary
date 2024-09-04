<div class="">
        <div class="d-flex flex-column">
            <h3>{{ $post->title }}</h3>
           
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex flex-column">
                    <small class="text-secondary">Author: {{ $post->author ? $post->author->name : 'CodingDiary' }}</small>
                    <small class="text-secondary">Published on: {{ $post->created_at->format('M d, Y') }}</small>
    
                </div>
                <div>
                    @auth
                    @if(Auth::user()->favouriteBlogs->contains('blog_post_id',$post->id))
                        <form id="remove-favourite-form-{{ $post->id }}" action="{{route('favourite.remove',$post->id)}}" method="POST" onsubmit="return confirmRemoveFavourite(event, {{ $post->id }});">
                            @csrf
                            @method('DELETE')
                            <div class="d-flex my-3">
                                <button class="border-0 bg-transparent ms-auto" type="submit">
                                    <i class="bi bi-heart-fill" style="font-size: 1.5rem;color:red;"></i>
                                </button>
                            </div>
                        </form>
            
                    @else
                    <form action="{{route('favourite.add', $post->id)}}" method="POST">
                        @csrf
                        <div class="d-flex my-3">
                            <button class="border-0 bg-transparent ms-auto" type="submit">
                                <i class="bi bi-heart" style="font-size: 1.5rem;"></i>
                            </button>
                        </div>
                    </form>
                    @endif
                @endauth
                   
                @guest
                    <form action="{{route('favourite.add', $post->id)}}" method="POST">
                        @csrf
                        <div class="d-flex my-3">
                            <button class="border-0 bg-transparent ms-auto" type="submit">
                                <i class="bi bi-heart" style="font-size: 1.5rem;"></i>
                            </button>
                        </div>
                    </form>
                @endguest
                </div>

            </div>

        </div>
    <p>{!! $post->content !!}</p>

    <script>
        function confirmRemoveFavourite(event, postId) {
            event.preventDefault();
            if (confirm('Are you sure you want to remove this blog post from your favourites?')) {
                document.getElementById(`remove-favourite-form-${postId}`).submit();
            }
        }
    </script>
</div>
