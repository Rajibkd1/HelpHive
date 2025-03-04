@extends('supervisor.sidebar')

@section('sidebar-content')

<body class="bg-gray-50 p-6">

    <div class="max-w-7xl mx-auto">
        <h1 class="text-2xl font-semibold text-gray-900 mb-8">Ticket Priorities</h1>

        <!-- Flex Layout for displaying all priorities in a row -->
        <div class="flex flex-wrap justify-center gap-6">
            @foreach ($priorityCounts as $priority)
                <div class="bg-white p-6 rounded-lg shadow-md text-center hover:shadow-lg transition-shadow duration-300 w-56">
                    <a href="{{ route('priority.tickets', $priority['priority']) }}" class="block">
                        <!-- Icon for the priority -->
                        @if($priority['priority'] == 'low')
                            <i class="fas fa-arrow-down text-4xl text-green-500 mb-4"></i>
                        @elseif($priority['priority'] == 'medium')
                            <i class="fas fa-arrow-right text-4xl text-yellow-500 mb-4"></i>
                        @elseif($priority['priority'] == 'high')
                            <i class="fas fa-arrow-up text-4xl text-red-500 mb-4"></i>
                        @elseif($priority['priority'] == 'urgent')
                            <i class="fas fa-exclamation-triangle text-4xl text-purple-500 mb-4"></i>
                        @endif

                        <!-- Priority name -->
                        <h2 class="text-lg font-semibold text-gray-800 hover:text-blue-600 transition-colors duration-300">
                            {{ ucfirst($priority['priority']) }}
                        </h2>

                        <!-- Show the count for the current priority -->
                        <p class="mt-2 text-gray-600">{{ $priority['count'] }} Tickets</p>
                    </a>
                </div>
            @endforeach
        </div>

    </div>

</body>

@endsection