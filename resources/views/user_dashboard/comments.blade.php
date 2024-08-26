<x-user-dashboard-layout>
    <main style="min-height:90vh;">

        <x-message.message></x-message.message>

        <div class="container py-3 py-md-3">
            <!-- Page Header -->
            <div class="mb-3">
                <h4>My Comments</h4>
                <hr class="col-2">
            </div>

            <!-- Comment Statistics Section -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title">Total Comments</h5>
                            <p class="display-5">{{ $totalComment }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title">Comments This Month</h5>
                            <p class="display-5">{{ $totalCommentsThisMonth }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title">Most Liked Comment</h5>
                            @if($mostLikedComment)
                                <p class="display-6"><a class="text-decoration-none" href="{{ route('blog.detail', $mostLikedComment->blogPost->id) }}"> "{{ Str::limit($mostLikedComment->blogPost->title, 30) }}" </a></p>
                                <p class="text-muted">{{ Str::limit($mostLikedComment->content, 50) }}</p>
                                <p class="text-muted">Likes: {{ $mostLikedComment->likes_count }}</p>
                            @else
                                <p class="text-muted">No comments yet.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters and Search Bar -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Search comments..." aria-label="Search">
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option selected>Filter by Post</option>
                        <option value="1">Post A</option>
                        <option value="2">Post B</option>
                        <option value="3">Post C</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option selected>Filter by Date</option>
                        <option value="1">Last 7 Days</option>
                        <option value="2">Last 30 Days</option>
                        <option value="3">This Year</option>
                    </select>
                </div>
            </div>

            <!-- Comments List -->
            <div class="row">
                @if($comments)
                    @foreach($comments as $comment)
                    <!-- Comment Card -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body position-relative">
                                <!-- Dropdown Toggle for Edit and Delete -->
                                <div class="dropdown position-absolute top-0 end-0">
                                    <button class="btn btn-sm btn-light" type="button" id="dropdownMenuButton{{ $comment->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton{{ $comment->id }}">
                                        <li>
                                            <button class="dropdown-item btn btn-transparent  " type="button" onclick="showEditForm({{$comment->id}})">
                                                Edit
                                            </button>
                                        </li>
                                        <li>
                                            <form action="{{ route('account.comments.destroy', $comment->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item btn btn-transparent text-decoration-none " type="submit" onclick="return confirm('Are you sure you want to dislike the comment and remove it?')">
                                                     Delete
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>

                                <h5 class="card-title"> <a class="text-decoration-none" href="{{ route('blog.detail', $comment->blogPost->id) }}">{{ $comment->blogPost->title }}</a> </h5>
                                <small class="card-subtitle mb-2 text-secondary">Posted on: {{ $comment->created_at->format('d F Y') }} | {{ $comment->created_at->diffForHumans() }}</small>
                                {{-- replies display toggle button  --}}
                                @if($comment->replies->isNotEmpty())
                                <button class="btn btn-transparent text-secondary btn-sm d-block" type="button" onclick="toggleReplies({{ $comment->id }})">
                                    <div class="text-nowrap d-flex align-items-center gap-2">
                                   <span>{{ $comment->replies->count() }} {{$comment->replies->count()==1?'reply':'replies'}}</span>  <i class="fas fa-chevron-down" id="arrow-down-{{$comment->id}}" style="display: block;"></i> <i class="fas fa-chevron-up" id="arrow-up-{{$comment->id}}" style="display: none;"></i>

                                    </div>
                                </button>
                                @endif
                                <div class="" id="comment-content-{{ $comment->id }}">
                                    <p class="mb-1" id="comment-{{$comment->id}}">{{ $comment->content }}</p>
                                     {{-- if user logged in can only edit or delete their comments  --}}
                                        @can('update',$comment)
                                        <div id="comment-edit-{{$comment->id}}" class="" style="display: none;">
                                            <form action="{{route('account.comments.update', $comment->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <textarea name="update_content" id="updateContent" class="form-control @error('update_content') is-invalid @enderror" rows="3">{{ old('updateContent', $comment->content) }}</textarea>
                                                    @error('update_content')
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
                                    <div class="ms-5 " id="replies-{{$comment->id}}" style="display: none;" >
    
                                            @foreach($comment->replies as $reply)
                                                <div class="d-flex  gap-1" >
                                                    <div>
                                                        <img src="{{ $reply->user->profile_picture ? asset('storage/' . $reply->user->profile_picture) : 'https://via.placeholder.com/50' }}" alt="Profile Picture" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
                                                    </div>
                                                    <div class="d-flex flex-column  flex-grow-1">
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
                                                            <form action="{{route('account.comments.update',$reply->id)}}" method="POST" class="d-flex flex-column gap-3">
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
                                                {{-- reply and like buttons  --}}
                                                <div class="col-4 d-flex ">
                                                    
                                                    <button class="btn btn-transparent text-decoration-none text-secondary p-0" type="button" onclick="replyFormShow({{$comment->id}})">
                                                        <small class="text-nowrap">Reply <i class="fa-solid fa-reply"></i></small>  
                                                    </button>                             
                                                </div>
                                                {{-- reply and like buttons ends --}}

                                                {{-- reply form  --}}
                                                <div class="reply-form w-100 " id="reply-form-{{$comment->id}}" style="display: {{session('reply_comment_id')==$comment->id && $errors->replyError->isNotEmpty()?'flex':'none'}} ;">
                                                    <form action='{{route('comment.reply',$comment->id)}}' method='post' class='d-flex flex-column gap-2 w-100' >
                                                        @csrf
                                                        <div class='form-floating'>
                                                            <textarea  class='form-control @if(session('reply_comment_id')==$comment->id && $errors->replyError->has('comment_reply')) is-invalid @endif' id='floatingTextarea' rows="2"  placeholder='Write your reply to the comment' name ='comment_reply'> </textarea>
                                                            <label for='floatingTextarea'>Reply to the comment...</label>
                                                        </div>
                                                        <div class='d-flex justify-content-end gap-2'>
                                                            <button type='button' class='btn btn-outline-danger btn-sm' onclick="replyFormHide({{$comment->id}})">Cancel</button>
                                                            <button type='submit' class='btn btn-outline-info btn-sm'>Reply</button>
                                                        </div>
                                    
                                                    </form>
                                                </div>
                                                {{-- reply form ends --}}
    
                                            @endforeach
    
                                    </div>
                                    @endif
                                    {{-- replies contents  ends--}}
                                    
                                </div>

                                @if($comment->replies->isNotEmpty())
                                <div class="ms-5 " id="replies-{{$comment->id}}" style="display: none;" >

                                        @foreach($comment->replies as $reply)
                                            <div class="d-flex  gap-1" >
                                                <div>
                                                    <img src="{{ $reply->user->profile_picture ? asset('storage/' . $reply->user->profile_picture) : 'https://via.placeholder.com/50' }}" alt="Profile Picture" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
                                                </div>
                                                <div class="d-flex flex-column  flex-grow-1">
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
                                                <!-- Reply and Like Feature -->
                                                <div class="d-flex justify-content-start align-items-center">
                                                    <button class="btn btn-transparent text-decoration-none text-secondary me-3" type="button" onclick="replyFormShow({{ $comment->id }})">
                                                        <small class="text-nowrap"><i class="fa-solid fa-reply"></i> Reply</small>
                                                    </button>
                                                    
                                                </div>
                                                {{-- replies contents  --}}
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

                                        @endforeach

                                </div>
                                @endif
                                {{-- replies contents  ends--}}
                              
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $comments->links('pagination::bootstrap-5') }} <!-- Use Bootstrap 5 pagination links -->
            </div>

            <!-- Top Commented Posts Section -->
            <div class="mt-5">
                <h5>Top Commented Posts</h5>
                <hr class="col-2">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        How to Learn Laravel
                        <span class="badge bg-primary rounded-pill">10 Comments</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Understanding MVC Architecture
                        <span class="badge bg-primary rounded-pill">8 Comments</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Laravel vs. Other Frameworks
                        <span class="badge bg-primary rounded-pill">5 Comments</span>
                    </li>
                </ul>
            </div>

            <!-- Bulk Actions and Export Comments -->
            <div class="mt-4 d-flex justify-content-between">
                <div>
                    <button class="btn btn-outline-secondary me-2">Delete All</button>
                    <button class="btn btn-outline-secondary">Mark All as Read</button>
                </div>
                <div>
                    <button class="btn btn-outline-secondary">Export Comments</button>
                </div>
            </div>

            <!-- Notifications Panel -->
            <div class="mt-5">
                <h5>Recent Notifications</h5>
                <hr class="col-2">
                <ul class="list-group">
                    <li class="list-group-item">Jane Smith replied to your comment on "How to Learn Laravel".</li>
                    <li class="list-group-item">New comment on your post "Understanding MVC Architecture".</li>
                    <li class="list-group-item">Your comment on "Laravel vs. Other Frameworks" received a new like.</li>
                </ul>
            </div>
        </div>
    </main>

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
</x-user-dashboard-layout>
