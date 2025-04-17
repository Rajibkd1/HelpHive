@extends('supervisor.sidebar')

@section('sidebar-content')
<div class="container max-w-3xl mx-auto px-4 py-6">
    <!-- Header with back button -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Agent</h1>
        <a href="{{ route('agents.index') }}" class="flex items-center text-indigo-600 hover:text-indigo-800 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Agents
        </a>
    </div>
    
    <!-- Card container -->
    <div class="bg-white rounded-lg shadow-md p-6 border border-gray-100">
        <form action="{{ route('agents.update', $agent->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Name Field -->
            <div class="mb-5">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Agent Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $agent->name) }}" 
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" required>
                @error('name') 
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
                @enderror
            </div>
            
            <!-- Email Field -->
            <div class="mb-5">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email', $agent->email) }}" 
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" required>
                @error('email') 
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
                @enderror
            </div>
            
            <!-- Password Field -->
            <div class="mb-5">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                    Password 
                    <span class="text-gray-500 font-normal">(Leave empty to keep current)</span>
                </label>
                <input type="password" name="password" id="password" 
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                @error('password') 
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
                @enderror
            </div>
            
            <!-- Department Field -->
            <div class="mb-6">
                <label for="department_id" class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                <select name="department_id" id="department_id" 
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" required>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ $department->id == old('department_id', $agent->department_id) ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
                @error('department_id') 
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
                @enderror
            </div>
            
            <!-- Form Buttons -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('agents.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition shadow-sm">
                    Update Agent
                </button>
            </div>
        </form>
    </div>
</div>
@endsection