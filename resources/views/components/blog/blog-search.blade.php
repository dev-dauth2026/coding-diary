<div @class(['list-group col-12 col-sm-12 d-flex flex-column ','col-lg-12 col-md-12 card shadow p-5' => !empty($query),'col-lg-3 col-md-3 ' =>empty($query)])>
    <div class="  mb-5">

        <form action="{{ route('blog.search') }}" class=" d-md-flex d-none" method="get">
            <div class="form-group d-flex gap-2">
                <input class="form-control @error('blogSearch') is-invalid @enderror" placeholder="Search blog topics..." name="blogSearch" id="blogSearch" value="{{ old('blogSearch', $query ?? '') }}" />
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

    {{-- Pagination links --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $posts->links() }}
    </div>

</div>