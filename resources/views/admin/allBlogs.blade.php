<x-admin.admin-layout>
    <div class="container p-3 bg-body-tertiary">

        <div class="w-100">
            @if(Session::has('success'))
                <p class="bg-success-subtle text-success p-2 rounded">{{Session::get('success')}} </p>
            @endif
            <div class="d-flex align-items-center justify-content-between w-100 ">
                <div class="col-10">
                    <h4><i class="fa-solid fa-blog me-2"></i>Blog List</h4>
                    <hr class="mb-5 col-2">
                </div>
                <div class="col-2 d-flex justify-content-end">
                    <a href="{{ route('admin.blog.create') }}" class="btn btn-sm btn-primary">Add Post</a>
                </div>
            </div>
        </div>


       {{-- Filter form  --}}
        <div>
            <form action="{{route('admin.blogs')}}" class=" d-flex flex-column gap-3 mb-5 w-100" method="GET">
                <div class="form-group d-flex align-items-center flex-grow-1">
                    <input type="text" class="form-control flex-grow-1" value="{{request('search')}}" name="search" id="search" placeholder="Search blog post name....">

                </div>
                <div class="d-flex flex-row justify-content-bewteen gap-3 flex-grow-1 ">
                    <div class="form-group d-flex align-items-center gap-2">

                        <label for="category">Category: </label>
                        <select name="category" id="category"  class="form-select" onchange="this.form.submit()" >
                            <option value="all">All Category</option>
    
                            @foreach($categories as $category)
                            <option value="{{old('category',$category->id)}}" {{(old('category')==$category->id || request('category') == $category->id)?'selected':''}}>{{ucfirst($category->name)}} </option>
                            @endforeach
    
                        </select>
                    </div>
                    <div class="form-group d-flex align-items-center gap-2">
                        <label for="status">Status: </label>
                        <select name="status" id="status" class="form-select" onchange="this.form.submit()" >
                            <option value="all">All Posts</option>
                            @foreach($statusOptions as $status)
                            <option value="{{old('status',$status)}}" {{($status== old('status') || request('status')==$status) ? 'selected':'' }}> {{ucfirst($status)}} </option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group d-flex align-items-center gap-2">
                        <label for="order_by" class="text-nowrap">Order By Date: </label>
                        <select name="order_by" id="" class="form-select" onchange="this.form.submit()">
                            <option value="new" {{request('order_by')== 'new'?'selected':''}}>New</option>
                            <option value="old" {{request('order_by')== 'old'?'selected':''}}>Old</option>
                            <option value="title_asc" {{request('order_by')== 'title_asc'?'selected':''}}>Title(A-Z)</option>
                            <option value="title_desc" {{request('order_by')== 'title_desc'?'selected':''}}>Title(Z-A)</option>
                        </select>
                    </div>
                    <div class="form-group d-flex align-items-center gap-2">
                        <label for="pagination_by" class="text-nowrap">Number of Post: </label>
                        <select name="pagination_by" id="" class="form-select" onchange="this.form.submit()">
                            <option value="10" {{request('pagination_by')== '10'?'selected':''}}>10</option>
                            <option value="20" {{request('pagination_by')== '20'?'selected':''}}>20</option>
                            <option value="50" {{request('pagination_by')== '50'?'selected':''}}>50</option>
                            <option value="100" {{request('pagination_by')== '100'?'selected':''}}>100</option>
                        </select>
                    </div>
                  
                  
                    <div>
                        <a href="{{route('admin.blogs')}}" class="btn btn-outline-secondary text-nowrap " >Reset Filter</a>
                    </div>

                </div>
            </form>  
        </div>
        {{-- Filter form ends--}}
               
        {{-- blog post list table  --}}
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-nowrap">ID</th>
                        <th class="text-nowrap">Image</th>
                        <th class="text-wrap" style="max-width: 600px">Title</th>
                        <th class="text-nowrap" style="min-width: 250px">Category</th>
                        <th class="text-nowrap " style="min-width: 190px">Status</th>
                        <th class="text-nowrap">Created</th>
                        <th class="text-nowrap">Updated</th>
                        <th class="text-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                  
                        @forelse($posts as $post)
                        <tr>
                            <td class="text-nowrap">{{ $post->id }}</td>
                            <td class="text-nowrap">
                                @if($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid" style="max-width: 100px; height: auto;">
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="text-truncate text-nowrap" style="max-width: 600px;">
                                <div class="d-flex flex-column">
                                    <span>
                                        {{ $post->title }}
                                    </span>
                                    <small class="text-secondary">
                                        Author: {{($post->author)? $post->author->name:N/A }}
                                    </small>

                                </div>
                            </td>
                            <td class="text-truncate " >
                                <form method="POST" action="{{ route('admin.post.category.update', $post->id) }}">
                                    @csrf
                                    @method('PUT')
                                <div class="form-group mb-0">
                                    <select class="form-select w-48 form-control form-control-sm @error('category') is-invalid @enderror" id="category-{{$post->id}}" name="category" onchange="this.form.submit()">
                                        @foreach($categories as $category)
                                            <option class="text-nowrap" value="{{ $category->id }}" {{ (old('category') == $category->id || $post->category_id == $category->id) ? 'selected' : '' }}>{{ ucfirst($category->name) }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                                </form>
                            </td>

                            <td class="text-nowrap w-48">
                                <form method="POST" action="{{ route('admin.post.status.update', $post->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group mb-0">
                                        <select class="form-select w-48 form-control form-control-sm @error('status') is-invalid @enderror" id="status" name="status" onchange="this.form.submit()">
                                            @foreach($statusOptions as $status)
                                                <option class="text-nowrap" value="{{ $status }}" {{ (old('status') == $status || $post->status == $status) ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
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
                        @empty
                        <tr  >
                           
                            <td colspan="8" class="text-center text-nowrap">
                                <div class="d-flex justify-content-center align-items-center" style="height: 40vh;">
                                   <h4>No posts available.</h4> 
                                </div>
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
            </table>
        </div>
         {{-- blog post list table ends --}}
          <!-- Pagination -->
          <div class="d-flex justify-content-center mt-4">
            {{ $posts->links('pagination::bootstrap-5') }}
        </div>

    </div>
</x-admin.admin-layout>
