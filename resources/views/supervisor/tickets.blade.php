@extends('supervisor.sidebar')

@section('sidebar-content')

<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header with gradient background -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl shadow-lg mb-8 p-6">
            <h1 class="text-3xl font-bold text-white">All Tickets</h1>
            <p class="text-blue-100 mt-1">Manage and monitor support requests</p>
        </div>

        <!-- Search and Filters Card -->
        <div class="bg-white rounded-xl shadow-md mb-6 p-5 transition-all duration-300 hover:shadow-lg">
            <div class="flex flex-col md:flex-row md:items-center gap-4">
                <!-- Search Input with animation -->
                <div class="relative flex-1 min-w-[240px]">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input id="searchInput" type="search" placeholder="Search tickets..." 
                           class="pl-10 pr-4 py-3 w-full border-0 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-200"
                           autofocus>
                </div>

                <!-- Filter Controls -->
                <div class="flex flex-wrap gap-3">
                    <select id="requestFilter" class="bg-gray-50 border-0 rounded-lg px-4 py-3 text-gray-700 focus:ring-2 focus:ring-blue-500 cursor-pointer">
                        <option value="all">All requests</option>
                        <option value="open">Open tickets</option>
                        <option value="closed">Closed tickets</option>
                        <option value="resolved">Resolved tickets</option>
                        <option value="pending">Pending tickets</option>
                    </select>
                    
                    <button id="sortButton" class="flex items-center gap-2 bg-gray-50 rounded-lg px-4 py-3 text-gray-700 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 transition-colors duration-200">
                        <span>Sort</span>
                        <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    
                    <button id="updateAtButton" class="flex items-center gap-2 bg-gray-50 rounded-lg px-4 py-3 text-gray-700 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 transition-colors duration-200">
                        <span>Updated at</span>
                        <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sort Dropdown (Initially Hidden) -->
        <div id="sortDropdown" class="hidden bg-white rounded-xl shadow-md mb-4 p-3 absolute z-10 right-8 mt-1">
            <div class="flex flex-col">
                <button class="sort-option px-4 py-2 text-left hover:bg-blue-50 rounded" data-sort="status_asc">Status (A-Z)</button>
                <button class="sort-option px-4 py-2 text-left hover:bg-blue-50 rounded" data-sort="status_desc">Status (Z-A)</button>
                <button class="sort-option px-4 py-2 text-left hover:bg-blue-50 rounded" data-sort="priority_asc">Priority (Low-High)</button>
                <button class="sort-option px-4 py-2 text-left hover:bg-blue-50 rounded" data-sort="priority_desc">Priority (High-Low)</button>
            </div>
        </div>

        <!-- Update At Dropdown (Initially Hidden) -->
        <div id="updateAtDropdown" class="hidden bg-white rounded-xl shadow-md mb-4 p-3 absolute z-10 right-8 mt-1">
            <div class="flex flex-col">
                <button class="update-option px-4 py-2 text-left hover:bg-blue-50 rounded" data-sort="newest">Newest first</button>
                <button class="update-option px-4 py-2 text-left hover:bg-blue-50 rounded" data-sort="oldest">Oldest first</button>
                <button class="update-option px-4 py-2 text-left hover:bg-blue-50 rounded" data-sort="recently_updated">Recently updated</button>
            </div>
        </div>

        <!-- Tickets Table -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table id="ticketsTable" class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Serial</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created at</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priority</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assigned To</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if($tickets->isEmpty())
                            <tr>
                                <td colspan="8" class="text-center py-8 text-gray-500 italic">No tickets found in the system.</td>
                            </tr>
                        @else
                            @foreach ($tickets as $index => $ticket)
                                <tr class="ticket-row hover:bg-blue-50 transition-colors duration-150 cursor-pointer" 
                                    data-title="{{ $ticket->title }}" 
                                    data-created="{{ $ticket->created_at->format('Y-m-d') }}"
                                    data-status="{{ $ticket->status }}"
                                    data-priority="{{ $ticket->priority }}"
                                    data-department="{{ $ticket->department->name }}">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $tickets->firstItem() + $index }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600" onclick="window.location='{{ route('ticket.details', $ticket->id) }}'">{{ $ticket->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $ticket->created_at->format('m/d/Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $ticket->department->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <form action="{{ route('ticket.update.priority', $ticket->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <select name="priority" 
                                                    class="border-0 rounded-md px-3 py-1 text-sm
                                                    {{ $ticket->priority == 'low' ? 'bg-green-50 text-green-700' : 
                                                      ($ticket->priority == 'medium' ? 'bg-yellow-50 text-yellow-700' : 
                                                      'bg-red-50 text-red-700') }}
                                                    focus:ring-2 focus:ring-blue-500"
                                                    onchange="this.form.submit()">
                                                <option value="low" {{ $ticket->priority == 'low' ? 'selected' : '' }}>Low</option>
                                                <option value="medium" {{ $ticket->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                                                <option value="high" {{ $ticket->priority == 'high' ? 'selected' : '' }}>High</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <form action="{{ route('ticket.update.assign', $ticket->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <select name="agent_id" 
                                                    class="border-0 bg-gray-50 rounded-md px-3 py-1 text-sm focus:ring-2 focus:ring-blue-500"
                                                    onchange="this.form.submit()">
                                                @foreach ($agents as $agent)
                                                    <option value="{{ $agent->id }}" {{ $ticket->agent_id == $agent->id ? 'selected' : '' }}>{{ $agent->name }}</option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @if($ticket->status == 'open') bg-yellow-100 text-yellow-800
                                            @elseif($ticket->status == 'closed') bg-green-100 text-green-800
                                            @elseif($ticket->status == 'resolved') bg-blue-100 text-blue-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ ucfirst($ticket->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Pagination with better styling -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-sm text-gray-700">
                    Showing <span class="font-medium">{{ $tickets->firstItem() }}</span> to 
                    <span class="font-medium">{{ $tickets->lastItem() }}</span> of 
                    <span class="font-medium">{{ $tickets->total() }}</span> results
                </div>
                <div class="flex gap-2">
                    {{ $tickets->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('requestFilter');
    const sortButton = document.getElementById('sortButton');
    const updateAtButton = document.getElementById('updateAtButton');
    const sortDropdown = document.getElementById('sortDropdown');
    const updateAtDropdown = document.getElementById('updateAtDropdown');
    const ticketRows = document.querySelectorAll('.ticket-row');
    
    // Hide dropdowns when clicking elsewhere
    document.addEventListener('click', function(event) {
        if (!sortButton.contains(event.target) && !sortDropdown.contains(event.target)) {
            sortDropdown.classList.add('hidden');
        }
        
        if (!updateAtButton.contains(event.target) && !updateAtDropdown.contains(event.target)) {
            updateAtDropdown.classList.add('hidden');
        }
    });
    
    // Toggle Sort dropdown
    sortButton.addEventListener('click', function() {
        sortDropdown.classList.toggle('hidden');
        updateAtDropdown.classList.add('hidden'); // Hide the other dropdown
    });
    
    // Toggle Update At dropdown
    updateAtButton.addEventListener('click', function() {
        updateAtDropdown.classList.toggle('hidden');
        sortDropdown.classList.add('hidden'); // Hide the other dropdown
    });
    
    // Search Functionality
    searchInput.addEventListener('input', filterTickets);
    
    // Status Filter Functionality
    statusFilter.addEventListener('change', filterTickets);
    
    // Sort Options Click Handlers
    document.querySelectorAll('.sort-option').forEach(option => {
        option.addEventListener('click', function() {
            const sortType = this.getAttribute('data-sort');
            sortTickets(sortType);
            sortDropdown.classList.add('hidden');
            
            // Update button text to show active sort
            sortButton.querySelector('span').textContent = 'Sort: ' + this.textContent;
            sortButton.classList.add('bg-blue-100');
        });
    });
    
    // Update At Options Click Handlers
    document.querySelectorAll('.update-option').forEach(option => {
        option.addEventListener('click', function() {
            const updateType = this.getAttribute('data-sort');
            sortByDate(updateType);
            updateAtDropdown.classList.add('hidden');
            
            // Update button text to show active filter
            updateAtButton.querySelector('span').textContent = 'Updated: ' + this.textContent;
            updateAtButton.classList.add('bg-blue-100');
        });
    });
    
    // Filter tickets based on search input and status filter
    function filterTickets() {
        const searchTerm = searchInput.value.toLowerCase();
        const filterValue = statusFilter.value;
        
        ticketRows.forEach(row => {
            const title = row.getAttribute('data-title').toLowerCase();
            const status = row.getAttribute('data-status');
            const department = row.getAttribute('data-department').toLowerCase();
            
            const matchesSearch = title.includes(searchTerm) || department.includes(searchTerm);
            const matchesFilter = filterValue === 'all' || status === filterValue;
            
            if (matchesSearch && matchesFilter) {
                row.classList.remove('hidden');
            } else {
                row.classList.add('hidden');
            }
        });
        
        updateNoResultsMessage();
    }
    
    // Sort tickets based on selected option
    function sortTickets(sortType) {
        const tbody = document.querySelector('#ticketsTable tbody');
        const rows = Array.from(ticketRows);
        
        rows.sort((a, b) => {
            if (sortType === 'status_asc') {
                return a.getAttribute('data-status').localeCompare(b.getAttribute('data-status'));
            } else if (sortType === 'status_desc') {
                return b.getAttribute('data-status').localeCompare(a.getAttribute('data-status'));
            } else if (sortType === 'priority_asc') {
                // Convert priority to numeric value for sorting (low: 1, medium: 2, high: 3)
                const priorityValues = { 'low': 1, 'medium': 2, 'high': 3 };
                return priorityValues[a.getAttribute('data-priority')] - priorityValues[b.getAttribute('data-priority')];
            } else if (sortType === 'priority_desc') {
                const priorityValues = { 'low': 1, 'medium': 2, 'high': 3 };
                return priorityValues[b.getAttribute('data-priority')] - priorityValues[a.getAttribute('data-priority')];
            }
            return 0;
        });
        
        // Reorder the DOM
        rows.forEach(row => tbody.appendChild(row));
    }
    
    // Sort by date options
    function sortByDate(sortType) {
        const tbody = document.querySelector('#ticketsTable tbody');
        const rows = Array.from(ticketRows);
        
        rows.sort((a, b) => {
            const dateA = new Date(a.getAttribute('data-created'));
            const dateB = new Date(b.getAttribute('data-created'));
            
            if (sortType === 'newest') {
                return dateB - dateA;
            } else if (sortType === 'oldest') {
                return dateA - dateB;
            } else if (sortType === 'recently_updated') {
                // In a real implementation, you would need a separate data attribute for 'updated_at'
                // For this example, we'll use 'data-created' as a substitute
                return dateB - dateA;
            }
            return 0;
        });
        
        // Reorder the DOM
        rows.forEach(row => tbody.appendChild(row));
    }
    
    // Add "No results found" message when needed
    function updateNoResultsMessage() {
        // Remove existing no results message if present
        const existingMessage = document.querySelector('.no-results-message');
        if (existingMessage) {
            existingMessage.remove();
        }
        
        // Check if any rows are visible
        const visibleRows = Array.from(ticketRows).filter(row => !row.classList.contains('hidden'));
        
        if (visibleRows.length === 0) {
            const tbody = document.querySelector('#ticketsTable tbody');
            const noResultsRow = document.createElement('tr');
            noResultsRow.className = 'no-results-message';
            noResultsRow.innerHTML = `
                <td colspan="7" class="text-center py-8 text-gray-500 italic">
                    No tickets match your search criteria.
                </td>
            `;
            tbody.appendChild(noResultsRow);
        }
    }
});
</script>

@endsection