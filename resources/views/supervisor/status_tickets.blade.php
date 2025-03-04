@extends('supervisor.sidebar')

@section('sidebar-content')

    <body class="bg-gray-50 p-6">

        <div class="max-w-7xl mx-auto">

            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold text-gray-900">Tickets - {{ ucfirst($status) }}</h1>
                <a href="{{ route('statuses') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-md transition-colors">
                    Return to status overview
                </a>
            </div>

            <!-- Tickets Table -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">

                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Serial</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Subject</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Created at</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Department</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Priority</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Assigned To</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if ($tickets->isEmpty())
                            <tr>
                                <td colspan="8" class="text-center py-4">No tickets found for this status.</td>
                            </tr>
                        @else
                            @foreach ($tickets as $index => $ticket)
                                <tr class="hover:bg-gray-50 cursor-pointer">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $tickets->firstItem() + $index }}</td> <!-- Serial number -->
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" onclick="window.location='{{ route('ticket.details', $ticket->id) }}'">{{ $ticket->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $ticket->created_at->format('m/d/Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $ticket->department->name }}</td> <!-- Department -->
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <form action="{{ route('ticket.update.priority', $ticket->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <select name="priority"
                                                class="border rounded-md px-3 py-1 focus:outline-none focus:ring-1 focus:ring-blue-500"
                                                onchange="this.form.submit()">
                                                <option value="low" {{ $ticket->priority == 'low' ? 'selected' : '' }}>
                                                    Low</option>
                                                <option value="medium"
                                                    {{ $ticket->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                                                <option value="high" {{ $ticket->priority == 'high' ? 'selected' : '' }}>
                                                    High</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <form action="{{ route('ticket.update.assign', $ticket->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <select name="agent_id"
                                                class="border rounded-md px-3 py-1 focus:outline-none focus:ring-1 focus:ring-blue-500"
                                                onchange="this.form.submit()">
                                                @foreach ($agents as $agent)
                                                    <option value="{{ $agent->id }}"
                                                        {{ $ticket->agent_id == $agent->id ? 'selected' : '' }}>
                                                        {{ $agent->name }}</option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </td> <!-- Assigned To -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if ($ticket->status == 'open') bg-yellow-100 text-yellow-800
                                        @elseif($ticket->status == 'in-progress') bg-blue-100 text-blue-800
                                        @elseif($ticket->status == 'resolved') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800 @endif">
                                            {{ ucfirst($ticket->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="bg-white px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Showing {{ $tickets->firstItem() }} to {{ $tickets->lastItem() }} of {{ $tickets->total() }}
                        results
                    </div>
                    <div class="flex gap-2">
                        {{ $tickets->links() }}
                    </div>
                </div>

            </div>
        </div>

    </body>

@endsection
