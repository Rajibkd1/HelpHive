@extends('customer.sidebar')

@section('sidebar-content')
    <h2 class="text-xl mb-4">Welcome to your Customer Dashboard!</h2>
    <p>Here you can manage your personal details, view your orders, and more.</p>


        <!-- Logout Button -->
        <div class="mt-4 text-center">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-700">
                    Logout
                </button>
            </form>
        </div>
@endsection
