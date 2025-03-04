@extends('supervisor.sidebar')

@section('sidebar-content')

<body class="bg-gray-50 p-6">

    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">All tickets</h1>
        </div>

        <!-- Search and Filters -->
        <div class="bg-white p-4 rounded-lg shadow-sm mb-4 flex flex-wrap gap-4">
            <div class="relative flex-1 min-w-[200px]">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="search" placeholder="Search" class="pl-10 pr-4 py-2 w-full border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>

            <div class="flex gap-4">
                <select class="border rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    <option>All requests</option>
                </select>
                <button class="flex items-center gap-2 border rounded-md px-3 py-2 hover:bg-gray-50">
                    <span>Sort</span>
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <button class="flex items-center gap-2 border rounded-md px-3 py-2 hover:bg-gray-50">
                    <span>Updated at</span>
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Tickets Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Serial</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created at</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priority</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assigned To</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if($tickets->isEmpty())
                        <tr>
                            <td colspan="8" class="text-center py-4">No tickets found.</td>
                        </tr>
                    @else
                        @foreach ($tickets as $index => $ticket)
                            <tr class="hover:bg-gray-50 cursor-pointer">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $tickets->firstItem() + $index }}</td> <!-- Serial number -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $ticket->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $ticket->created_at->format('m/d/Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $ticket->department->name }}</td> <!-- Department -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <form action="{{ route('ticket.update.priority', $ticket->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="priority" class="border rounded-md px-3 py-1 focus:outline-none focus:ring-1 focus:ring-blue-500" onchange="this.form.submit()">
                                            <option value="low" {{ $ticket->priority == 'low' ? 'selected' : '' }}>Low</option>
                                            <option value="medium" {{ $ticket->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                                            <option value="high" {{ $ticket->priority == 'high' ? 'selected' : '' }}>High</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <form action="{{ route('ticket.update.assign', $ticket->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="agent_id" class="border rounded-md px-3 py-1 focus:outline-none focus:ring-1 focus:ring-blue-500" onchange="this.form.submit()">
                                            @foreach ($agents as $agent)
                                                <option value="{{ $agent->id }}" {{ $ticket->agent_id == $agent->id ? 'selected' : '' }}>{{ $agent->name }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if($ticket->status == 'open') bg-yellow-100 text-yellow-800
                                        @elseif($ticket->status == 'closed') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($ticket->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('ticket.details', $ticket->id) }}" class="text-blue-500">View</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="bg-white px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                <div class="text-sm text-gray-700">
                    Showing {{ $tickets->firstItem() }} to {{ $tickets->lastItem() }} of {{ $tickets->total() }} results
                </div>
                <div class="flex gap-2">
                    {{ $tickets->links() }}  <!-- Display pagination links -->
                </div>
            </div>
        </div>

    </div>

    <script>
        // The onclick functionality for redirecting to ticket details is handled within the loop
    </script>

</body>

@endsection
