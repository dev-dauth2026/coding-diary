<x-admin.admin-layout>
    <div class="p-5">
    

        <form class=" form" action="{{route('admin.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="title" class="form-label">Title</label>
                <input class="form-control @error('title') is-invalid @enderror" value="{{old('title')}}" type="text" id="title" name="title" placeholder="Enter blog title" >
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
                <label for="tags" class="form-label">Tags</label>
                <input class="form-control @error('tags') is-invalid @enderror" value="{{old('tags')}}" type="text" id="tags" name="tags" placeholder="Enter tags (comma-separated)" >
                @error('tags')
                    <p class="invalid-feedback">{{$message}} </p>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="author" class="form-label">Author</label>
                <input class="form-control @error('author') is-invalid @enderror" value="{{Auth::user() && Auth::user()->name}}" type="text" id="author" name="author" placeholder="Enter author (comma-separated)" >
                @error('author')
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
    
</x-admin.admin-layout>


                    
                   
 