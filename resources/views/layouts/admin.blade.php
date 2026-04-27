<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Dashboard Admin - Klinik Digital')</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            overflow-x: hidden;
        }
        
        .sidebar {
            width: 280px;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            z-index: 40;
            background-color: #1f2937;
        }
        
        .main-content {
            margin-left: 280px;
            min-height: 100vh;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            .sidebar.mobile-open {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
        }
        
        /* Scrollbar Styling */
        .sidebar::-webkit-scrollbar {
            width: 5px;
        }
        
        .sidebar::-webkit-scrollbar-track {
            background: #1f2937;
        }
        
        .sidebar::-webkit-scrollbar-thumb {
            background: #4b5563;
            border-radius: 5px;
        }
        
        .sidebar::-webkit-scrollbar-thumb:hover {
            background: #6b7280;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Sidebar -->
    <div class="sidebar text-white flex flex-col shadow-xl">
        <!-- Logo -->
        <div class="p-6 border-b border-gray-800">
            <div class="flex items-center space-x-3">
                <i class="fas fa-hospital-user text-2xl text-blue-400"></i>
                <div>
                    <span class="font-bold text-xl block">Klinik Digital</span>
                    <span class="text-xs text-gray-400">Admin Panel</span>
                </div>
            </div>
        </div>
        
        <!-- Menu Navigasi -->
        <div class="flex-1 overflow-y-auto py-6">
            <nav class="space-y-1 px-4">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    <i class="fas fa-tachometer-alt w-5 text-lg"></i>
                    <span>Dashboard</span>
                </a>
                
                <div class="border-t border-gray-800 my-4"></div>
                
                <div class="text-xs text-gray-500 uppercase tracking-wider px-4 mb-2">Manajemen User</div>
                
                <a href="{{ route('admin.dokter.index') }}" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dokter*') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    <i class="fas fa-user-md w-5 text-lg"></i>
                    <span>Data Dokter</span>
                </a>
                
                <a href="{{ route('admin.pasien.index') }}" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.pasien*') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    <i class="fas fa-users w-5 text-lg"></i>
                    <span>Data Pasien</span>
                </a>
                
                <div class="border-t border-gray-800 my-4"></div>
                
                <div class="text-xs text-gray-500 uppercase tracking-wider px-4 mb-2">Manajemen Klinik</div>
                
                <a href="{{ route('admin.jadwal.index') }}" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.jadwal*') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    <i class="fas fa-calendar-alt w-5 text-lg"></i>
                    <span>Jadwal Konsultasi</span>
                </a>
                
                <a href="{{ route('admin.reservasi.index') }}" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.reservasi*') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    <i class="fas fa-calendar-check w-5 text-lg"></i>
                    <span>Reservasi</span>
                </a>
                
                <div class="border-t border-gray-800 my-4"></div>
                
                <div class="text-xs text-gray-500 uppercase tracking-wider px-4 mb-2">Pengaturan</div>
                
                <a href="{{ route('admin.profile') }}" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.profile') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    <i class="fas fa-user-circle w-5 text-lg"></i>
                    <span>Profile Admin</span>
                </a>
                
                <a href="{{ route('admin.settings') }}" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.settings') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    <i class="fas fa-cog w-5 text-lg"></i>
                    <span>Pengaturan</span>
                </a>
            </nav>
        </div>
        
        <!-- Logout -->
        <div class="p-4 border-t border-gray-800">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" 
                        class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-red-600 hover:text-white transition-all duration-200 w-full">
                    <i class="fas fa-sign-out-alt w-5 text-lg"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navbar -->
        <nav class="bg-white shadow-md sticky top-0 z-30">
            <div class="px-6 py-4">
                <div class="flex justify-between items-center">
                    <button id="menuToggle" class="lg:hidden text-gray-600 hover:text-gray-900 focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                    
                    <div class="flex items-center space-x-4">
                        <i class="fas fa-chart-line text-blue-500 text-xl"></i>
                        <h1 class="text-xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h1>
                    </div>
                    
                    <div class="relative">
                        <button id="profileDropdown" class="flex items-center space-x-2 focus:outline-none">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white">
                                <i class="fas fa-user text-sm"></i>
                            </div>
                            <span class="text-gray-700 hidden md:inline">Admin</span>
                            <i class="fas fa-chevron-down text-gray-500 text-xs hidden md:inline"></i>
                        </button>
                        
                        <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50">
                            <a href="{{ route('admin.profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-user mr-2"></i> Profile
                            </a>
                            <a href="{{ route('admin.settings') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-cog mr-2"></i> Settings
                            </a>
                            <hr class="my-1">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        
        <!-- Page Content -->
        <main class="p-6">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                    {{ session('error') }}
                </div>
            @endif
            
            @yield('content')
        </main>
    </div>
    
    <script>
        // Mobile menu toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.querySelector('.sidebar');
        
        if (menuToggle) {
            menuToggle.addEventListener('click', () => {
                sidebar.classList.toggle('mobile-open');
            });
        }
        
        // Profile dropdown
        const profileBtn = document.getElementById('profileDropdown');
        const dropdownMenu = document.getElementById('dropdownMenu');
        
        if (profileBtn) {
            profileBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdownMenu.classList.toggle('hidden');
            });
            
            document.addEventListener('click', (event) => {
                if (!profileBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        }
        
        // Close sidebar on mobile when clicking link
        const sidebarLinks = document.querySelectorAll('.sidebar a');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 768) {
                    sidebar.classList.remove('mobile-open');
                }
            });
        });
    </script>
</body>
</html>