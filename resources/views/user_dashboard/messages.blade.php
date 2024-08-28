<x-user-dashboard-layout>
    <main style="min-height:90vh;">
        <div class="container py-3 py-md-3">
            <!-- Page Header -->
            <div class="mb-3">
                <h4>My Messages</h4>
                <hr class="col-2">
            </div>

            <!-- Search and Filter Row -->
            <form method="GET" action="{{ route('account.messages.index') }}" class="d-flex gap-3 mb-3">
                <div class="flex-grow-1">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search messages..." aria-label="Search">
                </div>
                <div class="">
                    <select name="status" class="form-select">
                        <option value="">Filter by Status</option>
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
                </div>
            </form>

            <div class="row">
                <!-- Left Sidebar: Messages List -->
                <div class="col-md-4">
                    <!-- Messages List -->
                    <div class="list-group">
                        @forelse($messages as $msg)
                        <a href="{{ route('account.messages.show', $msg) }}" class="list-group-item list-group-item-action {{ $msg->is_read ? '' : 'bg-light' }}">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">{{ $msg->subject }}</h6>
                                    <p class="mb-1 text-muted">{{ Str::limit($msg->content, 50) }}</p>
                                    <small class="text-secondary">From: {{ $msg->sender->name }}</small>
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
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong>Subject: </strong>{{ $message->subject }}
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
                        <div class="card-footer text-end">
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

                    <!-- Reply Form -->
                    <div class="card">
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
                                <button type="submit" class="btn btn-primary">Send Reply</button>
                            </form>
                        </div>
                    </div>
                    @endisset
                </div>
            </div>
        </div>
    </main>
</x-user-dashboard-layout>
