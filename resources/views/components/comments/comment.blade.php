<div class="container col-12 my-5 ">


    <h3 class="mt-5">Comments</h3>
        @if($comments->isEmpty())
            <p>No comments yet. Be the first to comment!</p>
        @endif

        @auth
        {{-- if authenticated able to add a comment ..  --}}
        <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mt-4 form-floating">
            @csrf
            <div class="mb-3 ">
                <div class="form-floating ">
                    <input type="text" name="content" class="form-control @error('content') is-invalid @enderror" id="floatingInput" placeholder="Add a comment...">
                    <label for="floatingInput">Add a comment..</label>
                </div>
           
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </form>
         {{-- if authenticated able to add a comment ..end  --}}
        @else
        <p class="mt-4">Please <a href="{{ route('account.login') }}">login</a> to add a comment.</p>
        @endauth
         

        @if(!empty($comments))

            @foreach($comments as $comment)
                <div class="mb-3 bg-body p-3 rounded gap-5">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <img src="{{ $comment->user->profile_picture ? asset('storage/' . $comment->user->profile_picture) : 'https://via.placeholder.com/50' }}" alt="Profile Picture" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
                            <strong>{{ $comment->user->name }} : <small class="ms-3 text-secondary">{{$comment->created_at}} </small> </strong>
                            {{-- replies display toggle button  --}}
                            @if($comment->replies->isNotEmpty())
                            <button class="btn btn-trapsparent text-secondary btn-sm" type="button" onclick="toggleReplies({{ $comment->id }})">
                                {{ $comment->replies->count() }} {{$comment->replies->count()==1?'reply':'replies'}} 
                            </button>
                            @endif
                        </div>

                        {{-- edit delete toggle  --}}
                        @if(Auth::id() === $comment->user_id)
                        <div class="d-flex gap-2 align-items-center">
                            <div class="btn-group dropstart">
                                <button type="button" class="btn btn-transparent border-0 " data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis-vertical" ></i>
                                </button>
                                <ul class="dropdown-menu " class="">
                                  <li class="p-2 dropdown-item">
                                    <button class="btn btn-transparent m-0 p-0 " type="button" onclick="showEditForm({{$comment->id}})">
                                        Edit
                                     </button>
                                  </li>
                                  <li class="p-2 dropdown-item">
                                    <form action="{{ route('comment.destroy', $comment->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn bg-transparent border-none m-0 p-0 " type="submit" onclick="return confirm('Are you really want to delete this comment?')">Delete</button>
                                    </form>
                                  </li>
                                </ul>
                            </div>
                        </div>
                        @endif
                         {{-- edit delete toggle end --}}
                    </div>
                    
                   
                    <div class="" id="comment-content-{{ $comment->id }}">
                        <p class="mb-3">{{ $comment->content }}</p>

                         {{-- replies contents  --}}
                         @if($comment->replies->isNotEmpty())
                         <div class="ms-5 mb-3" id="replies-{{$comment->id}}" style="display: none;" >
                                @foreach($comment->replies as $reply)
                                    <div class="mb-3 d-flex flex-column gap-3" >
                                        <div class="d-flex align-items-center gap-2 ">
                                            <img src="{{ $reply->user->profile_picture ? asset('storage/' . $reply->user->profile_picture) : 'https://via.placeholder.com/50' }}" alt="Profile Picture" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
                                            <strong>{{ $reply->user->name }} : <small class="ms-3 text-secondary">{{$reply->created_at}} </small> </strong>
                                            @auth
                                                @if (Auth::user()->id == $reply->user_id)
                                                <div class="d-flex gap-2 align-items-center">
                                                <small><button class="border-0 text-secondary bg-secondary-subtle p-1 rounded " onclick="editReply({{$reply->id}})">Edit</button></small> 
                                                <small>
                                                    <form action="{{ route('comment.destroy', $reply->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-decoration-none text-secondary bg-secondary-subtle p-1 rounded border-0" onclick="return confirm('Do you really want to delete the comment?')">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </small> 

                                                </div>
                                                @endif
                                            @endauth
                                            
                                        </div> 
        
                                        <div id="display-replies-{{$reply->id}}" style="display: block;">
                                            {{$reply->content}}
                                        </div>

                                        {{-- edit replies form  --}}
                                        <div id="edit-replies-{{$reply->id}}" style="display: none;">
                                            <form action="{{route('comment.reply.update',$reply->id)}}" method="POST" class="d-flex flex-column gap-3">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <textarea class="form-control" name="replies_content" id="replies_content-{{$reply->id}}" rows="2" value="{{old('replies_content',$reply->content)}}">{{$reply->content}}</textarea>
                                                </div>

                                                <div class="d-flex gap-2">
                                                    <button class="btn btn-outline-danger " type="button" onclick="hideEditReplyForm({{$reply->id}})">Cancel</button>
                                                    <button class="btn btn-outline-info " type="submit">Update</button>
                                                </div>
                                            </form>
                                                
                                            
                                        </div>
                                        {{-- edit replies form  ends --}}
                                    </div>
                               

                                @endforeach

                            </div>
                            @endif
                         {{-- replies contents  ends--}}
                        
                        {{-- reply and like buttons  --}}
                        <div class="col-4 d-flex gap-4">
                            
                            <button class="btn btn-transparent text-decoration-none text-secondary" type="button" onclick="replyFormShow({{$comment->id}})">
                                <small>Reply</small> <i class="fa-solid fa-reply"></i> 
                            </button>
                            <button class="btn btn-transparent text-decoration-none text-secondary" type="button" onclick="like({{$comment->id}})">
                                <small>Like</small> <i class="fa-regular fa-thumbs-up" id="like-{{$comment->id}}"></i>
                                <i class="fa-solid fa-thumbs-up" style="display: none" id="liked-{{$comment->id}}"></i>
                            </button>
                        </div>
                        {{-- reply and like buttons ends --}}

                        {{-- reply form  --}}
                        <div class="reply-form" id="reply-form-{{$comment->id}}" style="display: {{session('reply_comment_id')==$comment->id && $errors->replyError->isNotEmpty()?'block':'none'}} ;">
                            <form action='{{route('comment.reply',$comment->id)}}' method='post' class='d-flex flex-column gap-2' >
                                @csrf
                                <div class='form-floating'>
                                    <textarea  class='form-control @if(session('reply_comment_id')==$comment->id && $errors->replyError->has('comment_reply')) is-invalid @endif' id='floatingTextarea'  placeholder='Write your reply to the comment' name ='comment_reply'> </textarea>
                                    <label for='floatingTextarea'>Reply to the comment...</label>
                                </div>
                                <div class='d-flex justify-content-end gap-2'>
                                    <button type='button' class='btn btn-outline-danger' onclick="replyFormHide({{$comment->id}})">Cancel</button>
                                    <button type='submit' class='btn btn-outline-info'>Reply</button>
                                </div>
            
                            </form>
                        </div>
                        {{-- reply form ends --}}

                    </div>
                   

                    {{-- if user logged in can only edit or delete comment  --}}
                    @if(Auth::id() === $comment->user_id)
                        <div id="comment-edit-{{$comment->id}}" class="" style="display: none;">
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
                    @endif
                    {{-- if user logged in can only edit or delete comment  ends--}}
                    
                </div>
            @endforeach
        @endif
   


    
</div>

<script>
    function showEditForm(commentId) {
        const editComment =  document.getElementById(`comment-edit-${commentId}`);
        document.getElementById(`reply-form-${commentId}`).style.display = "none";

        editComment.style.display = "block";

    }

    function hideEditForm(commentId) {
        const editComment =  document.getElementById(`comment-edit-${commentId}`);

        document.getElementById(`reply-form-${commentId}`).style.display = "none";

        editComment.style.display = "none";
    }

    function replyFormShow(commentId){
        const replyForm = document.getElementById(`reply-form-${commentId}`);
        const button = event.target;

        if(replyForm){

            replyForm.style.display = "block";
        }
    }
   
    function replyFormHide(commentId){
        const button = event.target;
        // document.getElementById(`reply-form-${commentId}`).style.display = "d-block";
        document.getElementById(`reply-form-${commentId}`).style.display="none";
    }

    function like(commentId){
        document.getElementById(`like-${commentId}`).style.display='none';
        document.getElementById(`liked-${commentId}`).style.display='block';
    }

    function toggleReplies(commentId){
        const replies = document.getElementById(`replies-${commentId}`);
        const button = event.target;

        if(replies.style.display=="none"){
            replies.style.display="block";
        }else{
            replies.style.display="none";
        }
    }

    function editReply(reply_comment_id){
        const reply_comment = document.getElementById(`edit-replies-${reply_comment_id}`);
        const display_reply_comment = document.getElementById(`display-replies-${reply_comment_id}`);
        const button = event.target;

        if(reply_comment.style.display=="none"){
            reply_comment.style.display="block";
            display_reply_comment.style.display="none"
        }else{
            reply_comment.style.display="none";
            display_reply_comment.style.display="block"
        }
    }

    function hideEditReplyForm(reply_comment_id){
        const reply_comment = document.getElementById(`edit-replies-${reply_comment_id}`);
        const display_reply_comment = document.getElementById(`display-replies-${reply_comment_id}`);

        reply_comment.style.display="none";
        display_reply_comment.style.display="block"
    }



</script>