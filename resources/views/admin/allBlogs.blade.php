<x-admin.admin-layout>
    <div class="container p-3 bg-body-tertiary">

        <div class=" w-100">
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
        
        <div class="table-responsive ">
            <table class="table table-striped table-hover ">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($allBlogs)
                    @foreach($allBlogs as $post)
                    <tr>
                        <td>{{$post->id}} </td>
                        <td>
                            <img src=" {{asset('storage/' . $post->image)}}" alt="{{$post->title}}" style="max-width: 100px;"/>
                        
                        </td>
                        <td>{{$post->title}} </td>
                        <td>
                            @if($post->author)
                            {{$post->author}} 
                            @else   
                            N/A
                            @endif
                        
                        </td>
                        <td>{{$post->created_at}} </td>
                        <td>{{$post->updated_at}} </td>
                        <td >
                            <div class="d-flex gap-2 h-100">
                                <a href="{{ route('admin.post.edit', $post->id) }} " class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{route('admin.post.delete', $post->id)}}" method="post">
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
                            
                            