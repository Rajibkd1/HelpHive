<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupervisorDashboardController extends Controller
{
    public function index()
    {
        $user = session('user'); // Retrieve the user data from session
        return view('supervisor.dashboard', compact('user')); // Pass the user data to the view
    }
}
