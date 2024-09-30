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

        .custom-scroll {
            max-height: 300px; /* Set a height to allow scrolling */
            overflow-y: auto; /* Enable vertical scrolling */
            scrollbar-width: none; /* Hide scrollbar for Firefox */
            -ms-overflow-style: none; /* Hide scrollbar for IE and Edge */
        }

        .custom-scroll::-webkit-scrollbar {
            display: none; /* Hide scrollbar for Chrome, Safari, and Opera */
        }
   

    </style>
</head>
<body>
    <div class="container-fluid mx-0 px-0 d-flex position-relative">
           <x-user-dashboard-navbar />
            <main id="main" class="col-10 col-sm-10 col-md-9 col-lg-10  overflow-y-auto custom-scroll py-0 my-0" style="min-height: 100vh;">
                <div class="d-flex  align-items-center bg-white px-3 py-2 border-bottom">
                    <div class="d-none d-sm-block">
                        <button class="btn btn-transparent p-0 m-0" type="button" onclick="toggleSidebar()"><i class="fa-solid fa-bars fs-4 text-secondary"></i></button>
                    </div>
                    <div class="d-flex align-items-center ms-auto">
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

    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

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
</body>
</html>
