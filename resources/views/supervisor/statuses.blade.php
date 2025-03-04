<!-- resources/views/supervisor/statuses.blade.php -->

@extends('supervisor.sidebar')

@section('sidebar-content')

<div class="max-w-6xl mx-auto p-4 sm:p-6 mt-12 lg:p-8">
    <h1 class="text-2xl font-semibold text-gray-900 mb-8">Ticket Statuses</h1>

    <!-- Flex Layout for displaying all ticket statuses in a row -->
    <div class="flex flex-wrap justify-center gap-6">
        <!-- Manually list all statuses with their counts and icons -->
        @foreach(['open', 'in-progress', 'resolved', 'closed'] as $status)
            <div class="bg-white p-6 rounded-lg shadow-md text-center hover:shadow-lg transition-shadow duration-300 w-48">
                <a href="{{ route('status.tickets', $status) }}" class="block">
                    <!-- Icon for the status -->
                    @if($status == 'open')
                        <i class="fas fa-folder-open text-4xl text-blue-500 mb-4"></i>
                    @elseif($status == 'in-progress')
                        <i class="fas fa-tasks text-4xl text-yellow-500 mb-4"></i>
                    @elseif($status == 'resolved')
                        <i class="fas fa-check-circle text-4xl text-green-500 mb-4"></i>
                    @elseif($status == 'closed')
                        <i class="fas fa-archive text-4xl text-gray-500 mb-4"></i>
                    @endif

                    <!-- Status name -->
                    <h2 class="text-lg font-semibold text-gray-800 hover:text-blue-600 transition-colors duration-300">
                        {{ ucfirst($status) }}
                    </h2>

                    <!-- Show the count for the current status -->
                    <p class="mt-2 text-gray-600">{{ $statusCounts[$status] }} Tickets</p>
                </a>
            </div>
        @endforeach
    </div>
</div>

@endsection