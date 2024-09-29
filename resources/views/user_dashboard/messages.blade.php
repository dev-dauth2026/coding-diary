<x-user-dashboard-layout>
    <main style="min-height:90vh;">
        <div class="container py-3 py-md-3">

            <x-message.message></x-message.message>
            <!-- Page Header -->
            <div class="mb-3">
                <h4>My Messages</h4>
                <hr class="col-2">
            </div>

            <!-- Search and Filter Row -->
            <form method="GET" action="{{ route('account.messages.index') }}" class="d-flex flex-sm-row flex-column gap-3 mb-3">
                <input type="hidden" value="{{$message_status}}" name="message_status" hidden>
                <div class="flex-grow-1">
                    <input type="text" name="message_search" value="{{ request('message_search') }}" class="form-control" placeholder="Search messages..." aria-label="Search">
                </div>
                <div class="">
                    <select name="status" class="form-select">
                        <option >Filter by Status</option>
                        <option value="all">All Status</option>
                        <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>Unread</option>
                        <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Read</option>
                    </select>
                </div>
                <div class="">
                    <select name="date" class="form-select">
                        <option value="">Filter by Date</option>
                        <option value="last_7_days" {{ request('date') == 'last_7_days' ? 'selected' : '' }}>Last 7 Days</option>
                        <option value="last_30_days" {{ request('date') == 'last_30_days' ? 'selected' : '' }}>Last 30 Days</option>
                        <option value="this_year" {{ request('date') == 'this_year' ? 'selected' : '' }}>This Year</option>
                    </select>
                </div>
                <div class="">
                    <button class="btn btn-info" type="submit">Search</button>
                    <a href="{{route('account.messages.index',['message_status'=>$message_status])}}" class="btn btn-outline-secondary" >Reset</a>
                </div>
            </form>

            <div class="row">
                <!-- Left Sidebar: Messages List -->
                <div class="col-md-4">
                    <div class="d-flex">
                        <ul class="nav nav-tabs ">
                            <li class="nav-item">
                                <form action="{{route('account.messages.index')}}" method="GET">
                                    <input type="hidden" value="received" name="message_status" hidden>
                                    <button type="submit" class="nav-link  text-decoration-none text-dark {{$message_status=='received'?'active':''}}" aria-current="page">Received</button>
                                </form>
                            </li>
                            <li class="nav-item">
                                <form action="{{route('account.messages.index')}}" method="GET">
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
                            <div class="modal  fade @if(session('compose-error')) show  @endif" id="compose" tabindex="-1" aria-labelledby="composeTitle" aria-hidden="true" @if(session('compose-error')) style="display: block;" @else style="display: none;" @endif>
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="composeTitle">New message</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('account.messages.store') }}" method="POST">
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
                                                    <a href="{{route('account.messages.index')}}" class="btn bg-transparent btn-sm text-danger" >Close</a>
                                                    <button type="submit" class="btn btn-info btn-sm">Send message</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Add the backdrop if there are validation errors --}}
                            @if(session('compose-error'))
                                <div class="modal-backdrop fade show"></div>
                            @endif
                        </div>
                        {{-- Compose section ends--}}
    
                    </div>
                    <!-- Messages List -->
                    <div class="list-group">
                        @forelse($messages as $msg)
                        <a href="{{ route('account.messages.show',['message'=>$msg,'message_status'=>$message_status]) }}" class="list-group-item list-group-item-action {{ $msg->is_read ? '' : 'bg-light' }}">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">{{ $msg->subject }}</h6>
                                    <p class="mb-1 text-muted">{{ Str::limit($msg->content, 50) }}</p>
                                    <small class="text-secondary">From: {{ $msg->sender->name }}</small>
                                </div>
                                <div class="text-end">
                                    <small class="text-muted">{{ $msg->created_at->diffForHumans() }}</small>
                                    <div>
                                        @if(!$msg->is_read && $message_status=='received')
                                        <span class="badge bg-primary">Unread</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                        @empty
                        <p class="text-center text-muted">No messages found.</p>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $messages->links('pagination::bootstrap-5') }}
                    </div>
                </div>

                <!-- Right Content: Message Details and Reply Form -->
                <div class="col-md-8">
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
                            <h5>Reply to {{ $message->sender->name }} ({{$message->sender->email}}) </h5>
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
                                    <button type="submit" class="btn btn-primary btn-sm">Send Reply</button>
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
