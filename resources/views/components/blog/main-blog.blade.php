<div class="">
    @if(Auth::check())
        @if(Auth::user()->favouriteBlogs->contains($post->id))
            <form action="" method="POST">
                @csrf
                <div class="d-flex">
                    <button class="border-0 bg-transparent ms-auto" type="submit">
                        <i class="bi bi-heart-fill" style="font-size: 1.5rem;color:red;"></i>
                    </button>
                </div>
            </form>

        @else
        <form action="{{route('favourite.add', $post->id)}}" method="POST">
            @csrf
            <div class="d-flex">
                <button class="border-0 bg-transparent ms-auto" type="submit">
                    <i class="bi bi-heart" style="font-size: 1.5rem;"></i>
                </button>
            </div>
        </form>
        @endif
       
    @else
        <form action="{{route('favourite.add', $post->id)}}" method="POST">
            @csrf
            <div class="d-flex">
                <button class="border-0 bg-transparent ms-auto" type="submit">
                    <i class="bi bi-heart" style="font-size: 1.5rem;"></i>
                </button>
            </div>
        </form>
    @endif
    <p>{!! $post->content !!}</p>
</div>
