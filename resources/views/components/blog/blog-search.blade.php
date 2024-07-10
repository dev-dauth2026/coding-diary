
    <div class="  mb-5">

        <form action="{{ route('blog.search') }}" class=" d-md-flex d-none " method="get">
            <div class="form-group d-flex flex-grow-1 gap-2">
                <input class="form-control  flex-grow-1  @error('blogSearch') is-invalid @enderror" placeholder="Search blog topics..." name="blogSearch" id="blogSearch" value="{{ old('blogSearch', $query ?? '') }}" />
                <button class="btn btn-outline-secondary" type="submit">Search</button>
                <div>
                    @error('blogSearch')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </form>
    </div>
   <h4 class="">Recent Blogs</h4>
   @foreach ($posts as $post)
       <div class="d-flex flex-column mb-3">
           <a href="#"><h6 class="mb-1">{{ $post->title }}</h6></a>
           <small>{{ $post->created_at->format('M d, Y') }}</small>
           <small>By John</small>
       </div>
   @endforeach
   
 

