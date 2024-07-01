<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Coding Diary</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
 

        <div class=" container-fluid  mx-0 px-0">
            <div class="d-flex col-12 mx-0 ">
                <nav id="sidebarMenu" class="col-md-2 col-lg-2 d-md-block navbar-dark bg-dark   vh-100 py-4 ">
                    <div class="position-sticky ">
                        <a class="navbar-brand" href="#"><h2 class="logotitle">CodingDiary</h2></a>

                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" href="{{route('admin.dashboard')}}">
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="account">
                                    Account
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="allblogs">
                                    All Blogs
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('admin.createBlog')}}">
                                    Add Blog
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="settings">
                                    Settings
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="col-md-10  col-lg-10  h-100 vh-100 overflow-x-scroll py-0 my-0 ">
                    <div class=" d-flex justify-content-end  bg-primary-subtle  px-3 py-2 mb-3">

                        <div class="d-flex align-items-center align-center" id="">
                            @if (Auth::guard('admin')->check())
                                    <a class="text-decoration-none text-dark me-3" href="/admin/dashboard">My Dashboard ({{ Auth::guard('admin')->user()->name }})</a>
                            
                                    <form action="{{ route('admin.logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger">Logout</button>
                                    </form>
                            
                            @endif
                        </div>
                    </div>
                <div class="container mt-4 vh-80">
                    <div class="row g-4 px-3 ">
                            <h2>Blog List</h2>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($allBlogs)
                                    @foreach($allBlogs as $post)
                                    <tr>
                                        <td>{{$post->id}} </td>
                                        <td>
                                            <img src=" {{asset('storage/' . $post->image)}}" alt="{{$post->title}}" style="max-width: 100px;"/>
                                           
                                        </td>
                                        <td>{{$post->title}} </td>
                                        <td>{{$post->created_at}} </td>
                                        <td>{{$post->updated_at}} </td>
                                        <td >
                                            <div class="d-flex gap-2 h-100">
                                                <a href="{{ route('admin.editPost', $post->id) }} " class="btn btn-sm btn-primary">Edit</a>
                                                <form action="{{route('admin.deletePost', $post->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete the post?')">Delete</button>
                                                </form>
                                            </div>
                                           
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <footer class="mt-auto py-3 bg-light">
                        <div class="container">
                            <p class="text-center">&copy; 2024 Coding Diary. All rights reserved. | <a href="privacy.html">Privacy Policy</a></p>
                        </div>
                    </footer>
                </div>

            </div>
           
            
        </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
