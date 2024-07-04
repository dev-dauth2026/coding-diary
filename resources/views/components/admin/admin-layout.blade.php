<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Coding Diary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.tiny.cloud/1/w8mpofb4fsu0da2x3j136ktemojtn4e8crol4882w3rpw0qo/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>
 

        <div class=" container-fluid  mx-0 px-0">
            <div class="d-flex col-12 mx-0 ">
                <nav id="sidebarMenu" class="col-md-2 col-lg-2 d-md-block navbar-dark bg-dark   vh-100 py-4 ">
                    <div class="position-sticky ">
                        
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-warning" href="dashboard"><h2 class="logotitle">CodingDiary </h2></a>
                               
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link text-white active" href="{{route('admin.dashboard')}}">
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white"  href="#">
                                    Account
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{route('admin.blogs')}}">
                                    All Blogs
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{route('admin.createBlog')}}">
                                    Add Blog
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">
                                    Settings
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="col-md-10  col-lg-10  h-100 vh-100 overflow-x-scroll py-0 my-0 ">
                    <div class=" d-flex justify-content-end  bg-dark text-white  px-3 py-2 mb-3">

                        <div class="d-flex align-items-center align-center" id="">
                            @if (Auth::guard('admin')->check())
                                    <a class="text-decoration-none text-white me-3" href="/admin/dashboard">Admin Dashboard ({{ Auth::guard('admin')->user()->name }})</a>
                            
                                    <form action="{{ route('admin.logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger">Logout</button>
                                    </form>
                            
                            @endif
                        </div>
                    </div>
                <div class="container mt-4 vh-80">
                    <div class="row g-4 px-3 ">
                        {{$slot}}
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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    
</body>
</html>
