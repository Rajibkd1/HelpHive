@extends('supervisor.sidebar')

@section('sidebar-content')
    <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- Back to Customer List button -->
        <div class="mb-4">
            <a href="{{ route('customers.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-200 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                        clip-rule="evenodd" />
                </svg>
                Back to Customer List
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-xl overflow-hidden">
            <!-- Header with gradient background -->
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-6">
                <h2 class="text-3xl font-bold text-white">Customer Details</h2>
                <p class="text-blue-100 mt-1">View and manage customer information</p>
            </div>

            <!-- Customer Profile Card -->
            <div class="p-6">
                <div
                    class="flex flex-col md:flex-row items-center md:items-start gap-6 bg-blue-50 p-6 rounded-lg border border-blue-100">
                    <div class="relative">
                        <img src="{{ asset('storage/' . $customer->profile_picture) }}" alt="{{ $customer->name }}"
                            class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-md">
                        <span
                            class="absolute bottom-0 right-0 w-4 h-4 bg-green-400 rounded-full border-2 border-white"></span>
                    </div>
                    <div class="text-center md:text-left space-y-2">
                        <h3 class="text-2xl font-bold text-gray-800">{{ $customer->name }}</h3>
                        <div class="flex flex-col md:flex-row md:items-center gap-2 md:gap-4 text-gray-600">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                                <span>{{ $customer->email }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                </svg>
                                <span>{{ $customer->mobile_number ?? 'No phone number' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="ml-auto hidden md:block">
                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="flex items-center gap-2 px-4 py-2 bg-white border border-red-500 text-red-500 rounded-lg hover:bg-red-50 transition focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                Delete Customer
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6 border-t border-gray-200">
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-lg shadow border border-blue-200">
                    <div class="flex justify-between items-center">
                        <h4 class="text-blue-800 font-medium">Total Tickets</h4>
                        <span class="bg-blue-500 text-white text-xs px-2 py-1 rounded-full">All time</span>
                    </div>
                    <p class="text-3xl font-bold text-blue-900 mt-2">{{ $tickets->total() }}</p>
                    <div class="flex items-center mt-2 text-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm">Customer tickets history</span>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-lg shadow border border-green-200">
                    <div class="flex justify-between items-center">
                        <h4 class="text-green-800 font-medium">Open Tickets</h4>
                        <span class="bg-green-500 text-white text-xs px-2 py-1 rounded-full">Active</span>
                    </div>
                    <p class="text-3xl font-bold text-green-900 mt-2">
                        {{ $tickets->where('status', 'open')->count() }}
                    </p>
                    <div class="flex items-center mt-2 text-green-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm">Awaiting resolution</span>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-lg shadow border border-purple-200">
                    <div class="flex justify-between items-center">
                        <h4 class="text-purple-800 font-medium">Closed Tickets</h4>
                        <span class="bg-purple-500 text-white text-xs px-2 py-1 rounded-full">Resolved</span>
                    </div>
                    <p class="text-3xl font-bold text-purple-900 mt-2">
                        {{ $tickets->where('status', 'closed')->count() }}
                    </p>
                    <div class="flex items-center mt-2 text-purple-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm">Successfully resolved</span>
                    </div>
                </div>
            </div>

            <!-- Tickets Section -->
            <div class="p-6 border-t border-gray-200">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Customer Tickets</h3>
                    <span class="bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full">{{ $tickets->total() }}
                        Tickets</span>
                </div>

                @if ($tickets->count() > 0)
                    <div class="space-y-4">
                        @foreach ($tickets as $ticket)
                            <div class="bg-white border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition">
                                <div
                                    class="border-l-4 
                                {{ $ticket->status === 'open'
                                    ? 'border-yellow-500'
                                    : ($ticket->status === 'closed'
                                        ? 'border-green-500'
                                        : 'border-blue-500') }}">
                                    <div class="p-4">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <a href="{{ route('ticket.details', $ticket->id) }}"
                                                    class="text-lg font-medium text-blue-600 hover:text-blue-800 transition">
                                                    Ticket #{{ $ticket->id }} - {{ $ticket->title }}
                                                </a>
                                                <div class="mt-1 flex flex-wrap gap-2">
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                    {{ $ticket->status === 'open'
                                                        ? 'bg-yellow-100 text-yellow-800'
                                                        : ($ticket->status === 'closed'
                                                            ? 'bg-green-100 text-green-800'
                                                            : 'bg-blue-100 text-blue-800') }}">
                                                        {{ ucfirst($ticket->status) }}
                                                    </span>

                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                    {{ $ticket->priority === 'high'
                                                        ? 'bg-red-100 text-red-800'
                                                        : ($ticket->priority === 'medium'
                                                            ? 'bg-orange-100 text-orange-800'
                                                            : 'bg-blue-100 text-blue-800') }}">
                                                        {{ ucfirst($ticket->priority) }} Priority
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="text-right text-sm text-gray-500">
                                                <div>Created: {{ $ticket->created_at->format('d M Y') }}</div>
                                                <div>{{ $ticket->created_at->diffForHumans() }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $tickets->links() }}
                    </div>
                @else
                    <div class="text-center py-8 bg-gray-50 rounded-lg border border-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No tickets found</h3>
                        <p class="mt-1 text-sm text-gray-500">This customer hasn't created any tickets yet.</p>
                    </div>
                @endif
            </div>

            <!-- Actions Section -->
            <div class="px-6 pb-6 flex flex-col sm:flex-row gap-4">
                <!-- Back to Customer List - Mobile Friendly Version -->
                <a href="{{ route('customers.index') }}"
                    class="sm:hidden flex items-center justify-center gap-2 px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-200 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                    Back to Customer List
                </a>

                <!-- Delete Customer Button - Mobile Version -->
                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="md:hidden w-full">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Delete Customer
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
