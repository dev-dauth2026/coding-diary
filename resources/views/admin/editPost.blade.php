<x-admin.admin-layout>

    <div class="container mt-5">
        <h1>Edit Post</h1>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger p-2">
                    {{ $error }}
                </div>
            @endforeach
        @endif

        <form action="{{route('admin.post.update', $post->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}" oninput="generateSlug()">
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="10" value="{{ old('content', $post->content) }}">{{ old('content', $post->content) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $post->slug) }}">
            </div>


             <!-- Meta Title -->
             <div class="form-group mb-3">
                <label for="meta_title" class="form-label">Meta Title</label>
                <input class="form-control @error('meta_title') is-invalid @enderror" value="{{ old('meta_title',$post->meta_title) }}" type="text" id="meta_title" name="meta_title" placeholder="Enter meta title for SEO">
                @error('meta_title')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>

            <!-- Meta Description -->
            <div class="form-group mb-3">
                <label for="meta_description" class="form-label">Meta Description</label>
                <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" name="meta_description" rows="3" placeholder="Enter meta description for SEO">{{ old('meta_description',$post->meta_description) }}</textarea>
                @error('meta_description')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="form-group mb-3">
                <label for="category" class="form-label">Category  </label>
                <select class="form-control @error('category') is-invalid @enderror" value="{{old('category',$post->category_id)}}" type="text" id="category" name="category"  >
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ (old('category->id') == $category->id || $post->category_id==$category->id) ? 'selected' : '' }}>{{ ucfirst($category->name) }}</option>
                    @endforeach

                </select>
                @error('category')
                    <p class="invalid-feedback">{{$message}} </p>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control @error('status') is-invalid @enderror" value="{{$post->featured}}" type="text" id="status" name="status"  >
                    @foreach($statusOptions as $status)
                        <option value="{{ $status }}" {{ (old('status') == $status || $post->status== $status) ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                    @endforeach

                </select>
                @error('status')
                    <p class="invalid-feedback">{{$message}} </p>
                @enderror
            </div>

             <!-- Feature Selection -->
             <div class="form-check mb-3 gap-3">
                <label for="featured" class="form-label">Featured</label>
                <input type="checkbox" class="form-check-input" name="featured" value="1" {{(old('featured') ||$post->featured) ?'checked':''}}>
                @error('featured')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>

             <!-- Author Selection -->
             <div class="form-group mb-3">
                <label for="author" class="form-label">Author</label>
                <select class="form-control @error('author') is-invalid @enderror" value="{{old('author',$auth->name)}}"  id="author" name="author"  >
                    @if($adminUsers)
                    @foreach($adminUsers as $user)
                        <option value="{{ $user->id }}" {{ (old('user->id') == $auth->id || $user->id == $auth->id )? 'selected' : '' }}>{{ ucfirst($user->name) }}</option>
                    @endforeach
                    @endif
                </select>
                @error('author')
                    <p class="invalid-feedback">{{$message}} </p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image">
                @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid mt-2" style="max-width: 200px;">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update Post</button>
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

