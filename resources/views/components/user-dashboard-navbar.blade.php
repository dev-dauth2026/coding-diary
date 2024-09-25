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
            display: none !important;
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

        @media(max-width:450px){
            .sidebar-text{
                display: none !important;
            }
            .collapsed .sidebar-text {
            display: none !important;
        }
        .collapsed-sidebar {
            width: 90px !important;
        }
        .expanded-main {
            width: calc(100% - 90px) !important;
        }

        }


</style>
<aside id="sidebarMenu" class="col-2  d-md-block navbar-dark bg-dark vh-100 py-4 overflow-scroll">
    <nav  class="">
        <div class="position-sticky">
            <div class="d-flex justify-content-center">
                {{-- <a id="" class="navbar-brand sidebar-logo1 d-none d-sm-block " href="{{route('account.home')}}">
                    <img src="{{ asset('storage/logo/CodingDiarylogo.png') }}" alt="Coding Diary Logo" style="height: 50px; width: 150px; object-fit: cover">
                </a> --}}
                <a class="navbar-brand  " href="{{route('account.home')}}">
                    <div class="d-flex gap-2 align-items-center " style="height: 60px;">
                        <div class=" h-100">
                            <img src="{{ asset('storage/logo/logo2.png') }}" alt="Coding Diary Logo" class="" style="height: 50px; width: 50px; object-fit: cover">
                        </div>
                        <div class=" d-flex align-items-center h-100 d-none d-sm-flex sidebar-text">
                            <h5 class=" text-info text-opacity-75">CODING DIARY</h5>
                        </div>
                    </div>
                </a>
            </div>
           
            <ul class="navbar-nav ms-auto d-flex flex-column mt-4 gap-2 " style="min-height: 85vh;">
                <x-dashboard-nav-link 
                    conditionUrl="account/dashboard"
                    url="account.dashboard"
                    icon="tachometer-alt"
                    text="Dashboard"
                />
                <x-dashboard-nav-link 
                 conditionUrl="account/account"
                 url="account.account"
                 icon="user"
                 text="Profile"
                />

                <x-dashboard-nav-link 
                 conditionUrl="account/dashboard/favourites"
                 url="account.favourites"
                 icon="heart"
                 text="Favorites"
                />

                <x-dashboard-nav-link 
                conditionUrl="account/dashboard/comments"
                url="account.comments"
                icon="comment-dots"
                text="Comments"
               />

               <x-dashboard-nav-link 
                conditionUrl="account/user/messages*"
                url="account.messages.index"
                icon="envelope"
                text="Messages"
                unreadMessageCount="{{$unreadMessageCount}}"
               />

               <x-dashboard-nav-link 
                conditionUrl="account/activities"
                url="account.activities.index"
                icon="fa-solid fa-clock-rotate-left "
                text="Activities"
               />

               <x-dashboard-nav-link 
                conditionUrl="account/notifications"
                url="account.notifications"
                icon="fa-solid fa-bell "
                text="Notifications"
               />

               <x-dashboard-nav-link 
                conditionUrl="account/user/settings"
                url="account.settings.index"
                icon="fa-solid fa-cogs"
                text="Settings"
               />

               
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
