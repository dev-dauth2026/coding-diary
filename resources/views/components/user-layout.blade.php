<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <title>Coding Diary | Home</title>
</head>

<body>
    <div class="container-fluid m-0 p-0">
        <nav class="sticky-top navbar navbar-expand-lg navbar-light bg-dark px-3" style="z-index: 100">
            <a class="navbar-brand" href="/">
                <img src="{{asset('storage/logo/CodingDiarylogo.png')}}" alt="Coding Diary Logo" style="height:50px; width:150px; object-fit:cover" >
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('account.blog')}}">Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('account.about')}}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('account.contact')}}">Contact</a>
                    </li>
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#!" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> {{Auth::user()->name}} <img src="{{asset('storage/' . Auth::user()->profile_picture)}}" alt="profile picture" style="width: 30px; height: 30px; border-radius: 50%"> </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow bsb-zoomIn bg-white" aria-labelledby="accountDropdown"> 
                            <li class="nav-item">
                                <a href="{{route('account.dashboard')}}" class=" text-decoration-none text-black dropdown-item">Dashboard</a>
                            </li>  
                            <li class="nav-item">
                                <a href="{{route('account.account')}}" class=" text-decoration-none text-black dropdown-item">My Account</a>
                            </li> 
                            <li class="nav-item">
                                <a href="" class="dropdown-item text-decoration-none text-black">My Favorite</a>
                            </li>  
                            <li class="nav-item">
                                <a href="" class="dropdown-item text-decoration-none text-black">Saved</a>
                            </li>  
                            <li class="nav-item">
                                <a href="" class="dropdown-item text-decoration-none text-black">Watch List</a>
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
                <div class="d-flex">
                    @auth
                    
                    @else
                    <button class="btn btn-outline-primary ms-2" >
                        <a href="{{route('account.register')}}" class="text-decoration-none text-white">Sign Up</a>
                    </button>
                    <button class="btn btn-outline-success ms-2">
    
                        <a href="{{ route('account.login') }}" class="text-decoration-none text-white">Login</a>
                    </button>
                    @endauth
                </div>
            </div>
        </nav>
        <main>
            <div class="container-fluid position-relative">
                <div class="row position-relative ">
                   {{$slot}}
                </div>
            </div>
            
        </main>
   
        <footer class=" footer-section position-relative   text-white  w-100" >
            <div class="container-fluid m-0 p-0 ">
                <div class="p-5 bg-dark " style="--bs-bg-opacity: .85; ">
                    <div class="row " >
                        <div class="col-md-4">
                            <h4>Know more about us</h4>
                            <p class="text-white text-opacity-50">Learn coding more effectively from Coding Diary blog.</p>
                        </div>
                        <div class="col-md-4">
                            <h4>Quick Links</h4>
                            <ul class="list-unstyled">
                                <li><a href="/" class="text-white text-opacity-50">Home</a></li>
                                <li><a href="{{route('account.blog')}}" class="text-white text-opacity-50">Blogs</a></li>
                                <li><a href="{{route('account.about')}}" class="text-white text-opacity-50">About</a></li>
                                <li><a href="{{route('account.contact')}}" class="text-white text-opacity-50">Contact</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h4>Contact Us</h4>
                            <p class="text-white text-opacity-50">Email: codingdiary2020@gmail.com</p>
                            <p class="text-white text-opacity-50">Address: 54 Brisbane City QLD 4000</p>
                            <p class="text-white text-opacity-50">Phone: 0404243454</p>
                            <div class="mt-3">
                                <h4>Follow Us</h4>
                                <a href="https://www.facebook.com" class="text-white text-opacity-50 mx-2">
                                    <i class="bi bi-facebook" style="font-size: 1.5rem;"></i>
                                </a>
                                <a href="https://www.youtube.com" class="text-white text-opacity-50 mx-2">
                                    <i class="bi bi-youtube" style="font-size: 1.5rem;"></i>
                                </a>
                                <a href="https://www.twitter.com" class="text-white text-opacity-50 mx-2">
                                    <i class="bi bi-twitter" style="font-size: 1.5rem;"></i>
                                </a>
                                <a href="https://www.instagram.com" class="text-white text-opacity-50 mx-2">
                                    <i class="bi bi-instagram" style="font-size: 1.5rem;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

               
                <div class=" bg-dark p-3">
                    <p class="mb-0 text-center">&copy; 2024 Coding Diary. All rights reserved.</p>
                </div>
            </div>
          
        
        </footer> 

    </div>

   
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
