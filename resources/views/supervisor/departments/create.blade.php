@extends('supervisor.sidebar')

@section('sidebar-content')

<body class="bg-gray-50 p-6">

    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Create New Department</h1>
            <a href="{{ route('departments.index') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white text-sm font-semibold rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
                <i class="fas fa-arrow-left mr-2"></i> Back to Departments
            </a>
        </div>

        <!-- Create Department Form -->
        <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-100">
            <form action="{{ route('departments.store') }}" method="POST">
                @csrf

                <!-- Department Name Field -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Department Name</label>
                    <div class="relative">
                        <i class="fas fa-building absolute left-3 top-3 text-gray-400"></i>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" required>
                    </div>
                    @error('name')
                        <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mt-8">
                    <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
                        <i class="fas fa-plus-circle mr-2"></i> Create Department
                    </button>
                </div>
            </form>
        </div>

    </div>

</body>

@endsection