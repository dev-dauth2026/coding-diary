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
                <li class="nav-item px-3 {{ request()->routeIs('admin.dashboard') ? 'bg-secondary' : '' }}">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active text-white' : 'text-secondary' }}" href="{{ route('admin.dashboard') }}">
                        <div class="d-flex align-items-center">
                        <i class="fa-solid fa-tachometer-alt sidebar-icon fs-4 me-3 " style="width:25px;"></i> <span class="sidebar-text text-nowrap">Dashboard</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item px-3 {{ request()->routeIs('admin.profile') ? 'bg-secondary' : '' }}">
                    <a class="nav-link {{ request()->routeIs('admin.profile') ? 'active text-white' : 'text-secondary' }}" href="{{route('admin.profile')}}">
                        <div class="d-flex align-items-center">

                            <i class="fa-solid fa-user sidebar-icon fs-4 me-3" style="width:25px;"></i> <span class="sidebar-text text-nowrap">Profile</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item px-3 {{ request()->routeIs('admin.blogs') ? 'bg-secondary' : '' }}">
                    <a class="nav-link {{ request()->routeIs('admin.blogs') ? 'active text-white' : 'text-secondary' }}" href="{{ route('admin.blogs') }}">
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-blog sidebar-icon fs-4 me-3" style="width:25px;"></i> <span class="sidebar-text text-nowrap">All Blogs</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item px-3 {{ request()->routeIs('admin.blog.create') ? 'bg-secondary' : '' }}">
                    <a class="nav-link {{ request()->routeIs('admin.blog.create') ? 'active text-white' : 'text-secondary' }}" href="{{ route('admin.blog.create') }}">
                        <div class="d-flex align-items-center">
                          <i class="fa-solid fa-plus-circle sidebar-icon fs-4 me-3" style="width:25px;"></i> <span class="sidebar-text text-nowrap">Add Blog</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item px-3 {{ request()->routeIs('admin.users') ? 'bg-secondary' : '' }}">
                    <a class="nav-link {{ request()->routeIs('admin.users') ? 'active text-white' : 'text-secondary' }}" href="{{ route('admin.users') }}">
                        <div class="d-flex align-items-center">
                          <i class="fa-solid fa-users sidebar-icon fs-4 me-3" style="width:25px;"></i> <span class="sidebar-text text-nowrap">Users</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item px-3 {{ request()->routeIs('admin.blog.category') ? 'bg-secondary' : '' }}">
                    <a class="nav-link {{ request()->routeIs('admin.blog.category') ? 'active text-white' : 'text-secondary' }}" href="{{route('admin.blog.category')}}">
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-list sidebar-icon fs-4 me-3" style="width:25px;"></i> <span class="sidebar-text text-nowrap">Categories</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item px-3 {{ request()->routeIs('admin.comments') ? 'bg-secondary' : '' }}">
                    <a class="nav-link {{ request()->routeIs('admin.comments') ? 'active text-white' : 'text-secondary' }}" href="{{route('admin.comments')}}">
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-comments sidebar-icon fs-4 me-3" style="width:25px;"></i> <span class="sidebar-text text-nowrap">Comments</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item px-3 {{ request()->routeIs('admin.messages*') ? 'bg-secondary' : '' }}">
                    <a class="nav-link {{ request()->routeIs('admin.messages*') ? 'active text-white' : 'text-secondary' }}" href="{{route('admin.messages')}}">
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-envelope sidebar-icon fs-4 me-3" style="width:25px;"></i> <span class="sidebar-text text-nowrap">Messages</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item px-3 {{ request()->routeIs('#') ? 'bg-secondary' : '' }}">
                    <a class="nav-link {{ request()->routeIs('#') ? 'active text-white' : 'text-secondary' }}" href="#">
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-chart-bar sidebar-icon fs-4 me-3" style="width:25px;"></i> <span class="sidebar-text text-nowrap">Analytics</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item px-3 {{ request()->routeIs('#') ? 'bg-secondary' : '' }}">
                    <a class="nav-link {{ request()->routeIs('#') ? 'active text-white' : 'text-secondary' }}" href="#">
                        <div class="d-flex align-items-center">
                        <i class="fa-solid fa-cogs sidebar-icon fs-4 me-3" style="width:25px;"></i> <span class="sidebar-text text-nowrap">Settings</span>
                        </div>
                    </a>
                </li>
               
             
                <li class="nav-item px-3 logout-item mt-auto">
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="">
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