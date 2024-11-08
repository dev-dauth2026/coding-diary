<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Coding Diary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    @if (auth('admin')->check())
    <meta name="user-id" content="{{ auth('admin')->user()->id }}">
    <meta name="user-role" content="admin">
    @elseif (auth('web')->check())
        <meta name="user-id" content="{{ auth('web')->user()->id }}">
        <meta name="user-role" content="user">
    @endif
    <!-- Vite CSS and JavaScript -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <x-head.prism-highlighter></x-head.prism-highlighter>

    <x-head.tinymce-config/>

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
            display: none;
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
   

    </style>
</head>
<body>
    <div class="container-fluid mx-0 px-0 d-flex">
            <x-admin.admin-dashboard-navbar></x-admin.admin-dashboard-navbar>
            <main id="main" class="col-md-10 col-lg-10 h-100 vh-100 overflow-x-scroll py-0 my-0">
                <div class="d-flex justify-content-between align-items-center bg-white px-3 py-2 border-bottom">
                    <button class="btn btn-transparent p-0 m-0" type="button" onclick="toggleSidebar()"><i class="fa-solid fa-bars fs-4 text-secondary"></i></button>
                    <i class="fa-solid fa-magnifying-glass fs-4 ms-3 "></i>
                    <input class="form-control mx-3" placeholder="Search blogs..." />
                    <div class="d-flex align-items-center">
                        @if (Auth::guard('admin')->check())
                            @if (Auth::guard('admin')->user()->profile_picture)
                                <img src="{{asset('storage/' . Auth::guard('admin')->user()->profile_picture)}}" alt="profile picture" style="width: 30px; height: 30px; border-radius: 50%">
                            @else
                                <i class="fa fa-user-circle fs-4"></i>
                            @endif
                        <a class="text-decoration-none text-secondary me-3 text-nowrap " href="/admin/dashboard"> ({{ Auth::guard('admin')->user()->name }})</a>
                        
                        @endif
                    </div>
                </div>
                <div id="main-content">
                    {{$slot}}
                    <footer class="mt-auto py-3 bg-light">
                        <div class="container">
                            <p class="text-center">&copy; 2024 Coding Diary. All rights reserved. | <a href="privacy.html">Privacy Policy</a></p>
                        </div>
                    </footer>
                    
                    
                </div>
              
                
            </main>
            <x-message.notification-message/>
        
    </div>

    
   

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

        // prisma text highlight  function call
        document.addEventListener('DOMContentLoaded', (event) => {
        Prism.highlightAll();
         });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>
</html>
<!DOCTYPE html>

