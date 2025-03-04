@extends('supervisor.sidebar')

@section('sidebar-content')
<div class="max-w-6xl mx-auto p-4 sm:p-6 mt-12 lg:p-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8 text-center">Add New Agent</h1>

    <!-- Display validation errors if there are any -->
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-400 rounded-lg shadow-sm">
            <ul class="list-disc list-inside text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Back to Agent List Button -->
    <div class="mb-8 text-center">
        <a href="{{ route('agents.index') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white text-sm font-semibold rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
            <i class="fas fa-arrow-left mr-2"></i> Back to Agent List
        </a>
    </div>

    <!-- Form Section -->
    <form action="{{ route('store.agent') }}" method="POST" class="bg-white p-8 rounded-xl shadow-lg border border-gray-100">
        @csrf

        <!-- Grid Layout for Input Fields -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                <div class="relative">
                    <i class="fas fa-user absolute left-3 top-3 text-gray-400"></i>
                    <input type="text" name="name" id="name" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" value="{{ old('name') }}" required>
                </div>
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <div class="relative">
                    <i class="fas fa-envelope absolute left-3 top-3 text-gray-400"></i>
                    <input type="email" name="email" id="email" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" value="{{ old('email') }}" required>
                </div>
            </div>
        </div>

        <!-- Grid Layout for Password Fields -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-6">
            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <div class="relative">
                    <i class="fas fa-lock absolute left-3 top-3 text-gray-400"></i>
                    <input type="password" name="password" id="password" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" required>
                </div>
            </div>

            <!-- Password Confirmation -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                <div class="relative">
                    <i class="fas fa-lock absolute left-3 top-3 text-gray-400"></i>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" required>
                </div>
            </div>
        </div>

        <!-- Department Dropdown -->
        <div class="mt-8">
            <label for="department_id" class="block text-sm font-medium text-gray-700 mb-2">Department</label>
            <div class="relative">
                <i class="fas fa-building absolute left-3 top-3 text-gray-400"></i>
                <select name="department_id" id="department_id" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all appearance-none" required>
                    <option value="">Select Department</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="mt-10">
            <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
                <i class="fas fa-user-plus mr-2"></i> Create Agent
            </button>
        </div>
    </form>
</div>
@endsection