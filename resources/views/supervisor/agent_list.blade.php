@extends('supervisor.sidebar')

@section('sidebar-content')

<body class="bg-gray-50 p-6">

    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">Agent List</h1>
            <a href="{{ route('create.agent') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-md transition-colors"
                data-bs-toggle="modal" data-bs-target="#addAgentModal">Add New Agent</a>
        </div>

        <!-- Agents Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">

            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($agents as $agent)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $agent->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $agent->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $agent->department->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="bg-white px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                <div class="text-sm text-gray-700">
                    Showing {{ $agents->firstItem() }} to {{ $agents->lastItem() }} of {{ $agents->total() }} results
                </div>
                <div class="flex gap-2">
                    {{ $agents->links() }}  <!-- Display pagination links -->
                </div>
            </div>

        </div>

    </div>

</body>

@endsection
