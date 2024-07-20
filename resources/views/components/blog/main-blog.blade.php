<div class="">
    @if(Auth::check())
        @if(Auth::user()->favouriteBlogs->contains($post->id))
            <form id="remove-favourite-form-{{ $post->id }}" action="{{route('favourite.remove',$post->id)}}" method="POST" onsubmit="return confirmRemoveFavourite(event, {{ $post->id }});">
                @csrf
                @method('DELETE')
                <div class="d-flex mb-5">
                    <button class="border-0 bg-transparent ms-auto" type="submit">
                        <i class="bi bi-heart-fill" style="font-size: 1.5rem;color:red;"></i>
                    </button>
                </div>
            </form>

        @else
        <form action="{{route('favourite.add', $post->id)}}" method="POST">
            @csrf
            <div class="d-flex mb-5">
                <button class="border-0 bg-transparent ms-auto" type="submit">
                    <i class="bi bi-heart" style="font-size: 1.5rem;"></i>
                </button>
            </div>
        </form>
        @endif
       
    @else
        <form action="{{route('favourite.add', $post->id)}}" method="POST">
            @csrf
            <div class="d-flex mb-5">
                <button class="border-0 bg-transparent ms-auto" type="submit">
                    <i class="bi bi-heart" style="font-size: 1.5rem;"></i>
                </button>
            </div>
        </form>
    @endif
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
