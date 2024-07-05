<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">

    <title>Coding Diary | Home</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary-subtle px-3">
        <a class="navbar-brand" href="/">
            <h2 class="logotitle">CodingDiary</h2>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{route('account.blog')}}">Blogs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{route('account.about')}}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{route('account.contact')}}">Contact</a>
                </li>
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#!" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Hello, {{Auth::user()->name}} </a>
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
                <button class="btn btn-primary ms-2">
                    <a href="{{route('account.register')}}" class="text-decoration-none text-white">Sign Up</a>
                </button>
                <button class="btn btn-secondary ms-2">
                    <a href="{{route('account.login')}}" class="text-decoration-none text-white">Login</a>
                </button>
                @endauth
            </div>
        </div>
    </nav>

    <main>
        <div class="container-fluid">
            <div class="row">
               {{$slot}}
            </div>
        </div>
        
    </main>

    <footer class="footer-section bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h4>Know more about us</h4>
                    <p>Learn coding more effectively from Coding Diary blog.</p>
                </div>
                <div class="col-md-4">
                    <h4>Quick Links</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-secondary">Home</a></li>
                        <li><a href="#" class="text-secondary">Blogs</a></li>
                        <li><a href="#" class="text-secondary">About</a></li>
                        <li><a href="#" class="text-secondary">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4>Contact Us</h4>
                    <p>Email: codingdiary2020@gmail.com</p>
                    <p>Address: 54 Brisbane City QLD 4000</p>
                    <p>Phone: 0404243454</p>
                </div>
            </div>
            <div class="text-center mt-4">
                <p class="mb-0">&copy; 2024 Coding Diary. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
