<div class="container col-12 my-5 ">


    <h3 class="mt-5">Comments</h3>
        @if($comments->isEmpty())
            <p>No comments yet. Be the first to comment!</p>
        @else

            @foreach($comments as $comment)
                <div class="mb-3">
                    <img src="{{ $comment->user->profile_picture ? asset('storage/' . $comment->user->profile_picture) : 'https://via.placeholder.com/50' }}" alt="Profile Picture" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                    <strong>{{ $comment->user->name }} : <small class="ms-3 text-secondary">{{$comment->created_at}} </small> </strong>
                    
                      
                            @if(Auth::id() === $comment->user_id)
                                <div id="comment-display-{{ $comment->id }}">
                                    <p class="mb-0">{{ $comment->content }}</p>
                                    @auth
                                        @if(Auth::id() === $comment->user_id)
                                            <div class="d-flex gap-2">
                                                <a href="javascript:void(0);" onclick="showEditForm({{ $comment->id }});" class="ms-2">Edit</a>
                                                <form action="{{ route('comment.destroy', $comment->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link p-0 ms-2" onclick="return confirm('Are you sure you want to delete this comment?');">Delete</button>
                                                </form>
                                            </div> 
                                        @endif
                                    @endauth
                                </div>
                                <div id="comment-edit-{{ $comment->id }}" class="d-none">
                                    <form action="{{ route('comment.update', $comment->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <textarea name="updateContent" id="updateContent" class="form-control @error('updateContent') is-invalid @enderror" rows="3">{{ old('updateContent', $comment->content) }}</textarea>
                                            @error('updateContent')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                        <button type="button" class="btn btn-secondary btn-sm" onclick="hideEditForm({{ $comment->id }});">Cancel</button>
                                    </form>
                                </div>  
                                
                          
                            @else
                            <p>  {{ $comment->content }}  </p>
                            @endif
                    
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
        <button type="submit" class="btn btn-outline-warning">Submit</button>
    </form>
    @else
    <p class="mt-4">Please <a href="{{ route('account.login') }}">login</a> to add a comment.</p>
    @endauth
</div>

<script>
    function showEditForm(commentId) {
        document.getElementById('comment-display-' + commentId).classList.add('d-none');
        document.getElementById('comment-edit-' + commentId).classList.remove('d-none');
    }

    function hideEditForm(commentId) {
        document.getElementById('comment-display-' + commentId).classList.remove('d-none');
        document.getElementById('comment-edit-' + commentId).classList.add('d-none');
    }
</script>