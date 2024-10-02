<x-admin.admin-layout>
    <div class="container p-3 bg-body-tertiary" style="min-height:80vh;">

        @if(Session::has('success'))
            <p class="bg-success-subtle text-success p-2 rounded">{{Session::get('success')}} </p>

        @endif

        <h4>All User comments</h4> 
        <hr class="col-2 mb-3">
        <div class="row">

            {{-- total comments  --}}
            <div class="col-12 col-md-6 col-lg-3 border-none">
                <div class="card h-100 text-white bg-info-gradient border-none border-0">
                    <div class="card-body d-flex flex-row justify-content-center align-items-center gap-3 text-center">
                        <i class="fas fa-blog fa-3x text-white-50"></i>
                        <div>
                            <h5 class="card-title mt-3 text-white">Total Comments</h5>
                            <p class="card-text display-4">{{$totalComments}}</p>
                        </div>
                    
                    </div>
                </div>
            </div>

            {{-- total new comments  --}}
            <div class="col-12 col-md-6 col-lg-3 border-none">
                <div class="card h-100 text-white bg-danger-gradient border-none border-0">
                    <div class="card-body d-flex flex-row justify-content-center align-items-center gap-3 text-center">
                        <i class="fas fa-message fa-3x text-white-50"></i>
                        <div>
                            <h5 class="card-title mt-3 text-white">New Comments</h5>
                            <p class="card-text display-4">{{$totalComments}}</p>
                        </div>
                    
                    </div>
                </div>
            </div>
            {{-- total new comments ends --}}
            <main class="mt-5 d-flex flex-column gap-5">
                <div>
                    <form action="{{route('admin.comments')}}" method="GET" class="row d-flex flex-row gap-3">
                        <div class="form-group flex-grow-1 col-md-4 col-12">
                            <input type="text" name="search_comment" class="form-control" value="{{old('search_comment',$search_comment)}}" placeholder="Search comment...">
                        </div>
                        <div class="form-group col-md-4 col-12 d-flex align-items-center gap-2">
                            <label for="post_title" class="text-nowrap ">Post Title : </label>
                            <select name="post_title" class="form-select" onchange="this.form.submit()">
                                <option value="">All</option>
                                @foreach($posts as $post)
                                <option value="{{$post->id}}" {{(old('post_title')==$post->id || $post_title_id==$post->id) ?'selected':''}}>{{$post->title}} </option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-md-2">
                            <a href="{{route('admin.comments')}}" class="btn btn-outline-secondary">Reset</a>
                        </div>
                    </form>
                </div>
                @if($comments->count()>0)
                <div class="table-responsive bg-body px-3 py-5 rounded">
                    <table class="table table-striped table-hover">
                            <thead>
                              <tr>
                                <th scope="col">ID</th>
                                <th scope="col">User</th>
                                <th class="text-wrap" scope="col" style="width: 400px;">Blog Post</th>
                                <th scope="col">Comments</th>
                                <th scope="col">Parent Comments</th>
                                <th scope="col ">Verified</th>
                                <th scope="col " style="width: 100px;">Featured</th>
                                <th scope="col ">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($comments as $comment)
                              <tr>
                                <th scope="row">{{$comment->id}} </th>
                                <td>{{$comment->user->name}} </td>
                                <td>{{$comment->blogPost->title}} </td>
                                <td>{{$comment->content}} </td>
                                <td>{{$comment->parent->content??'N/A'}} </td>
                                <td>
                                    <div class="d-flex  align-items-center ">
                                        <i class="fa-solid fa-circle-xmark text-danger"></i>
                                    </div>
                                </td>
                                <td style="width: 60px;">
                                    <form action="{{route('admin.comment.featured',$comment->id)}}" method="POST" class="form-group w-100">
                                        @csrf
                                        @method('PUT')
                                        <select name="featured" class="form-select form-select-sm w-100" onchange="this.form.submit()">
                                            <option value="1" {{( $comment->featured==1)?'selected':''}}>True</option>
                                            <option value="0"  {{( $comment->featured==0)?'selected':''}}>False</option>
                                        </select>
                                    </form>
                                    
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{route('admin.comments.edit',$comment->id)}}" class=""><i class="fa-solid fa-pen-to-square text-warning"></i></a>
                                        <form action="{{route('admin.comments.delete',$comment->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn bg-transparent border-none m-0 p-0" type="submit" onclick="return confirm('Are you really want to delete this comment?')"><i class="fa-solid fa-trash text-danger"></i></button>
                                        </form>
                                       
                                    </div>
                                </td>
                              </tr>
                              @endforeach
                         
                            </tbody>
                        </table>

                </div>
                 <!-- Pagination Links -->
                 <div class="d-flex justify-content-center mt-4">
                    {{ $comments->links('vendor.pagination.bootstrap-5') }}
                </div>
               
                @else

                <div class="d-flex justify-content-center align-items-center">
                    <p>Sorry no comments available!!</p>
                </div>

                @endif

                <div class="d-flex flex-column  p-3 ">
                    <h5 class="text-secondary">Recent Comments</h5>
                    <hr class="col-2 mb-5">

                    <div class="row gap-3">
                        {{-- if comments  --}}
                        @if($comments->count()>0)
                        @foreach($comments->take(3) as $comment)
                        <div class="col-12 bg-body d-flex flex-column gap-3 p-3 rounded">
                            <div class="d-flex flex-column comment-content gap-2" id="comment-content-{{$comment->id}}">
                                <div class="d-flex justify-content-between align-items-center ">
                                    <div>
                                        <img src="storage/" . {{$comment->user->profile_picture}} alt="" style="height: 40px;width:40px;border-radius:50%;">
                                        <span class="fw-bold ">{{$comment->user->name}}</span> <span> commented on <strong>{{$comment->blogPost->title}}</strong> blog post. </span> 

                                        {{-- replies display toggle button  --}}
                                        @if($comment->replies->isNotEmpty())
                                        <button class="btn btn-trapsparent text-secondary btn-sm" type="button" onclick="toggleReplies({{ $comment->id }})">
                                             {{ $comment->replies->count() }} {{$comment->replies->count()==1?'reply':'replies'}} 
                                        </button>
                                        @endif
                                         {{-- replies display toggle button end --}}
   
                                    </div>
                                    <form action="{{route('admin.comments.delete',$comment->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn bg-transparent border-none m-0 p-0" type="submit" onclick="return confirm('Are you really want to delete this comment?')"><i class="fa-solid fa-trash text-secondary"></i></button>
                                    </form>
                                     
                                </div>
                                 <small class="text-secondary">{{ $comment->created_at}} </small>
                            </div>
                            <p>{{$comment->content}} </p>

                            {{-- if replies    --}}

                            @if($comment->replies->isNotEmpty())
                               
                                @if($comment->replies)
                                    <div class="replies p-2  flex-column gap-2" id="replies-{{$comment->id}}" style="display: none;">
                                        @foreach($comment->replies as $reply)
                                        <div class="d-flex">
                                            <p><strong>{{ $reply->user->name }}</strong> replied:</p>
                                            <small class="text-secondary">{{ $reply->created_at }}</small>
                                        </div>
                                        <p>{{ $reply->content }}</p>
                
                                        @endforeach
                                    </div>

                                @endif

                            @endif
                             {{-- if replies  ends  --}}

                            @if(Session::has('reply_error'))
                                <p class="alert alert-danger p-2 my-2">{{Session::get('reply_error')}} </p>
                                <form action='{{route('admin.comments.reply',$comment->id)}}' method='post' class='d-flex flex-column gap-2'>
                                    @csrf
                                    <div class='form-floating'>
                                        <textarea  class='form-control ' id='floatingTextarea'  placeholder='Write your reply to the comment' name ='comment_reply'> </textarea>
                                        <label for='floatingTextarea'>Reply to the comment...</label>
                                    </div>
                                    <div class='d-flex justify-content-end gap-2'>
                                        <a href='{{route('admin.comments')}}' type='submit' class='btn btn-outline-danger'>Cancel</a>
                                        <button type='submit' class='btn btn-outline-info'>Reply</button>
                                    </div>
            
                            </form>
                            @endif
                            
                            <div class="col-4 d-flex gap-4">
                                <button class="btn btn-transparent">
                                    <a href="{{route('admin.comments.edit',$comment->id)}}" class="text-decoration-none text-secondary" ><i class="fa-solid fa-pen-to-square "></i></a>
                                </button>
                                <button class="btn btn-transparent text-decoration-none text-secondary" type="button" onclick="reply({{$comment->id}})">
                                    <i class="fa-regular fa-message text-secondary"></i>
                                </button>
                            </div>
                        </div>

                        @endforeach
                        @endif
                         {{-- if comments ends --}}
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script>

        function reply(commentId){

            const comment = document.getElementById(`comment-content-${commentId}`);
            const replyForm = document.createElement('div');
            replyForm.innerHTML = `
                        <form action='blogs/comments/reply/${commentId}' method='post' class='d-flex flex-column gap-2' >
                            @csrf
                            <div class='form-floating'>
                                <textarea  class='form-control' id='floatingTextarea'  placeholder='Write your reply to the comment' name ='comment_reply'> </textarea>
                                <label for='floatingTextarea'>Reply to the comment...</label>
                            </div>
                            <div class='d-flex justify-content-end gap-2'>
                                <a href='{{route('admin.comments')}}' type='submit' class='btn btn-outline-danger'>Cancel</a>
                                <button type='submit' class='btn btn-outline-info'>Reply</button>
                            </div>
    
                        </form>
                       
            `;
            comment.appendChild(replyForm);
        }

        function toggleReplies(commentId){
            const reply = document.getElementById(`replies-${commentId}`);
            const button = event.target;

            if(reply.style.display =="none"){
                reply.style.display = "flex ";
            }else{
                reply.style.display = "none ";
            }

        }

    </script>
</x-admin.admin-layout>
