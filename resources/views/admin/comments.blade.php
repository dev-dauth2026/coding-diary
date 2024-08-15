<x-admin.admin-layout>
    <div class="container p-3 bg-body-tertiary" style="min-height:80vh;">

        @if(Session::has('success'))
            <p class="bg-success-subtle text-success p-2 rounded">{{Session::get('success')}} </p>

        @endif

        <h4>All User comments</h4> 
        <hr class="col-2 mb-3">
        <div class="row">

            {{-- total comments  --}}
            <div class="col-12 col-md-6 col-lg-3 border-none">
                <div class="card h-100 text-white bg-info-gradient border-none border-0">
                    <div class="card-body d-flex flex-row justify-content-center align-items-center gap-3 text-center">
                        <i class="fas fa-blog fa-3x text-white-50"></i>
                        <div>
                            <h5 class="card-title mt-3 text-white">Total Comments</h5>
                            <p class="card-text display-4">{{$totalComments}}</p>
                        </div>
                    
                    </div>
                </div>
            </div>

            {{-- total new comments  --}}
            <div class="col-12 col-md-6 col-lg-3 border-none">
                <div class="card h-100 text-white bg-danger-gradient border-none border-0">
                    <div class="card-body d-flex flex-row justify-content-center align-items-center gap-3 text-center">
                        <i class="fas fa-message fa-3x text-white-50"></i>
                        <div>
                            <h5 class="card-title mt-3 text-white">New Comments</h5>
                            <p class="card-text display-4">{{$totalComments}}</p>
                        </div>
                    
                    </div>
                </div>
            </div>
            {{-- total new comments ends --}}
            <main class="mt-5 d-flex flex-column gap-5">
                @if($comments->count()>0)
                <div class="table-responsive bg-body px-3 py-5 rounded">
                    <table class="table table-striped table-hover">
                            <thead>
                              <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Blog Post</th>
                                <th scope="col">Comments</th>
                                <th scope="col ">Verified</th>
                                <th scope="col ">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($comments as $comment)
                              <tr>
                                <th scope="row">{{$comment->id}} </th>
                                <td>{{$comment->user->name}} </td>
                                <td>{{$comment->blogPost->title}} </td>
                                <td>{{$comment->content}} </td>
                                <td>
                                    <div class="d-flex  align-items-center ">
                                        <i class="fa-solid fa-circle-xmark text-danger"></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{route('admin.comments.edit',$comment->id)}}" class=""><i class="fa-solid fa-pen-to-square text-warning"></i></a>
                                        <form action="{{route('admin.comments.delete',$comment->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn bg-transparent border-none m-0 p-0" type="submit" onclick="return confirm('Are you really want to delete this comment?')"><i class="fa-solid fa-trash text-danger"></i></button>
                                        </form>
                                       
                                    </div>
                                </td>
                              </tr>
                              @endforeach
                         
                            </tbody>
                        </table>

                </div>
               
                   

                @else

                <div class="d-flex justify-content-center align-items-center">
                    <p>Sorry no comments available!!</p>
                </div>

                @endif

                <div class="d-flex flex-column  p-3 ">
                    <h5 class="text-secondary">Recent Comments</h5>
                    <hr class="col-2 mb-5">

                    <div class="row gap-3">
                        @foreach($comments->take(3) as $comment)
                        <div class="col-12 bg-body d-flex flex-column gap-3 p-3 rounded">
                            <div class="d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <img src="storage/" . {{$comment->user->profile_picture}} alt="" style="height: 40px;width:40px;border-radius:50%;">
                                        <span>{{$comment->user->name}} </span> 
                                    </div>
                                    <form action="{{route('admin.comments.delete',$comment->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn bg-transparent border-none m-0 p-0" type="submit" onclick="return confirm('Are you really want to delete this comment?')"><i class="fa-solid fa-trash text-secondary"></i></button>
                                    </form>
                                     
                                </div>
                                 <small class="text-secondary">{{ $comment->created_at}} </small>
                            </div>
                            <p>{{$comment->content}} </p>
                            <div class="col-4 d-flex gap-4">
                                <a href="{{route('admin.comments.edit',$comment->id)}}" class="text-decoration-none text-secondary"><i class="fa-solid fa-pen-to-square "></i></a>
                                <a href="text-decoration-none text-secondary">
                                    <i class="fa-regular fa-message text-secondary"></i>
                                </a>
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-admin.admin-layout>