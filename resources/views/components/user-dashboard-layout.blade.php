<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard | Coding Diary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <x-head.prism-highlighter></x-head.prism-highlighter>

    <x-head.tinymce-config/>

    <style>
        #sidebarMenu {
            transition: width 0.5s, display 0.3s;
        }
        /* #main {
            transition: margin-left 0.3s;
        } */
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

        .nav-item{
            transition: 0.5s ease
        }


        .bg-primary-gradient {
            background: linear-gradient(45deg, #0460c2, #729cca);
        }
        .bg-success-gradient {
            background: linear-gradient(45deg, #0ad038, #91dba2);
        }
        .bg-danger-gradient {
            background: linear-gradient(45deg, #a90415, #d5838b);
        }
        .bg-secondary-gradient {
            background: linear-gradient(45deg, #536779, #b9c6d2);
        }
        .bg-info-gradient {
            background: linear-gradient(45deg, #066a79, #6cd0e0);
        }
   

    </style>
</head>
<body>
    <div class="container-fluid mx-0 px-0 d-flex">
            <aside id="sidebarMenu" class="col-md-2 col-lg-2 d-md-block navbar-dark bg-dark vh-100 py-4 overflow-scroll">
                <nav  class="">
                    <div class="position-sticky">
                        <div class="d-flex justify-content-center">
                            <a id="" class="navbar-brand sidebar-logo1 " href="dashboard">
                                <img src="{{ asset('storage/logo/CodingDiarylogo.png') }}" alt="Coding Diary Logo" style="height: 50px; width: 150px; object-fit: cover">
                            </a>
                            <a class="navbar-brand sidebar-logo2" href="dashboard">
                                <img src="{{ asset('storage/logo/logo2.png') }}" alt="Coding Diary Logo" style="height: 50px; width: 50px; object-fit: cover">
                            </a>
                        </div>
                       
                        <ul class="navbar-nav ms-auto d-flex flex-column mt-4 gap-2 " style="min-height: 85vh;">
                            <li class="nav-item px-3 {{ request()->routeIs('account.dashboard') ? 'bg-secondary' : '' }}">
                                <a class="nav-link {{ request()->routeIs('account.dashboard') ? 'active text-white' : 'text-secondary' }}" href="{{ route('account.dashboard') }}">
                                    <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-tachometer-alt sidebar-icon fs-4 me-3 " style="width:25px;"></i> <span class="sidebar-text text-nowrap">Dashboard</span>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item px-3 {{ request()->routeIs('account.account') ? 'bg-secondary' : '' }}">
                                <a class="nav-link {{ request()->routeIs('account.account') ? 'active text-white' : 'text-secondary' }}" href="{{route('account.account')}}">
                                    <div class="d-flex align-items-center">
    
                                        <i class="fa-solid fa-user sidebar-icon fs-4 me-3" style="width:25px;"></i> <span class="sidebar-text text-nowrap">Profile</span>
                                    </div>
                                </a>
                            </li>

                            <li class="nav-item px-3 {{ request()->routeIs('account.favourites') ? 'bg-secondary' : '' }}">
                                <a class="nav-link {{ request()->routeIs('account.favourites') ? 'active text-white' : 'text-secondary' }}" href="{{ route('account.favourites') }}">
                                    <div class="d-flex align-items-center">
                                        <i class="fa-regular fa-heart fs-4 me-3" style="width:25px;"></i> <span class="sidebar-text text-nowrap"> Favorites</span>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item px-3 {{ request()->routeIs('account.comments') ? 'bg-secondary' : '' }}">
                                <a class="nav-link {{ request()->routeIs('account.comments') ? 'active text-white' : 'text-secondary' }}" href="{{route('account.comments')}}">
                                    <div class="d-flex align-items-center">
                                        
                                      <i class="fas fa-comment-dots sidebar-icon fs-4 me-3" style="width:25px;"></i> <span class="sidebar-text text-nowrap"> Comments</span>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item px-3 {{ request()->routeIs('account.messages.index') ? 'bg-secondary' : '' }}">
                                <a class="nav-link {{ request()->routeIs('account.messages.index') ? 'active text-white' : 'text-secondary' }}" href="{{route('account.messages.index')}}">
                                    <div class="d-flex align-items-center">
                                        <i class="fa-solid fa-envelope sidebar-icon fs-4 me-3" style="width:25px;"></i><span class="sidebar-text text-nowrap">Messages</span>
                                    </div>
                                </a>
                            </li>

                            <li class="nav-item px-3 {{ request()->routeIs('account.activities.index') ? 'bg-secondary' : '' }}">
                                <a class="nav-link {{ request()->routeIs('account.activities.index') ? 'active text-white' : 'text-secondary' }}" href="{{route('account.activities.index')}}">
                                    <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-clock-rotate-left sidebar-icon fs-4 me-3" style="width:25px;"></i> <span class="sidebar-text text-nowrap">Activities</span>
                                    </div>
                                </a>
                            </li>

                            <li class="nav-item px-3 {{ request()->routeIs('account.notifications') ? 'bg-secondary' : '' }}">
                                <a class="nav-link {{ request()->routeIs('account.notifications') ? 'active text-white' : 'text-secondary' }}" href="{{route('account.notifications')}}">
                                    <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-bell sidebar-icon fs-4 me-3" style="width:25px;"></i> <span class="sidebar-text text-nowrap">Notifications</span>
                                    </div>
                                </a>
                            </li>

                            <li class="nav-item px-3 {{ request()->routeIs('account.settings.index') ? 'bg-secondary' : '' }}">
                                <a class="nav-link {{ request()->routeIs('account.settings.index') ? 'active text-white' : 'text-secondary' }}" href="{{route('account.settings.index')}}">
                                    <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-cogs sidebar-icon fs-4 me-3" style="width:25px;"></i> <span class="sidebar-text text-nowrap">Settings</span>
                                    </div>
                                </a>
                            </li>
                           
                         
                            <li class="nav-item px-3 logout-item mt-auto">
                                <form id="logout-form" action="{{ route('account.logout') }}" method="POST" class="">
                                    @csrf
                                    <button class="nav-link text-secondary bg-transparent" type="submit" >
                                        <div class="d-flex align-items-center">
                                            <i class="fa-solid fa-right-from-bracket sidebar-icon fs-4 me-3" style="width:25px;"></i> <span class="sidebar-text text-nowrap">Logout</span>
                                        </div>
                                    </button>
                                </form>
                                   
                                </li>
                        </ul>
                    </div>
                </nav>
            </aside>
            <main id="main" class="col-md-10 col-lg-10 h-100 vh-100 overflow-x-scroll py-0 my-0">
                <div class="d-flex justify-content-between align-items-center bg-white px-3 py-2 border-bottom">
                    <button class="btn btn-transparent p-0 m-0" type="button" onclick="toggleSidebar()"><i class="fa-solid fa-bars fs-4 text-secondary"></i></button>
                    <i class="fa-solid fa-magnifying-glass fs-4 ms-3 "></i>
                    <input class="form-control mx-3" placeholder="Search blogs..." />
                    <ul class=" navbar-nav d-flex flex-row gap-3 flex-nowrap mx-3 ">
                        <li class="nav-item  d-sm-flex justify-content-sm-center ">
                            <a class="nav-link  {{ request()->is('/') ? 'active text-dark  ' : 'text-secondary-50' }}" href="/">Home</a>
                        </li>
                        <li class="nav-item d-sm-flex justify-content-sm-center">
                            <a class="nav-link  {{request()->routeIs('account.blog')?'active text-dark':'text-secondary-50'}} " href="{{route('account.blog')}}">Blogs</a>
                        </li>
                        <li class="nav-item d-sm-flex justify-content-sm-center">
                            <a class="nav-link  {{request()->routeIs('account.about')?'active text-dark':'text-secondary-50'}} " href="{{route('account.about')}}">About</a>
                        </li>
                        <li class="nav-item d-sm-flex justify-content-sm-center">
                            <a class="nav-link {{request()->routeIs('account.contact')?'active text-dark':'text-secondary-50'}} " href="{{route('account.contact')}}">Contact</a>
                        </li>
                    </ul>
                    <div class="d-flex align-items-center">
                        @if (Auth::check())
                        @if (Auth::user()->profile_picture)
                        <img src="{{asset('storage/' . Auth::user()->profile_picture)}}" alt="profile picture" style="width: 30px; height: 30px; border-radius: 50%">
                        @else
                        <i class="fa fa-user-circle fs-4"></i>
                        @endif
                        <a class="text-decoration-none text-secondary me-3 text-nowrap " href="#"> ({{ Auth::user()->name }})</a>
                        
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
            </main>
        
    </div>

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

        // Prism text hightlight function call
        document.addEventListener('DOMContentLoaded', (event) => {
        Prism.highlightAll();
        });
    </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


</body>
</html>
