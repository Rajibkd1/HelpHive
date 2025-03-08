@extends('layouts.app')
@section('content')

    <head>
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }

            @media (min-width: 1024px) {
                .lg\:pl-64 {
                    padding-left: 16rem;
                }
            }

            /* Custom scrollbar for sidebar */
            .sidebar-scroll::-webkit-scrollbar {
                width: 4px;
            }

            .sidebar-scroll::-webkit-scrollbar-track {
                background: #1e293b;
            }

            .sidebar-scroll::-webkit-scrollbar-thumb {
                background: #475569;
                border-radius: 2px;
            }

            /* Style for selected item */
            .selected {
                background-color: #475569;
                border-left: 3px solid #10b981;
            }

            /* Gradient background for sidebar */
            .sidebar-gradient {
                background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            }

            /* Hover effect for sidebar items */
            .sidebar-item {
                position: relative;
                overflow: hidden;
                transition: all 0.3s ease;
            }

            .sidebar-item:hover {
                background-color: #334155;
                transform: translateX(5px);
            }

            .sidebar-item:hover::after {
                content: '';
                position: absolute;
                left: 0;
                top: 0;
                height: 100%;
                width: 3px;
                background-color: #10b981;
            }

            /* Logo animation */
            .logo-container {
                transition: all 0.3s ease;
            }

            .logo-container:hover {
                transform: scale(1.05);
            }

            /* Glow effect for active menu */
            .sidebar-item.selected {
                box-shadow: 0 0 8px rgba(16, 185, 129, 0.3);
            }

            /* Pulse animation for notification badges */
            @keyframes pulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.1); }
                100% { transform: scale(1); }
            }
            
            .notification-badge {
                animation: pulse 2s infinite;
            }
        </style>

        <script>
            // Simple toggle function for mobile menu
            function toggleMobileMenu() {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('overlay');
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            }

            // Function to select an item
            function selectItem(event) {
                // Get all items
                const items = document.querySelectorAll('.sidebar-item');
                // Remove the 'selected' class from all items
                items.forEach(item => item.classList.remove('selected'));
                // Add the 'selected' class to the clicked item
                event.currentTarget.classList.add('selected');
            }

            // Add ripple effect to sidebar items
            document.addEventListener('DOMContentLoaded', function() {
                const sidebarItems = document.querySelectorAll('.sidebar-item');
                
                sidebarItems.forEach(item => {
                    item.addEventListener('click', function(e) {
                        const rect = item.getBoundingClientRect();
                        const x = e.clientX - rect.left;
                        const y = e.clientY - rect.top;
                        
                        const ripple = document.createElement('span');
                        ripple.classList.add('ripple-effect');
                        ripple.style.left = `${x}px`;
                        ripple.style.top = `${y}px`;
                        
                        item.appendChild(ripple);
                        
                        setTimeout(() => {
                            ripple.remove();
                        }, 600);
                    });
                });
            });
        </script>

    </head>

    <body class="bg-gray-100">

        <!-- Mobile menu overlay -->
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 lg:hidden hidden z-20" onclick="toggleMobileMenu()">
        </div>

        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 w-64 sidebar-gradient transform -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out z-30">

            <!-- Logo Section -->
            <div class="logo-container p-4 flex justify-center items-center bg-slate-900">
                <!-- HelpHive Logo -->
                <div class="flex items-center gap-2">
                    <svg class="w-10 h-10" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M25 2C12.85 2 3 11.85 3 24C3 36.15 12.85 46 25 46C37.15 46 47 36.15 47 24C47 11.85 37.15 2 25 2Z" fill="#0F172A" stroke="#10B981" stroke-width="2"/>
                        <path d="M34 16L25 23L16 16L13 24L25 32L37 24L34 16Z" fill="#10B981"/>
                        <path d="M25 32V40" stroke="#10B981" stroke-width="2" stroke-linecap="round"/>
                        <path d="M20 35L25 40L30 35" fill="none" stroke="#10B981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="25" cy="15" r="3" fill="#F59E0B"/>
                    </svg>
                    <div>
                        <h1 class="text-white text-xl font-bold">HelpHive</h1>
                        <p class="text-emerald-400 text-xs">Support System</p>
                    </div>
                </div>
            </div>

            <!-- User Profile Section -->
            <div class="p-6 bg-slate-800 border-b border-slate-700">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-slate-700 overflow-hidden border-2 border-emerald-500">
                        <!-- Display Profile Picture from Session -->
                        <img src="{{ session('user')->profile_picture ? asset('storage/' . session('user')->profile_picture) : asset('default.png') }}"
                            alt="Profile" class="w-full h-full object-cover">
                    </div>

                    <div>
                        <!-- Display User Name from Session -->
                        <h2 class="text-white font-semibold">{{ session('user')->name ?? 'Guest' }}</h2>
                        <div class="flex items-center gap-1">
                            <span class="inline-block w-2 h-2 bg-emerald-500 rounded-full"></span>
                            <p class="text-sm text-emerald-400">Customer</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Items -->
            <nav class="p-4 sidebar-scroll overflow-y-auto h-[calc(100vh-200px)]">
                <div class="text-slate-400 text-xs uppercase font-semibold mb-2 pl-4">Main Menu</div>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('customer.dashboard') }}"
                            class="sidebar-item flex items-center gap-4 px-4 py-3 text-slate-300 hover:bg-slate-700 rounded-md group transition-all duration-200"
                            onclick="selectItem(event)">
                            <svg class="w-6 h-6 text-emerald-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('customer.profile') }}"
                            class="sidebar-item flex items-center gap-4 px-4 py-3 text-slate-300 hover:bg-slate-700 rounded-md group transition-all duration-200"
                            onclick="selectItem(event)">
                            <svg class="w-6 h-6 text-emerald-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('customer.tickets') }}"
                            class="sidebar-item flex items-center gap-4 px-4 py-3 text-slate-300 hover:bg-slate-700 rounded-md group transition-all duration-200"
                            onclick="selectItem(event)">
                            <svg class="w-6 h-6 text-emerald-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                </path>
                            </svg>
                            <span>Tickets</span>
                        </a>
                    </li>
                    
                    <div class="my-4 border-t border-slate-700"></div>
                    
                    <div class="text-slate-400 text-xs uppercase font-semibold mb-2 pl-4">Settings & Help</div>
                    
                    <li>
                        <a href="#"
                            class="sidebar-item flex items-center gap-4 px-4 py-3 text-slate-300 hover:bg-slate-700 rounded-md group transition-all duration-200"
                            onclick="selectItem(event)">
                            <svg class="w-6 h-6 text-emerald-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Settings</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="#"
                            class="sidebar-item flex items-center gap-4 px-4 py-3 text-slate-300 hover:bg-slate-700 rounded-md group transition-all duration-200"
                            onclick="selectItem(event)">
                            <svg class="w-6 h-6 text-emerald-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Help Center</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="{{ route('logout') }}"
                            class="sidebar-item flex items-center gap-4 px-4 py-3 text-slate-300 hover:bg-red-700 rounded-md group transition-all duration-200"
                            onclick="selectItem(event)">
                            <svg class="w-6 h-6 text-red-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
            
            <!-- Sidebar Footer -->
            <div class="absolute bottom-0 w-full p-4 bg-slate-900 border-t border-slate-700">
                <div class="flex items-center justify-between">
                    <div class="text-xs text-slate-400">&copy; 2025 HelpHive</div>
                    <div class="flex space-x-2">
                        <a href="#" class="text-slate-400 hover:text-emerald-400 transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path>
                            </svg>
                        </a>
                        <a href="#" class="text-slate-400 hover:text-emerald-400 transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

        </aside>

        <!-- Main Content -->
        <div class="lg:pl-64 min-h-screen">
            <!-- Header -->
            <header class="bg-white border-b h-16 fixed top-0 right-0 left-0 lg:left-64 z-10">
                <div class="flex items-center justify-between h-full px-4">
                    <!-- Mobile menu button -->
                    <button onclick="toggleMobileMenu()" class="lg:hidden p-2 rounded-md hover:bg-gray-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <!-- Search -->
                    <div class="flex-1 max-w-md ml-4">
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </span>
                            <input type="search" placeholder="Search for something..."
                                class="w-full pl-10 pr-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                        </div>
                    </div>

                    <!-- Right side icons -->
                    <div class="flex items-center gap-4">
                        <span class="hidden lg:block text-sm text-gray-600">Welcome to HelpHive Support System</span>

                        <a href="#" class="relative p-2 hover:bg-gray-100 rounded-full transition-all">
                            <span
                                class="notification-badge absolute top-0 right-0 h-4 w-4 bg-red-500 text-xs text-white rounded-full flex items-center justify-center">12</span>
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                </path>
                            </svg>
                        </a>

                        <a href="#" class="relative p-2 hover:bg-gray-100 rounded-full transition-all">
                            <span
                                class="notification-badge absolute top-0 right-0 h-4 w-4 bg-red-500 text-xs text-white rounded-full flex items-center justify-center">8</span>
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </a>

                        <a href="#" class="p-2 hover:bg-gray-100 rounded-full transition-all">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                        </a>
                    </div>

                </div>
            </header>

            <!-- Main Content -->
            <main class="pt-16 p-6 mt-48">
                @yield('sidebar-content')
            </main>

        </div>

    </body>
@endsection