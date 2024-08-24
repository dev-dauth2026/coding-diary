<div class="container col-12 my-5 ">
    <h3 class="mt-5">Comments</h3>
        @if($comments->isEmpty())
            <p>No comments yet. Be the first to comment!</p>
        @endif

        {{--  use is able to add a comment  --}}
        @auth
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
        @endauth
        {{--  user is able to add a comment ends  --}}
        @guest
        <p class="mt-4">Please <a href="{{ route('account.login') }}">login</a> to add a comment.</p>
        @endguest
         
        {{--  comments is not empty  --}}
        @if(!empty($comments))

            {{-- foreach for displaying all comments --}}
            @foreach($comments as $comment)
                <div class="mb-3 bg-body p-3 rounded gap-5">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="d-flex gap-2 w-100">
                            <div class="">
                                <img src="{{ $comment->user->profile_picture ? asset('storage/' . $comment->user->profile_picture) : 'https://via.placeholder.com/50' }}" alt="Profile Picture" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                            </div>
                            <div class="d-flex flex-column flex-grow-1">
                                <div class="d-flex align-items-center">
                                    <strong>{{ $comment->user->name }} : <small class="ms-3 text-secondary">{{$comment->created_at}} </small> </strong>
                                    {{-- replies display toggle button  --}}
                                        @if($comment->replies->isNotEmpty())
                                        <button class="btn btn-transparent text-secondary btn-sm" type="button" onclick="toggleReplies({{ $comment->id }})">
                                            <div class="text-nowrap d-flex align-items-center gap-2">
                                           <span>{{ $comment->replies->count() }} {{$comment->replies->count()==1?'reply':'replies'}}</span>  <i class="fas fa-chevron-down" id="arrow-down-{{$comment->id}}" style="display: block;"></i> <i class="fas fa-chevron-up" id="arrow-up-{{$comment->id}}" style="display: none;"></i>

                                            </div>
                                        </button>
                                        @endif
        
                                        @if($comment->likes->isNotEmpty())
                                            <small class="text-secondary">{{$comment->likes->count()}} {{$comment->likes->count()==1?'like':'likes'}} </small>
                                        @endif
                                </div>
    
                                <div class="" id="comment-content-{{ $comment->id }}">
                                    <p class="mb-3" id="comment-{{$comment->id}}">{{ $comment->content }}</p>
                                     {{-- if user logged in can only edit or delete their comments  --}}
                                        @can('update',$comment)
                                        <div id="comment-edit-{{$comment->id}}" class="" style="display: none;">
                                            <form action="{{route('comment.update', $comment->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <textarea name="updateContent" id="updateContent" class="form-control @error('updateContent') is-invalid @enderror" rows="3">{{ old('updateContent', $comment->content) }}</textarea>
                                                    @error('updateContent')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <button type="button" class="btn btn-secondary btn-sm" onclick="hideEditForm({{ $comment->id }});">Cancel</button>
                                                <button type="submit" class="btn btn-outline-info btn-sm">Update</button>
                                            </form>
                                        </div>  
                                    @endcan
                                    {{-- if user logged in can only edit or delete comment  ends--}}
    
                                    {{-- replies contents  --}}
                                    @if($comment->replies->isNotEmpty())
                                    <div class="ms-5 mb-3" id="replies-{{$comment->id}}" style="display: none;" >
    
                                            @foreach($comment->replies as $reply)
                                                <div class="mb-3 d-flex  gap-3" >
                                                    <div>
                                                        <img src="{{ $reply->user->profile_picture ? asset('storage/' . $reply->user->profile_picture) : 'https://via.placeholder.com/50' }}" alt="Profile Picture" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
                                                    </div>
                                                    <div class="d-flex flex-column gap-2  flex-grow-1">
                                                        <div class="d-flex  gap-2">
                                                            <strong>{{ $reply->user->name }} : <small class="mx-2 text-secondary">{{$reply->created_at}} </small> </strong>
                                                    
                                                            {{-- if user can update and delete the comment  --}}
                                                            <div class="d-flex gap-2 align-items-center">
                                                                @can('update',$reply)
                                                                <small><button class="border-0 text-secondary bg-secondary-subtle p-1 rounded " onclick="editReply({{$reply->id}})">Edit</button></small> 
                                                                @endcan
                                                                @can('delete',$reply)
                                                                <small>
                                                                    <form action="{{ route('comment.destroy', $reply->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="text-decoration-none text-secondary bg-secondary-subtle p-1 rounded border-0" onclick="return confirm('Do you really want to delete the comment?')">
                                                                            Delete
                                                                        </button>
                                                                    </form>
                                                                </small> 
                                                                @endcan
        
                                                                </div>
                                                            {{-- if user can update and delete the comment ends--}}
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
                                                                    <button class="btn btn-outline-danger btn-sm " type="button" onclick="hideEditReplyForm({{$reply->id}})">Cancel</button>
                                                                    <button class="btn btn-outline-info btn-sm" type="submit">Update</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    {{-- edit replies form  ends --}}
    
                                                    </div> 
                                                </div>
    
                                            @endforeach
    
                                    </div>
                                    @endif
                                    {{-- replies contents  ends--}}
                                    
                                    {{-- reply and like buttons  --}}
                                    <div class="col-4 d-flex ">
                                        
                                        <button class="btn btn-transparent text-decoration-none text-secondary p-0" type="button" onclick="replyFormShow({{$comment->id}})">
                                            <small class="text-nowrap">Reply <i class="fa-solid fa-reply"></i></small>  
                                        </button>
    
                                        {{-- like comment  --}}
                                        @auth
                                            @php
                                                
                                                $userLike = $comment->likes->where('user_id', Auth::user()->id)->first(); // Assume the user hasn't liked the comment
                                            @endphp
                                    
                                            @if($userLike)
                                                @if($userLike->count()>0)
                                                <small class="text-nowrap">
                                                    Liked
                                                    <i class="fa-solid fa-thumbs-up" ></i>
                                                </small>
                                                @endif
    
                                            @else
                                            <form action="{{route('comment.like',$comment->id)}}" method="POST">
                                                @csrf
    
                                                <button class="btn btn-transparent text-decoration-none text-secondary" type="submit" >
                                                    <small class="text-nowrap">
                                                            Like
                                                            <i class="fa-regular fa-thumbs-up"  ></i>
                                                    </small> 
                                                    
                                                </button>
                                            </form>
                                            @endif
                                        @endauth
                                    
                                        {{-- like comment  ends--}}
                                        
                                    </div>
                                    {{-- reply and like buttons ends --}}
    
                                    {{-- reply form  --}}
                                    <div class="reply-form w-100 " id="reply-form-{{$comment->id}}" style="display: {{session('reply_comment_id')==$comment->id && $errors->replyError->isNotEmpty()?'flex':'none'}} ;">
                                        <form action='{{route('comment.reply',$comment->id)}}' method='post' class='d-flex flex-column gap-2 w-100' >
                                            @csrf
                                            <div class='form-floating'>
                                                <textarea  class='form-control @if(session('reply_comment_id')==$comment->id && $errors->replyError->has('comment_reply')) is-invalid @endif' id='floatingTextarea'  placeholder='Write your reply to the comment' name ='comment_reply'> </textarea>
                                                <label for='floatingTextarea'>Reply to the comment...</label>
                                            </div>
                                            <div class='d-flex justify-content-end gap-2'>
                                                <button type='button' class='btn btn-outline-danger btn-sm' onclick="replyFormHide({{$comment->id}})">Cancel</button>
                                                <button type='submit' class='btn btn-outline-info btn-sm'>Reply</button>
                                            </div>
                        
                                        </form>
                                    </div>
                                    {{-- reply form ends --}}
    
                                </div>
    
                            </div>
                        </div>

                        {{-- edit delete toggle  --}}
                        <div class="d-flex gap-2 align-items-start ">
                            <div class="btn-group dropstart">
                                @can('update', $comment)
                                    @can('delete', $comment)
                                    <button type="button" class="btn btn-transparent border-0 " data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical" ></i>
                                    </button>
                                
                                    <ul class="dropdown-menu " class="">
                                    <li class="dropdown-item">
                                        <button class="btn btn-transparent m-0 p-0  w-100 text-start" type="button" onclick="showEditForm({{$comment->id}})">
                                            Edit
                                        </button>
                                    </li>
                                    <li class="dropdown-item">
                                        <form action="{{ route('comment.destroy', $comment->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn bg-transparent border-none m-0 p-0 w-100 text-start" type="submit" onclick="return confirm('Are you really want to delete this comment?')">Delete</button>
                                        </form>
                                    </li>
                                    </ul>
                                    @endcan
                                @endcan
                            </div>
                        </div>
                         {{-- edit delete toggle end --}}
                    </div>
                    
                </div>
            @endforeach
            {{-- foreach for displaying all comments ends--}}

        @endif
        {{-- if comments is not empty ends --}}
</div>

<script>
    function showEditForm(commentId) {
        const editComment =  document.getElementById(`comment-edit-${commentId}`);
        const comment =  document.getElementById(`comment-${commentId}`);
        const replyForm = document.getElementById(`reply-form-${commentId}`)

        editComment.style.display = "block";
        comment.style.display = "none";
        replyForm.style.display = "none";

    }

    function hideEditForm(commentId) {
        const editComment =  document.getElementById(`comment-edit-${commentId}`);
        const comment =  document.getElementById(`comment-${commentId}`);
        const replyForm = document.getElementById(`reply-form-${commentId}`)

        editComment.style.display = "none";
        comment.style.display = "flex";
        replyForm.style.display = "none";
    }

    function replyFormShow(commentId){
        const replyForm = document.getElementById(`reply-form-${commentId}`);
        const button = event.target;

        if(replyForm){

            replyForm.style.display = "flex";
        }
    }
   
    function replyFormHide(commentId){
        const button = event.target;
        // document.getElementById(`reply-form-${commentId}`).style.display = "d-block";
        document.getElementById(`reply-form-${commentId}`).style.display="none";
    }

    function likeToggle(commentId){
        const like =  document.getElementById(`like-${commentId}`);
        const liked = document.getElementById(`liked-${commentId}`);

        if (liked.style.display == 'none'){
            like.style.display = 'none';
            liked.style.display = 'block';
        }else
            like.style.display='block';
            liked.style.display='none';
    }

    function toggleReplies(commentId){
        const replies = document.getElementById(`replies-${commentId}`);
        const arrowDown = document.getElementById(`arrow-down-${commentId}`);
        const arrowUp = document.getElementById(`arrow-up-${commentId}`);
        const button = event.target;

        if(replies.style.display=="none"){
            replies.style.display="block";
            arrowDown.style.display="none";
            arrowUp.style.display="block";
        }else{
            replies.style.display="none";
            arrowDown.style.display="block";
            arrowUp.style.display="none";
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