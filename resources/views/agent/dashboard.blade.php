@extends('agent.sidebar')

@section('sidebar-content')

<body class="bg-gray-50 p-6">

    <div class="max-w-7xl mx-auto">
        <h1 class="text-2xl font-semibold text-gray-900 mb-6">Agent Dashboard</h1>

        <!-- Metrics Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <!-- Created tickets -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Created tickets</h3>
                <p class="text-3xl font-semibold text-gray-900">{{ $createdTicketsCount }}</p>
            </div>

            <!-- Open tickets -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Open tickets</h3>
                <p class="text-3xl font-semibold text-gray-900">{{ $openTickets }}</p>
            </div>

            <!-- Resolved tickets -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Resolved tickets</h3>
                <p class="text-3xl font-semibold text-gray-900">{{ $resolvedTickets }}</p>
            </div>

            <!-- Closed tickets -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Closed tickets</h3>
                <p class="text-3xl font-semibold text-gray-900">{{ $closedTickets }}</p>
            </div>
        </div>

        <!-- Chart -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Created tickets this year</h3>
            <div class="h-[400px]">
                <canvas id="ticketsChart"></canvas>
            </div>
        </div>

    </div>

    <script>
        // Chart data for the tickets created throughout the year
        const ctx = document.getElementById('ticketsChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'], // Month names
                datasets: [{
                    label: 'Created Tickets',
                    data: @json(array_values($monthlyTickets)), // Data for the chart (monthly ticket data)
                    fill: true,
                    backgroundColor: 'rgba(59, 130, 246, 0.2)', // Light blue with opacity
                    borderColor: 'rgb(59, 130, 246)', // Blue color
                    tension: 0.4,
                    pointRadius: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false  // Hide the legend for simplicity
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)',
                        },
                        ticks: {
                            stepSize: 5
                        }
                    },
                    x: {
                        grid: {
                            display: false  // Hide x-axis grid lines
                        }
                    }
                }
            }
        });
    </script>

</body>

@endsection
