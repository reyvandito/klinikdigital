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
        
        /* Hover effect for cards */
        .stat-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Sidebar -->
    <div class="sidebar bg-gray-900 text-white flex flex-col shadow-xl">
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
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    <i class="fas fa-tachometer-alt w-5 text-lg"></i>
                    <span>Dashboard</span>
                    @if(request()->routeIs('admin.dashboard'))
                        <i class="fas fa-chevron-right ml-auto text-xs"></i>
                    @endif
                </a>
                
                <!-- Divider -->
                <div class="border-t border-gray-800 my-4"></div>
                
                <!-- Manajemen User -->
                <div class="text-xs text-gray-500 uppercase tracking-wider px-4 mb-2">Manajemen User</div>
                
                <!-- Data Dokter -->
                <a href="{{ route('admin.dokter.index') }}" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dokter*') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    <i class="fas fa-user-md w-5 text-lg"></i>
                    <span>Data Dokter</span>
                    @if(request()->routeIs('admin.dokter*'))
                        <i class="fas fa-chevron-right ml-auto text-xs"></i>
                    @endif
                </a>
                
                <!-- Data Pasien -->
                <a href="{{ route('admin.pasien.index') }}" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.pasien*') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    <i class="fas fa-users w-5 text-lg"></i>
                    <span>Data Pasien</span>
                    @if(request()->routeIs('admin.pasien*'))
                        <i class="fas fa-chevron-right ml-auto text-xs"></i>
                    @endif
                </a>
                
                <!-- Divider -->
                <div class="border-t border-gray-800 my-4"></div>
                
                <!-- Manajemen Klinik -->
                <div class="text-xs text-gray-500 uppercase tracking-wider px-4 mb-2">Manajemen Klinik</div>
                
                <!-- Jadwal Konsultasi -->
                <a href="{{ route('admin.jadwal.index') }}" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.jadwal*') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    <i class="fas fa-calendar-alt w-5 text-lg"></i>
                    <span>Jadwal Konsultasi</span>
                    @if(request()->routeIs('admin.jadwal*'))
                        <i class="fas fa-chevron-right ml-auto text-xs"></i>
                    @endif
                </a>
                
                <!-- Reservasi -->
                <a href="{{ route('admin.reservasi.index') }}" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.reservasi*') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    <i class="fas fa-calendar-check w-5 text-lg"></i>
                    <span>Reservasi</span>
                    @if(request()->routeIs('admin.reservasi*'))
                        <i class="fas fa-chevron-right ml-auto text-xs"></i>
                    @endif
                </a>
                
                <!-- Divider -->
                <div class="border-t border-gray-800 my-4"></div>
                
                <!-- Pengaturan -->
                <div class="text-xs text-gray-500 uppercase tracking-wider px-4 mb-2">Pengaturan</div>
                
                <!-- Profile Admin -->
                <a href="{{ route('admin.profile') }}" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.profile') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    <i class="fas fa-user-circle w-5 text-lg"></i>
                    <span>Profile Admin</span>
                    @if(request()->routeIs('admin.profile'))
                        <i class="fas fa-chevron-right ml-auto text-xs"></i>
                    @endif
                </a>
                
                <!-- Pengaturan Sistem -->
                <a href="{{ route('admin.settings') }}" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.settings') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    <i class="fas fa-cog w-5 text-lg"></i>
                    <span>Pengaturan</span>
                    @if(request()->routeIs('admin.settings'))
                        <i class="fas fa-chevron-right ml-auto text-xs"></i>
                    @endif
                </a>
            </nav>
        </div>
        
        <!-- Footer Sidebar (Logout) -->
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
    
    <!-- Navbar Atas -->
    <div class="main-content">
        <nav class="bg-white shadow-md sticky top-0 z-30">
            <div class="px-6 py-4">
                <div class="flex justify-between items-center">
                    <!-- Mobile Menu Button -->
                    <button id="menuToggle" class="lg:hidden text-gray-600 hover:text-gray-900 focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                    
                    <!-- Breadcrumb -->
                    <div class="hidden md:flex items-center space-x-2 text-sm text-gray-500">
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                        <i class="fas fa-chevron-right text-xs"></i>
                        <span class="text-gray-700">@yield('page-title', 'Dashboard')</span>
                    </div>
                    
                    <!-- Page Title Mobile -->
                    <div class="flex items-center space-x-4 md:hidden">
                        <i class="fas fa-chart-line text-blue-500 text-xl"></i>
                        <h1 class="text-xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h1>
                    </div>
                    
                    <!-- Right Side -->
                    <div class="flex items-center space-x-4">
                        <!-- Notification Bell -->
                        <div class="relative">
                            <button id="notificationBtn" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                                <i class="fas fa-bell text-xl"></i>
                                <span class="absolute -top-1 -right-2 bg-red-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">3</span>
                            </button>
                            
                            <!-- Notification Dropdown -->
                            <div id="notificationMenu" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg py-2 z-50">
                                <div class="px-4 py-2 border-b">
                                    <h3 class="font-semibold">Notifikasi</h3>
                                </div>
                                <div class="max-h-96 overflow-y-auto">
                                    <a href="#" class="block px-4 py-3 hover:bg-gray-50 border-b">
                                        <p class="text-sm font-medium">Dokter baru mendaftar</p>
                                        <p class="text-xs text-gray-500">dr. Budi Santoso menunggu verifikasi</p>
                                        <span class="text-xs text-gray-400">5 menit lalu</span>
                                    </a>
                                    <a href="#" class="block px-4 py-3 hover:bg-gray-50 border-b">
                                        <p class="text-sm font-medium">Reservasi baru</p>
                                        <p class="text-xs text-gray-500">Pasien Ahmad Sudrajat membuat reservasi</p>
                                        <span class="text-xs text-gray-400">1 jam lalu</span>
                                    </a>
                                </div>
                                <div class="px-4 py-2 border-t">
                                    <a href="#" class="text-sm text-blue-500 hover:text-blue-600">Lihat semua notifikasi</a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Profile Dropdown -->
                        <div class="relative">
                            <button id="profileDropdown" class="flex items-center space-x-2 focus:outline-none">
                                <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white">
                                    <i class="fas fa-user text-sm"></i>
                                </div>
                                <span class="text-gray-700 hidden md:inline">Admin</span>
                                <i class="fas fa-chevron-down text-gray-500 text-xs hidden md:inline"></i>
                            </button>
                            
                            <!-- Dropdown Menu -->
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
            </div>
        </nav>
        
        <!-- Main Content -->
        <main class="p-6">
            <!-- Success Alert -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-green-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif
            
            <!-- Error Alert -->
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-red-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif
            
            <!-- Warning Alert -->
            @if(session('warning'))
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded-lg mb-4 flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <span>{{ session('warning') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-yellow-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif
            
            <!-- Info Alert -->
            @if(session('info'))
                <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded-lg mb-4 flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-info-circle mr-2"></i>
                        <span>{{ session('info') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-blue-700">
                        <i class="fas fa-times"></i>
                    </button>
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
            
            // Close dropdown when clicking outside
            document.addEventListener('click', (event) => {
                if (!profileBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        }
        
        // Notification dropdown
        const notificationBtn = document.getElementById('notificationBtn');
        const notificationMenu = document.getElementById('notificationMenu');
        
        if (notificationBtn) {
            notificationBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                notificationMenu.classList.toggle('hidden');
            });
            
            document.addEventListener('click', (event) => {
                if (notificationBtn && !notificationBtn.contains(event.target) && notificationMenu && !notificationMenu.contains(event.target)) {
                    notificationMenu.classList.add('hidden');
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
        
        // Auto close alerts after 5 seconds
        const alerts = document.querySelectorAll('.bg-green-100, .bg-red-100, .bg-yellow-100, .bg-blue-100');
        alerts.forEach(alert => {
            setTimeout(() => {
                if (alert) {
                    alert.style.opacity = '0';
                    alert.style.transition = 'opacity 0.5s ease';
                    setTimeout(() => {
                        if (alert) alert.remove();
                    }, 500);
                }
            }, 5000);
        });
        
        // Active menu state based on current URL
        const currentUrl = window.location.pathname;
        const menuLinks = document.querySelectorAll('.sidebar a');
        menuLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (href && currentUrl.includes(href) && href !== '/admin/dashboard') {
                link.classList.add('bg-blue-600', 'text-white', 'shadow-lg');
                const chevron = link.querySelector('.fa-chevron-right');
                if (chevron) chevron.classList.remove('hidden');
            }
        });
    </script>
</body>
</html>