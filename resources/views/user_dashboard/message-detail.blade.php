<x-user-dashboard-layout>
    <main style="min-height:90vh;">
        <div class="container py-3 py-md-3">

            <x-message.message></x-message.message>
            <!-- Page Header -->
            <div class="mb-3">
                <h4>My Messages</h4>
                <hr class="col-2">
            </div>

            <div class="row">
              
                <!-- Right Content: Message Details and Reply Form -->
                <div class="col-md-12 ">
                    @isset($message)
                    <!-- Message Content -->
                    <div class="card mb-4">
                        <div class="card-header d-flex flex-column flex-sm-row justify-content-start justify-content-sm-between align-items-sm-center align-item-start">
                            <div>
                                <strong>Subject: </strong>{{ $message->subject }}
                            </div>
                            <div>
                                <small class="text-muted">{{ $message->created_at->format('d M Y, h:i A') }}</small>
                            </div>
                        </div>
                        <div class="card-body">
                            <small class="text-secondary">From: {{ $message->sender->name }} ({{$message->sender->email}}) </small>
                            <small class="text-secondary">to me: {{ $message->receiver->name }} ({{$message->receiver->email}}) </small>

                            <hr>
                            <p>{{ $message->content }}</p>
                            <hr>
                            @if($message->parent)
                            <small class="text-secondary">From: {{ $message->parent->sender->name }} ({{$message->parent->sender->email}}) </small>
                            <small class="text-secondary">to : {{ $message->parent->receiver->name }} ({{$message->parent->receiver->email}}) </small>
                               
                                <p class="text-secondary">{{$message->parent->content}} </p>
                            @endif
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <div>
                                <button class="btn bg-trasparent text-secondary" onclick="toggleReplyForm({{$message->id}})">Reply <i class="fa-solid fa-reply"></i></button>
                                
                            </div>
                            <div>

                                <form action="{{ route('account.messages.destroy', $message->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this message?')">Delete</button>
                                </form>
                                @if(!$message->is_read)
                                <form action="{{ route('account.messages.markRead', $message->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary btn-sm">Mark as Read</button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Reply Form -->
                    <div class="card" id="replyForm-{{$message->id}}" style="display:{{session('reply-error-id')==$message->id?'block':'none'}};">
                        <div class="card-header">
                            <p class="fs-5 d-none d-sm-block">Reply to {{ $message->sender->name }} ({{$message->sender->email}}) </p>
                            <p class="d-block d-sm-none fs-6">Reply to {{ $message->sender->name }} ({{$message->sender->email}}) </p>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('account.messages.reply', $message->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <textarea name="reply_content" class="form-control @error('reply_content') is-invalid @enderror" rows="4" placeholder="Write your reply..."></textarea>
                                    @error('reply_content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-between">

                                    <button type="button" class="btn btn-danger btn-sm" onclick="hideReplyForm({{$message->id}})">Cancel</button>
                                    <button type="submit" class="btn btn-info btn-sm">Send Reply</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endisset
                </div>
            </div>
        </div>
    </main>

    <script>
        function toggleReplyForm(messageId){
            const replyForm = document.getElementById(`replyForm-${messageId}`);
            if(replyForm.style.display==="none"){
                replyForm.style.display="block";
            }else{  
                replyForm.style.display="none";
            }
        }
        function hideReplyForm(messageId){
            const replyForm = document.getElementById(`replyForm-${messageId}`);
             
            replyForm.style.display="none";
            
        }
    </script>
</x-user-dashboard-layout>
