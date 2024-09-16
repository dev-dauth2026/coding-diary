<x-admin.admin-layout>
    

    @section('head')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    @endsection

    <x-message.message></x-message.message>
    
    <div class="container p-3 bg-body-tertiary" style="min-height: 90vh;">
        <h4 class="text-capitalize "><i class="fa-solid fa-gauge me-2"></i> Admin Dashboard</h4>
        <hr class="col-3 mb-5" >
        
        <div class="row g-4 mb-5" >
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 text-white bg-primary-gradient">
                    <div class="card-body d-flex flex-row justify-content-center align-items-center gap-3 text-center">
                        <i class="fas fa-blog fa-3x text-white-50"></i>
                        <div>
                            <h5 class="card-title mt-3 ">Total Blogs</h5>
                            <p class="card-text display-4">{{$totalPosts}}</p>
                        </div>
                       
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 text-white bg-success-gradient">
                    <div class="card-body d-flex flex-row justify-content-center align-items-center gap-3 text-center">
                        <i class="fas fa-users fa-3x text-white-50"></i>
                        <div>
                            <h5 class="card-title mt-3">Users</h5>
                            <p class="card-text display-4">{{$totalUsers}}</p>
                        </div>
                       
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 text-white bg-danger-gradient">
                    <div class="card-body d-flex flex-row justify-content-center align-items-center gap-3 text-center">
                        <i class="fas fa-user-shield fa-3x text-white-50"></i>
                        <div>
                            <h5 class="card-title mt-3">Admin Users</h5>
                            <p class="card-text display-4">{{$totalAdminUsers}}</p>
                        </div>
                       
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 text-white bg-secondary-gradient">
                    <div class="card-body d-flex flex-row justify-content-center align-items-center gap-3 text-center">
                        <i class="fas fa-envelope fa-3x text-white-50"></i>
                        <div>
                            <h5 class="card-title mt-3">Messages</h5>
                            <p class="card-text display-4">0</p>
                        </div>
                       
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 text-white bg-info-gradient">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center ">
                 
                            <h5 class="card-title mt-3 ">Add New Blog</h5>
                            <a href="{{ route('admin.blog.create') }}" class="text-decoration-none text-white mt-3"><i class="fas fa-plus-circle fa-3x text-white-50"></i></a>
                       
                    </div>
                </div>
            </div>
        </div>
        <section>
            <div class="mb-5">
                <h5 class="text-secondary">Recent Published Blog Posts</h5>
                <hr class="col-3 mb-5">
                <div class="d-flex  gap-4 flex-wrap">
                    @foreach($posts as $post)
                    <div class="card flex-fill" style="width:15rem">
                         <a href="{{route('blog.detail',$post->id)}}" class="text-decoration-none text-secondary">
                            <img src="{{asset('storage/'. $post->image)}}" class="card-img-top " alt="{{$post->title}}" style="height: 100px; object-fit:cover;">
                            <div class="card-body">
                            <h5 class="card-title">{{ Str::limit(strip_tags($post->title), 30) }} </h5>
                           
                            </div>
                        </a>
                        </div>
                    @endforeach
                   

                </div>
            </div>
           
        </section>
        {{-- Recent blogs post comments  --}}
        <section>
            <div class=" mb-5">
                <h5 class="text-secondary">Recent Posts Comments </h5>
                <hr class="col-3 ">
                <div class="">
                    @foreach($posts as $post)
                    <div class="border-bottom p-2">
                        <a href="" class="text-decoration-none text-secondary">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="card-title">{{ Str::limit(strip_tags($post->content), 90) }} </p>
                                <small>{{$post->created_at->diffForHumans()}} </small>
                            </div>
                        </a>
                    </div>
                       
                    @endforeach
                </div>
            </div>
           
        </section>
         {{-- Recent blogs post comments end --}}
          {{-- Recent blogs post comments  --}}
        <section>
            <div class=" mb-5">
                <h5 class="text-secondary">Recent Messages </h5>
                <hr class="col-3 ">
                <div class="">
                    @foreach($posts as $post)
                    <div class="border-bottom p-2">
                        <a href="" class="text-decoration-none text-secondary">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="card-title">{{ Str::limit(strip_tags($post->content), 90) }} </p>
                                <small>{{$post->created_at->diffForHumans()}} </small>

                            </div>
                        </a>
                    </div>
                       
                    @endforeach
                </div>
            </div>
           
        </section>
         {{-- Recent blogs post comments end --}}
    </div>

</x-admin.admin-layout>
