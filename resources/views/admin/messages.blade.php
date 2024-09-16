<x-admin.admin-layout>
    <div class="container p-3 bg-body-tertiary">
        <x-message.message></x-message.message>
        <h4 class=""><i class="fa-solid fa-envelope me-2"></i>Admin Messages</h4>
        <hr class="col-3 mb-5">

        <!-- Message Filters -->
        <form action="{{ route('admin.messages') }}" method="GET" class="row mb-4">
            <input type="hidden" value="{{$message_status}}" name="message_status" hidden>
            <div class="col-md-6">
                <input type="text" name="message_search" value="{{ request('message_search') }}" class="form-control" placeholder="Search messages..." aria-label="Search">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select" onchange="this.form.submit()">
                    <option value="all">All Status</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Read</option>
                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Unread</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
            <div class="col-md-1">
                <a href="{{ route('admin.messages',['message_status'=>$message_status]) }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>

        <!-- Two-column layout -->
        <div class="row">
           
            <!-- Left Column: Messages List -->
            <div class="col-lg-4 col-md-12 mb-4">
                <div class="d-flex">
                    <ul class="nav nav-tabs ">
                        <li class="nav-item">
                            <form action="{{route('admin.messages')}}" method="GET">
                                <input type="hidden" value="received" name="message_status" hidden>
                                <button type="submit" class="nav-link  text-decoration-none text-dark {{$message_status=='received'?'active':''}}" aria-current="page">Received</button>
                            </form>
                        </li>
                        <li class="nav-item">
                            <form action="{{route('admin.messages')}}" method="GET">
                                <input type="hidden" value="sent" name="message_status" hidden>
                                <button type="submit" class="nav-link text-decoration-none text-dark {{$message_status=='sent'?'active':''}}" aria-current="page">Sent</button>
                            </form>
                        </li>
                        
                    </ul>
                    {{-- Compose section --}}
                    {{-- Compose section --}}
                    <div class="ms-auto">
                        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#compose">Compose</button>

                        {{-- Check if there are any validation errors and adjust modal attributes accordingly --}}
                        <div class="modal fade @if($errors->any()) show @endif" id="compose" tabindex="-1" aria-labelledby="composeTitle" aria-hidden="true" @if($errors->any()) style="display: block;" @else style="display: none;" @endif>
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="composeTitle">New message</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.messages.store') }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="recipient_id" class="col-form-label">Recipient:</label>
                                                <select name="recipient_id" id="recipient" class="form-select @error('recipient_id') is-invalid @enderror">
                                                    <option value="">Select Recipient</option>
                                                    @foreach($recipients as $recipient)
                                                        <option value="{{ $recipient->id }}" {{ old('recipient_id') == $recipient->id ? 'selected' : '' }}>{{ $recipient->name }} - <span class="text-secondary bg-secondary-subtle">{{ $recipient->email }}</span> </option>
                                                    @endforeach
                                                </select>
                                                @error('recipient_id')
                                                    <p class="invalid-feedback">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="subject" class="col-form-label">Subject:</label>
                                                <input class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject') }}">
                                                @error('subject')
                                                    <p class="invalid-feedback">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="message_content" class="col-form-label">Message:</label>
                                                <textarea class="form-control @error('message_content') is-invalid @enderror" id="message_content" name="message_content">{{ old('message_content') }}</textarea>
                                                @error('message_content')
                                                    <p class="invalid-feedback">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{route('admin.messages')}}" class="btn btn-secondary btn-sm" >Close</a>
                                                <button type="submit" class="btn btn-primary btn-sm">Send message</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Add the backdrop if there are validation errors --}}
                        @if($errors->any())
                            <div class="modal-backdrop fade show"></div>
                        @endif
                    </div>
                    {{-- Compose section ends--}}

                </div>
                

                    <!-- Messages List -->
                    <div class="list-group border-top-0">
                            @forelse ($messages as $msg)
                            <a href="{{ route('admin.messages.show', ['message'=>$msg,'message_status'=>$message_status,'page'=>request('page'),'message_search'=>$message_search])}}" class="list-group-item list-group-item-action border-top-0 {{ $msg->is_read ? '' : 'bg-light' }}">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6>{{ Str::limit($msg->subject, 30) }}</h6>
                                        <p class="mb-1 text-muted">{{ Str::limit($msg->content, 50) }}</p>
                                        <small class="text-secondary">
                                            @if($message_status=='received')
                                            From: {{ $msg->sender->name }}
                                            @else
                                            to: {{ $msg->receiver->name }}
                                            @endif
                                        </small>
                                    </div>
                                    <div class="text-end">
                                        <small class="text-muted">{{ $msg->created_at->diffForHumans() }}</small>
                                        <div>
                                            @if(!$msg->is_read)
                                            <span class="badge bg-primary">Unread</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @empty
                            <p colspan="5" class="text-center">No messages found.</p>
                            @endforelse
                    </div>

                    <!-- Pagination Links -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $messages->links('pagination::bootstrap-5') }}
                    </div>
                </div>


                 <!-- Right Content: Message Details and Reply Form -->
                 <div class="col-md-8">

                    @isset($message)
                    <!-- Message Content -->

                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong>Subject: </strong>{{ $message->subject }}
                            <div>
                                <small class="text-muted">{{ $message->created_at->format('d M Y, h:i A') }}</small>
                            </div>
                        </div>
                        <div class="card-body">
                            <small class="text-secondary">From: {{ $message->sender->name }} ({{$message->sender->email}}) </small>
                            <small class="text-secondary">to {{request('message_status')=='received'?'me':''}}: {{ $message->receiver->name }} ({{$message->receiver->email}}) </small>

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
                                @if(!$message->is_read)
                                <form action="{{ route('admin.messages.markRead', $message->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary btn-sm">Mark as Read</button>
                                </form>
                                @endif
                            </div>
                            <form action="{{ route('account.messages.destroy', $message->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this message?')">Delete</button>
                            </form>
                            
                        </div>
                    </div>

                    <!-- Reply Form -->
                    <div class="card" id="replyForm-{{$message->id}}" style="display:{{session('reply-error-id')==$message->id?'block':'none'}};">
                        <div class="card-header">
                            <h5>Reply to {{ $message->sender->name }} ({{$message->sender->email}}) </h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.messages.reply', $message->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <textarea name="reply_content" class="form-control @error('reply_content') is-invalid @enderror" rows="4" placeholder="Write your reply..."></textarea>
                                    @error('reply_content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-between">

                                    <button type="button" class="btn btn-danger btn-sm" onclick="hideReplyForm({{$message->id}})">Cancel</button>
                                    <button type="submit" class="btn btn-primary btn-sm">Send Reply</button>
                                </div>
                            </form>
                        </div>
                    </div>
                     <!-- Reply Form ends-->
                    @endisset
                </div>
            </div>

            <!-- Right Column: Message Detail -->
            <div class="col-lg-8 col-md-12">
                @if(isset($selectedMessage))
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h5>{{ $selectedMessage->subject }}</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>From:</strong> {{ $selectedMessage->sender->name }}</p>
                            <p><strong>Received:</strong> {{ $selectedMessage->created_at->diffForHumans() }}</p>
                            <hr>
                            <p>{{ $selectedMessage->body }}</p>
                        </div>
                    </div>
                @else
                    <div class="text-center">
                        <p class="text-muted">Select a message to view the details.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

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
</x-admin.admin-layout>
