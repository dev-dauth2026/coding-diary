<x-admin.admin-layout>
    <div class="container p-3 bg-body-tertiary">

        <div class="w-100">
            @if(Session::has('success'))
                <p class="bg-success-subtle text-success p-2 rounded">{{Session::get('success')}} </p>
            @endif
            <div class="d-flex align-items-center justify-content-between w-100 mb-3">
                <div class="col-10">
                    <h4><i class="fa-solid fa-blog me-2"></i>Blog List</h4>
                    <hr class="mb-5 col-2">
                </div>
                <div class="col-2 d-flex justify-content-end">
                    <a href="{{ route('admin.blog.create') }}" class="btn btn-sm btn-primary">Add Post</a>
                </div>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-nowrap">ID</th>
                        <th class="text-nowrap">Image</th>
                        <th class="text-nowrap">Title</th>
                        <th class="text-nowrap">Author</th>
                        <th class="text-nowrap">Status</th>
                        <th class="text-nowrap">Created</th>
                        <th class="text-nowrap">Updated</th>
                        <th class="text-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($allBlogs)
                        @foreach($allBlogs as $post)
                        <tr>
                            <td class="text-nowrap">{{ $post->id }}</td>
                            <td class="text-nowrap">
                                @if($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid" style="max-width: 100px; height: auto;">
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="text-truncate" style="max-width: 150px;">{{ $post->title }}</td>
                            <td class="text-truncate" style="max-width: 150px;">
                                @if($post->author)
                                    {{ $post->author->name }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="text-nowrap">
                                <form method="POST" action="{{ route('admin.post.status.update', $post->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group mb-0">
                                        <select class="form-select form-control form-control-sm @error('status') is-invalid @enderror" id="status" name="status" onchange="this.form.submit()">
                                            @foreach($statusOptions as $status)
                                                <option value="{{ $status }}" {{ (old('status') == $status || $post->status == $status) ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </form>
                            </td>
                            <td class="text-nowrap text-secondary">
                                <div class="d-flex flex-column">
                                    <small>{{ $post->created_at->format('d M Y') }}</small>
                                    <small>{{ $post->created_at->diffForHumans() }}</small>
                                </div>
                            </td>
                            <td class="text-nowrap text-secondary">
                                <div class="d-flex flex-column">
                                    <small>{{ $post->updated_at->format('d M Y') }}</small>
                                    <small>{{ $post->updated_at->diffForHumans() }}</small>
                                </div>
                            </td>
                            <td class="text-nowrap">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.post.edit', $post->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('admin.post.delete', $post->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete the post?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-admin.admin-layout>
