<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\AgentDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerDashboardController;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\OTPController;
use App\Http\Controllers\SupervisorController;

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

    Route::get('/help-center', function () {
        return view('help_center'); // This loads the help_center.blade.php file
    })->name('help-center');
    

// Protect routes with authentication middleware
Route::middleware('role:customer')->group(function () {
    Route::get('/customer/profile', [CustomerDashboardController::class, 'showProfile'])->name('customer.profile');
    Route::get('/customer/profile/edit', [CustomerDashboardController::class, 'editProfile'])->name('customer.profile.edit');
    // Route to update the profile
    Route::put('/customer/profile/update', [CustomerDashboardController::class, 'updateProfile'])->name('customer.profile.update');

    // Route to show tickets
    Route::get('/customer-dashboard/tickets', [CustomerDashboardController::class, 'showTickets'])->name('customer.tickets');
    Route::get('/customer-dashboard/ticket/{ticketId}', [CustomerDashboardController::class, 'showTicketDetails'])->name('cus-ticket.details');
    Route::post('customer/ticket/{ticket}/reply', [CustomerDashboardController::class, 'storeReply'])->name('customer.ticket.reply');

    Route::get('/customer/ticket/create', [CustomerDashboardController::class, 'createTicket'])->name('ticket.create');
    Route::post('/customer/ticket/store', [CustomerDashboardController::class, 'storeTicket'])->name('ticket.store');

});


// Protect routes with authentication middleware
Route::middleware('role:supervisor')->group(function () {
    Route::get('/supervisor-dashboard', [SupervisorController::class, 'dashboard'])->name('supervisor.dashboard');
    Route::get('tickets', [SupervisorController::class, 'showAllTickets'])->name('tickets');
    Route::patch('/ticket/{ticket}/update-priority', [SupervisorController::class, 'updatePriority'])->name('ticket.update.priority');

    Route::patch('/ticket/{ticket}/update-assign', [SupervisorController::class, 'updateAssign'])->name('ticket.update.assign');
    // Route to view ticket details
    Route::get('/ticket/{ticket}', [SupervisorController::class, 'showTicketDetails'])->name('ticket.details');

    Route::get('/statuses', [SupervisorController::class, 'statuses'])->name('statuses');

    // Route to display tickets by a specific status
    Route::get('/statuses/{status}', [SupervisorController::class, 'showTicketsByStatus'])->name('status.tickets');

    // Route for showing the priority overview page
    Route::get('/priorities', [SupervisorController::class, 'showPriorities'])->name('priorities');
    // Route for showing tickets filtered by priority
    Route::get('/tickets/priority/{priority}', [SupervisorController::class, 'showTicketsByPriority'])->name('priority.tickets');

    Route::get('/agents', [AgentController::class, 'agentlist'])->name('agents.index');

    // Show the 'Add New Agent' form
Route::get('create-agent', [AgentController::class, 'create'])->name('create.agent');

// Store the new agent
Route::post('create-agent', [AgentController::class, 'store'])->name('store.agent');

// Show list of departments
Route::get('departments', [SupervisorController::class, 'showDepartments'])->name('departments.index');

// Create a new department (Form)
Route::get('departments/create', [SupervisorController::class, 'createDepartment'])->name('departments.create');

// Store the newly created department
Route::post('departments', [SupervisorController::class, 'storeDepartment'])->name('departments.store');
// Show the edit form for a department
Route::get('departments/{department}/edit', [SupervisorController::class, 'editDepartment'])->name('departments.edit');

// Update the department
Route::put('departments/{department}', [SupervisorController::class, 'updateDepartment'])->name('departments.update');

    Route::get('labels', [SupervisorController::class, 'labels'])->name('labels');
    Route::get('statuses', [SupervisorController::class, 'statuses'])->name('statuses');
    Route::get('priorities', [SupervisorController::class, 'priorities'])->name('priorities');
    Route::get('users', [SupervisorController::class, 'users'])->name('users');
    Route::get('user-roles', [SupervisorController::class, 'userRoles'])->name('user-roles');
    Route::get('settings', [SupervisorController::class, 'settings'])->name('settings');
    Route::get('translations', [SupervisorController::class, 'translations'])->name('translations');
});

// Route::middleware('role:agent')->get('/ticket/{ticketId}', [AgentController::class, 'showTicketDetails'])->name('ticket-details-show');


Route::middleware('role:agent')->group(function () {
    Route::get('/agent/dashboard', [AgentController::class, 'index'])->name('agent.dashboard');
    Route::get('/agent/tickets', [AgentController::class, 'showTickets'])->name('agent.tickets-show');
 
    Route::get('agent/ticket/{ticketId}', [AgentController::class, 'showTicketDetails'])->name('ticket-details-show');
    // This route handles the reply submission for the ticket
    Route::post('agent/ticket/{ticket}/reply', [AgentController::class, 'storeReply'])->name('ticket.reply');
});
