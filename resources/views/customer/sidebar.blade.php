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
            }

            /* Gradient background for sidebar */
            .sidebar-gradient {
                background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            }

            /* Hover effect for sidebar items */
            .sidebar-item:hover {
                background-color: #334155;
                transform: translateX(5px);
                transition: all 0.3s ease;
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
        </script>

    </head>

    <body class="bg-gray-100">

        <!-- Mobile menu overlay -->
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 lg:hidden hidden z-20" onclick="toggleMobileMenu()">
        </div>

        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 w-64 sidebar-gradient transform -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out z-30">

            <!-- User Profile Section -->
            <div class="p-6 bg-slate-900">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-slate-700 overflow-hidden">
                        <!-- Display Profile Picture from Session -->
                        <img src="{{ session('user')->profile_picture ? asset('storage/' . session('user')->profile_picture) : asset('default.png') }}"
                            alt="Profile" class="w-full h-full object-cover">
                    </div>

                    <div>
                        <!-- Display User Name from Session -->
                        <h2 class="text-white font-semibold">Welcome, {{ session('user')->name ?? 'Guest' }}</h2>
                        <p class="text-sm text-slate-400">Customer</p>
                    </div>
                </div>
            </div>



            <!-- Navigation Header -->
            <div class="bg-emerald-500 py-2 px-6">
                <span class="text-white font-medium">HelpHive</span>
            </div>

            <!-- Navigation Items -->
            <nav class="p-4 sidebar-scroll overflow-y-auto h-[calc(100vh-200px)]">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('customer.dashboard') }}"
                            class="sidebar-item flex items-center gap-4 px-4 py-2 text-slate-300 hover:bg-slate-700 rounded-md group"
                            onclick="selectItem(event)">
                            <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('customer.profile') }}"
                            class="sidebar-item flex items-center gap-4 px-4 py-2 text-slate-300 hover:bg-slate-700 rounded-md"
                            onclick="selectItem(event)">
                            <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('customer.tickets') }}"
                            class="sidebar-item flex items-center gap-4 px-4 py-2 text-slate-300 hover:bg-slate-700 rounded-md"
                            onclick="selectItem(event)">
                            <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                </path>
                            </svg>
                            <span>Tickets</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}"
                            class="sidebar-item flex items-center gap-4 px-4 py-2 text-slate-300 hover:bg-slate-700 rounded-md"
                            onclick="selectItem(event)">
                            <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>

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
                                class="w-full pl-10 pr-4 py-2 border rounded-md focus:outline-none focus:border-emerald-500">
                        </div>
                    </div>

                    <!-- Right side icons -->
                    <div class="flex items-center gap-4">
                        <span class="hidden lg:block text-sm text-gray-600">Welcome to NavAdmin Sidebar Navigation</span>

                        <a href="#" class="relative p-2 hover:bg-gray-100 rounded-full">
                            <span
                                class="absolute top-0 right-0 h-4 w-4 bg-red-500 text-xs text-white rounded-full flex items-center justify-center">12</span>
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                </path>
                            </svg>
                        </a>

                        <a href="#" class="relative p-2 hover:bg-gray-100 rounded-full">
                            <span
                                class="absolute top-0 right-0 h-4 w-4 bg-red-500 text-xs text-white rounded-full flex items-center justify-center">8</span>
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </a>

                        <a href="#" class="p-2 hover:bg-gray-100 rounded-full">
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
