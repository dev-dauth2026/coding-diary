<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Coding Diary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <style>
        #sidebarMenu {
            transition: width 0.3s, display 0.3s;
        }
        #main {
            transition: margin-left 0.3s;
        }
        .collapsed-sidebar {
            width: 80px !important;
        }
        .expanded-main {
            width: calc(100% - 80px) !important;
        }
        
        .sidebar-text {
            display: inline;
        }
        .collapsed .sidebar-icon {
            display: inline;
        }
        .collapsed .sidebar-text {
            display: none;
        }

        .sidebar-logo2{
            display: none;
        }
        .collapsed .sidebar-logo2 {
            display: inline;
        }

        .collapsed .sidebar-logo1 {
            display: none;
        }

    </style>
</head>
<body>
    <div class="container-fluid mx-0 px-0 ">
        <div class="row mx-0">
            <nav id="sidebarMenu" class="col-md-2 col-lg-2 d-md-block navbar-dark bg-dark vh-100 py-4 overflow-scroll">
                <div class="position-sticky">
                    <a id="" class="navbar-brand sidebar-logo1" href="dashboard">
                        <img src="{{ asset('storage/logo/CodingDiarylogo.png') }}" alt="Coding Diary Logo" style="height: 50px; width: 150px; object-fit: cover">
                    </a>
                    <a class="navbar-brand sidebar-logo2" href="dashboard">
                        <img src="{{ asset('storage/logo/logo2.png') }}" alt="Coding Diary Logo" style="height: 50px; width: 50px; object-fit: cover">
                    </a>
                    <ul class="navbar-nav ms-auto d-flex flex-column mt-4 gap-2" style="min-height: 85vh;">
                        <li class="nav-item px-3">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active text-white' : 'text-secondary' }}" href="{{ route('admin.dashboard') }}">
                                <div class="d-flex align-items-center">
                                <i class="fa-solid fa-tachometer-alt sidebar-icon fs-4 me-3"></i> <span class="sidebar-text text-nowrap">Dashboard</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link {{ request()->routeIs('#') ? 'active text-white' : 'text-secondary' }}" href="#">
                                <div class="d-flex align-items-center">

                                    <i class="fa-solid fa-user sidebar-icon fs-4 me-3"></i> <span class="sidebar-text text-nowrap">Profile</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link {{ request()->routeIs('admin.blogs') ? 'active text-white' : 'text-secondary' }}" href="{{ route('admin.blogs') }}">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-blog sidebar-icon fs-4 me-3"></i> <span class="sidebar-text text-nowrap">All Blogs</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link {{ request()->routeIs('admin.createBlog') ? 'active text-white' : 'text-secondary' }}" href="{{ route('admin.createBlog') }}">
                                <div class="d-flex align-items-center">
                                  <i class="fa-solid fa-plus-circle sidebar-icon fs-4 me-3"></i> <span class="sidebar-text text-nowrap">Add Blog</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link {{ request()->routeIs('#') ? 'active text-white' : 'text-secondary' }}" href="{{ route('admin.createBlog') }}">
                                <div class="d-flex align-items-center">
                                  <i class="fa-solid fa-users sidebar-icon fs-4 me-3"></i> <span class="sidebar-text text-nowrap">Users</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link {{ request()->routeIs('#') ? 'active text-white' : 'text-secondary' }}" href="#">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-list sidebar-icon fs-4 me-3"></i> <span class="sidebar-text text-nowrap">Categories</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link {{ request()->routeIs('#') ? 'active text-white' : 'text-secondary' }}" href="#">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-comments sidebar-icon fs-4 me-3"></i> <span class="sidebar-text text-nowrap">Comments</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link {{ request()->routeIs('#') ? 'active text-white' : 'text-secondary' }}" href="#">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-envelope sidebar-icon fs-4 me-3"></i> <span class="sidebar-text text-nowrap">Messages</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link {{ request()->routeIs('#') ? 'active text-white' : 'text-secondary' }}" href="#">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-chart-bar sidebar-icon fs-4 me-3"></i> <span class="sidebar-text text-nowrap">Analytics</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link {{ request()->routeIs('#') ? 'active text-white' : 'text-secondary' }}" href="#">
                                <div class="d-flex align-items-center">
                                <i class="fa-solid fa-cogs sidebar-icon fs-4 me-3"></i> <span class="sidebar-text text-nowrap">Settings</span>
                                </div>
                            </a>
                        </li>
                       
                     
                        <li class="nav-item px-3 logout-item mt-auto">
                            <a class="nav-link text-secondary" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-right-from-bracket sidebar-icon fs-4 me-3"></i> <span class="sidebar-text text-nowrap">Logout</span>
                                </div>
                            </a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                @csrf
                            </li>
                    </ul>
                </div>
            </nav>
            <div id="main" class="col-md-10 col-lg-10 h-100 vh-100 overflow-x-scroll py-0 my-0">
                <div class="d-flex justify-content-between align-items-center bg-white px-3 py-2 border-bottom">
                    <button class="btn btn-transparent p-0 m-0" type="button" onclick="toggleSidebar()"><i class="fa-solid fa-bars fs-4 text-secondary"></i></button>
                    <i class="fa-solid fa-magnifying-glass fs-4 ms-3 "></i>
                    <input class="form-control mx-3" placeholder="Search blogs..." />
                    <div class="d-flex align-items-center">
                        @if (Auth::guard('admin')->check())
                            <a class="text-decoration-none text-secondary me-3" href="/admin/dashboard">Admin Dashboard ({{ Auth::guard('admin')->user()->name }})</a>
                            
                        @endif
                    </div>
                </div>
                <div id="main-content">
                    {{$slot}}
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarMenu = document.getElementById('sidebarMenu');
            const main = document.getElementById('main');

            // Check the localStorage value and apply the appropriate class
            if (localStorage.getItem('sidebarState') === 'collapsed') {
                sidebarMenu.classList.add('collapsed-sidebar');
                main.classList.add('expanded-main');
                document.body.classList.add('collapsed');
            }
        });

        function toggleSidebar() {
            const sidebarMenu = document.getElementById('sidebarMenu');
            const main = document.getElementById('main');

            sidebarMenu.classList.toggle('collapsed-sidebar');
            main.classList.toggle('expanded-main');
            document.body.classList.toggle('collapsed');

            // Save the sidebar state in localStorage
            if (sidebarMenu.classList.contains('collapsed-sidebar')) {
                localStorage.setItem('sidebarState', 'collapsed');
            } else {
                localStorage.removeItem('sidebarState');
            }
        }
    </script>
</body>
</html>
