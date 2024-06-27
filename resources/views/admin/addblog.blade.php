<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard | Coding Diary</title>
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
            <div class="navbar-menu">
                <ul class="nav-links">
                    @auth
                    <li><a href="/admin/dashboard">My Dashboard</a></li>
                    @endauth
                </ul>
                <div class="navbar-buttons">
                    @auth
                    <button class="logout"><a href="/admin/logout">Logout</a></button>
                    @endauth
                </div>
            </div>
        </nav>
    </header>
    <main class="main-container">
        <aside class="sidebar">
            <ul class="sidebar-links">
                <li><a href="dasboard">Dashboard</a></li>
                <li><a href="account">Account</a></li>
                <li><a href="allblogs">All Blogs</a></li>
                <li><a href="addblog">Add Blog</a></li>
                <li><a href="settings">Settings</a></li>
                <li><a href="logout">Logout</a></li>
            </ul>
        </aside>
        <section class="dashboard-content">
            <h2>User Dashboard</h2>
            <form class="blog-form">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" placeholder="Enter blog title" required>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea id="content" name="content" rows="10" placeholder="Write your blog content here..." required></textarea>
                </div>
                <div class="form-group">
                    <label for="tags">Tags</label>
                    <input type="text" id="tags" name="tags" placeholder="Enter tags (comma-separated)" required>
                </div>
                <button type="submit" class="submit-button">Add Blog Post</button>
            </form>
        </section>
        <footer>
            <p>&copy; 2024 Coding Diary. All rights reserved. | <a href="privacy.html">Privacy Policy</a></p>
        </footer>
    </main>
   
</body>
</html>
