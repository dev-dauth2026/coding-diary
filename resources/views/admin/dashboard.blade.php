<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Coding Diary</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/navbar.css') }}">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="navbar-brand">
                <h2 class="logotitle">CodingDiary</h2>
            </div>
            @if (Auth::guard('admin'))
            <div class="navbar-menu">
                <ul class="nav-links">
                
                    <li><a href="/admin/dashboard">My Dashboard ( {{Auth::guard('admin')->user()->name}} ) </a></li>
            
                </ul>
                <div class="navbar-buttons">
               
                    <form action="{{route('admin.logout')}}" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
               
                </div>
            </div>
            @endif
        </nav>
    </header>
    <main class="main-container">
        <aside class="sidebar">
            <ul class="sidebar-links">
                <li><a href="dashboard">Dashboard</a></li>
                <li><a href="account">Account</a></li>
                <li><a href="allblogs">All Blogs</a></li>
                <li><a href="addblog">Add Blog</a></li>
                <li><a href="settings">Settings</a></li>
                
               
            </ul>
        </aside>
        <section class="dashboard-content">
            <h2 class="text-capitalize">  {{Auth::guard('admin')->user()->role}} Dashboard</h2>
            <div class="dashboard">

                <div class="card totalblogs">Total Blogs</div>
                <div class="card message">Messages</div>
                <div class="card users">Users</div>
                <div class="card newblog">Add New Blog</div>
            </div>
        </section>
        <footer>
            <p>&copy; 2024 Coding Diary. All rights reserved. | <a href="privacy.html">Privacy Policy</a></p>
        </footer>
    </main>
   
</body>
</html>
