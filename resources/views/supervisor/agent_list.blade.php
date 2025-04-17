@extends('supervisor.sidebar')

@section('sidebar-content')
<div class="bg-gray-50 min-h-screen p-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header with gradient background -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-lg shadow-md p-6 mb-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <h1 class="text-2xl font-bold text-white mb-4 md:mb-0">Agent Directory</h1>
                <a href="{{ route('create.agent') }}" 
                   class="inline-flex items-center px-4 py-2 bg-white text-blue-600 hover:bg-blue-50 text-sm font-medium rounded-md transition-colors shadow-sm"
                   data-bs-toggle="modal" data-bs-target="#addAgentModal">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Add New Agent
                </a>
            </div>
        </div>
        
        <!-- Search and Filter Controls -->
        <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
            <div class="flex flex-col md:flex-row gap-4">
                <!-- Search -->
                <div class="flex-grow">
                    <div class="flex">
                        <div class="relative flex-grow">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="searchInput" placeholder="Search agents by name..." 
                                   class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 pr-3 py-2 sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>
                </div>
                
                <!-- Department Filter -->
                <div class="md:w-64">
                    <select id="departmentFilter" 
                            class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option value="">All Departments</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->name }}">
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        
        <!-- Agents Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200" id="agentsTable">
                    <thead class="bg-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <button class="flex items-center group" data-sort="name">
                                    Name
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 text-gray-400 group-hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                    </svg>
                                </button>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <button class="flex items-center group" data-sort="email">
                                    Email
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 text-gray-400 group-hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                    </svg>
                                </button>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <button class="flex items-center group" data-sort="department">
                                    Department
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 text-gray-400 group-hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                    </svg>
                                </button>
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($agents as $agent)
                            <tr class="hover:bg-gray-50 transition-colors agent-row">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                                <span class="text-indigo-700 font-medium text-lg">{{ substr($agent->name, 0, 1) }}</span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 agent-name">{{ $agent->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 agent-email">
                                    {{ $agent->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($agent->department)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 agent-department">
                                            {{ $agent->department->name }}
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 agent-department">
                                            No Department
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('agents.edit', $agent->id) }}" class="text-indigo-600 hover:text-indigo-900 inline-flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            <span class="sr-only">Edit</span>
                                        </a>
                                        <form action="{{ route('agents.destroy', $agent->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this agent?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 inline-flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                <span class="sr-only">Delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <!-- No Results Message (Initially Hidden) -->
                <div id="noResults" class="hidden px-6 py-10 text-center text-sm text-gray-500">
                    <div class="flex flex-col items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="font-medium">No agents found</p>
                        <p class="mt-1">Try adjusting your search or filter to find what you're looking for.</p>
                    </div>
                </div>
            </div>
            
            <!-- Pagination -->
            <div class="bg-white px-6 py-4 border-t border-gray-200 flex flex-col sm:flex-row items-center justify-between">
                <div class="text-sm text-gray-700 mb-4 sm:mb-0">
                    Showing {{ $agents->firstItem() ?? 0 }} to {{ $agents->lastItem() ?? 0 }} of {{ $agents->total() }} results
                </div>
                <div class="flex justify-center">
                    {{ $agents->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Search, Filter and Sort -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Elements
        const searchInput = document.getElementById('searchInput');
        const departmentFilter = document.getElementById('departmentFilter');
        const agentRows = document.querySelectorAll('.agent-row');
        const noResults = document.getElementById('noResults');
        const sortButtons = document.querySelectorAll('[data-sort]');
        
        // Current sort state
        let sortConfig = {
            column: 'name',
            direction: 'asc'
        };
        
        // Search and filter function
        function filterTable() {
            const searchTerm = searchInput.value.toLowerCase();
            const department = departmentFilter.value.toLowerCase();
            let visibleCount = 0;
            
            agentRows.forEach(row => {
                const name = row.querySelector('.agent-name').textContent.toLowerCase();
                const agentDepartment = row.querySelector('.agent-department').textContent.toLowerCase();
                
                // Check if row matches both filters
                const matchesSearch = name.includes(searchTerm);
                const matchesDepartment = department === '' || agentDepartment === department;
                
                // Show or hide row
                if (matchesSearch && matchesDepartment) {
                    row.classList.remove('hidden');
                    visibleCount++;
                } else {
                    row.classList.add('hidden');
                }
            });
            
            // Show "No results" message if needed
            if (visibleCount === 0) {
                noResults.classList.remove('hidden');
            } else {
                noResults.classList.add('hidden');
            }
        }
        
        // Sort function
        function sortTable(column) {
            // Update sort direction
            if (sortConfig.column === column) {
                sortConfig.direction = sortConfig.direction === 'asc' ? 'desc' : 'asc';
            } else {
                sortConfig.column = column;
                sortConfig.direction = 'asc';
            }
            
            // Get rows as array for sorting
            const tbody = document.querySelector('#agentsTable tbody');
            const rows = Array.from(tbody.querySelectorAll('tr.agent-row'));
            
            // Sort rows
            rows.sort((a, b) => {
                let valA, valB;
                
                if (column === 'name') {
                    valA = a.querySelector('.agent-name').textContent.toLowerCase();
                    valB = b.querySelector('.agent-name').textContent.toLowerCase();
                } else if (column === 'email') {
                    valA = a.querySelector('.agent-email').textContent.toLowerCase();
                    valB = b.querySelector('.agent-email').textContent.toLowerCase();
                } else if (column === 'department') {
                    valA = a.querySelector('.agent-department').textContent.toLowerCase();
                    valB = b.querySelector('.agent-department').textContent.toLowerCase();
                }
                
                if (sortConfig.direction === 'asc') {
                    return valA.localeCompare(valB);
                } else {
                    return valB.localeCompare(valA);
                }
            });
            
            // Re-append rows in sorted order
            rows.forEach(row => {
                tbody.appendChild(row);
            });
            
            // Update visual indicators for sort direction
            sortButtons.forEach(btn => {
                const btnColumn = btn.getAttribute('data-sort');
                const svg = btn.querySelector('svg');
                
                if (btnColumn === sortConfig.column) {
                    svg.classList.add('text-indigo-500');
                    svg.classList.remove('text-gray-400');
                    
                    // Update SVG for sort direction indicator
                    if (sortConfig.direction === 'asc') {
                        svg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />';
                    } else {
                        svg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />';
                    }
                } else {
                    svg.classList.add('text-gray-400');
                    svg.classList.remove('text-indigo-500');
                    svg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />';
                }
            });
        }
        
        // Event listeners
        searchInput.addEventListener('input', filterTable);
        departmentFilter.addEventListener('change', filterTable);
        
        sortButtons.forEach(button => {
            button.addEventListener('click', function() {
                const column = this.getAttribute('data-sort');
                sortTable(column);
            });
        });
        
        // Initial sort
        sortTable('name');
    });
</script>
@endsection