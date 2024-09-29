<x-user-dashboard-layout>
    <main class="pb-5" style="min-height:90vh;">

        <x-message.message></x-message.message>

        <div class="container py-3 py-md-3">
            <!-- Page Header -->
            <div class="mb-3">
                <h4>My Comments</h4>
                <hr class="col-6 col-md-3 col-lg-2">
            </div>

            <!-- Comment Statistics Section -->
            <div class="row mb-4">
                <div class="col-6 col-md-4 col-lg-4 mb-2">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <h5 class="card-title text-secondary">Total Comments</h5>
                            <p class="display-4 ">{{ $totalComment }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-4 mb-2">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <h5 class="card-title text-secondary">Comments This Month</h5>
                            <p class="display-4 ">{{ $totalCommentsThisMonth }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <h5 class="card-title text-secondary">Most Liked Comment</h5>
                            @if($mostLikedComment)
                            <p class="fw-bold">"{{ Str::limit($mostLikedComment->content, 50) }}"</p>
                            <div class="d-flex gap-2">
                                <p class=" "><a class="text-decoration-none text-info" href="{{ route('blog.detail', $mostLikedComment->blogPost->id) }}"> {{ Str::limit($mostLikedComment->blogPost->title, 30) }} </a></p>
                                    <p class="text-muted">Likes: {{ $mostLikedComment->likes_count }}</p>
                            </div>
                            @else
                                <p class="text-muted">No comments yet.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters and Search Bar -->
            <div class=" mb-4">
                <form action="{{route('account.comments')}}" method="GET" class="row gap-2">
                    <div class="col-md-6">
                        <input type="text" name="comment_search" value="{{old('comment_search',$comment_search)}}" class="form-control" placeholder="Search comments or blog post title..." aria-label="Search">
                    </div>
                   
                    <div class="col-md-3">
                        <select name="date_filter" class="form-select" onchange="this.form.submit()">
                            <option value="">Filter by Date</option>
                            <option value="today" {{ request('date_filter') == 'today' ? 'selected' : '' }}>Today</option>
                            <option value="yesterday" {{ request('date_filter') == 'yesterday' ? 'selected' : '' }}>Yesterday</option>
                            <option value="7" {{ request('date_filter') == '7' ? 'selected' : '' }}>Last 7 Days</option>
                            <option value="30" {{ request('date_filter') == '30' ? 'selected' : '' }}>Last 30 Days</option>
                            <option value="365" {{ request('date_filter') == '365' ? 'selected' : '' }}>This Year</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <a href="{{route('account.comments')}}" class="btn btn-outline-secondary">Reset</a>
                    </div>

                </form>
            </div>

            <!-- Comments List -->
            <div class="row">
                @if($comments->count()>0)
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

                                <h5 class="card-title"> <a class="text-decoration-none text-info" href="{{ route('blog.detail', $comment->blogPost->id) }}">{{ $comment->blogPost->title }}</a> </h5>
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
                                        <div id="comment-edit-{{$comment->id}}" class="py-4 " style="display: none;">
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
                                        @include('user_dashboard.reply',['comment'=>$comment])
                                    @endif
                                    {{-- replies contents  ends--}}
                                    
                                </div>

                           
                              
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="d-flex justify-content-center align-items-center">
                        <p>No comments available!</p>
                    </div>
                @endif
            </div>

            <!-- Pagination -->
            @if($comments->count()>0)
            <div class="d-flex justify-content-center mt-4">
                {{ $comments->links('pagination::bootstrap-5') }} <!-- Use Bootstrap 5 pagination links -->
            </div>
            @endif

            <!-- Top Commented Posts Section -->
            <div class="mt-5">
                @if($topLikedComments)
                <h5>Top Liked Comments</h5>
                <hr class="col-2">
                <ul class="list-group list-group-flush">
                    @foreach($topLikedComments as $likedComment)
                    <li class="list-group-item py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Comment Content -->
                            <div class="flex-grow-1">
                                <p class="mb-1 "><i class="fa-solid fa-comment-dots me-2 text-secondary"></i>{{ Str::limit($likedComment->content, 80) }} <span class="text-secondary"><i class="fa-solid fa-thumbs-up mx-1"></i>{{ $likedComment->likes_count }} Likes</span></p>
                                <a href="{{ route('blog.detail', $likedComment->blogPost->id) }}" class="text-decoration-none">
                                    <h6 class="mb-0 text-secondary"><i class="fa-solid fa-book-open me-1 text-success"></i>{{ Str::limit($likedComment->blogPost->title, 50) }}</h6>
                                </a>
                            </div>
            
                            <!-- Comment Info -->
                            <div class="text-end">
                                <small class="text-muted"><i class="fa-solid fa-clock me-1"></i>{{ $likedComment->created_at->diffForHumans() }}</small>
                                <div>
                                    
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
                @else
                    <div>
                        You haven't commented to any blog post yet.
                    </div>
                @endif
            
            </div>


            <!-- Notifications Panel -->
            <div class="mt-5">
                <h5>Recent Notifications</h5>
                <hr class="col-2">
                @if($recent_comments_replies->isNotEmpty())
                <ul class="list-group">
                    @foreach($recent_comments_replies->take(3) as $reply)
                    <li class="list-group-item d-flex justify-content-between">
                        <div>
                            <strong>{{$reply->user->name}}</strong> replied to your comment on <strong>"{{$reply->blogPost->title}}"</strong>.
                        </div>
                        <div>
                            <small>{{$reply->created_at->diffForHumans()}} </small>
                        </div>
                    </li>
                    @endforeach
                </ul>
                @endif
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
