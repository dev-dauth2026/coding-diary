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
                    <div class="row g-4 px-3">
                        @if (Session::has('postCreated'))
                        <p class="text-success bg-success-subtle p-2 rounded">{{Session::get('postCreated')}} </p>
                        @endif

                        <h2 class="my-4 text-capitalize">{{ Auth::guard('admin')->user()->role }} Dashboard</h2>
                        <div class="col-12 col-md-6 col-lg-3 ">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Total Blogs</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Messages</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Users</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Add New Blog</h5>
                                </div>
                            </div>
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
