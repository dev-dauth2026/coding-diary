<div class="ms-2 " id="replies-{{$comment->id}}" style="display: none;" >
    
    @foreach($comment->replies as $reply)
        <div class="d-flex " >
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
                            <form action="{{ route('account.comments.destroy', $reply->id) }}" method="POST">
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
                  <p>  {{$reply->content}}</p>
                  {{-- replies reply  --}}
                  @if($reply->replies->isNotEmpty())
                  <div class="ms-2 " id="replies-reply-{{$reply->id}}" style="display: flex;" >

                          @foreach($reply->replies as $rereply)
                              <div class="d-flex  gap-1" >
                                  <div>
                                      <img src="{{ $rereply->user->profile_picture ? asset('storage/' . $rereply->user->profile_picture) : 'https://via.placeholder.com/50' }}" alt="Profile Picture" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
                                  </div>
                                  <div class="d-flex flex-column  flex-grow-1">
                                      <div class="d-flex  gap-2">
                                          <strong>{{ $rereply->user->name }} : <small class="mx-2 text-secondary">{{$rereply->created_at}} </small> </strong>
                                  
                                          {{-- if user can update and delete the comment  --}}
                                          <div class="d-flex gap-2 align-items-center">
                                              @can('update',$rereply)
                                              <small><button class="border-0 text-secondary bg-secondary-subtle p-1 rounded " onclick="editReply({{$rereply->id}})">Edit</button></small> 
                                              @endcan
                                              @can('delete',$rereply)
                                              <small>
                                                  <form action="{{ route('comment.destroy', $rereply->id) }}" method="POST">
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
                                      <div id="display-replies-{{$rereply->id}}" style="display: block;">
                                          {{$rereply->content}}
                                      </div>

                                         {{-- edit replies form  --}}
                                      <div id="edit-replies-{{$rereply->id}}" style="display: none;">
                                          <form action="{{route('comment.reply.update',$rereply->id)}}" method="POST" class="d-flex flex-column gap-3">
                                              @csrf
                                              @method('PUT')
                                              <div class="form-group">
                                                  <textarea class="form-control" name="replies_content" id="replies_content-{{$rereply->id}}" rows="2" value="{{old('replies_content',$rereply->content)}}">{{$rereply->content}}</textarea>
                                              </div>
                                              <div class="d-flex gap-2">
                                                  <button class="btn btn-outline-danger btn-sm " type="button" onclick="hideEditReplyForm({{$rereply->id}})">Cancel</button>
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
                  {{-- replies reply end  --}}
                </div>

                   {{-- edit replies form  --}}
                <div id="edit-replies-{{$reply->id}}" style="display: none;">
                    <form action="{{route('account.comments.update',$reply->id)}}" method="POST" class="d-flex flex-column gap-3">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <textarea class="form-control" name="update_content" id="replies_content-{{$reply->id}}" rows="2" value="{{old('replies_content',$reply->content)}}">{{$reply->content}}</textarea>
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
        <div class="col-4 d-flex mb-4 ">
            
            <button class="btn btn-transparent text-decoration-none text-secondary p-0" type="button" onclick="replyFormShow({{$reply->id}})">
                <small class="text-nowrap">Reply <i class="fa-solid fa-reply"></i></small>  
            </button>                             
        </div>
        {{-- reply and like buttons ends --}}

        {{-- reply form  --}}
        <div class="reply-form w-100 mb-3" id="reply-form-{{$reply->id}}" style="display: {{session('reply_comment_id')==$comment->id && $errors->replyError->isNotEmpty()?'flex':'none'}} ;">
            <form action='{{route('account.comments.reply',$reply->id)}}' method='post' class='d-flex flex-column gap-2 w-100' >
                @csrf
                <div class='form-floating'>
                    <textarea  class='form-control @if(session('reply_comment_id')==$comment->id && $errors->replyError->has('comment_reply')) is-invalid @endif' id='floatingTextarea' rows="2"  placeholder='Write your reply to the comment' name ='comment_reply'> </textarea>
                    <label for='floatingTextarea'>Reply to the comment...</label>
                </div>
                <div class='d-flex justify-content-end gap-2'>
                    <button type='button' class='btn btn-outline-danger btn-sm' onclick="replyFormHide({{$reply->id}})">Cancel</button>
                    <button type='submit' class='btn btn-outline-info btn-sm'>Reply</button>
                </div>

            </form>
        </div>
        {{-- reply form ends --}}

    @endforeach

</div>
