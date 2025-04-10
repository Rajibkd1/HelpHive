@extends('agent.sidebar')

@section('sidebar-content')

<body class="bg-gray-100 p-6">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Agent Dashboard</h1>

        <!-- Search and Filters -->
        <div class="bg-white p-6 rounded-xl shadow-md mb-6 flex flex-wrap gap-4 items-center">
            <div class="relative flex-1 min-w-[250px]">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input id="searchInput" type="search" placeholder="Search tickets..." class="pl-10 pr-4 py-3 w-full border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
            </div>

            <div class="flex flex-wrap gap-4">
                <select id="statusFilter" class="border border-gray-200 rounded-lg px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700">
                    <option value="all">All requests</option>
                    <option value="open">Open</option>
                    <option value="closed">Closed</option>
                    <option value="resolved">Resolved</option>
                </select>
                
                <div class="relative inline-block">
                    <button id="sortButton" class="flex items-center gap-2 bg-white border border-gray-200 rounded-lg px-4 py-3 hover:bg-gray-50 transition focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <span>Sort</span>
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="sortDropdown" class="hidden absolute z-10 mt-1 bg-white rounded-lg shadow-lg py-1 w-48 right-0">
                        <a href="#" class="sort-option block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50" data-sort="title">Subject (A-Z)</a>
                        <a href="#" class="sort-option block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50" data-sort="-title">Subject (Z-A)</a>
                        <a href="#" class="sort-option block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50" data-sort="customer">Customer (A-Z)</a>
                        <a href="#" class="sort-option block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50" data-sort="-customer">Customer (Z-A)</a>
                    </div>
                </div>
                
                <div class="relative inline-block">
                    <button id="dateButton" class="flex items-center gap-2 bg-white border border-gray-200 rounded-lg px-4 py-3 hover:bg-gray-50 transition focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <span>Updated at</span>
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="dateDropdown" class="hidden absolute z-10 mt-1 bg-white rounded-lg shadow-lg py-1 w-48 right-0">
                        <a href="#" class="date-option block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50" data-date="newest">Newest first</a>
                        <a href="#" class="date-option block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50" data-date="oldest">Oldest first</a>
                        <a href="#" class="date-option block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50" data-date="today">Updated today</a>
                        <a href="#" class="date-option block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50" data-date="week">Updated this week</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tickets Table -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table id="ticketsTable" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created at</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if($tickets->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center py-8 text-gray-500">No tickets found.</td>
                            </tr>
                        @else
                            @foreach ($tickets as $ticket)
                                <tr class="hover:bg-blue-50 transition-colors cursor-pointer ticket-row" 
                                    onclick="window.location='{{ route('ticket-details-show', $ticket->id) }}'"
                                    data-title="{{ $ticket->title }}"
                                    data-customer="{{ $ticket->customer->name }}"
                                    data-department="{{ $ticket->department->name }}"
                                    data-created="{{ $ticket->created_at->format('Y-m-d') }}"
                                    data-updated="{{ $ticket->updated_at->format('Y-m-d') }}"
                                    data-status="{{ $ticket->status }}">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $ticket->title }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $ticket->customer->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $ticket->department->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $ticket->created_at->format('M d, Y') }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($ticket->status == 'open') bg-yellow-100 text-yellow-800 
                                            @elseif($ticket->status == 'closed') bg-green-100 text-green-800 
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

            <!-- Pagination -->
            <div class="bg-white px-6 py-4 border-t border-gray-200 flex flex-wrap items-center justify-between gap-4">
                <div class="text-sm text-gray-700">
                    Showing {{ $tickets->firstItem() ?? 0 }} to {{ $tickets->lastItem() ?? 0 }} of {{ $tickets->total() ?? 0 }} results
                </div>
                <div class="flex gap-2">
                    {{ $tickets->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sort button functionality
            const sortButton = document.getElementById('sortButton');
            const sortDropdown = document.getElementById('sortDropdown');
            
            sortButton.addEventListener('click', function() {
                sortDropdown.classList.toggle('hidden');
                dateDropdown.classList.add('hidden'); // Close the other dropdown
            });
            
            // Date button functionality
            const dateButton = document.getElementById('dateButton');
            const dateDropdown = document.getElementById('dateDropdown');
            
            dateButton.addEventListener('click', function() {
                dateDropdown.classList.toggle('hidden');
                sortDropdown.classList.add('hidden'); // Close the other dropdown
            });
            
            // Close dropdowns when clicking outside
            document.addEventListener('click', function(event) {
                if (!sortButton.contains(event.target) && !sortDropdown.contains(event.target)) {
                    sortDropdown.classList.add('hidden');
                }
                
                if (!dateButton.contains(event.target) && !dateDropdown.contains(event.target)) {
                    dateDropdown.classList.add('hidden');
                }
            });
            
            // Search functionality
            const searchInput = document.getElementById('searchInput');
            const statusFilter = document.getElementById('statusFilter');
            const ticketRows = document.querySelectorAll('.ticket-row');
            
            function filterTickets() {
                const searchTerm = searchInput.value.toLowerCase();
                const statusValue = statusFilter.value;
                
                ticketRows.forEach(row => {
                    const title = row.getAttribute('data-title').toLowerCase();
                    const customer = row.getAttribute('data-customer').toLowerCase();
                    const department = row.getAttribute('data-department').toLowerCase();
                    const status = row.getAttribute('data-status');
                    
                    const matchesSearch = title.includes(searchTerm) || 
                                         customer.includes(searchTerm) || 
                                         department.includes(searchTerm);
                                         
                    const matchesStatus = statusValue === 'all' || status === statusValue;
                    
                    if (matchesSearch && matchesStatus) {
                        row.classList.remove('hidden');
                    } else {
                        row.classList.add('hidden');
                    }
                });
                
                updateEmptyState();
            }
            
            function updateEmptyState() {
                const visibleRows = document.querySelectorAll('.ticket-row:not(.hidden)');
                const tbody = document.querySelector('tbody');
                const existingEmptyMessage = document.getElementById('emptyMessage');
                
                if (visibleRows.length === 0) {
                    if (!existingEmptyMessage) {
                        const emptyRow = document.createElement('tr');
                        emptyRow.id = 'emptyMessage';
                        emptyRow.innerHTML = '<td colspan="5" class="text-center py-8 text-gray-500">No matching tickets found.</td>';
                        tbody.appendChild(emptyRow);
                    }
                } else if (existingEmptyMessage) {
                    existingEmptyMessage.remove();
                }
            }
            
            searchInput.addEventListener('input', filterTickets);
            statusFilter.addEventListener('change', filterTickets);
            
            // Sort functionality
            const sortOptions = document.querySelectorAll('.sort-option');
            
            sortOptions.forEach(option => {
                option.addEventListener('click', function(e) {
                    e.preventDefault();
                    const sortBy = this.getAttribute('data-sort');
                    sortTickets(sortBy);
                    sortDropdown.classList.add('hidden');
                });
            });
            
            function sortTickets(sortBy) {
                const reverse = sortBy.startsWith('-');
                const field = reverse ? sortBy.substring(1) : sortBy;
                const tbody = document.querySelector('tbody');
                
                const rows = Array.from(ticketRows);
                
                rows.sort((a, b) => {
                    const valueA = a.getAttribute('data-' + field).toLowerCase();
                    const valueB = b.getAttribute('data-' + field).toLowerCase();
                    
                    if (reverse) {
                        return valueB.localeCompare(valueA);
                    } else {
                        return valueA.localeCompare(valueB);
                    }
                });
                
                rows.forEach(row => {
                    tbody.appendChild(row);
                });
            }
            
            // Date filtering
            const dateOptions = document.querySelectorAll('.date-option');
            
            dateOptions.forEach(option => {
                option.addEventListener('click', function(e) {
                    e.preventDefault();
                    const dateFilter = this.getAttribute('data-date');
                    filterByDate(dateFilter);
                    dateDropdown.classList.add('hidden');
                });
            });
            
            function filterByDate(dateFilter) {
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                
                const oneWeekAgo = new Date();
                oneWeekAgo.setDate(oneWeekAgo.getDate() - 7);
                oneWeekAgo.setHours(0, 0, 0, 0);
                
                ticketRows.forEach(row => {
                    const updatedDate = new Date(row.getAttribute('data-updated'));
                    updatedDate.setHours(0, 0, 0, 0);
                    
                    let showRow = true;
                    
                    if (dateFilter === 'newest') {
                        // Already sorted by updated_at in controller, but we could implement client-side sorting here
                        sortTickets('-updated');
                    } else if (dateFilter === 'oldest') {
                        sortTickets('updated');
                    } else if (dateFilter === 'today') {
                        showRow = updatedDate.getTime() === today.getTime();
                    } else if (dateFilter === 'week') {
                        showRow = updatedDate >= oneWeekAgo;
                    }
                    
                    if (showRow) {
                        row.classList.remove('hidden-date');
                    } else {
                        row.classList.add('hidden-date');
                    }
                });
                
                // Run the search filter again to respect both filters
                filterTickets();
            }
        });
    </script>
</body>

@endsection