@extends('supervisor.sidebar')

@section('sidebar-content')

<body class="bg-gradient-to-br from-slate-50 to-slate-100 p-6 min-h-screen">

    <div class="max-w-7xl mx-auto">

        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-slate-800 flex items-center gap-3">
                <span class="bg-indigo-600 w-2 h-10 rounded-full"></span>
                Supervisor Dashboard
            </h1>
            <div class="flex items-center gap-2 bg-white px-4 py-2 rounded-lg shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="text-sm font-medium text-slate-700">{{ date('F d, Y') }}</span>
            </div>
        </div>

        <!-- Metrics Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Created tickets -->
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden group">
                <div class="h-2 bg-blue-500 group-hover:h-3 transition-all duration-300"></div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-medium text-slate-500">Created Tickets</h3>
                        <div class="p-2 bg-blue-50 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-slate-800">{{ $createdTicketsCount }}</p>
                    <p class="text-xs font-medium text-slate-400 mt-2">Total tickets in system</p>
                </div>
            </div>

            <!-- Open tickets -->
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden group">
                <div class="h-2 bg-amber-500 group-hover:h-3 transition-all duration-300"></div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-medium text-slate-500">Open Tickets</h3>
                        <div class="p-2 bg-amber-50 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-slate-800">{{ $openTickets }}</p>
                    <p class="text-xs font-medium text-slate-400 mt-2">Tickets needing attention</p>
                </div>
            </div>

            <!-- Resolved tickets -->
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden group">
                <div class="h-2 bg-emerald-500 group-hover:h-3 transition-all duration-300"></div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-medium text-slate-500">Resolved Tickets</h3>
                        <div class="p-2 bg-emerald-50 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-slate-800">{{ $resolvedTickets }}</p>
                    <p class="text-xs font-medium text-slate-400 mt-2">Successfully addressed</p>
                </div>
            </div>

            <!-- Closed tickets -->
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden group">
                <div class="h-2 bg-violet-500 group-hover:h-3 transition-all duration-300"></div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-medium text-slate-500">Closed Tickets</h3>
                        <div class="p-2 bg-violet-50 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-violet-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-slate-800">{{ $closedTickets }}</p>
                    <p class="text-xs font-medium text-slate-400 mt-2">Completed and archived</p>
                </div>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="bg-white rounded-xl shadow-sm p-8 mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                <h3 class="text-xl font-bold text-slate-800 mb-2 sm:mb-0">Created Tickets This Year</h3>
                <div class="flex space-x-2">
                    <span class="bg-indigo-100 text-indigo-600 px-4 py-1.5 rounded-full text-sm font-medium">
                        Year to Date
                    </span>
                    <span class="bg-slate-100 text-slate-600 px-4 py-1.5 rounded-full text-sm font-medium">
                        {{ date('Y') }}
                    </span>
                </div>
            </div>
            
            <div class="h-96">
                <canvas id="ticketsChart"></canvas>
            </div>
        </div>

    </div>

    <script>
        // Chart data for the tickets created throughout the year
        const ctx = document.getElementById('ticketsChart').getContext('2d');
        
        // Create gradient for chart background
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(79, 70, 229, 0.45)');  // Indigo with opacity
        gradient.addColorStop(1, 'rgba(79, 70, 229, 0.0)');   // Transparent at bottom
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                    label: 'Created Tickets',
                    data: @json(array_values($monthlyTickets)),
                    fill: true,
                    backgroundColor: gradient,
                    borderColor: 'rgb(79, 70, 229)',  // Indigo
                    borderWidth: 3,
                    tension: 0.4,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: 'rgb(79, 70, 229)',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    pointHoverBackgroundColor: 'rgb(79, 70, 229)',
                    pointHoverBorderColor: '#ffffff',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(15, 23, 42, 0.8)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        padding: 12,
                        cornerRadius: 8,
                        titleFont: {
                            size: 14,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 14
                        },
                        displayColors: false,
                        callbacks: {
                            title: function(context) {
                                return context[0].label;
                            },
                            label: function(context) {
                                return 'Tickets: ' + context.raw;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false,
                        },
                        ticks: {
                            stepSize: 5,
                            font: {
                                size: 12
                            },
                            padding: 10,
                            color: '#64748b'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 12
                            },
                            padding: 10,
                            color: '#64748b'
                        }
                    }
                },
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'index',
                    intersect: false
                }
            }
        });
    </script>

</body>

@endsection