<x-admin.admin-layout>
    <div class="p-5 pt-3">
        <h4 class=" "><i class="fa-solid fa-plus-circle  me-2"></i> Create Blog</h4>
        <hr class="col-2 mb-5" >

        <form class=" form" action="{{route('admin.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="title" class="form-label">Title</label>
                <input class="form-control @error('title') is-invalid @enderror" value="{{old('title')}}" type="text" id="title" name="title" placeholder="Enter blog title" oninput="generateSlug()" >
                @error('title')
                    <p class="invalid-feedback">{{$message}} </p>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="content" class="form-label ">Content</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="10" placeholder="Write your blog content here..." >{{old('content')}}</textarea>
                @error('content')
                    <p class="invalid-feedback">{{$message}} </p>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input class="form-control @error('slug') is-invalid @enderror" value="{{old('slug')}}" type="text" id="slug" name="slug" placeholder="Enter slug (comma-separated)" >
                @error('slug')
                    <p class="invalid-feedback">{{$message}} </p>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="author" class="form-label">Author</label>
                <select class="form-control @error('author') is-invalid @enderror" value="{{old('author',$auth->name)}}"  id="author" name="author"  >
                    @if($adminUsers)
                    @foreach($adminUsers as $user)
                        <option value="{{ $user->id }}" {{ (old('user->id')== $auth->id  || $user->id == $auth->id) ? 'selected' : '' }}>{{ ucfirst($user->name) }}</option>
                    @endforeach
                    @endif
                </select>
                @error('author')
                    <p class="invalid-feedback">{{$message}} </p>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-control @error('category') is-invalid @enderror" value="{{old('category')}}" type="text" id="category" name="category"  >
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category->id') == $category->id ? 'selected' : '' }}>{{ ucfirst($category->name) }}</option>
                    @endforeach

                </select>
                @error('category')
                    <p class="invalid-feedback">{{$message}} </p>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control @error('status') is-invalid @enderror" value="" type="text" id="status" name="status"  >
                    @foreach($statusOptions as $status)
                        <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                    @endforeach

                </select>
                @error('status')
                    <p class="invalid-feedback">{{$message}} </p>
                @enderror
            </div>
            
            <div class="form-group mb-3">
                <label for="image" class="form-label">Image</label>
                <input class ="form-control @error('image') is-invalid @enderror"  type="file" id="image" name="image">
                @if (Session::has('temp_image'))
                    <div class="mt-2">
                        <p>Previously uploaded image:</p>
                        <img src="{{ asset('storage/' . Session::get('temp_image')) }}" alt="Uploaded Image" class="img-thumbnail" width="200">
                    </div>
                @elseif (old('image'))
                    <div class="mt-2">
                        <p>Previously uploaded image:</p>
                        <img src="{{ asset('storage/' . old('image')) }}" alt="Uploaded Image" class="img-thumbnail" width="200">
                    </div>
                @endif
                @error('image')
                    <p class="invalid-feedback">{{$message}} </p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Create Blog Post</button>
        </form>
    </div>
    <script>
        function generateSlug() {
            const title = document.getElementById('title').value;
            const slug = title.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
            document.getElementById('slug').value = slug;
        }
    </script>
    
</x-admin.admin-layout>


                    
                   
 