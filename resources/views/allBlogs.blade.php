<x-user-layout>
    <div class="p-lg-5 p-md-4 p-sm-1 p-1" style="height: 70vh">

        <h4 class="text-center">
            @if(empty($query))
                All Blogs
            @else
                Searched Results
            @endif
        </h4>
 
        <hr class="col-12 col-lg-2 col-md-5 col-sm-10 mx-auto mb-5">
        <div class="col-12 col-lg-8 col-md-10 col-sm-11 mx-auto">

            <div class="  mb-5">

                <form action="{{ route('blog.search') }}" class=" d-flex " method="get">
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
           
           @foreach ($posts as $post)
               <div class="d-flex flex-column mb-3">
                   <a href="{{route('blog.detail',$post->id)}}"><h6 class="mb-1">{{ $post->title }}</h6></a>
                   <small>{{ $post->created_at->format('M d, Y') }}</small>
                   <small>By {{$post->author ? $post->author: 'N/A'}} </small>
               </div>
           @endforeach

           @if(!empty($query))
               <a href="{{route('account.allBlogs')}}" class="">All Blogs</a>
           @endif
         {{-- Pagination links --}}
         <div class="d-flex justify-content-center mt-5">
            {{ $posts->links('vendor.pagination.bootstrap-5') }}
        </div>
        </div>
    </div>
    
    
    </x-user-layout>