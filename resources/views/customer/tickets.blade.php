@extends('customer.sidebar')

@section('sidebar-content')
<body class="bg-gray-100 p-6 font-sans">
    <div class="max-w-7xl mx-auto">

        <!-- Header with improved styling -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">My Tickets</h1>
            <a href="{{ route('ticket.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center gap-2 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                New Ticket
            </a>
        </div>

        <!-- Search and Filters with enhanced UI -->
        <div class="bg-white p-5 rounded-xl shadow-md mb-6">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="relative flex-1 min-w-[250px]">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="search" id="searchInput" placeholder="Search tickets..." class="pl-10 pr-4 py-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                </div>
                <div class="flex flex-wrap gap-3">
                    <select id="statusFilter" class="border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 bg-white">
                        <option value="all">All Requests</option>
                        <option value="open">Open</option>
                        <option value="closed">Closed</option>
                        <option value="resolved">Resolved</option>
                    </select>
                    <button id="sortButton" class="flex items-center gap-2 border border-gray-300 rounded-lg px-4 py-3 hover:bg-gray-50 text-gray-700 transition-colors">
                        <span>Sort</span>
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <button id="updatedAtButton" class="flex items-center gap-2 border border-gray-300 rounded-lg px-4 py-3 hover:bg-gray-50 text-gray-700 transition-colors">
                        <span>Updated at</span>
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Tickets Table with improved styling -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200" id="ticketsTable">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Subject</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Created at</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Updated at</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="ticketsList">
                    @if($tickets->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center py-8 text-gray-500">No tickets found.</td>
                        </tr>
                    @else
                        @foreach ($tickets as $ticket)
                            <tr class="hover:bg-blue-50 cursor-pointer transition-colors" onclick="window.location='{{ route('cus-ticket.details', $ticket->id) }}'">
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-medium text-gray-900">{{ $ticket->title }}</td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-500">{{ $ticket->created_at->format('m/d/Y') }}</td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-500">{{ $ticket->updated_at->diffForHumans() }}</td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($ticket->status == 'open') bg-yellow-100 text-yellow-800 border border-yellow-200
                                        @elseif($ticket->status == 'closed') bg-green-100 text-green-800 border border-green-200
                                        @else bg-red-100 text-red-800 border border-red-200 @endif">
                                        {{ ucfirst($ticket->status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            <!-- Pagination with improved styling -->
            <div class="bg-white px-6 py-5 border-t border-gray-200 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-sm text-gray-700">
                    Showing <span class="font-medium">{{ $tickets->firstItem() }}</span> to <span class="font-medium">{{ $tickets->lastItem() }}</span> of <span class="font-medium">{{ $tickets->total() }}</span> results
                </div>
                <div class="flex gap-2">
                    {{ $tickets->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        // Make search bar active
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#ticketsList tr');
            
            rows.forEach(row => {
                const title = row.querySelector('td:first-child').textContent.toLowerCase();
                if (title.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Status filter functionality
        document.getElementById('statusFilter').addEventListener('change', function() {
            const selectedStatus = this.value.toLowerCase();
            const rows = document.querySelectorAll('#ticketsList tr');
            
            rows.forEach(row => {
                if (selectedStatus === 'all') {
                    row.style.display = '';
                    return;
                }
                
                const statusCell = row.querySelector('td:nth-child(4) span');
                const status = statusCell ? statusCell.textContent.trim().toLowerCase() : '';
                
                if (status === selectedStatus) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Sort button functionality
        document.getElementById('sortButton').addEventListener('click', function() {
            const table = document.getElementById('ticketsTable');
            const rows = Array.from(table.querySelectorAll('tbody tr'));
            const ascending = this.dataset.order !== 'asc';
            
            // Toggle sort order
            this.dataset.order = ascending ? 'asc' : 'desc';
            
            // Update button icon
            const svg = this.querySelector('svg');
            svg.innerHTML = ascending 
                ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />'
                : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />';
                
            // Sort rows
            rows.sort((a, b) => {
                const aText = a.querySelector('td:first-child').textContent;
                const bText = b.querySelector('td:first-child').textContent;
                return ascending ? aText.localeCompare(bText) : bText.localeCompare(aText);
            });
            
            // Append sorted rows
            const tbody = table.querySelector('tbody');
            rows.forEach(row => tbody.appendChild(row));
        });

        // Updated at button functionality
        document.getElementById('updatedAtButton').addEventListener('click', function() {
            const table = document.getElementById('ticketsTable');
            const rows = Array.from(table.querySelectorAll('tbody tr'));
            const ascending = this.dataset.order !== 'asc';
            
            // Toggle sort order
            this.dataset.order = ascending ? 'asc' : 'desc';
            
            // Update button icon
            const svg = this.querySelector('svg');
            svg.innerHTML = ascending 
                ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />'
                : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />';
                
            // Sort rows by the "Updated at" column (3rd column)
            rows.sort((a, b) => {
                const aText = a.querySelector('td:nth-child(3)').textContent;
                const bText = b.querySelector('td:nth-child(3)').textContent;
                return ascending ? aText.localeCompare(bText) : bText.localeCompare(aText);
            });
            
            // Append sorted rows
            const tbody = table.querySelector('tbody');
            rows.forEach(row => tbody.appendChild(row));
        });
    </script>
</body>
@endsection