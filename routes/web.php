<?php

use App\Http\Controllers\AgentDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerDashboardController;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\OTPController;
use App\Http\Controllers\SupervisorDashboardController;

Route::get('/auth', [AuthController::class, 'showAuthForm'])->name('auth');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth')->name('dashboard'); // Route for the dashboard
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::post('/send-otp', [AuthController::class, 'sendOtp'])->name('send-otp');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('verify-otp');

// Customer dashboard route
Route::get('/customer-dashboard', [CustomerDashboardController::class, 'index'])
    ->middleware('role:customer')
    ->name('customer.dashboard');  // Apply role middleware for customers and add name



// Agent dashboard route
Route::get('/agent-dashboard', [AgentDashboardController::class, 'index'])
    ->middleware('role:agent')
    ->name('agent.dashboard');  // Apply role middleware for agents and add name

// Supervisor dashboard route
Route::get('/supervisor-dashboard', [SupervisorDashboardController::class, 'index'])
    ->middleware('role:supervisor')
    ->name('supervisor.dashboard');  // Apply role middleware for supervisors and add name

// Protect routes with authentication middleware
Route::middleware('role:customer')->group(function () {
        // Route to show tickets
Route::get('/customer-dashboard/tickets', [CustomerDashboardController::class, 'showTickets'])->name('customer.tickets');

Route::get('/customer/ticket/create', [CustomerDashboardController::class, 'createTicket'])->name('ticket.create');
Route::post('/customer/ticket/store', [CustomerDashboardController::class, 'storeTicket'])->name('ticket.store');
Route::get('/customer/ticket/{ticketId}', [CustomerDashboardController::class, 'showTicketDetails'])->name('ticket.details');
});
