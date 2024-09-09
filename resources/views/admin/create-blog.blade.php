<x-admin.admin-layout>
    <div class="p-5 pt-3">
        <h4><i class="fa-solid fa-plus-circle me-2"></i> Create Blog</h4>
        <hr class="col-2 mb-5">

        <form class="form" action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Blog Title -->
            <div class="form-group mb-3">
                <label for="title" class="form-label">Title</label>
                <input class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" type="text" id="title" name="title" placeholder="Enter blog title" oninput="generateSlug()">
                @error('title')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>

            <!-- Summary -->
            <div class="form-group mb-3">
                <label for="summary" class="form-label">Summary</label>
                <textarea class="form-control @error('summary') is-invalid @enderror" id="summary" name="summary" rows="3" placeholder="Enter a brief summary of the blog">{{ old('summary') }}</textarea>
                @error('summary')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>

            <!-- Blog Content with Rich Text Editor -->
            <div class="form-group mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="10" placeholder="Write your blog content here...">{{ old('content') }}</textarea>
                @error('content')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>

            <!-- Slug -->
            <div class="form-group mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" type="text" id="slug" name="slug" placeholder="Enter slug (comma-separated)">
                @error('slug')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>

             <!-- Meta Title -->
             <div class="form-group mb-3">
                <label for="meta_title" class="form-label">Meta Title</label>
                <input class="form-control @error('meta_title') is-invalid @enderror" value="{{ old('meta_title') }}" type="text" id="meta_title" name="meta_title" placeholder="Enter meta title for SEO">
                @error('meta_title')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>

            <!-- Meta Description -->
            <div class="form-group mb-3">
                <label for="meta_description" class="form-label">Meta Description</label>
                <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" name="meta_description" rows="3" placeholder="Enter meta description for SEO">{{ old('meta_description') }}</textarea>
                @error('meta_description')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>

           

            <!-- Category Selection -->
            <div class="form-group mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-control @error('category') is-invalid @enderror" id="category" name="category">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ ucfirst($category->name) }}</option>
                    @endforeach
                </select>
                @error('category')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status Selection -->
            <div class="form-group mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                    @foreach($statusOptions as $status)
                        <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
                @error('status')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>

             <!-- Feature Selection -->
             <div class="form-check mb-3 gap-3">
                <label for="featured" class="form-label">Featured</label>
                <input type="checkbox" class="form-check-input" name="featured">
                @error('featured')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>

             <!-- Author Selection -->
             <div class="form-group mb-3">
                <label for="author" class="form-label">Author</label>
                <select class="form-control @error('author') is-invalid @enderror" id="author" name="author">
                    @foreach($adminUsers as $user)
                        <option value="{{ $user->id }}" {{ (old('author') == $user->id || $user->id == $auth->id) ? 'selected' : '' }}>{{ ucfirst($user->name) }}</option>
                    @endforeach
                </select>
                @error('author')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image Upload -->
            <div class="form-group mb-3">
                <label for="image" class="form-label">Image</label>
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage(event)">
                @if (Session::has('temp_image'))
                    <div class="mt-2">
                        <p>Previously uploaded image:</p>
                        <img src="{{ asset('storage/' . Session::get('temp_image')) }}" alt="Uploaded Image" class="img-thumbnail" width="200">
                    </div>
                @endif
                <img id="image-preview" src="#" alt="Image Preview" class="img-thumbnail mt-2" style="display:none; max-width: 200px;">
                @error('image')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create Blog Post</button>
        </form>
    </div>

    <script>
        // Function to generate slug from title
        function generateSlug() {
            const title = document.getElementById('title').value;
            const slug = title.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
            document.getElementById('slug').value = slug;
        }

        // Function to preview image before upload
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('image-preview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }

     
    </script>
    
</x-admin.admin-layout>
