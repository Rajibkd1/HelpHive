<?php

use App\Http\Controllers\AgentDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerDashboardController;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\OTPController;
use App\Http\Controllers\SupervisorController;
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


// Protect routes with authentication middleware
Route::middleware('role:customer')->group(function () {
    Route::get('/customer/profile', [CustomerDashboardController::class, 'showProfile'])->name('customer.profile');
    Route::get('/customer/profile/edit', [CustomerDashboardController::class, 'editProfile'])->name('customer.profile.edit');
    // Route to update the profile
    Route::put('/customer/profile/update', [CustomerDashboardController::class, 'updateProfile'])->name('customer.profile.update');

    // Route to show tickets
    Route::get('/customer-dashboard/tickets', [CustomerDashboardController::class, 'showTickets'])->name('customer.tickets');

    Route::get('/customer/ticket/create', [CustomerDashboardController::class, 'createTicket'])->name('ticket.create');
    Route::post('/customer/ticket/store', [CustomerDashboardController::class, 'storeTicket'])->name('ticket.store');
    Route::get('/customer/ticket/{ticketId}', [CustomerDashboardController::class, 'showTicketDetails'])->name('ticket.details');
});


// Protect routes with authentication middleware
Route::middleware('role:supervisor')->group(function () {
    Route::get('/supervisor-dashboard', [SupervisorController::class, 'dashboard'])->name('supervisor.dashboard');
    Route::get('tickets', [SupervisorController::class, 'showAllTickets'])->name('tickets');
    Route::patch('/ticket/{ticket}/update-priority', [SupervisorController::class, 'updatePriority'])->name('ticket.update.priority');

    Route::patch('/ticket/{ticket}/update-assign', [SupervisorController::class, 'updateAssign'])->name('ticket.update.assign');
    // Route to view ticket details
Route::get('/ticket/{ticket}', [SupervisorController::class, 'showTicketDetails'])->name('ticket.details');

    Route::get('canned-replies', [SupervisorController::class, 'cannedReplies'])->name('canned-replies');
    Route::get('departments', [SupervisorController::class, 'departments'])->name('departments');
    Route::get('labels', [SupervisorController::class, 'labels'])->name('labels');
    Route::get('statuses', [SupervisorController::class, 'statuses'])->name('statuses');
    Route::get('priorities', [SupervisorController::class, 'priorities'])->name('priorities');
    Route::get('users', [SupervisorController::class, 'users'])->name('users');
    Route::get('user-roles', [SupervisorController::class, 'userRoles'])->name('user-roles');
    Route::get('settings', [SupervisorController::class, 'settings'])->name('settings');
    Route::get('translations', [SupervisorController::class, 'translations'])->name('translations');
});
