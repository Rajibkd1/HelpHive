<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupervisorDashboardController extends Controller
{
    // Apply the 'role:supervisor' middleware to this controller method
    public function index()
    {
        return view('supervisor.supervisor-dashboard');  // Return the supervisor dashboard view
    }
}
