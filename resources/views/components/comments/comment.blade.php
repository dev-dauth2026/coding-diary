<div class="container col-12 my-5 ">


    <h3 class="mt-5">Comments</h3>
        @if($comments->isEmpty())
            <p>No comments yet. Be the first to comment!</p>
        @else

            @foreach($comments as $comment)
                <div class="mb-3">
                    <strong>{{ $comment->user->name }}</strong>:
                    <p>{{ $comment->content }}</p>
                </div>
            @endforeach
        @endif


    @auth
    <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mt-4">
        @csrf
        <div class="mb-3">
            <label for="content" class="form-label">Add a Comment</label>
            <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="3"></textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    @else
    <p class="mt-4">Please <a href="{{ route('account.login') }}">login</a> to add a comment.</p>
    @endauth
</div>