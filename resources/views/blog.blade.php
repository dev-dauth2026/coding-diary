<x-user-layout>
    <div class=" d-flex justify-content-center p-5" style="min-height: 80vh">

            @if (empty($posts))
                <p>No blogs found.</p>
            @else
                <div class="row ">
                    @if(!empty($query))
                    <a href="{{route('account.blog')}}" alt="blog page" class="text-align-end"> Refresh </a>
                   @endif
                   <div @class(['d-flex flex-column flex-md-row','justify-content-between' => empty($query) ])> 
                       
                        {{-- search in small devices  --}}
                       
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
                        @if ($latestPost && empty($query))
                           <x-blog.main-blog :latestPost="$latestPost"/>
                         @endif
                         {{-- main blog section ended --}}

                         {{-- search section  --}}
                         @if($posts)

                            <x-blog.blog-search :posts="$posts" :query="$query"  />
                        @endif
                         {{-- search section ended --}}
                    </div>
                </div>
            @endif
    </div>
</x-user-layout>
