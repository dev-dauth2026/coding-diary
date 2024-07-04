<x-user-layout>
    <div class=" d-flex  justify-content-center p-5" style="min-height:80vh">
        <div class="col-11 ">
            @if ($allBlogs->isEmpty())
            <p>No blogs found.</p>
        @else
        <div class="row ">
            <div class="d-flex justify-content-between">
                <div class="latestBlog col-8">
                    @if ($latestPost)
                        <div class="heading mb-5 d-flex flex-column">
                            <h3>{{$latestPost->title}} </h3>
                            <small class="text-secondary">Author: John Smith  </small>
                            <small class="text-secondary">Published on:{{ $latestPost->created_at->format('M d, Y') }} </small>
                        </div>
                        
                        <p>{!! $latestPost->content !!} </p>
                    
                    @endif
                </div>
                <div class="list-group col-3">
                    <form action="" class="mb-5">
                        @csrf
                        <div class="form-group d-flex gap-2">
                            <input class="form-control" placeholder="Search blog topics..." name="blogSearch" id="blogSearch"/>
                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                        </div>
                        
                    </form>
                    <h4 class="">Recent Blogs</h4>
                    @foreach ($allBlogs as $post)

                       
                            <div class="d-flex w-100 flex-column">
                               <a href="#"><h5 class="mb-1">{{ $post->title }}</h5></a> 
                                <small>{{ $post->created_at->format('M d, Y') }}</small>
                                <small>By John</small>
                            </div>
                 
                    @endforeach
                </div>
            </div>
           
        </div>
            
        @endif
        </div>
        
    </div>
</x-user-layout>
