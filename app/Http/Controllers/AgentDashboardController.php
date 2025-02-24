<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgentDashboardController extends Controller
{
    // Apply the 'role:agent' middleware to this controller method
    public function index()
    {
        return view('agent.agent-dashboard');  // Return the agent dashboard view
    }
}
