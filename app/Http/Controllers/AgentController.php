<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AgentController extends Controller
{
    public function index()
    {
        // Fetch all agents with their associated department and paginate them
        $agents = Agent::with('department')->paginate(10);

        // Fetch all departments to use in the 'Add New Agent' form
        $departments = Department::all();

        return view('supervisor.agent_list', compact('agents', 'departments'));
    }

    public function create()
    {
        // Fetch all departments to populate the department dropdown
        $departments = Department::all();

        return view('supervisor.create_agent', compact('departments'));
    }

    // Store the new agent in the database
    public function store(Request $request)
    {
        // Validate input data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:agents,email',
            'password' => 'required|string|min:8|confirmed', // Password confirmation validation
            'department_id' => 'required|exists:departments,id',
        ]);

        // Create the agent and hash the password
        Agent::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),  // Hash password
            'department_id' => $request->department_id,
        ]);

        // Redirect back with a success message
        return redirect()->route('agents.index')->with('success', 'Agent created successfully!');
    }
}
