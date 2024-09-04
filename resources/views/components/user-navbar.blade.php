<nav class="sticky-top  navbar navbar-expand-lg navbar-light bg-dark px-3 d-flex flex-lg-row flex-row-reverse" style="z-index: 100">
    <div class="d-flex justify-content-center d-lg-none">
        @auth
        {{-- small and medium devicee  --}}
        <li class="nav-item dropdown  d-lg-none d-flex">
            <a class="nav-link dropdown-toggle text-white" href="#!" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><span class="d-none d-md-flex"> {{Auth::user()->name}}</span> <img src="{{asset('storage/' . Auth::user()->profile_picture)}}" alt="profile picture" style="width: 30px; height: 30px; border-radius: 50%"> </a>
            <ul class="dropdown-menu dropdown-menu-end border-0 shadow bsb-zoomIn bg-white" aria-labelledby="accountDropdown"> 
                <li class="nav-item">
                    <a href="{{route('account.dashboard')}}" class=" text-decoration-none text-black dropdown-item">Dashboard</a>
                </li>  
                <li class="nav-item">
                    <a href="{{route('account.account')}}" class=" text-decoration-none text-black dropdown-item">My Account</a>
                </li> 
                <li class="nav-item">
                    <a href="{{route('account.favourites')}}" class="dropdown-item text-decoration-none text-black">My Favorite</a>
                </li>  
                <li class="nav-item">
                    <a href="" class="dropdown-item text-decoration-none text-black">Settings</a>
                </li>  
                <li>
                    <form action="{{route('account.logout')}}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item" href="">Logout</button>
                    </form>
                </li>
            </ul>
        </li>
        @else
    
        <a class=" text-white" href="{{route('account.login')}}" id="loginAccount" role="button" > <i class="fa-regular fa-circle-user fa-2x"></i></a>

        @endauth
         {{-- small and medium devicee end --}}
    </div>
    <a class="navbar-brand" href="/">
        <img src="{{asset('storage/logo/CodingDiarylogo.png')}}" alt="Coding Diary Logo" style="height:50px; width:150px; object-fit:cover" >
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list text-white " style="font-size: 40px"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto ">
            <li class="nav-item r d-sm-flex justify-content-sm-center ">
                <a class="nav-link  {{ request()->is('/') ? 'active text-white  ' : 'text-white-50' }}" href="/">Home</a>
            </li>
            <li class="nav-item d-sm-flex justify-content-sm-center">
                <a class="nav-link  {{request()->is('account/blog*')?'active text-white':'text-white-50'}} " href="{{route('account.blog')}}">Blogs</a>
            </li>
            <li class="nav-item d-sm-flex justify-content-sm-center">
                <a class="nav-link  {{request()->routeIs('account.about')?'active text-white':'text-white-50'}} " href="{{route('account.about')}}">About</a>
            </li>
            <li class="nav-item d-sm-flex justify-content-sm-center">
                <a class="nav-link {{request()->routeIs('account.contact')?'active text-white':'text-white-50'}} " href="{{route('account.contact')}}">Contact</a>
            </li>
            @auth
            <li class="nav-item dropdown  d-lg-flex d-none">
                <a class="nav-link dropdown-toggle text-white" href="#!" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> {{Auth::user()->name}} <img src="{{asset('storage/' . Auth::user()->profile_picture)}}" alt="profile picture" style="width: 30px; height: 30px; border-radius: 50%"> </a>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow bsb-zoomIn bg-white" aria-labelledby="accountDropdown"> 
                    <li class="nav-item">
                        <a href="{{route('account.dashboard')}}" class=" text-decoration-none text-black dropdown-item">Dashboard</a>
                    </li>  
                    <li class="nav-item">
                        <a href="{{route('account.account')}}" class=" text-decoration-none text-black dropdown-item">My Account</a>
                    </li> 
                    <li class="nav-item">
                        <a href="{{route('account.favourites')}}" class="dropdown-item text-decoration-none text-black">My Favorite</a>
                    </li>  
                    <li class="nav-item">
                        <a href="" class="dropdown-item text-decoration-none text-black">Settings</a>
                    </li>  
                    <li>
                        <form action="{{route('account.logout')}}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item" href="">Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
            
            @endauth
        </ul>
        <div class="d-none d-lg-flex justify-content-lg-center ms-3">
            @guest
                <div>
                    <a href="{{route('account.register')}}" class="text-decoration-none {{request()->routeIs('account.register')?'active text-white':'text-white-50'}}">Sign Up</a>
                    <span class="text-white-50">/</span>
                    <a href="{{ route('account.login') }}" class="text-decoration-none {{request()->routeIs('account.login')?'active text-white':'text-white-50'}}">Login</a>
                </div>
               
            
            @endguest
        </div>
    </div>
</nav>