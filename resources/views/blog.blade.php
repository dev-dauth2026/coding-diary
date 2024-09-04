<x-user-layout>
    <div class="container-fluid px-0"> 

        {{-- Success Message --}}
        @if(Session::has('success'))
            <p class="p-2 rounded mt-2 bg-success-subtle text-success">{{ Session::get('success') }}</p>
        @endif

        {{-- No Blogs Found Message --}}
        @if (empty($posts))
            <div class="container">
                <div class="row">
                    <div class="col">
                        <p class="text-center fs-4">No blogs found.</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- Main Content Area --}}
        @if ($post && empty($query))
            <!-- Banner Image Section -->
            <div class=" d-flex justify-content-center align-items-center py-2 py-lg-1 w-100" style="background: linear-gradient(135deg, rgba(149, 209, 58, 0.6), rgba(128, 0, 128, 0.6)); z-index: 1;">
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid w-lg-75 w-75 p-lg-5 p-2" style=""> <!-- w-100 makes the image width 100% -->
            </div>
             <!-- Banner Image Section ends-->

            <section class="container-fluid">
                <div class="row">
                    {{-- Main Content --}}
                    <div class="col-lg-8 col-md-8 col-12 ">
                        <div class="py-3 p-lg-5">
                            <x-blog.main-blog :post="$post" />
                        </div>
                    </div>
                    {{-- Main Content ends--}}

                    {{-- Sidebar --}}
                    <div class="col-lg-4 col-md-4 col-12 py-2">
                        <div class=" p-3 border-start border-info-subtle" style="">
                                <x-blog.blog-search :posts="$posts" :totalBlogs="$totalBlogs" />
                        </div>
                    </div>
                    {{-- Sidebar ends--}}
                </div>
            </section>

            {{-- Blog List Section --}}
            <x-blog.more-blogs :posts="$posts"></x-blog.more-blogs>

            {{-- Comment Section --}}
            <x-comments.comment :comments="$comments" :post="$post"/>
        @endif

    </div>
</x-user-layout>
