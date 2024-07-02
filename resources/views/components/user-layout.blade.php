<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Coding Diary | Home</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary-subtle px-3">
        <a class="navbar-brand" href="#">
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
                    <a class="nav-link text-dark" href="#">Blogs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="account/about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#">Contact</a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link text-dark" href="/dashboard">My Dashboard</a>
                </li>
                @endauth
            </ul>
            <div class="d-flex">
                @auth
                <button class="btn btn-danger ms-2">
                    <a href="/logout" class="text-decoration-none text-white">Logout</a>
                </button>
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

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>
