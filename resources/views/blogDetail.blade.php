<x-user-layout>
    <div class=" d-flex justify-content-center p-5 " style="min-height: 80vh">
            
        <div class="mb-5 d-block d-md-none">
            <form action="{{ route('blog.search') }}" class=" d-block d-md-none" method="get">
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
       {{-- search in small devices ended --}}
     
       {{-- main blog section  --}}
        @if ($post && empty($query))
           <x-blog.main-blog :post="$post"/>
         @endif
         {{-- main blog section ended --}}
         
        {{-- search section  --}}
        <div class="col-12  d-flex flex-column col-lg-3 col-md-3">
             <x-blog.blog-search :posts="$posts" totalBlogs="$totalBlogs"/>
        </div>
        {{-- search section ended --}}

    </div>
</x-user-layout>
