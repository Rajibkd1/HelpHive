@extends('layouts.app')

@section('content')
<body class="bg-gradient-to-br from-indigo-200 via-purple-100 to-sky-100 font-sans min-h-screen overflow-x-hidden">
    <!-- Animated Honeycomb Background -->
    <div class="fixed inset-0 opacity-10 z-0">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4NiIgaGVpZ2h0PSI0OCIgdmlld0JveD0iMCAwIDg2IDQ4Ij48cGF0aCBmaWxsPSIjMzMzIiBmaWxsLW9wYWNpdHk9Ii4xNSIgZD0iTTAgNDRoMTR2NEgwem0yMC0yMGgxNnYxNkgyMHptMTggMjBoMTZ2NEgzOHptMC0zNmgxNnYxNkgzOHptMzYgMTZoMTZ2MTZINzR6TTAgMTRoMTR2MTRIMFR6Ii8+PC9zdmc+'); background-position: 0 0; background-size: 100px 100px;"></div>
    </div>
    
    <!-- Floating Hexagons Background -->
    <div class="fixed inset-0 z-0 overflow-hidden">
        <div id="hexagon-container" class="absolute inset-0"></div>
    </div>

    <!-- Main Content Container -->
    <div class="relative z-10 flex flex-col items-center justify-center min-h-screen p-4">
        <!-- Logo and Main Content -->
        <div class="w-full max-w-4xl bg-white/90 backdrop-blur-md rounded-3xl shadow-2xl overflow-hidden transform transition-all duration-700 hover:shadow-amber-200/50">
            <!-- Header with Hexagon Pattern -->
            <div class="relative bg-gradient-to-r from-amber-500 to-amber-600 text-white p-10 md:p-14 overflow-hidden">
                <!-- Animated Hexagon Pattern Background -->
                <div class="absolute top-0 right-0 w-full h-full overflow-hidden opacity-20">
                    <div class="honeycomb-pattern absolute inset-0"></div>
                </div>

                <!-- Logo and Title -->
                <div class="relative flex flex-col md:flex-row md:items-center mb-8 animate-fade-in-down">
                    <div class="flex items-center">
                        <div class="mr-6 bg-white text-amber-500 rounded-2xl p-3 shadow-lg transform transition-transform duration-500 hover:rotate-12">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </div>
                        <h1 class="text-4xl md:text-6xl font-bold tracking-tight drop-shadow-md">HelpHive</h1>
                    </div>
                    
                    <!-- Animated Buzz Line -->
                    <div class="hidden md:block md:ml-4 p-2 bg-amber-400/30 rounded-lg backdrop-blur-sm">
                        <div class="buzz-line"></div>
                    </div>
                </div>

                <!-- Tagline -->
                <p class="text-xl md:text-2xl opacity-90 max-w-2xl font-light leading-relaxed animate-fade-in">
                    Your customer support solution that <span class="font-semibold">transforms problems into solutions</span> with speed and precision.
                </p>
                
                <!-- Subtle Divider -->
                <div class="w-24 h-1 bg-white/30 rounded-full mt-6 mb-3"></div>
                
                <!-- Quick Stats -->
                <div class="flex flex-wrap gap-6 text-amber-50 animate-fade-in">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-sm font-medium">Average response: <strong>2 minutes</strong></span>
                    </div>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                        </svg>
                        <span class="text-sm font-medium">Customer satisfaction: <strong>98%</strong></span>
                    </div>
                </div>
            </div>

            <!-- Feature Highlights -->
            <div class="p-8 md:p-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                    <div class="feature-card group" id="feature1">
                        <div class="bg-indigo-100 text-indigo-600 p-4 rounded-xl inline-flex mb-2 transform transition-transform group-hover:scale-110 group-hover:rotate-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-semibold mt-4 text-gray-800">Lightning Fast</h3>
                        <div class="w-12 h-1 bg-indigo-500/50 rounded-full my-3"></div>
                        <p class="text-gray-600 mt-2 leading-relaxed">Get answers to your questions within minutes with our dedicated rapid-response support team.</p>
                    </div>

                    <div class="feature-card group" id="feature2">
                        <div class="bg-emerald-100 text-emerald-600 p-4 rounded-xl inline-flex mb-2 transform transition-transform group-hover:scale-110 group-hover:rotate-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-semibold mt-4 text-gray-800">Bank-Level Security</h3>
                        <div class="w-12 h-1 bg-emerald-500/50 rounded-full my-3"></div>
                        <p class="text-gray-600 mt-2 leading-relaxed">Your sensitive information is protected with our enterprise-grade security systems and encryption.</p>
                    </div>

                    <div class="feature-card group" id="feature3">
                        <div class="bg-rose-100 text-rose-600 p-4 rounded-xl inline-flex mb-2 transform transition-transform group-hover:scale-110 group-hover:rotate-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-semibold mt-4 text-gray-800">AI-Powered Solutions</h3>
                        <div class="w-12 h-1 bg-rose-500/50 rounded-full my-3"></div>
                        <p class="text-gray-600 mt-2 leading-relaxed">Our intelligent system provides customized solutions tailored to your specific needs and requirements.</p>
                    </div>
                </div>

                <!-- Testimonial -->
                <div class="bg-indigo-50 rounded-2xl p-6 md:p-8 mb-8 relative overflow-hidden animate-fade-in">
                    <div class="absolute top-0 right-0 w-32 h-32 -mt-8 -mr-8 text-indigo-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                        </svg>
                    </div>
                    <div class="relative z-10">
                        <p class="text-lg italic text-gray-700 mb-4">HelpHive transformed our customer support experience. Their response time is incredible, and the solutions are always spot-on!</p>
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-indigo-500 rounded-full flex items-center justify-center text-white font-bold">JD</div>
                            <div class="ml-3">
                                <p class="font-medium text-gray-800">Jane Doe</p>
                                <p class="text-sm text-gray-500">CEO, TechCorp</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Call to Action -->
                <div class="text-center">
                    <div class="relative inline-block group">
                        <div class="absolute -inset-1 bg-gradient-to-r from-amber-400 via-amber-500 to-amber-600 rounded-lg blur opacity-70 group-hover:opacity-100 animate-pulse transition duration-1000 group-hover:duration-200"></div>
                        <button id="redirect-button" class="relative px-10 py-5 bg-gradient-to-br from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-bold text-lg md:text-xl rounded-lg shadow-xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-opacity-50">
                            <div class="flex items-center justify-center">
                                <span>Let's Get Buzzing</span>
                                <span id="countdown" class="ml-3 inline-flex items-center justify-center w-8 h-8 bg-white text-amber-600 rounded-full text-md font-bold">3</span>
                            </div>
                        </button>
                    </div>
                    
                    <!-- Additional Info Text -->
                    <p class="text-gray-500 mt-4 animate-fade-in">Instant setup • No credit card required • Free trial available</p>
                </div>
            </div>
        </div>

        <!-- Trust Badges -->
        <div class="w-full max-w-4xl mt-8 mb-4 flex justify-center space-x-8 opacity-70">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                <span class="ml-2 text-sm text-gray-600">SSL Secured</span>
            </div>
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                <span class="ml-2 text-sm text-gray-600">GDPR Compliant</span>
            </div>
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="ml-2 text-sm text-gray-600">24/7 Support</span>
            </div>
        </div>

        <!-- Footer -->
        <div class="w-full max-w-4xl text-center mt-4 mb-8 text-gray-500 animate-fade-in">
            <p>&copy; 2025 HelpHive - Transforming Customer Support Worldwide</p>
        </div>
    </div>

    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 10px 25px -5px rgba(251, 191, 36, 0.4);
            }
            50% {
                transform: scale(1.03);
                box-shadow: 0 15px 35px -5px rgba(251, 191, 36, 0.6);
            }
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-20px);
            }
        }
        
        @keyframes spin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }
        
        @keyframes wiggle {
            0%, 100% {
                transform: rotate(-3deg);
            }
            50% {
                transform: rotate(3deg);
            }
        }
        
        .animate-fade-in {
            animation: fadeIn 1s ease-out forwards;
        }
        
        .animate-fade-in-down {
            animation: fadeInUp 1s ease-out backwards;
        }
        
        .honeycomb-pattern {
            background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1NiIgaGVpZ2h0PSIxMDAiPjxwYXRoIGQ9Ik0yOCAwTDAgMTZ2MjJsMjggMTYgMjgtMTZWMTZ6IiBvcGFjaXR5PSIuOCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjZmZmIi8+PHBhdGggZD0iTTI4IDU4TDAgNzR2MjJsMjggMTYgMjgtMTZWNzR6IiBvcGFjaXR5PSIuNSIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjZmZmIi8+PC9zdmc+');
            background-size: 56px 100px;
            animation: float 15s ease-in-out infinite;
        }
        
        .buzz-line {
            height: 2px;
            width: 60px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.8), transparent);
            animation: wiggle 2s ease-in-out infinite;
        }
        
        .feature-card {
            animation: fadeInUp 0.8s ease-out both;
            @apply p-8 bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-500 transform hover:-translate-y-2;
        }

        #feature1 { animation-delay: 0.3s; }
        #feature2 { animation-delay: 0.6s; }
        #feature3 { animation-delay: 0.9s; }

        #redirect-button {
            animation: pulse 3s infinite;
        }
        
        /* Floating Hexagons */
        .hexagon {
            position: absolute;
            width: 100px;
            height: 110px;
            background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
            clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
            animation-name: float;
            animation-timing-function: ease-in-out;
            animation-iteration-count: infinite;
            opacity: 0.5;
        }
    </style>

    <script>
        // Countdown and redirect
        document.addEventListener('DOMContentLoaded', function() {
            let count = 4;
            const countdownElement = document.getElementById('countdown');
            const redirectButton = document.getElementById('redirect-button');
            
            const countdown = setInterval(function() {
                count--;
                countdownElement.textContent = count;
                
                if (count <= 0) {
                    clearInterval(countdown);
                    window.location.href = "{{ route('auth') }}";
                }
            }, 1000);
            
            // Allow user to skip waiting and go directly to auth page
            redirectButton.addEventListener('click', function() {
                window.location.href = "{{ route('auth') }}";
            });
            
            // Create floating hexagons for background
            const hexContainer = document.getElementById('hexagon-container');
            const hexColors = ['rgba(251, 191, 36, 0.1)', 'rgba(79, 70, 229, 0.1)', 'rgba(16, 185, 129, 0.1)', 'rgba(239, 68, 68, 0.1)'];
            
            for (let i = 0; i < 12; i++) {
                const hex = document.createElement('div');
                hex.classList.add('hexagon');
                
                // Random position
                const topPos = Math.random() * 100;
                const leftPos = Math.random() * 100;
                hex.style.top = `${topPos}%`;
                hex.style.left = `${leftPos}%`;
                
                // Random size
                const size = 30 + Math.random() * 80;
                hex.style.width = `${size}px`;
                hex.style.height = `${size * 1.1}px`;
                
                // Random color
                const colorIndex = Math.floor(Math.random() * hexColors.length);
                hex.style.background = hexColors[colorIndex];
                
                // Random animation duration
                const animDuration = 10 + Math.random() * 20;
                hex.style.animationDuration = `${animDuration}s`;
                
                // Random delay
                const delay = Math.random() * 10;
                hex.style.animationDelay = `${delay}s`;
                
                hexContainer.appendChild(hex);
            }
        });
    </script>
</body>
@endsection