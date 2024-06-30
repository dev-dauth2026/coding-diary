<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Coding Diary</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><h2 class="logotitle">CodingDiary</h2></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    @if (Auth::guard('admin')->check())
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/dashboard">My Dashboard ({{ Auth::guard('admin')->user()->name }})</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger">Logout</button>
                            </form>
                        </li>
                    </ul>
                    @endif
                </div>
            </div>
        </nav>
    </header>
    <main class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-2 col-lg-2 d-md-block navbar-dark bg-dark collapse h-100 vh-100 position-fixed">
                <div class="position-sticky ">
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
            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 h-100 vh-100 overflow-x-scroll">
                <h2 class="my-4 text-capitalize">{{ Auth::guard('admin')->user()->role }} Dashboard</h2>
                <div class="row g-4">
                    
                    <form class=" form" action="{{route('admin.processCreateBlog')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input class="form-control @error('title') is-invalid @enderror" value="{{old('title')}}" type="text" id="title" name="title" placeholder="Enter blog title" >
                            @error('title')
                                <p class="invalid-feedback">{{$message}} </p>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="content" class="form-label ">Content</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="10" placeholder="Write your blog content here..." >{{old('content')}}</textarea>
                            @error('content')
                                <p class="invalid-feedback">{{$message}} </p>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="tags" class="form-label">Tags</label>
                            <input class="form-control @error('tags') is-invalid @enderror" value="{{old('tags')}}" type="text" id="tags" name="tags" placeholder="Enter tags (comma-separated)" >
                            @error('tags')
                                <p class="invalid-feedback">{{$message}} </p>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input class ="form-control @error('image') is-invalid @enderror"  type="file" id="image" name="image">
                            @if (Session::has('temp_image'))
                                <div class="mt-2">
                                    <p>Previously uploaded image:</p>
                                    <img src="{{ asset('storage/' . Session::get('temp_image')) }}" alt="Uploaded Image" class="img-thumbnail" width="200">
                                </div>
                            @elseif (old('image'))
                                <div class="mt-2">
                                    <p>Previously uploaded image:</p>
                                    <img src="{{ asset('storage/' . old('image')) }}" alt="Uploaded Image" class="img-thumbnail" width="200">
                                </div>
                            @endif
                            @error('image')
                                <p class="invalid-feedback">{{$message}} </p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Add Blog Post</button>
                    </form>
                </div>
            </div>
            <footer class="mt-auto py-3 bg-light">
                <div class="container">
                    <p class="text-center">&copy; 2024 Coding Diary. All rights reserved. | <a href="privacy.html">Privacy Policy</a></p>
                </div>
            </footer>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
