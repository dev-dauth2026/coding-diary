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
                <li class="nav-item px-3 {{ request()->is('account/user/messages*') ? 'bg-secondary' : '' }}">
                    <a class="nav-link {{ request()->is('account/user/messages*') ? 'active text-white' : 'text-secondary' }}" href="{{route('account.messages.index')}}">
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