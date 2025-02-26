@extends('customer.sidebar')

@section('sidebar-content')

<body class="bg-gradient-to-br from-blue-50 to-purple-50 p-6">

    <div class="max-w-7xl mx-auto">

        <!-- Glassmorphism Card -->
        <div class="bg-white/80 backdrop-blur-lg p-8 rounded-2xl shadow-2xl transform transition-all duration-300 hover:shadow-3xl border border-white/20">

            <!-- Profile Header -->
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                    Profile
                </h1>
                <a href="{{ route('customer.dashboard') }}" class="bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white px-5 py-2.5 rounded-lg text-sm font-semibold transition-all duration-300 transform hover:scale-105 shadow-md">
                    Back to Dashboard
                </a>
            </div>

            <!-- Profile Info -->
            <div class="flex items-center space-x-8">
                <!-- Profile Image (Circular with Gradient Border) -->
                <div class="w-32 h-32 rounded-full overflow-hidden p-1 bg-gradient-to-r from-blue-500 to-purple-500 shadow-lg">
                    <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : 'https://via.placeholder.com/150' }}" alt="Profile Picture" class="w-full h-full object-cover rounded-full border-4 border-white">
                </div>

                <!-- User Info -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                    <p class="text-sm text-gray-500">Customer since: {{ $user->created_at->format('F j, Y') }}</p>
                </div>
            </div>

            <!-- Contact Information Section -->
            <div class="mt-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                    Contact Information
                </h3>
                <div class="space-y-4">
                    <!-- Phone -->
                    <div class="flex justify-between items-center p-4 bg-white/90 backdrop-blur-sm rounded-xl hover:bg-white transition-all duration-300 shadow-sm hover:shadow-md">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span class="text-sm font-medium text-gray-600">Phone:</span>
                        </div>
                        <span class="text-sm text-gray-800">{{ $user->mobile_number ?? 'Not provided' }}</span>
                    </div>

                    <!-- Address -->
                    <div class="flex justify-between items-center p-4 bg-white/90 backdrop-blur-sm rounded-xl hover:bg-white transition-all duration-300 shadow-sm hover:shadow-md">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-sm font-medium text-gray-600">Address:</span>
                        </div>
                        <span class="text-sm text-gray-800">{{ $user->address ?? 'Not provided' }}</span>
                    </div>

                    <!-- Gender -->
                    <div class="flex justify-between items-center p-4 bg-white/90 backdrop-blur-sm rounded-xl hover:bg-white transition-all duration-300 shadow-sm hover:shadow-md">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="text-sm font-medium text-gray-600">Gender:</span>
                        </div>
                        <span class="text-sm text-gray-800">{{ $user->gender ?? 'Not provided' }}</span>
                    </div>

                    <!-- Date of Birth -->
                    <div class="flex justify-between items-center p-4 bg-white/90 backdrop-blur-sm rounded-xl hover:bg-white transition-all duration-300 shadow-sm hover:shadow-md">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-sm font-medium text-gray-600">Date of Birth:</span>
                        </div>
                        <span class="text-sm text-gray-800">{{ $user->dob ? \Carbon\Carbon::parse($user->dob)->format('F j, Y') : 'Not provided' }}</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex space-x-4">
                <a href="{{ route('customer.profile.edit') }}" class="bg-gradient-to-r from-green-500 to-teal-500 hover:from-green-600 hover:to-teal-600 text-white px-5 py-2.5 rounded-lg text-sm font-semibold transition-all duration-300 transform hover:scale-105 shadow-md">
                    Edit Profile
                </a>
            </div>

        </div>

    </div>

</body>

@endsection